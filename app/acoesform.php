<?php
namespace formulario;

class AcoesForm {

    private $pdo;
    public function __construct() {
        try {
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            // Conexão com o banco de dados usando PDO
            $this->pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function pegarlocais() {
        try {
            $sql = "SELECT locais FROM locais";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function selecionarFacilitadores() {
        try {
            $sql = "SELECT * FROM facilitadores";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function puxarId() {
        try {
            $sql = "SELECT id FROM assunto ORDER BY id DESC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            throw $e;
        }
    } 

    public function pegarfacilitador() {
        try {
            $sql = "SELECT id, nome_facilitador, matricula FROM facilitadores ORDER BY nome_facilitador ASC ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        } catch (\PDOException $e) {
            throw $e;
        }
    } 
        
    public function obterUltimoRegistro() {
        try {
            $sql = "SELECT tema, hora_inicial, hora_termino, data_solicitada, objetivo, local 
                    FROM assunto 
                    ORDER BY data_registro DESC 
                    LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $row;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            throw $e;
        }
    }



    public function pegarUltimaAta() {
        try {
            $sql = "SELECT  tema, hora_inicial, hora_termino, data_solicitada, objetivo, local 
                    FROM assunto 
                    ORDER BY data_registro DESC 
                    LIMIT 1";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $_SESSION['conteudo'] = $row["tema"];
                $_SESSION['horainicio'] = substr($row["hora_inicial"], 0, 5);
                $_SESSION['horaterm'] = substr($row["hora_termino"], 0, 5);
                $_SESSION['data'] = substr($row["data_solicitada"], 0, 10);
                $_SESSION['objetivoSelecionado'] = $row["objetivo"];
                $_SESSION['local'] = $row["local"];

            } else {
                echo "Nenhum resultado encontrado";
            }
        } catch (\PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }
    public function puxandoUltimosFacilitadores() {
        try {
            
            $sql1 = "SELECT id FROM assunto ORDER BY id DESC LIMIT 1";
            $stmt1 = $this->pdo->prepare($sql1);
            $stmt1->execute();
            $lastAtaId = $stmt1->fetchColumn();
    
            // Em seguida, usamos esse ID para obter os registros da tabela de associação
            $sql2 = "SELECT id_ata, facilitadores FROM ata_has_fac WHERE id_ata = ?";
            $stmt2 = $this->pdo->prepare($sql2);
            $stmt2->execute([$lastAtaId]);
            $resultadosAtaFacilitadores = $stmt2->fetchAll(\PDO::FETCH_ASSOC);
    
            // Agora, usamos os IDs dos facilitadores para obter suas informações
            $facilitadores = [];

            foreach ($resultadosAtaFacilitadores as $resultado) {

                $facilitadorId = $resultado['facilitadores'];
                $sql3 = "SELECT id, matricula, nome_facilitador FROM facilitadores WHERE id = ?";
                $stmt3 = $this->pdo->prepare($sql3);
                $stmt3->execute([$facilitadorId]);
                $facilitadorInfo = $stmt3->fetch(\PDO::FETCH_ASSOC);

                if ($facilitadorInfo) {
                    $facilitadores[] = $facilitadorInfo;
                }
            }
    
            return $facilitadores;
        } catch (\PDOException $e) {
            throw $e;
        }
    }
    
    public function puxandoUltimosParticipantes($id_ata) {
        $sql = "SELECT F.nome_facilitador
                FROM facilitadores as F
                INNER JOIN ata_has_fac as AF ON F.id = AF.facilitadores
                WHERE AF.id_ata = :id_ata";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_ata', $id_ata, \PDO::PARAM_INT);
        $stmt->execute();
        
        $participantes = []; // Inicializa um array para armazenar os nomes dos participantes
    
        // Itera sobre os resultados da consulta e armazena os nomes dos participantes no array
        while ($row = $stmt->fetchColumn()) {
            $participantes[] = $row; // Adiciona o nome do participante ao array
        }
    
        return $participantes; // Retorna o array de participantes
    }
    

    

    public function pegarParticipantes($id_ata) {
        $sql = "SELECT F.nome_facilitador
                FROM facilitadores as F
                INNER JOIN ata_has_fac as AF ON F.id = AF.facilitadores
                WHERE AF.id_ata = :id_ata";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_ata', $id_ata, \PDO::PARAM_INT);
        $stmt->execute();
        
        $participantes = ''; // Inicializa a string de participantes
    
        // Itera sobre os resultados da consulta e concatena os nomes dos participantes
        while ($row = $stmt->fetchColumn()) {
            $participantes .= $row . ', '; // Concatena o nome do participante
        }
    
        // Remove a vírgula extra no final da string
        $participantes = rtrim($participantes, ', ');
    
        // Retorna a string contendo os nomes dos participantes
        return $participantes;
    }
    
    public function buscarDeliberacoesPorIdAta($id_ata) {
        try {
            $sql = "SELECT d.deliberacoes, IFNULL(f.nome_facilitador, 'N/A') AS deliberador
                    FROM deliberacoes d
                    LEFT JOIN facilitadores f ON d.deliberadores = f.id
                    WHERE d.id_ata = :id_ata";
    
            // Prepara a consulta
            $stmt = $this->pdo->prepare($sql);
            
            // Vincula o parâmetro :id_ata com o valor fornecido
            $stmt->bindParam(':id_ata', $id_ata, \PDO::PARAM_INT);
            
            // Executa a consulta
            $stmt->execute();
            
            // Retorna os resultados como um array associativo contendo as deliberações e os nomes dos deliberadores
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Em caso de erro, lança uma exceção para que o erro possa ser tratado
            throw $e;
        }
    }
    public function apagarDeliberacoesPorIdAta($id_ata) {
        try {
            // Prepara a consulta para excluir as deliberações por ID da ATA
            $sql = "DELETE FROM deliberacoes WHERE id_ata = :id_ata";
    
            // Prepara a consulta
            $stmt = $this->pdo->prepare($sql);
    
            // Vincula o parâmetro :id_ata com o valor fornecido
            $stmt->bindParam(':id_ata', $id_ata, \PDO::PARAM_INT);
    
            // Executa a consulta
            $stmt->execute();
    
            // Retorna true para indicar que as deliberações foram excluídas com sucesso
            return true;
        } catch (\PDOException $e) {
            // Em caso de erro, lança uma exceção para que o erro possa ser tratado
            throw $e;
        }
    }
    
    public function excluirParticipantePorIdAta($id_ata, $nome_participante) {
        try {
            // Primeiro, encontrar o ID do participante pelo nome
            $sql = "SELECT id FROM facilitadores WHERE nome_facilitador = :nome_participante";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome_participante', $nome_participante, \PDO::PARAM_STR);
            $stmt->execute();
            $participante_id = $stmt->fetchColumn();
    
            if ($participante_id) {
                // Prepara a consulta para excluir o participante da ata
                $sql = "DELETE FROM participantes WHERE id_ata = :id_ata AND participantes = :participante_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id_ata', $id_ata, \PDO::PARAM_INT);
                $stmt->bindParam(':participante_id', $participante_id, \PDO::PARAM_INT);
                $stmt->execute();
    
                // Retorna verdadeiro se a exclusão for bem-sucedida
                return true;
            } else {
                return false; // Retorna falso se o participante não foi encontrado
            }
        } catch (\PDOException $e) {
            // Em caso de erro, lança uma exceção para que o erro possa ser tratado
            throw $e;
        }
    }
    
    
    public function buscarParticipantesPorIdAta($id_ata) {
        try {
            $sql = "SELECT F.nome_facilitador
                    FROM facilitadores AS F
                    WHERE F.id IN (SELECT participantes FROM participantes WHERE id_ata = :id_ata)";
    
            // Prepara a consulta
            $stmt = $this->pdo->prepare($sql);
            
            // Vincula o parâmetro :id_ata com o valor fornecido
            $stmt->bindParam(':id_ata', $id_ata, \PDO::PARAM_INT);
            
            // Executa a consulta
            $stmt->execute();
            
            // Retorna os resultados como um array de strings contendo os nomes dos facilitadores
            return $stmt->fetchAll(\PDO::FETCH_COLUMN);
        } catch (\PDOException $e) {
            // Em caso de erro, lança uma exceção para que o erro possa ser tratado
            throw $e;
        }
    }
 
        public function pegandoTudo(){
            try {
                $sql = "SELECT 
                            A.id,
                            DATE_FORMAT(A.data_solicitada, '%d/%m/%Y') as data_solicitada_formatada,
                            A.objetivo,
                            GROUP_CONCAT(F.nome_facilitador SEPARATOR ', ') as facilitador,
                            A.tema,
                            A.local,
                            A.status
                        FROM 
                            assunto as A
                        INNER JOIN 
                            ata_has_fac as B ON A.id = B.id_ata
                        INNER JOIN 
                            facilitadores as F ON B.facilitadores = F.id
                        GROUP BY 
                            A.id";
                
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                
                // Retorna todos os resultados
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                throw $e;
            }
        }
        
      public  $sql4 = "SELECT 
        part.id_ata,
        part.participantes,
        fac.nome_facilitador as participante
    FROM 
        assunto as assu
    INNER JOIN 
        participantes as part ON part.id_ata = assu.id
    INNER JOIN 
        facilitadores as fac ON fac.id = part.participantes
    WHERE 
        part.id_ata = 558";
    
    
       }
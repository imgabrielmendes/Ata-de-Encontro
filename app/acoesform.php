<?php
namespace formulario;

//include ("conexao.php");

$puxarclas = new AcoesForm;
$puxarfun=$puxarclas->selecionarfacilitador();

$acoesForm = new AcoesForm();
$resultados = $acoesForm->selecionarFacilitadores();
$apenascargos= $acoesForm->pegarfacilitador();
//print_r($apenascargos);

class AcoesForm {

    public function pegarlocais(){

        
        try {
                   
            //ARRUMAR UM JEITO DE DIMINUIR ISSO
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            // Conexão com o banco de dados usando PDO
            $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            //SELECT * FROM facilitadores
            $sql = "SELECT locais FROM locais;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //print_r($sql);

            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }

    }

    public function selecionarFacilitadores() {
        try {
        
            include_once ("database.php");

            //ARRUMAR UM JEITO DE DIMINUIR ISSO
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            // Conexão com o banco de dados usando PDO
            $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM facilitadores";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function selecionarfacilitador() {}
    
    //FUNÇÃO CADASTRAR DA MODAL
    public function cadastrarfacilitador($nomefacilitador, $email, $cargo)
    {

        $sql = "INSERT INTO facilitadores (nome_facilitador, email_facilitador, cargo) VALUES (?, ?, ?)";
        $stmt = Conexao::getConnMy()->prepare($sql);
        $stmt->bindValue(1, $nomefacilitador['nome_facilitador']);
        $stmt->bindValue(2, $email['email_facilitador']);
        $stmt->bindValue(3, $cargo['cargo']);
        
    }
    
    public function pegarfacilitador() {

        try {
                   
            //ARRUMAR UM JEITO DE DIMINUIR ISSO
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            // Conexão com o banco de dados usando PDO
            $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            //SELECT * FROM facilitadores
            $sql = "SELECT nome_facilitador , cargo FROM facilitadores;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //print_r($sql);

            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }    
    

    public function pegarcoordenador() {

        try {
                   
            //ARRUMAR UM JEITO DE DIMINUIR ISSO
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            // Conexão com o banco de dados usando PDO
            $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            //SELECT * FROM facilitadores
            $sql = "SELECT nome_facilitador , cargo FROM facilitadores WHERE cargo = 'Coordenador';";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //print_r($sql);

            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
            
    }

    function obterUltimoRegistro() {
        // ARRUMAR UM JEITO DE DIMINUIR ISSO
        $dbhost = 'localhost';
        $dbname = 'atareu';
        $dbuser = 'root';
        $dbpass = '';
    
        try {
            // Conexão com o banco de dados usando PDO
            $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
            // Consulta SQL para selecionar os últimos valores da tabela
            $sql = "SELECT facilitador, tema, hora_inicial, hora_termino, data_solicitada, objetivo, local 
                    FROM assunto 
                    ORDER BY data_registro DESC 
                    LIMIT 1";
                    
    
            // Preparar e executar a consulta
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
    
            // Verificar se há linhas retornadas
            if ($stmt->rowCount() > 0) {
                // Exibir os dados encontrados
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $row; // Retornar os dados encontrados
            } else {
                return false; // Se nenhum registro for encontrado, retornar false
            }
    
            // Fechar a conexão
            $pdo = null;
        } catch (\PDOException $e) {
            // Se houver um erro, lançar uma exceção
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

  }



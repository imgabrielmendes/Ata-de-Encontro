<?php

namespace formulario;

// Exemplo de utilização:
$acoesForm = new AcoesForm();
$resultados = $acoesForm->selecionarFacilitadores();

// Exibe os resultados
print_r($resultados);

class AcoesForm {

    public function selecionarFacilitadores() {
        try {
            // Configurações do banco de dados
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            include_once ("database.php");
            
            // Conexão com o banco de dados usando PDO
            $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);

            // Configura para que o PDO lance exceções em caso de erro
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Query SQL para selecionar todos os registros da tabela "facilitadores"
            $sql = "SELECT * FROM facilitadores";

            // Prepara a query
            $stmt = $pdo->prepare($sql);

            // Executa a query
            $stmt->execute();

            // Obtém os resultados
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Retorna os resultados
            return $resultados;
        } catch (\PDOException $e) {
            // Em caso de erro, lança a exceção
            throw $e;
        }
    }

  


    public function cadastrarfacilitador($nomefacilitador, $email, $cargo)
    {

        $sql = "INSERT INTO facilitadores (nome_facilitador, email_facilitador, cargo) VALUES (?, ?, ?)";
        $stmt = Conexao::getConnMy()->prepare($sql);
        $stmt->bindValue(1, $nomefacilitador['nome_facilitador']);
        $stmt->bindValue(2, $email['email_facilitador']);
        $stmt->bindValue(3, $cargo['cargo']);
        
    }
    
    public function pegarfacilitador() {

        $sql = "SELECT atareu as nome_facilitador from facilitadores order by facilitadores asc;";
        
        $stmt = Conexao::getConnMy()->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        print_r($resultado);

        return $resultado;

    }

  }



<?php

namespace formulario;


$acoesForm = new AcoesForm();
$resultados = $acoesForm->selecionarFacilitadores();
print_r($resultados);

class AcoesForm {

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

  


    public function cadastrarfacilitador($nomefacilitador, $email, $cargo)
    {

        $sql = "INSERT INTO facilitadores (nome_facilitador, email_facilitador, cargo) VALUES (?, ?, ?)";
        $stmt = Conexao::getConnMy()->prepare($sql);
        $stmt->bindValue(1, $nomefacilitador['nome_facilitador']);
        $stmt->bindValue(2, $email['email_facilitador']);
        $stmt->bindValue(3, $cargo['cargo']);
        
    }
    
    public function pegarfacilitador() {

        $sql = "SELECT atareu FROM facilitadores;";
        
        $stmt = Conexao::getConnMy()->prepare($sql);
        //$stmt->execute();

        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        print_r($resultado);

        return $resultado;

    }

  }



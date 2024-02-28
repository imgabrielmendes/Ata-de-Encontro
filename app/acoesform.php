<?php
namespace formulario;

//include ("conexao.php");

$puxarclas = new AcoesForm;
$puxarfun=$puxarclas->selecionarfacilitador();

$acoesForm = new AcoesForm();
$resultados = $acoesForm->selecionarFacilitadores();

$apenascargos= $acoesForm->pegarfacilitador();
print_r($apenascargos);

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

    public function cadastrarata(){
        // INSERIR A DATA, TÍTULO E DESCRIÇÃO DA ATA PARA A TABELA ASSUNTO
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
            $sql = "SELECT nome_facilitador , cargo FROM facilitadores WHERE cargo = 'ADM';";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            print_r($sql);

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

            print_r($sql);

            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
            
    }

  }



<?php
namespace formulario;

class FuncoesAdmin {

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

    function consultarValores() {
        // Aqui você realiza a consulta SQL
        $sql = "SELECT * FROM assunto WHERE id = $id";
    
        // Executar a consulta e obter o resultado
        $resultado = mysqli_query($sql);
    
        // Verificar se a consulta retornou algum resultado
        if ($resultado) {
            // Extrair os valores das variáveis do resultado da consulta
            $row = mysqli_fetch_assoc($resultado);
            
            $datasolicitada = $row['data_solicitada'];
            $tema = $row['tema'];
            $objetivo = $row['objetivo'];
            $password = $row['local'];
            $horainic = $row['hora_inicial'];
            $horaterm = $row['hora_termino'];
    
            // Retornar um array associativo com os valores
            return [
                'datasolicitada' => $datasolicitada,
                'tema' => $tema,
                'objetivo' => $objetivo,
                'password' => $password,
                'horainic' => $horainic,
                'horaterm' => $horaterm
            ];
        } else {
            // Tratar caso a consulta não retorne resultados
            return null;
        }
    }

}

?>

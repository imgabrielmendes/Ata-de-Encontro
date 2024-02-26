<?php
namespace App\Models; // Definindo o namespace para a classe

class Conexao
{
    private static $instanceMy; // Variável para armazenar a instância PDO para MySQL
    private static $instanceSrv; // Variável para armazenar a instância PDO para SQL Server

    /**
     * Obtém a conexão PDO para MySQL.
     *
     * @return \PDO A instância PDO para MySQL.
     * @throws \PDOException Em caso de erro na conexão.
     */
    public static function getConnMy()
    {
        if (!isset(self::$instanceMy)) {
            try {
                // Configurando a conexão PDO para MySQL
                self::$instanceMy = new \PDO("mysql:host=localhost;dbname=atareu;charset=utf8", "root", '');
                self::$instanceMy->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $exception) {
                throw $exception;
            }
        }
        return self::$instanceMy;
    }

    /**
     * Obtém a conexão PDO para SQL Server.
     *
     * @return resource A instância de conexão PDO para SQL Server.
     * @throws \PDOException Em caso de erro na conexão.
     */
    public static function getConnSrv()
    {
        if (!isset(self::$instanceSrv)) {
            $host = "localhost";
            $user = Array("UID" => "root", "PWD" => '', "Database" => "atareu", "CharacterSet" => "UTF-8");

            // Conectando ao SQL Server usando sqlsrv_connect
            self::$instanceSrv = sqlsrv_connect($host, $user);

            if (!self::$instanceSrv) {
                echo "A conexão não pôde ser estabelecida.<br />";
                die(print_r(sqlsrv_errors(), true));
            }
        }
        return self::$instanceSrv;
    }
}

?>

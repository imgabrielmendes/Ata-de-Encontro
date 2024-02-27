<?php
namespace formulario;
use \PDOException;

echo "mostrando o local do banco";

$dbhost = "localhost";
$dbname = "atareu";
$dbuser = "root";
$dbpass = "";

// Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Conexão deu ruim: " . mysqli_connect_error());
}

class Conexao{

    private static $instanceMy;
    private static $instanceSrv;
    


    public static function getConnMy(){
        if(!isset(self::$instanceMy)){
            try
            {
                self::$instanceMy = new \PDO("mysql:host=localhost;dbname=atareu;charset=utf8","root", '');
                self::$instanceMy->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception)
            {
                throw $exception;
            }
        }
        return self::$instanceMy;
    }
    public static function getConnSrv(){
        if(!isset(self::$instanceSrv)){
            $host = "localhost,50000";
            //$user = Array("UID" => "smart", "PWD" => 'SMART2018#', "Database" => "SMART","CharacterSet" => "UTF-8");
             $user = Array("UID" => "root", "PWD" => 'root ', "atareu" => "SMART","CharacterSet" => "UTF-8");
            
            self::$instanceSrv = sqlsrv_connect($host, $user);

            if(!self::$instanceSrv){
                 echo "Conexão deu ruim.<br />";
                 die(print_r(sqlsrv_errors(), true));
            }
        }
        return self::$instanceSrv;
    }

}

?>
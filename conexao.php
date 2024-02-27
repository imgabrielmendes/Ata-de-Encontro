<?php
namespace formulario;

echo "mostrando o local do banco";

$servername = "localhost";
$database = "atareu";
$username = "root";
$dbpass = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Conexão deu ruim: " . mysqli_connect_error());
}
echo "Conexão deu bom";
mysqli_close($conn);


class Conexao{

    private static $instanceMy;
    private static $instanceSrv;
    


    public static function getConnMy(){
        if(!isset(self::$instanceMy)){
            try
            {
                self::$instanceMy = new \PDO("mysql:host=10.1.1.57;dbname=medicos_ps;charset=utf8","bi_user", 'qwe456*');
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
            $host = "10.1.3.195,50000";
            //$user = Array("UID" => "smart", "PWD" => 'SMART2018#', "Database" => "SMART","CharacterSet" => "UTF-8");
             $user = Array("UID" => "root", "PWD" => '', "Database" => "atareu","CharacterSet" => "UTF-8");
            
            self::$instanceSrv = sqlsrv_connect($host, $user);

            if(!self::$instanceSrv){
                 echo "Connection could not be established.<br />";
                 die(print_r(sqlsrv_errors(), true));
            }
        }
        return self::$instanceSrv;
    }

}

?>
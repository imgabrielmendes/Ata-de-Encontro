<?php
namespace formulario;

use PDO;
use PDOException;

class ChartsFunc {
    private $pdo;

    public function __construct() {
        try {
            $dbhost = 'localhost';
            $dbname = 'atareu';
            $dbuser = 'root';
            $dbpass = '';

            $this->pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    private function getMonthNumber($mesClicadoAbbr) {
        $meses = array(
            "Jan" => 1,
            "Feb" => 2,
            "Mar" => 3,
            "Apr" => 4,
            "May" => 5,
            "Jun" => 6,
            "Jul" => 7,
            "Aug" => 8,
            "Sep" => 9,
            "Oct" => 10,
            "Nov" => 11,
            "Dec" => 12
        );

        return $meses[$mesClicadoAbbr] ?? null;
    }

    public function pegandoTudo() {
        try {
            $mesClicadourl = $_GET['mes'] ?? null;

            if ($mesClicadourl) {
                $mesClicado = $this->getMonthNumber($mesClicadourl);
                
                if ($mesClicado) {
                    $sql = "SELECT * FROM assunto AS ass 
                            WHERE MONTH(ass.data_registro) = :mesClicado 
                            GROUP BY ass.data_registro";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(':mesClicado', $mesClicado, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    // throw new \Exception("Mês inválido fornecido.");
                    $mesClicado=null;

                }
            } else {
                // throw new \Exception("Nenhum mês foi fornecido.");
                $mesClicado=null;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

// try {
//     $chartsFunc = new ChartsFunc();
//     $data = $chartsFunc->pegandoTudo();
//     echo json_encode($data);
// } catch (\Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }
?>

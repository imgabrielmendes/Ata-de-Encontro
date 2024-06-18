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
            "Fev" => 2,
            "Mar" => 3,
            "Abr" => 4,
            "Mai" => 5,
            "Jun" => 6,
            "Jul" => 7,
            "Ago" => 8,
            "Set" => 9,
            "Out" => 10,
            "Nov" => 11,
            "Dez" => 12
        );

        return $meses[$mesClicadoAbbr] ?? null;
    }

    public function pegandoTudo() {
        try {
            $mesClicadourl = $_GET['mes'] ?? null;
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
                    $sql = "SELECT * FROM assunto AS ass 
                    WHERE MONTH(ass.data_registro) = :mesClicado 
                    GROUP BY ass.data_registro";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(':mesClicado', $mesClicado, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function pegarQuantidadeAberta()
    {
        try {
            if (isset($_GET['mes'])) {
                $monthMap = array(
                    "Jan" => 1,
                    "Fev" => 2,
                    "Mar" => 3,
                    "Abr" => 4,
                    "Mai" => 5,
                    "Jun" => 6,
                    "Jul" => 7,
                    "Ago" => 8,
                    "Set" => 9,
                    "Out" => 10,
                    "Nov" => 11,
                    "Dez" => 12
                );
                $mesClicadoAbbr = $_GET['mes'];
                $mesClicado = $monthMap[$mesClicadoAbbr];
                $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'ABERTA' AND MONTH(ass.data_solicitada)=$mesClicado";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada

                return $resultado;

            } else {
                $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'ABERTA' AND MONTH(ass.data_solicitada)=$mesClicado";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada

                return $resultado;
            }
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function pegarQuantidadeFechada()
    {
        try {
            if (isset($_GET['mes'])) {
                $monthMap = array(
                    "Jan" => 1,
                    "Fev" => 2,
                    "Mar" => 3,
                    "Abr" => 4,
                    "Mai" => 5,
                    "Jun" => 6,
                    "Jul" => 7,
                    "Ago" => 8,
                    "Set" => 9,
                    "Out" => 10,
                    "Nov" => 11,
                    "Dez" => 12
                );
                $mesClicadoAbbr = $_GET['mes'];
                $mesClicado = $monthMap[$mesClicadoAbbr];
                $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'FECHADA' AND MONTH(ass.data_solicitada)=$mesClicado";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada

                return $resultado;
                
            } else {
                $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'FECHADA' AND MONTH(ass.data_solicitada)=$mesClicado";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada

                return $resultado;
            }
        } catch (\PDOException $e) {
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

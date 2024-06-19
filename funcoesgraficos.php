<?php
namespace formulario;

use PDO;
use PDOException;

class ChartsFunc
{

    private $pdo;

    public function __construct()
    {
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

    private function getMonthNumber($mesClicadoAbbr)
    {
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

    public function pegandoTudo()
    {
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
                $mesClicado = null;

                $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'ABERTA'";

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
                $mesClicado = null;
                $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'FECHADA'";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada

                return $resultado;
            }
        } catch (\PDOException $e) {
            throw $e;
        }
    }
    public function pegarObjetivo()
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

                $sql = "SELECT objetivo, COUNT(id) as quantidade 
                        FROM atareu.assunto 
                        WHERE MONTH(data_solicitada) = :mesClicado 
                        GROUP BY objetivo";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':mesClicado', $mesClicado, \PDO::PARAM_INT);
            } else {
                $sql = "SELECT objetivo, COUNT(id) as quantidade 
                        FROM atareu.assunto 
                        GROUP BY objetivo";
                $stmt = $this->pdo->prepare($sql);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function pegarLocal()
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

                $sql = "SELECT local, COUNT(id) as quantidade FROM atareu.assunto WHERE MONTH(data_solicitada) = :mesClicado  GROUP BY local";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':mesClicado', $mesClicado, \PDO::PARAM_INT);
            } else {
                $sql = "SELECT local, COUNT(id) as quantidade FROM atareu.assunto GROUP BY local";

                $stmt = $this->pdo->prepare($sql);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function pegar5()
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

                $sql = "SELECT *
FROM (
    SELECT 
        MONTH(assunto.data_solicitada) AS mes,
        assunto.id,
        assunto.data_solicitada,
        assunto.objetivo,
        ROW_NUMBER() OVER(PARTITION BY MONTH(assunto.data_solicitada) ORDER BY assunto.data_solicitada DESC) as row_num
    FROM atareu.ata_has_fac as has
    INNER JOIN atareu.assunto as assunto ON has.id_ata = assunto.id
) AS subquery
WHERE row_num <= 5 AND MONTH(data_solicitada) = :mesClicado 
ORDER BY mes DESC, data_solicitada DESC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':mesClicado', $mesClicado, \PDO::PARAM_INT);
            } else {
                $sql = "SELECT *
FROM (
    SELECT 
        MONTH(assunto.data_solicitada) AS mes,
        assunto.id,
        assunto.data_solicitada,
        assunto.objetivo,
        ROW_NUMBER() OVER(PARTITION BY MONTH(assunto.data_solicitada) ORDER BY assunto.data_solicitada DESC) as row_num
    FROM atareu.ata_has_fac as has
    INNER JOIN atareu.assunto as assunto ON has.id_ata = assunto.id
) AS subquery
WHERE row_num <= 5
ORDER BY mes DESC, data_solicitada DESC;
";

                $stmt = $this->pdo->prepare($sql);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }



    public function faciliAta()
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

                $sql = "SELECT 
    facili.id AS id_facilitador,
    facili.nome_facilitador AS facilitador,
    COUNT(ata.id_ata) AS numero_de_atas
FROM 
    atareu.ata_has_fac AS ata
INNER JOIN 
    atareu.assunto AS assunto ON ata.id_ata = assunto.id
INNER JOIN 
    atareu.facilitadores AS facili ON ata.facilitadores = facili.id
 WHERE MONTH(data_solicitada) = :mesClicado GROUP BY 
    facili.id, facili.nome_facilitador
ORDER BY 
    numero_de_atas DESC";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':mesClicado', $mesClicado, \PDO::PARAM_INT);
            } else {
                $sql = "SELECT 
    facili.id AS id_facilitador,
    facili.nome_facilitador AS facilitador,
    COUNT(ata.id_ata) AS numero_de_atas
FROM 
    atareu.ata_has_fac AS ata
INNER JOIN 
    atareu.assunto AS assunto ON ata.id_ata = assunto.id
INNER JOIN 
    atareu.facilitadores AS facili ON ata.facilitadores = facili.id
GROUP BY 
    facili.id, facili.nome_facilitador
ORDER BY 
    numero_de_atas DESC";

                $stmt = $this->pdo->prepare($sql);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }




    public function pegarPorDia()
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

                $sql = "SELECT DATE(assunto.data_solicitada) AS data, COUNT(*) AS quantidade_ata FROM atareu.ata_has_fac as has INNER JOIN atareu.assunto as assunto ON has.id_ata = assunto.id  WHERE MONTH(data_solicitada) = :mesClicado GROUP BY DATE(assunto.data_solicitada)";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':mesClicado', $mesClicado, \PDO::PARAM_INT);
            } else {
                $sql = "SELECT DATE(assunto.data_solicitada) AS data, COUNT(*) AS quantidade_ata FROM atareu.ata_has_fac as has INNER JOIN atareu.assunto as assunto ON has.id_ata = assunto.id GROUP BY DATE(assunto.data_solicitada)";

                $stmt = $this->pdo->prepare($sql);
            }

            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $resultados;

        } catch (\PDOException $e) {
            throw $e;
        }
    }



    // FUNÇAO USADA PARA A QUANTIDADE DE FACILITADORES: QUANTOS/MÊS , QUEM+QUANT.DE ATAS 
    public function pegandoFacilitadores()
    {
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
            $sql = "SELECT 
                    ass.id as idassunto,
                    ahf.id_ata,
                    ahf.facilitadores,

                    fac.id as idparticipantes,
                    fac.nome_facilitador as nomesparticipantes,
                    count(ahf.id_ata) as participancoes

                    from atareu.ata_has_fac as ahf
                        INNER JOIN atareu.facilitadores as fac ON fac.id = ahf.facilitadores
                        INNER JOIN atareu.assunto as ass ON ass.id = ahf.id_ata
                        WHERE 
                        MONTH(ass.data_registro) = $mesClicado;
                    ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada

            return $resultado;

        } else {

            $mesClicado = null;

            // $sql = "SELECT COUNT(*) AS quantidade FROM assunto as ass WHERE status = 'ABERTA' AND MONTH(ass.data_solicitada)=$mesClicado";
            // $stmt = $this->pdo->prepare($sql);
            // $stmt->execute();
            // $resultado = $stmt->fetchColumn(); // Apenas uma coluna é retornada
            // return $resultado;
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



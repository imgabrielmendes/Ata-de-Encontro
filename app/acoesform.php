<?php

namespace App\Models;

class AcoesForm {

        public function selecionarfacilitador() {

        $sql = "SELECT facilitadores as nome_facilitador from facilitadores;";
        
        try {
            $sqlconnect = Conexao::getConnSrv();
            $stmt = sqlsrv_query($sqlconnect, $sql);

            $listafacil = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $listafacil[] = $row;
            }

            // Mova a impressão para fora do bloco try-catch
            print_r($listafacil);
            return $listafacil;
        } catch (PDOException $e) {
            throw $e;
        }

        // A query SQL não será executada porque está após o return
        print_r($sql);
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



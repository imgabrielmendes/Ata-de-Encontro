<?php 
include ("conexao.php");

$linkando = "estou puxando a página";

  class AcoesForm {

      public function selecionarfacilitador() {

          $sql = "SELECT atareu as nome_facilitador from facilitadores;";
          
          try {
            $sqlconnect = conexao::getConnSrv();
            $stmt = sqlsrv_query($sqlconnect, $sql);

            $listafacil=[];
            while ($row = sqlsrv_fetch_array($stmt, sqlsrv_fetch_assoc)) {
              $listafacil[] = $row;
            }
            return $listafacil;
          } catch (PDOException $e) {
            throw $e;
          }

      
        print_r($sql);
    }


    public function pegarfacilitador() {

        $sql = "SELECT atareu as nome_facilitador from facilitadores order by facilitadores asc;";
        
        $stmt = Conexao::getConnMy()->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // print_r($resultado);

        return $resultado;

    }

    //* public function solicitarAta($){

      //  $sql = "INSERT INTO facilitadores () VALUES (?, ?, ?, ?)";
       // $stmt = Conexao::getConnMy()->prepare($sql);
        //$stmt->bindValue(1, $['']);
       // $stmt->bindValue(2, $['']);
       // $stmt->bindValue(3, $['']);
       // $stmt->bindValue(4, $['']);//
   // } 

  }



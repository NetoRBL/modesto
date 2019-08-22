<?php

  class Conexao {

    private $host = "localhost";
    private $usuario = "root"; 
    private $senha = "";
    private $nomeBanco = "modesto";

    public function conecta(){
      try{
       $conexao = new PDO('mysql:host='.$this->host.';dbname='.$this->nomeBanco.';charset=utf8', $this->usuario, $this->senha);
       return $conexao;
      } 
      catch(PDOException $e){
        //echo $e->getMessage();
        return false;
      }
    }
  }
$conexao = new Conexao();
$pdo = $conexao->conecta();
?>
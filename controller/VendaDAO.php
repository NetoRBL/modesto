<?php

	function cadastrar_produto($venda){
		try{
			require_once("../config/conexao.php");
			$sql ="INSERT INTO venda (valor, produto, data, hora, tipo) VALUES (:valor, :produto, :data, :hora, :tipo)";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$inserir = $pdo->prepare($sql);
			$inserir->bindValue(':valor',$venda->getValor());
			$inserir->bindValue(':produto',$venda->getProduto());
			$inserir->bindValue(':data',$venda->getData());
			$inserir->bindValue(':hora',$venda->getHora());
			$inserir->bindValue(':tipo',$venda->getTipo());
			$inserir->execute();
			header("location:../view/pages/vendas.php");
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}
	
?>
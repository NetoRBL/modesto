<?php

	function listar_vendas_produtos(){
		try{
			require_once("../../config/conexao.php");
			$sql ="SELECT * FROM venda WHERE tipo = 0";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->execute();
			$resultado = $listar->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function listar_vendas_impressoes(){
		try{
			require_once("../../config/conexao.php");
			$sql ="SELECT * FROM venda WHERE tipo = 1";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->execute();
			$resultado = $listar->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function cadastrar_venda($venda){
		try{
			require_once("../config/conexao.php");
			$sql ="INSERT INTO venda (valor, produto, qtd, data, hora, tipo) VALUES (:valor, :produto, :qtd, :data, :hora, :tipo)";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$inserir = $pdo->prepare($sql);
			$inserir->bindValue(':valor',$venda->getValor());
			$inserir->bindValue(':produto',$venda->getProduto());
			$inserir->bindValue(':qtd',$venda->getQtd());
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
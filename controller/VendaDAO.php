<?php

class vendaDAO{
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

	function listar_ganho_impressoes(){
		try{
			$data = date('d') . '/' . date('m') . '/' . date('Y');

			require_once("../config/conexao.php");
			$sql ="SELECT SUM(valor) as valor_total_impressão FROM venda WHERE tipo = 1 AND data = :data";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->bindValue(':data', $data);
			$listar->execute();
			$resultado = $listar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}
	function caixa(){
		try{
			$data = date('d') . '/' . date('m') . '/' . date('Y');

			require_once("../config/conexao.php");
			$sql ="SELECT SUM(valor) as caixa FROM venda WHERE data = :data";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->bindValue(':data', $data);
			$listar->execute();
			$resultado = $listar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function listar_tudo(){
		try{
			$data = date('d') . '/' . date('m') . '/' . date('Y');

			require_once("../config/conexao.php");
			$sql ="SELECT SUM(valor) as caixa FROM venda WHERE data = :data";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->bindValue(':data', $data);
			$listar->execute();
			$resultado = $listar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function listar_relatorio_vendas($mes, $ano){
		try{
			if ($mes < 10) {
				$data = '%/0' . $mes . '/' . $ano;
			}else{
				$data = '%/' . $mes . '/' . $ano;
			}
			

			require_once("../config/conexao.php");
			$sql ="SELECT * FROM venda WHERE  data LIKE :data";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->bindValue(':data', $data);
			$listar->execute();
			$resultado = $listar->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function listar_ganho(){
		try{

			$data = '%/' . date('m') . '/' . date('Y');

			require_once("../config/conexao.php");
			$sql ="SELECT SUM(valor) as total_valor FROM venda WHERE data LIKE :data";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->bindValue(':data', $data);
			$listar->execute();
			$resultado = $listar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function listar_ganho_ano(){
		try{
			$ganho_ano = array();
			for($i = 1; $i <= 12; $i++){
				if($i < 10){
					$mes = '0' . $i;
				}else{
					$mes = $i;
				}
				$data = '%/' . $mes . '/' . date('Y');

				require_once("../config/conexao.php");
				$sql ="SELECT SUM(valor) as total_valor FROM venda WHERE data LIKE :data";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$listar = $pdo->prepare($sql);
				$listar->bindValue(':data', $data);
				$listar->execute();
				$resultado = $listar->fetch(PDO::FETCH_ASSOC);
				$ganho_ano[$i] = $resultado;
			}
			return $ganho_ano;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function listar_ganho_passado(){
		try{

			if (date('m') == 1) {
				$mes_passado = 12;
				$ano = date('Y') - 1;
				$data = '%/' . $mes_passado . '/' . $ano;
			}else{
				$mes_passado = date('m') - 1;
				$ano = date('Y');
				if ($mes_passado < 10) {
					$data = '%/0' . $mes_passado . '/' . $ano;
				}else{
					$data = '%/' . $mes_passado . '/' . $ano;
				}
				
			}

			require_once("../config/conexao.php");
			$sql ="SELECT SUM(valor) as total_valor_passado FROM venda WHERE data LIKE :data";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$listar = $pdo->prepare($sql);
			$listar->bindValue(':data', $data);
			$listar->execute();
			$resultado = $listar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

	function cadastrar_venda($venda){
		try{
			require_once("../../config/conexao.php");
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
			header("location:realizarVenda.php");
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}
	function pegar_servico($id){
		try{
			require_once("../../config/conexao.php");
			$sql ="SELECT preco,nome FROM servico WHERE id = :id";
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$pegar = $pdo->prepare($sql);
			$pegar->bindValue(':id', $id);
			$pegar->execute();
			$resultado = $pegar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}
	}
?>
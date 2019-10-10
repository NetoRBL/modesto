<?php

	class caixaDAO{

		function resgistrar_caixa($caixa){
			try{
				require_once("../config/conexao.php");
				$sql ="INSERT INTO caixa ( status, valor, data, hora) VALUES ( :status, :valor, :data, :hora)";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$inserir = $pdo->prepare($sql);
				$inserir->bindValue(':status',$caixa->getStatus());
				$inserir->bindValue(':valor',$caixa->getValor());
				$inserir->bindValue(':data',$caixa->getData());
				$inserir->bindValue(':hora',$caixa->getHora());
				$inserir->execute();
				header("location:inicio.php?status=".$caixa->getStatus()."&confirm=ok");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function listar_ultimo_status(){
			try{
				require_once("../config/conexao.php");
				$sql ="SELECT status, data, valor FROM caixa ORDER BY id DESC LIMIT 1";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$listar = $pdo->prepare($sql);
				$listar->execute();
				$resultado = $listar->fetch(PDO::FETCH_ASSOC);
				return $resultado;
				header("location:inicio.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function valor_caixa($data){
			try{
				require_once("../config/conexao.php");
				$sql ="SELECT (SELECT IFNULL(SUM(valor),0) FROM venda WHERE data = :data) + (SELECT IFNULL(SUM(valor),0) FROM caixa WHERE status = 'Entrada' AND data = :data) + (SELECT IFNULL(valor,0) FROM caixa WHERE status = 'Aberto' ORDER BY id DESC LIMIT 1) - (SELECT IFNULL(SUM(valor),0) FROM caixa WHERE status = 'Retirada' AND data = :data) AS valor_caixa";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$listar = $pdo->prepare($sql);
				$listar->bindValue(':data',$data);
				$listar->execute();
				$resultado = $listar->fetch(PDO::FETCH_ASSOC);
				return $resultado;
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function check($data){
			try{
				require_once("../config/conexao.php");
				$sql ="SELECT valor FROM caixa WHERE status = 'Aberto' ORDER BY id DESC LIMIT 1";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$listar = $pdo->prepare($sql);
				// $listar->bindValue(':data',$data);
				$listar->execute();
				$resultado = $listar->fetch(PDO::FETCH_ASSOC);
				return $resultado;
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function editar_produto($produtos){
			echo $produtos->getNome();
				echo "Olaaaa";
			try{
				include_once("../../config/conexao.php");

				$sql ="UPDATE produto SET  nome = :nome, marca = :marca, descricao = :descricao, preco = :preco, qtd = :qtd, imagem = :imagem WHERE id = :id";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$atualizar = $pdo->prepare($sql);
				$atualizar->bindValue(':id',$produtos->getId());
				//$atualizar->bindValue(':cod_barra',$produtos->getCod_barra());
				$atualizar->bindValue(':nome',$produtos->getNome());
				$atualizar->bindValue(':marca',$produtos->getMarca());
				$atualizar->bindValue(':descricao',$produtos->getDescricao());
				$atualizar->bindValue(':preco',$produtos->getPreco());
				$atualizar->bindValue(':qtd',$produtos->getQtd());
				$atualizar->bindValue(':imagem',$produtos->getImagem());
				$atualizar->execute();
				header("location:produtos.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function apagar_produto($produtos){
			require_once("../../config/conexao.php");
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$sql ="DELETE FROM produto WHERE id = :id";
			$apagar = $pdo->prepare($sql);
			$apagar->bindValue(':id',$produtos->getId());
			$apagar->execute();
			header("location:produtos.php");
		}
		function listar_servicos(){
			try{
				require_once("../../config/conexao.php");
				$sql ="SELECT * FROM produto WHERE tipo = 1";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$listar = $pdo->prepare($sql);
				$listar->execute();
				$resultado = $listar->fetchAll(PDO::FETCH_ASSOC);
				return $resultado;
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}
	}
?>
<?php

	class produtoDAO{

		function cadastrar_produto($produto){
			try{
				require_once("../config/conexao.php");
				$sql ="INSERT INTO produto (cod_barra, nome, marca, descricao, preco, qtd, imagem) VALUES (cod_barra, :nome, :marca, :descricao, :preco, :qtd, :imagem)";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$inserir = $pdo->prepare($sql);
				$inserir->bindValue(':cod_barra',$produto->getCod_barra());
				$inserir->bindValue(':nome',$produto->getNome());
				$inserir->bindValue(':marca',$produto->getMarca());
				$inserir->bindValue(':descricao',$produto->getDescricao());
				$inserir->bindValue(':preco',$produto->getPreco());
				$inserir->bindValue(':qtd',$produto->getQtd());
				$inserir->bindValue(':imagem',$produto->getImagem());
				$inserir->execute();
				header("location:../view/pages/produtos.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function listar_produtos(){
			try{
				require_once("../../config/conexao.php");
				$sql ="SELECT * FROM produto";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$listar = $pdo->prepare($sql);
				$listar->execute();
				$resultado = $listar->fetchAll(PDO::FETCH_ASSOC);
				return $resultado;
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function editar_produto($produtos){
			try{
				require_once("../config/conexao.php");
				$sql ="UPDATE produto SET cod_barra = :cod_barra, nome = :nome, marca = :marca, descricao = :descricao, preco = :preco, qtd = :qtd, imagem = :imagem WHERE id = :id";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$atualizar = $pdo->prepare($sql);
				$atualizar->bindValue(':id',$produtos->getId());
				$inserir->bindValue(':cod_barra',$produto->getCod_barra());
				$atualizar->bindValue(':nome',$produtos->getNome());
				$atualizar->bindValue(':marca',$produtos->getMarca());
				$atualizar->bindValue(':descricao',$produtos->getDescricao());
				$atualizar->bindValue(':preco',$produtos->getPreco());
				$atualizar->bindValue(':qtd',$produtos->getQtd());
				$atualizar->bindValue(':imagem',$produtos->getImagem());
				$atualizar->execute();
				header("location:../view/pages/produtos.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function apagar_questao($produtos){
			require_once("../config/conexao.php");
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$sql ="DELETE FROM produto WHERE COD = :COD";
			$apagar = $pdo->prepare($sql);
			$apagar->bindValue(':COD',$produtos->getId());
			$apagar->execute();
			header("location:../view/pages/produtos.php");
		}
	}
?>
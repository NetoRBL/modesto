<?php

	class servicoDAO{

		function cadastrar_servico($servico){
			try{
				require_once("../../config/conexao.php");
				$sql ="INSERT INTO servico ( nome,  preco,  imagem) VALUES ( :nome, :preco,  :imagem)";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$inserir = $pdo->prepare($sql);
				$inserir->bindValue(':nome',$servico->getNome());
				$inserir->bindValue(':preco',$servico->getPreco());
				
				$inserir->bindValue(':imagem',$servico->getImagem());
				$inserir->execute();
				header("location:relatorio.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function remover_servicos($servico){
			try{
				require_once("../../config/conexao.php");
				$sql ="UPDATE servico SET qtd = :qtd WHERE id = :id";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$inserir = $pdo->prepare($sql);
				$inserir->bindValue(':id',$servico->getId());
				$inserir->bindValue(':qtd',$servico->getQtd());
				$inserir->execute();
				header("location:realizarVenda.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function editar_servico($servicos){
			echo $servicos->getNome();
				echo "Olaaaa";
			try{
				include_once("../../config/conexao.php");

				$sql ="UPDATE servico SET  nome = :nome, preco = :preco, imagem = :imagem WHERE id = :id";
				$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
				$atualizar = $pdo->prepare($sql);
				$atualizar->bindValue(':id',$servicos->getId());
				
				$atualizar->bindValue(':nome',$servicos->getNome());
				$atualizar->bindValue(':preco',$servicos->getPreco());
				$atualizar->bindValue(':imagem',$servicos->getImagem());
				$atualizar->execute();
				header("location:relatorio.php");
			} catch(PDOException $e){
				echo 'Erro:' . $e->getMessage();
			}
		}

		function apagar_servico($servicos){
			require_once("../../config/conexao.php");
			$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
			$sql ="DELETE FROM servico WHERE id = :id";
			$apagar = $pdo->prepare($sql);
			$apagar->bindValue(':id',$servicos->getId());
			$apagar->execute();
			header("location:relatorio.php");
		}
		function listar_servicos(){
			try{
				require_once("../../config/conexao.php");
				$sql ="SELECT * FROM servico";
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
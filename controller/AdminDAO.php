<?php

	function logar_admin($admin){
		try{
			require_once("../config/Conexao.php");
			$sql ="SELECT * FROM administrador WHERE login=:login AND senha=:senha";
			$logar = $pdo->prepare($sql);
			$logar->bindValue(':login',$admin->getLogin());
			$logar->bindValue(':senha',$admin->getSenha());
			$logar->execute();
			$resultado = $logar->fetch(PDO::FETCH_ASSOC);
			return $resultado;
		} catch(PDOException $e){
			echo 'Erro:' . $e->getMessage();
		}
	}

?>
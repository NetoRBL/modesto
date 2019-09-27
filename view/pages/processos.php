<?php
include_once("../../controller/VendaDAO.php");
include_once("../../controller/AdminDAO.php");
include_once("../../model/AdminModel.php");
include_once("../../model/ProdutoModel.php");
include_once("../../controller/ProdutoDAO.php");
include_once("../../model/VendaModel.php");
include_once("../../controller/servicoDAO.php");
$produtoDAO = new produtoDAO();
$produto = new Produto();
$preco = $_POST['preco'];
$mensagens = array();

if(!is_numeric($preco)){
	$mensagens['msg'] = "Voce não digitou um numero";
}else{
	$mensagens['erro'] = 0;
	if (isset($preco) ) {
		$produto->setId($preco);
		$teste = $produtoDAO->pegarValor($produto);
		$mensagens['valor'] = $teste[0]["preco"];
	}
}
die( json_encode($mensagens) );

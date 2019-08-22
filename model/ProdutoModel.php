<?php

	class Produto {

		private $id;
		private $nome;
		private $descricao;
		private $preco;
		private $qtd;
		private $imagem;

		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getNome(){
			return $this->nome;
		}

		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		public function getDescricao(){
			return $this->descricao;
		}

		public function setPreco($preco){
			$this->preco = $preco;
		}
		public function getPreco(){
			return $this->preco;
		}

		public function setQtd($qtd){
			$this->qtd = $qtd;
		}
		public function getQtd(){
			return $this->qtd;
		}


?>
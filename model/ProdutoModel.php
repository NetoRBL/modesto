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

		public function setDescricao($nome){
			$this->nome = $nome;
		}
		public function getDescricao(){
			return $this->nome;
		}
	}

?>
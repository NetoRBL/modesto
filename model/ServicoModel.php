<?php

	class Servico {	
		private $id;	
		private $nome;
		private $preco;
		private $imagem;
		public function setId($id){
			$this->id = $id;
		}
		public function getId(){
			return $this->id;
		}		
		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getNome(){
			return $this->nome;
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
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		public function getImagem(){
			return $this->imagem;
		}
	}

?>
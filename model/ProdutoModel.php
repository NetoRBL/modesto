<?php

	class Produto {
		private $tipo;
		private $id;
		private $cod_barra;
		private $nome;
		private $marca;
		private $descricao;
		private $preco;
		private $qtd;
		private $imagem;

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}
		public function getTipo(){
			return $this->tipo;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getId(){
			return $this->id;
		}
		public function setCod_barra($cod_barra){
			$this->cod_barra = $cod_barra;
		}
		public function getCod_barra(){
			return $this->cod_barra;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}
		public function getNome(){
			return $this->nome;
		}

		public function setMarca($marca){
			$this->marca = $marca;
		}
		public function getMarca(){
			return $this->marca;
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
		public function setImagem($imagem){
			$this->imagem = $imagem;
		}
		public function getImagem(){
			return $this->imagem;
		}
	}

?>
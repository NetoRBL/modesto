<?php

	class Venda {

		private $id;
		private $valor;
		private $produto;
		private $qtd;
		private $data;
		private $hora;
		private $tipo;

		public function setValor($valor){
			$this->valor = $valor;
		}
		public function getValor(){
			return $this->valor;
		}

		public function setProduto($produto){
			$this->produto = $produto;
		}
		public function getProduto(){
			return $this->produto;
		}

		public function setQtd($qtd){
			$this->qtd = $qtd;
		}
		public function getQtd(){
			return $this->qtd;
		}

		public function setData($data){
			$this->data = $data;
		}
		public function getData(){
			return $this->data;
		}

		public function setHora($hora){
			$this->hora = $hora;
		}
		public function getHora(){
			return $this->hora;
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}
		public function getTipo(){
			return $this->tipo;
		}
	}

?>
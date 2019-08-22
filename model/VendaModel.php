<?php

	class Produto {

		private $id;
		private $valor;
		private $produto;
		private $data;
		private $hora;

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
	}

?>
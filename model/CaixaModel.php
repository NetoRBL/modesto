<?php

	class CaixaModel {	
		private $status;	
		private $valor;
		private $data;
		private $hora;
		public function setStatus($status){
			$this->status = $status;
		}
		public function getStatus(){
			return $this->status;
		}		
		public function setValor($valor){
			$this->valor = $valor;
		}
		public function getValor(){
			return $this->valor;
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
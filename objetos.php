<?php 
	class Users {
		private $user;
		private $pass;
		private $email;
		private $name;
		private $firma;
		private $avatar;
		private $tipo;

		function setUsers($user,$pass, $email, $name, $firma, $avatar, $tipo){
			$this -> user = $user;
			$this -> pass = $pass;
			$this -> name = $name;
			$this -> email = $email;
			$this -> firma = $firma;
			$this -> avatar = $avatar;
			$this -> tipo = $tipo;
		}

		function setUser ($user){
			$this -> user = $user;
		}
		
		function getUser(){
			return $this->user;
		}

		function setPass ($pass){
			$this -> pass = $pass;
		}

		function getPass(){
			return $this->pass;
		}

		function setName ($name){
			$this -> name = $name;
		}

		function getName(){
			return $this->name;
		}

		function setEmail ($email){
			$this -> email = $email;
		}

		function getEmail(){
			return $this->email;
		}

		function setFirma ($firma){
			$this -> firma = $firma;
		}

		function getFirma(){
			return $this->firma;
		}

		function setAvatar ($avatar){
			$this -> avatar = $avatar;
		}

		function getAvatar(){
			return $this->avatar;
		}

		function setTipo ($tipo){
			$this -> tipo = $tipo;
		}

		function getTipo(){
			return $this->tipo;
		}


	}

	/*class BasesWok() {
		private $idBase;
		private $descripción;
		private $precio;

		function setBasesWok($idBase, $descripción, $precio) {
			$this -> idBase = $idBase;
			$this -> descripción = $descripción;
			$this -> precio = $precio;
		}

		function setIdBase($idBase) {
			$this -> idBase = $idBase;
		}

		function getIdBase() {
			return $this -> $idBase;
		}

		function setDescripción($descripción) {
			$this -> descripción = $descripción;
		}

		function getDescripción() {
			return $this -> $descripción;
		}

		function setPrecio($precio) {
			$this -> precio = $precio;
		}

		function getPrecio() {
			return $this -> $precio;
		}

	}

	class Ingredientes() {
		private $nombreIng;
		private $descripcionIng;

		function setIngredientes ($nombreIng, $descripcionIng) {
			$this -> nombreIng = $nombreIng;
			$this -> descripcionIng = $descripcionIng
		}

		function setNombreIng($nombreIng) {
			$this -> nombreIng = $nombreIng;
		}

		function getNombreIng() {
			return $this -> $nombreIng;
		}

		function setDescripcionIng($descripcionIng) {
			$this -> descripcionIng = $descripcionIng;
		}

		function getDescripcionIng() {
			return $this -> $descripcionIng;
		}
	}*/

 ?>
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
 ?>
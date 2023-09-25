<?php

class User {
   public $pdo;
   public $login;
   public $password;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=super-reminder","root","2206");

    }
    public function register($login, $password) {
        $register = $this->pdo->prepare("INSERT INTO user (:login, :password)") ;
        $register->execute([
            "login" => $login,
            "password" => $password
        ]);
    }
    
}

// se connecter à la base de données

?>
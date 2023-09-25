<?php

class User {
   public $pdo;
   public $login;
   public $password;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=super-reminder", "root", "root");

    }
    public function register($login, $password) {
       $insert = $this->pdo->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
         $insert->execute([
            ":login" => $login,
            ":password" => $password
        ]);

    }

    public function ifExist($login){
        $select = $this->pdo->prepare("SELECT * FROM user WHERE login = :login");
        $select->execute([
            "login" => $login
        ]);
        $result = $select->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    
}

?>
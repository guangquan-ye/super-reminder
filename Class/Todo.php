<?php

class Todo {

    public $pdo;
    public $todo;
    public $iscomplited;
    public $user_id;

    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=super-reminder", "root", "root");
    }

    public function addTodo($title, $user_id){
        $insert = $this->pdo->prepare("INSERT INTO todo (todo, iscompleted, id_user) VALUES (:todo, :iscompleted, :id_user)");
        $insert->execute([
            ":todo" => $title,
            ":iscompleted" => 0,
            ":id_user" => $user_id
        ]);
    }

}

?>
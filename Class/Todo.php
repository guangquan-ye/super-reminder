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

    public function getTodos($user_id){
        $select = $this->pdo->prepare("SELECT * FROM todo WHERE id_user = :id_user AND iscompleted = 0");
        $select->execute([
            ":id_user" => $user_id
        ]);
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function doneTodo($id_task){
        $update = $this->pdo->prepare("UPDATE todo SET iscompleted = :iscompleted WHERE id = :id");
        $update->execute([
            ":iscompleted" => 1,
            ":id" => $id_task
        ]);
    }
    
    public function getDoneTodos($user_id){
        $select = $this->pdo->prepare("SELECT * FROM todo WHERE id_user = :id_user AND iscompleted = 1");
        $select->execute([
            ":id_user" => $user_id
        ]);
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    public function deleteTask($id_task){
        $delete = $this->pdo->prepare("DELETE FROM todo WHERE id = :id");
        $delete->execute([
            ":id" => $id_task
        ]);
    }
}

?>
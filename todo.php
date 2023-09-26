<?php
require_once "./Class/Todo.php";

session_start();

$todo = new Todo();

if(isset($_POST["addTodo"])){

    $title = $_POST["todoTitle"];
    $user_id = $_SESSION["user"]["id"];
    $todo->addTodo($title, $user_id);
    die();
  }

if(isset($_GET["getTodos"])){
    $user_id = $_SESSION["user"]["id"];
    $getTask = $todo->getTodos($user_id);
    return $getTask;
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="./script/todo.js"></script>
    <title>Todolist</title>
</head>
<body>
    <h1>My Todolist</h1>
    <form method="post" id="addTodoForm">
        
        <input type="text" name="todoTitle" placeholder="Title">
        
        <button id="addTodoBtn">Add</button>
    </form>
    <div id="todoList"></div>
    
    
</body>
</html>
<?php
session_start();
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
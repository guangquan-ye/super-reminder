<?php
require_once "./Class/Todo.php";

session_start();

$todo = new Todo();

if (isset($_POST["addTodo"])) {

    if (empty($_POST["todoTitle"])) {
        echo "Please enter a task";
        die();
    }else{
    $title = $_POST["todoTitle"];
    $user_id = $_SESSION["user"]["id"];
    $todo->addTodo($title, $user_id);
    die();
    }
}

if (isset($_GET["getTodos"])) {
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="./script/todo.js"></script>
    <title>Todolist</title>
</head>

<body>
    <h2 class="mt-12 text-center text-4xl font-bold leading-9 tracking-tight text-gray-500">My Todolist</h2>

    <form method="post" id="addTodoForm">
    <p class="mt-12 text-center text-1xl font-bold leading-9 tracking-tight text-sky-500" id="todoMsg"></p>
        <div class="relative mt-5 m-5 rounded-md shadow-sm">
            <input type="text" name="todoTitle" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Faire les courses">
            <div class="absolute inset-y-0 right-0 flex items-center">
                <button id="addTodoBtn" class="h-full rounded-md border-1  bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">+</button>
            </div>
        </div>
    </form>
    <div id="todoList"></div>


</body>

</html>
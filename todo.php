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

if(isset($_POST["done"])){
    $id_task = $_POST["id_task"];
    $todo->doneTodo($id_task);
    die();
}

if(isset($_GET["getTodosDone"])){
    $user_id = $_SESSION["user"]["id"];
    $getDoneTask = $todo->getDoneTodos($user_id);
    return $getDoneTask;

    die();
}

if(isset($_POST["delete"])){
    $id_task = $_POST["id_task"];
    $todo->deleteTask($id_task);
    die();
}
if(isset($_POST["logOut"])){
    session_destroy();
    header("Location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
    <script defer src="./script/todo.js"></script>
    <title>Todolist</title>
</head>

<body>
    <div>
    <h2 class="mt-12 text-center text-4xl font-bold leading-9 tracking-tight text-black">My Todolist</h2>
    <form action="" method="post">
        
    <button name="logOut">Log out</button>
    </form>
    <form method="post" id="addTodoForm">
    <p class="mt-12 text-center text-1xl  justify-center font-bold leading-9 tracking-tight text-sky-500" id="todoMsg"></p>
        <div class="lg:w-3/5 relative mt-5 m-5 rounded-md shadow-sm">
            <input type="text" name="todoTitle" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6" placeholder="Faire les courses">
            <div class="absolute inset-y-0 right-0 flex items-center">
                <button id="addTodoBtn" class="h-full rounded-md border-1  bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm">+</button>
            </div>
        </div>
    </form>

    <p class="mt-6 ml-6 text-2xl font-bold leading-9 tracking-tight text-gray-800" >Task</p>
    <div id="todoList"></div>

    <p class="mt-6 ml-6 text-2xl font-bold leading-9 tracking-tight text-gray-800" >Finished</p>
    <div id="doneList"></div>
    </div>
</body>

</html>
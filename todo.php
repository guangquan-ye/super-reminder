<?php
require_once "./Class/Todo.php";

session_start();

$todo = new Todo();

if (isset($_POST["addTodo"])) {

    if (empty($_POST["todoTitle"])) {
        echo "Please enter a task";
        die();
    } else {
        $title = $_POST["todoTitle"];
        $user_id = $_SESSION["user"]["id"];
        $todo->addTodo($title, $user_id);
        die();
    }
}

if (isset($_GET["getTodos"])) {
    $user_id = $_SESSION["user"]["id"];
    $todo->getTodos($user_id);
    
    die();
}

if (isset($_POST["done"])) {
    $id_task = $_POST["id_task"];
    $todo->doneTodo($id_task);
    die();
}

if (isset($_GET["getTodosDone"])) {
    $user_id = $_SESSION["user"]["id"];
    $getDoneTask = $todo->getDoneTodos($user_id);
    return $getDoneTask;

    die();
}

if (isset($_POST["delete"])) {
    $id_task = $_POST["id_task"];
    $todo->deleteTask($id_task);
    die();
}
if (isset($_POST["logOut"])) {
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
    <section>
    <div class="lg:w-2/5 flex flex-col justify-center m-auto lg:border-double lg:border-4 lg:border-[#f8e3ba] lg:mt-10">
        <div class="flex flex-row justify-around align-center">
            <div>
                <h2 class="mt-12 text-center text-4xl font-bold leading-9 tracking-tight text-black">My Todolist</h2>
                
            </div>
            <div class="flex justify-center align-center content-center">
                <form action="" method="post">
                    <button name="logOut" class="mt-14 text-1xl w-5 h-5"><img src="./public/exit.png" alt=""></button>
                </form>
            </div>
        </div>

        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <p class="m-5 mt-4 text-2xl text-black"><?= "Welcome " . $_SESSION["user"]["login"]?></p>

            <form method="post" id="addTodoForm">
                <p class="mt-6 text-center text-1xl  justify-center font-bold leading-9 tracking-tight text-sky-500" id="todoMsg"></p>
                <div class="relative mt-5 m-5 rounded-md shadow-sm">
                    <input type="text" name="todoTitle" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6" placeholder="Faire les courses">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                        <button id="addTodoBtn" class="w-9 h-9 rounded-md border-1  bg-transparent pr-2 p-2 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm"><img src="public/add.png"></button>
                    </div>
                </div>
            </form>

            <p class="mt-6 ml-6 text-2xl font-bold leading-9 tracking-tight text-gray-800">To do</p>
            <div id="todoList"></div>

            <p class="mt-6 ml-6 text-2xl font-bold leading-9 tracking-tight text-gray-800">Finished</p>
            <div id="doneList"></div>
        </div>
    </div>
    </section>
</body>

</html>
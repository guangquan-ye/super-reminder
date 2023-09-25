<?php
require_once "./Class/User.php";
require_once "./Class/Todo.php";
session_start();

$user = new User();
$todo = new Todo();


if (isset($_POST["register"])) {

    $password = $_POST["signUpPwd"];
    $passwordConf = $_POST["signUpPwdConf"];
    $login = $_POST["signUpLogin"];

    if($password == $passwordConf){
            
        if($user->ifExist($login)){
            echo "Login already exist";
        }else{
            $specialLogin = htmlspecialchars($login);
            $specialPwd = htmlspecialchars($password);
            $hashedPwd = password_hash($specialPwd, PASSWORD_DEFAULT);
            $user->register($specialLogin, $hashedPwd);

            echo "Succesfully Submit";
            die();
        }   
        
    }
    else{
        echo "Pwd and confirm do not match";
        die();
    }
}

if(isset($_POST["login"])){

    $login = $_POST["signInLogin"];
    $password = $_POST["signInPwd"];

    htmlspecialchars($login);
    htmlspecialchars($password);

    $result = $user->ifExist($login);

    if (is_array($result) && isset($result["password"])) {
        if (password_verify($password, $result["password"])) {
            $_SESSION["user"] = [
                "id" => $result["id"],
                "login" => $result["login"]
            ];
            echo "Welcome";
            die();
        }
        else{
            echo "Wrong informations";
            die();
        }
    }
    else{
        echo "empty of wrong informations";
        die();
    }
  };

  if(isset($_POST["addTodo"])){

    $title = $_POST["todoTitle"];
    $user_id = $_SESSION["user"]["id"];
    $todo->addTodo($title, $user_id);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <script defer src="./script/header.js"></script>
    <script defer src="./script/auth.js"></script>
    <script defer src="./script/todolist.js"></script>

    <title>Todolist</title>
</head>

<body>
    <?php require_once "header.php" ?>
    <h1>Welcome To my Todolist</h1>

    <div>
        <form action="" method="post">
            <input type="text" name="task" placeholder="Enter your task">
            <button id="addTaskBtn">Add Task</button>
        </form>
    </div>

</body>

</html>
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style/style.css">
    <script defer src="./script/header.js"></script>
    <script defer src="./script/auth.js"></script>
    <script defer src="./script/todolist.js"></script>

    <title>Todolist</title>
</head>

<body>
    <h1>Welcome To my Todolist</h1>

    <a href="" id="signUpDisplay">Inscription</a>
    <a href="" id="signInDisplay">Connexion</a>
  </div>
 
  <div id="formDisplayDiv"></div>

</body>

</html>
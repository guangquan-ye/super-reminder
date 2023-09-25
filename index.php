<?php
require_once "./Class/User.php";
session_start();

$user = new User();


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
        }   
        
    }
    else{
        echo "Pwd and confirm do not match";
    }
}

if(isset($_POST["login"])){

    $login = $_POST["signInLogin"];
    $password = $_POST["signInPwd"];

    htmlspecialchars($login);
    htmlspecialchars($password);

    $result = $user->ifExist($login);

    if (password_verify($password, $result["password"])) {
      $_SESSION["user"] = [
          "id" => $result["id"],
          "login" => $result["login"]
      ];
      echo "Welcome";
     
     }
    else{
        echo "Wrong login or pwd" ;
    }
  };

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="./script/auth.js"></script>
    <title>Todolist</title>
</head>

<body>
    <?php require_once "header.php" ?>
    <h1>Welcome To my Todolist</h1>

    <div>
        <form action="add.php" method="post">
            <input type="text" name="task" placeholder="Enter your task">
            <input type="submit" value="Add">
        </form>
    </div>

</body>

</html>
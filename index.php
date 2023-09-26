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
    <script defer src="./script/auth.js"></script>
    <title>Todolist</title>
</head>

<body>
    <h1>Welcome To my Todolist</h1>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8" id="signInFormDisplay">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login</h2>
      <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-sky-500" id="signInMsg"></h2>
    </div>
  
    <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST" id="signInForm" action="index.php">
        <div>
          <label for="login" class="block text-sm font-medium leading-6 text-gray-900">Login</label>
          <div class="mt-2">
            <input name="signInLogin" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
  
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input  name="signInPwd" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
  
        <div>
          <button type="submit" id="signInBtn" class="flex w-full justify-center rounded-md bg-yellow-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
        </div>
      </form>
      <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a href="" id="signUpDisplayBtn" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign up</a>
    </p>
    </div>
</div>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8" id="signUpFormDisplay">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register</h2>
          <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900" id="signUpMsg"></h2>
        </div>
      
        <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="#" method="POST" id="signUpForm" action="index.php">
            <div>
              <label for="login" class="block text-sm font-medium leading-6 text-gray-900">Login</label>
              <div class="mt-2">
                <input name="signUpLogin" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
      
            <div>
              <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              </div>
              <div class="mt-2">
                <input  name="signUpPwd" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password Confirm</label>
              <div class="mt-2">
                <input  name="signUpPwdConf" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
      
            <div>
              <button type="submit" id="signUpBtn" class="flex w-full justify-center rounded-md bg-yellow-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">Sign up</button>
            </div>
          </form>
          <p class="mt-10 text-center text-sm text-gray-500">
            Already a member?
      <a href="" id="signInDisplayBtn" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign In</a>
    </p>
        </div>
</div>


</body>

</html>
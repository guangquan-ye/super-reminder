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

  if ($password == $passwordConf && !empty($password) && !empty($passwordConf)) {

    if ($user->ifExist($login)) {
      echo "Login already exist";
      die();
    } else {
      $specialLogin = htmlspecialchars($login);
      $specialPwd = htmlspecialchars($password);
      $hashedPwd = password_hash($specialPwd, PASSWORD_DEFAULT);
      $user->register($specialLogin, $hashedPwd);

      echo "Succesfully Submit";
      die();
    }
  } else {
    echo "Empty or wrong informations";
    die();
  }
}

if (isset($_POST["login"])) {

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
    } else {
      echo "Wrong informations";
      die();
    }
  } else {
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
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./style/style.css">
  <script defer src="./script/auth.js"></script>
  <title>Todolist</title>
</head>

<body>
  <section>
    <div class="lg:w-2/5 flex flex-col justify-center m-auto lg:border-double lg:border-4 lg:border-[#f8e3ba] lg:mt-10 rounded-md">

      <div class="mt-12 flex justify-center items-center">
        <img class="flex justify rounded-full  w-60 h-60 " src="https://img.freepik.com/premium-vector/cute-flat-cartoon-illustration-with-copybook-list-concept-planner-selfcare_637721-270.jpg" alt="image description">
      </div>

      <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8" id="signInFormDisplay">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-sky-500" id="signInMsg"></h2>
        </div>

        <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" method="POST" id="signInForm" action="index.php">
            <div>
              <label for="signInLogin" class="block text-sm font-medium leading-6 text-gray-900">Login</label>
              <div class="mt-2">
                <input id="signInLogin" name="signInLogin" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6 pl-2">
              </div>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="signInPwd" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              </div>
              <div class="mt-2">
                <input id= "signInPwd" name="signInPwd" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6 pl-2">
              </div>
            </div>

            <div>
              <button type="submit" id="signInBtn" class="flex w-full justify-center rounded-md bg-[#f8e3ba] px-3 py-1.5 text-lg font-semibold leading-6 text-black shadow-sm hover:bg-yellow-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-300">Sign In</button>
            </div>
          </form>
          <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            <a href="" id="signUpDisplayBtn" class="font-semibold leading-6 text-blue-700 hover:text-blue-500">Sign up</a>
          </p>
        </div>
      </div>

      <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8" id="signUpFormDisplay">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-sky-500" id="signUpMsg"></h2>
        </div>

        <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" method="POST" id="signUpForm" action="index.php">
            <div>
              <label for="signUpLogin" class="block text-sm font-medium leading-6 text-gray-900">Login</label>
              <div class="mt-2">
                <input id="signUpLogin" name="signUpLogin" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6 pl-2">
              </div>
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="signUpPwd" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              </div>
              <div class="mt-2">
                <input id="signUpPwd" name="signUpPwd" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6 pl-2">
              </div>
              <label for="signUpPwdConf" class="block text-sm font-medium leading-6 text-gray-900">Password Confirm</label>
              <div class="mt-2">
                <input id="signUpPwdConf" name="signUpPwdConf" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#f8e3ba] sm:text-sm sm:leading-6 pl-2">
              </div>
            </div>

            <div>
              <button type="submit" id="signUpBtn" class="flex w-full justify-center rounded-md bg-[#f8e3ba] px-3 py-1.5 text-lg font-semibold leading-6 text-black shadow-sm hover:bg-yellow-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">Sign up</button>
            </div>
          </form>
          <p class="mt-10 text-center text-sm text-gray-500">
            Already a member?
            <a href="" id="signInDisplayBtn" class="font-semibold leading-6 text-cyan-400 hover:text-cyan-500">Sign In</a>
          </p>
        </div>
      </div>

    </div>
  </section>
</body>

</html>
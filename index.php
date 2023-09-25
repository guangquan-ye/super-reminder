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
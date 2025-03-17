<?php
    // ben ik aan het posten / inloggen???
    if(isset($_POST['submit'])){
       // post vars uitlezen
       $username = $_POST['username'];
       $password = $_POST['password'];


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="submit" value="Login">
    </form>
    <p>geen account?</p>
    <a href="register.php">Register</a>
</body>
</html>
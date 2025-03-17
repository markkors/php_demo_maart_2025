<?php
require("classes/db.php");

    // ben ik aan het registeren???
    if(isset($_POST['submit'])){
       // post vars uitlezen
       $username = $_POST['username'];
       $password1 = $_POST['password1'];
       $password2 = $_POST['password2'];

        // check of de wachtwoorden gelijk zijn
        if($password1 != $password2){
            echo "<a href=\"register.php\">Wachtwoorden zijn niet gelijk</a>";
            exit;
        }
        // zo ja, dan registreren -> naar login
        //iets met de dabase
        $db = new db();
        $age = 50;
        if($db->register_user($username, $age,$password1)) {
            // naar login
            header("Location: login.php");

        } else {
            echo "<a href=\"register.php\">User niet geregistreerd</a>";
        }


       
        // zo nee, registeren

       
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
    <h1>Register</h1>
    <form method="post" action="register.php">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password1" placeholder="password">
        <input type="password" name="password2" placeholder="retype password">
        <input type="submit" name="submit" value="Register">
    </form>
    <p>inloggen?</p>
    <a href="login.php">Login</a>
</body>
</html>
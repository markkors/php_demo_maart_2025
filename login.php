<?php
    require("classes/db.php");

    // ben ik aan het posten / inloggen???
    if(isset($_POST['submit'])){
       // post vars uitlezen
       $username = $_POST['username'];
       $password = $_POST['password'];
       
       $db = new db();
      if ($db->checklogin($username, $password)) {
        // ingelogd
        //echo "ingelogd";
        // maak een sessie aan
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["loggedin"] = true;
        $_SESSION["sessionid"] = session_id(); 
        header("Location: get.php");
      } else {
        // niet ingelogd
        echo "niet ingelogd";
      }

       // user checken
       // klopt het password?
       // zo ja, ingelogd
         // zo nee, foutmelding

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
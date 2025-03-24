<?php

require("classes/db.php");
// ben je aan het posten?
if(isset($_POST["submit"])) {

  
    // ga je gang
    // zo ja, lees de post variabelen in
    $username = $_POST["username"];
    $password = $_POST["password"];
    $db = new db();
    $user = null;
    $error = null;
    if($db->doLogin($username, $password, $user,$error)) {
        //echo "Je bent ingelogd";
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["user"] = $user;
        header("Location: get.php");
    } else {
        if(isset($error)) {
            $m = $error->getMessage();
            echo "Je bent niet ingelogd omdat $m";
        }
    }

}




// haal de user uit de dabase met hashed password

// check of hash klopt met password

// zo ja, log in -> session enzo...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
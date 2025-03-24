<?php
require("classes/db.php");
    // ben ik aan het posten of niet?

    if(isset($_POST['submit'])) {
      // registreer de user
        $username = htmlspecialchars($_POST['username']);
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        // check of de wachtwoorden gelijk zijn
        if($password1 != $password2) {
            echo "Wachtwoorden zijn niet gelijk";
            exit;
        }
        // zo ja, voeg de user toe aan de database
        $db = new db();
        $age = 50;
        if($db->register_user($username,$age,$password1)) {
            // klaar, terug maar inloggen
            header("Location: login.php");
        } else {
            echo "User is niet toegevoegd (wellicht bestaat deze al?)";
        }        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
</head>
<body>
    <h1>Registreer</h1>
    <form method="post" >
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password1" placeholder="Password">
        <input type="password" name="password2" placeholder="Retype Password">
        <input type="submit" name="submit" value="Registreer">
    </form>
</body>
</html>
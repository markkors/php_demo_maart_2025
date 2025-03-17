<?php

// ben ik ingelogd?
session_start();
var_dump($_SESSION);


$username = "";
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} else {
    $id = $_SESSION["user"]["id"];
    $username = $_SESSION["username"];
}

// records tonen uit database
//require("database.php");

require("classes/db.php");



$db = new db(); // instance van de class maken -> object


//echo $db->hello_world();
//echo $db->message("Hello world too");

//var_dump($db->users);


// Wat gaan we doen

// 1. Error handling
// 2. User Input valideren
// 3. ??

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border: 1px solid black;
        }
        </style>

</head>
<body>
   
    <form method="post" action="logout.php">
        <input type="submit" value="Logout">
    </form>

    <h1>User overview</h1>
    <p>Welkom <?=$username ?></p>   
    <?=$db->get_html_user_table() ?>
    
 


</body>
</html>
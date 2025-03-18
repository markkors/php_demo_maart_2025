<?php

// ben ik ingelogd?
session_start();



$username = "";
if(!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} else {
    // ingelogd
    require("classes/db.php");
    $db = new db(); // instance van de class maken -> object
    $username = $_SESSION["username"];    
    $editForm = null;

    // edit geklikt
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $UserToEdit = $db->getUser($id);
        $editForm = $db->get_html_user_edit_form($UserToEdit);
    }

    // post edit?   
    var_dump($_POST);
    if(isset($_POST["submit"]) && $_POST["submit"] == "Update") {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $age = $_POST["age"];
        $db->updateUser($id, $name, $age);
    }   


}






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

    <div>
        <?=$editForm ?>
    </div>

    <h1>User overview</h1>
    <p>Welkom <?=$username ?></p>   
    <?=$db->get_html_user_table() ?>
    
 


</body>
</html>
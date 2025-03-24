<?php

// ben ik ingelogd?
session_start();



$username = "";
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} else {
    // ingelogd
    require("classes/db.php");
    $db = new db(); // instance van de class maken -> object
    $username = $_SESSION["username"];
    $editForm = null;
    $deleteForm = null;
}

    // post edit?   
    if (isset($_POST["submit"]) && $_POST["submit"] == "Update") {
        // werkelijk update
        $id = $_POST["id"];
        $name = $_POST["name"];
        $age = $_POST["age"];
        if($db->updateUser($id, $name, $age)) {
            header("Location: logout.php");
        }
    } else if (isset($_POST["submit"]) && $_POST["submit"] == "Delete") {
        // als ga deleten
        $id = $_POST["id"];
        if($db->deleteUser($id)) {
            header("Location: logout.php");
        }
    } else {
       
        var_dump($_GET);

        // edit (update of delete) geklikt -> toon formulier
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $action = $_GET["action"];
            switch ($action) {
                case "update":
                    $UserToEdit = $db->getUser($id);
                    if ($_SESSION["user"]["id"] == $UserToEdit->id) {
                        $editForm = $db->get_html_user_edit_form($UserToEdit);
                    } else {
                        $editForm = "You are not allowed to edit this user";
                    }
                    break;
                case "delete":
                    $UserToDelete = $db->getUser($id);
                    if ($_SESSION["user"]["id"] == $UserToDelete->id) {
                        $deleteForm = $db->get_html_user_delete_form($UserToDelete);
                    } else {
                        $deleteForm = "You are not allowed to delete this user";
                    }
                    break;
            }
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

        .menu {
            display: flex;
        }

        .menu div {
            margin: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
</head>

<body>
    <div class="menu">
        <div>
            <form method="post" action="register.php">
                <input type="submit" value="Register (Create)">
            </form>
        </div>
        <div>
            <form method="post" action="logout.php">
                <input type="submit" value="Logout">
            </form>
        </div>
    </div>


    <div>
        <?= $editForm ?>
    </div>
    <div>
        <?= $deleteForm ?>
    </div>

 



    <h1>User overview</h1>
    <p>Welkom <?= $username ?></p>
    <?= $db->get_html_user_table() ?>




</body>

</html>
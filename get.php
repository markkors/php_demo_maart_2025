<?php


// records tonen uit database
//require("database.php");

require("classes/db.php");
$db = new db();
$db->get_users();
var_dump($db->users);


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
</head>
<body>
    <form method="post" action="verwerk.php">
        <input type="text" name="user" placeholder="User">
        <input type="text" name="age" placeholder="Age">
        
        <button>Send</button>
    </form>

    <p>Latest records:</p>
    <?=get_html_user_table() ?>

   


</body>
</html>
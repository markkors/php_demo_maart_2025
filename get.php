<?php

// records tonen uit database
require("database.php");

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
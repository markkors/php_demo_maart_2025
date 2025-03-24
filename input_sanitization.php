<?php
//var_dump($_POST);


$username = null;
$password = null;
if(isset($_POST["submit"])) {
    $username = $_POST["username"]; // <script> => &lt;script&gt;
    $password = $_POST["password"];
} 


$t = "woei sdgdsgdgh";
test("a","b");

function test() {
   echo "test";
}
//echo htmlspecialchars("<script>");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Sanitization</title>
</head>
<body>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">
    </form>

    <h1>Result</h1>
    <p>Username: <?=$username ?></p>
    <p>Password: <?=$password ?></p>
    
</body>
</html>
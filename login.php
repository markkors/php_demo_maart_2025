<?php

// ben je aan het posten?

// zo ja, lees de post variabelen in

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
    <form>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
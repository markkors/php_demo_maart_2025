<?php
$error_message = null;

if(!isset($_GET['errorcode'])){
    header("Location: get.php");
    exit();
} else {
    if($_GET['errorcode'] == 1){
        $error_message = "<p>Sorry, user bestaat al!</p>";
    } else if($_GET['errorcode'] == 2){
        $error_message = "<p>Sorry, database is offline!</p>";
    } else {
        $error_message = "<p>Sorry, er is een fout opgetreden!</p>";
    }    
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
    <?=$error_message?>
    <script>
        // stuur de gebruiker automatisch terug naar de get.php pagina
        setTimeout(function(){
            window.location.href = "get.php";
        }, 3000);
    </script>
</body>
</html>

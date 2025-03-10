<?php

require("database.php");

if(isset($_POST['user']) && isset($_POST['age'])){
   // lees de users eerst in van de post variabelen:
     $user = $_POST['user'];
     $age = $_POST['age'];  


     if(insert_user($user, $age)){ 
          header("Location: get.php");
     } else {
          header("Location: error.php?errorcode=$errorcode");
     }      
}
?>

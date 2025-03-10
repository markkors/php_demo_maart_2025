<?php

require_once("database.php");
if(isset($_POST['user']) && isset($_POST['age'])){
   if(insert_user()) {
        header("Location: get.php");
   } else {
        header("Location: error.php?errorcode=$errorcode");
   }      
}
?>

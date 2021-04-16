<?php
 include_once("./class/database.class.php");
 $sql = new database();
if(isset($_POST['donnee'])){
  
$x=$_POST['donnee'];

    echo 'Success';

}
?>
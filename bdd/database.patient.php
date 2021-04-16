<?php
 include_once("./class/database.class.php");
 $sql = new database();
if(isset($_POST['donnee'])){
  
$x=$_POST['donnee'];
$this->user->sql->request('insert into consultation (id_consultation,motif) values(DEFAULT,:motif)',
array(

    'motif' => $x 

));
    echo 'Success';

}
?>
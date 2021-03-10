<?php

if( isset($_POST['nom']) && isset($_POST['prenom']) ){
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];

if( ($_POST['nom']!="") && ($_POST['prenom']!="") ){

//verif if exist
$n = $this->user->sql->request(
    'select * from patient where nom=:nom and prenom=:prenom  ',
    array(
        'nom' => $nom,
        'prenom' => $prenom,

    )
);
$y = $n->fetch();

if ($n->rowCount() == 1) {echo'exist';}
else{  $this->user->sql->request('insert into patient (code_patient,nom,prenom) values(DEFAULT,:nom,:prenom)',
    array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        
       



));
echo'Success';
}

}
else {echo'vide';}
}


?>
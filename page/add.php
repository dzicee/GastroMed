<?php

               

if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age']) && isset($_POST['daten']) && isset($_POST['adresse']) && isset($_POST['fonction']) && isset($_POST['mob1']) && isset($_POST['mob2']) && isset($_POST['sf']) && isset($_POST['sexe'])  && isset($_POST['email']) && isset($_POST['medicaux']) && isset($_POST['chir']) && isset($_POST['famil']) && isset($_POST['autre']) ){
    
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$daten=$_POST['daten'];
$age=$_POST['age'];
$adresse=$_POST['adresse'];
$fonction=$_POST['fonction'];
$mob1=$_POST['mob1'];
$mob2=$_POST['mob2'];
$sf=$_POST['sf'];
$sexe=$_POST['sexe'];
$email=$_POST['email'];
$medicaux=$_POST['medicaux'];
$autre=$_POST['autre'];
$famil=$_POST['famil'];
$chir=$_POST['chir'];

if( ($_POST['nom']!="") && ($_POST['prenom']!="") && ($_POST['age']!="") ){

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
else{  $this->user->sql->request('insert into patient (code_patient,nom,prenom,date_nec,age,adresse,fonction,mobile1,mobile2,sf,sexe,date_creation,email,Ant_med,Ant_chir,Ant_famil,autre) values(DEFAULT,:nom,:prenom,:date_nec,:age,:adresse,:fonction,:mobile1,:mobile2,:sf,:sexe,:datec,:email,:medicaux,:chir,:famil,:autre)',
    array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'date_nec' => $daten,
        'age' => $age,
        'adresse' => $adresse,
        'fonction' => $fonction,
        'mobile1' => $mob1,
        'mobile2' => $mob2,
        'sf' => $sf,
        'sexe' => $sexe,
        'datec' =>date("Y-m-d H:i:s"),
        'email' =>$email,
        'medicaux' =>$medicaux,
        'chir' =>$chir,
        'famil' =>$famil,
        'autre' =>$autre

        
       



));
// create vsriable 
//verif if exist
$nn = $this->user->sql->request(
    'select * from patient where nom=:nom and prenom=:prenom  ',
    array(
        'nom' => $nom,
        'prenom' => $prenom,

    )
);
$yy = $nn->fetch();
$_SESSION["current_patient"]=$yy["Code_patient"];

echo'Success';

}

}
else {echo'vide';}
}


?>
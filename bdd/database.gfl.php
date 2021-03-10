<?php
include_once("../class/database.class.php");
$sql = new database();
 if(isset($_POST['supp'])){
	$sql->request('delete from compte where id_compte=:id', array('id' => $_POST['supp']));
}

else if(isset($_POST['affclient'])){
	
	
	$labo = $sql->request('select * from labo where id_labo=:id', array('id' => $_POST['id_labo']))->fetch();
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $labo['id_compte']))->fetch();
    
}



else if(isset($_POST['aff'])){
	
	$labo = $sql->request('select * from labo where id_labo=:id', array('id' => $_POST['id_labo']))->fetch();
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $labo['id_compte']))->fetch();
	$total=$compte['airr_cours']+$compte['airr']+$compte['airr_mois'];
	echo '
			<div class="modal-content">
				<br>
				<table cellpadding="10" align="center">
  <tr>
    <th class="tg-s268"><form name="input" action="index.php?infos" method="post">
<input type="hidden" value="'. $compte['id_compte'].'" name="user_id" />
<input type="hidden" value="'. $compte['Code_client'].'" name="code" />

<button type="submit" class="btn btn-primary btn-lg" > Détail Du Client</button>

</form></th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th class="tg-s268"><form name="input" action="index.php?detail_app" method="post">
<input type="hidden" value="'. $compte['id_compte'].'" name="user_id" />



<button type="submit" class="btn btn-primary btn-lg"> Détail Appartement</button>
</form></th>
  </tr>
  <tr>
    <td align="right"></td>
			<td>
			<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
					
				</div>
			</div>
			</td>
  </tr>
  <tr>
  </tr>
</table>
				
				
				
				
				
				
				
				
			







			
			
	';
}

if(isset($_POST['affgfl'])){
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $_POST['idgfl']))->fetch();
	echo '
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Compte GFL</h2>
				</div>
				<div class="modal-body">
					 <h3 align="center"><span style="text-decoration:underline;">Nom/Prénom <br/></span>Mr/Mmme '.$compte['nom'].' '.$compte['prenom'].'</h3>
					 <h3 align="center"><span style="text-decoration:underline;">Grade <br/></span>Gestion Financier de Laboratoire (Administrateur)</h3>
				</div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>
	';
}
else if(isset($_POST['modif'])){
	$labo = $sql->request('select * from labo where id_labo=:id', array('id' => $_POST['id_labo']))->fetch();
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $labo['id_compte']))->fetch();
	
	echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Edition Client N° '.$compte['id_compte'].'</h2>
				</div>
				<div class="modal-body">
					<div><label for="user_d"><h3>Nom d\'utilisateur : </h3></label><input type="text" class="form-control input-large" name="user_d" id="user_d" value="'.$compte['username'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="nom_d"><h3>Nom : </h3></label><input type="text" class="form-control input-large" name="nom_d" id="nom_d" value="'.$compte['nom'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Prénom : </h3></label><input type="text" class="form-control input-large" name="prenom_d" id="prenom_d" value="'.$compte['prenom'].'" style="display:inline;margin-left:15px;"/></div>
					
					<div><label for="prenom_d"><h3>Date de naisssance : </h3></label><input type="text" class="form-control input-large" name="date_nec" id="date_nec" value="'.$compte['date_nec'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Email : </h3></label><input type="text" class="form-control input-large" name="email" id="email" value="'.$compte['email'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="commune"><h3>commune : </h3></label><input type="text" class="form-control input-large" name="commune" id="commune" value="'.$compte['commune'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>cité : </h3></label><input type="text" class="form-control input-large" name="cite" id="cite" value="'.$compte['cite'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Type de logement : </h3></label><input type="text" class="form-control input-large" name="typ" id="typ" value="'.$compte['typee'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>N° Batiment: </h3></label><input type="text" class="form-control input-large" name="n_batiment" id="n_batiment" value="'.$compte['n_batiment'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>N°D\'appartement  : </h3></label><input type="text" class="form-control input-large" name="appartement" id="appartement" value="'.$compte['appartement'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Nombre d\'enfant : </h3></label><input type="text" class="form-control input-large" name="airr" id="airr" value="'.$compte['nbre_enf'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Fonction : </h3></label><input type="text" class="form-control input-large" name="fonct" id="fonct" value="'.$compte['fonction'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Telephone : </h3></label><input type="text" class="form-control input-large" name="tel" id="tel" value="'.$compte['tel'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Dérniere mois payé  : </h3></label><input type="text" class="form-control input-large" name="der_mois_p" id="der_mois_p" value="'.$compte['der_mois_p'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Dérniere année payé : </h3></label><input type="text" class="form-control input-large" name="der_annee_p" id="der_annee_p" value="'.$compte['der_annee_p'].'" style="display:inline;margin-left:15px;"/></div>
					<input type="hidden" name="idc" id="idc" value="'.$labo['id_compte'].'" />
				 </div>
				<div class="modal-footer">
					<a id="submitModifLabo" href="#" class="btn btn-circle green"><i class="fa fa-plus"></i> Enregistrer</a>
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
					<script src=\'js/modif_gfl.js\'></script>
				</div>
			</div>';
}
else if(isset($_POST['modifgfl'])){
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $_POST['idgfl']))->fetch();
	
	echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Edition Administration du Compte '.$compte['username'].'</h2>
				</div>
				<div class="modal-body">
					<div><label for="user_d"><h3>Nom d\'utilisateur : </h3></label><input type="text" class="form-control input-large" name="user_d" id="user_d" value="'.$compte['username'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="nom_d"><h3>Nom Administrateur : </h3></label><input type="text" class="form-control input-large" name="nom_d" id="nom_d" value="'.$compte['nom'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Prénom Administrateur : </h3></label><input type="text" class="form-control input-large" name="prenom_d" id="prenom_d" value="'.$compte['typee'].'" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Date de naisssance : </h3></label><input type="text" class="form-control input-large" name="prenom_d" id="prenom_d" value="'.$compte['date_nec'].'" style="display:inline;margin-left:15px;"/></div>
					<input type="hidden" name="idc" id="idc" value="'.$compte['id_compte'].'" />
				 </div>
				<div class="modal-footer">
					<a id="submitModifGFL" href="#" class="btn btn-circle green"><i class="fa fa-plus"></i> Enregistrer</a>
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
					<script src=\'js/modif_gfl.js\'></script>
				</div>
			</div>';
}
else if(isset($_POST['notif'])){
	if(isset($_COOKIE['token_agfl'])){
		$compte = $sql->request('select * from compte where id_compte=:ide', array('ide' => $_POST['idgfl']))->fetch();
		$notifs = $sql->request('select * from quittance where Code_client=:ide ORDER BY  num_quitance DESC ',
								array(
									'ide' => $compte['Code_client'],
									
								));
		echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Historique des Paiements </h2>
				</div>
				<div class="modal-body" align="center">
					<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;text-align:center;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg .tg-hgcj{font-weight:bold;text-align:center}
					</style>
					<table class="tg"><thead><tr>
					<th class="tg-hgcj" width="150">N° Quittance </th>
					<th class="tg-hgcj" width="550">Date Quittance</th>
					<th class="tg-hgcj" width="550">Du</th>
					<th class="tg-hgcj" width="550">Au</th>
					<th class="tg-hgcj" width="550">Montant TTC</th>
					
					</tr></thead><tbody>';
			while(($notif=$notifs->fetch())){
				echo '
					<tr>
					<td class="tg-031e">'.$notif['num_quitance'].'</td>
					<td class="tg-031e">'.$notif['date_quitt'].'</td>
					<td class="tg-031e">'.$notif['du_mois'].' / '.$notif['de_lannee'].'</td>
					<td class="tg-031e">'.$notif['au_mois'].' / '.$notif['au_lannee'].'</td>
					<td class="tg-031e"> '.$notif['montant_ttc'].' DA</td>
					</tr>
				';
			}			
				echo '</tbody></table></div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>';
	}
	else{
		echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Notifications de '.$compte['username'].'</h2>
				</div>
				<div class="modal-body">
					<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg .tg-hgcj{font-weight:bold;text-align:center}
					</style>
					<table class="tg" align="center"><thead><tr>
					<th class="tg-hgcj" width="150">Date / Heure</th>
					<th class="tg-hgcj" width="550">Notification</th>
					</tr></thead><tbody>
					<td class="tg-031e">Erreur Chargement ! veuiller actualiser votre page web</td>
					</tbody></table></div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>';
	}
}


else if(isset($_POST['password'])){
	if(isset($_COOKIE['token_agfl'])){
		$compte = $sql->request('select * from compte where id_compte=:ide', array('ide' => $_POST['idgfl']))->fetch();
		$notifs = $sql->request('select * from bon where id_compte=:ide  order by date desc',
								array(
									'ide' => $_POST['idgfl'],
									
								));
		echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Password</h2>
				</div>
				<div class="modal-body" align="center">
					<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;text-align:center;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg .tg-hgcj{font-weight:bold;text-align:center}
					</style>
					<table class="tg"><thead><tr>
					<th class="tg-hgcj" width="150">Password</th>
				
					
					</tr></thead><tbody>';
			while(($notif=$notifs->fetch())){
				echo '
					<tr>
					<td class="tg-031e">'.$compte['password'].'</td>
					
					</tr>
				';
			}			
				echo '</tbody></table></div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>';
	}
	else{
		echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Notifications de '.$compte['username'].'</h2>
				</div>
				<div class="modal-body">
					<style type="text/css">
					.tg  {border-collapse:collapse;border-spacing:0;}
					.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
					.tg .tg-hgcj{font-weight:bold;text-align:center}
					</style>
					<table class="tg" align="center"><thead><tr>
					<th class="tg-hgcj" width="150">Date / Heure</th>
					<th class="tg-hgcj" width="550">Notification</th>
					</tr></thead><tbody>
					<td class="tg-031e">Erreur Chargement ! veuiller actualiser votre page web</td>
					</tbody></table></div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>';
	}
}



else if(isset($_POST['situation'])){
	
$vent = $sql->request('select * from ventilation where id_labo=:id and annee=:annee', array('id' => $_POST['id_labo'], 'annee' => $_POST['annee']))->fetch();
$compte = $sql->request('select * from compte where id_compte=(select id_compte from labo where id_labo=:id)', array('id' => $vent['id_labo']))->fetch();
if($vent != null){
$ventile = array(
				(double)$vent['c1a1'],
				(double)$vent['c1a2'],
				(double)$vent['c1a3'],
				(double)$vent['c1a4'],
				(double)$vent['c1a5'],
				(double)$vent['c1a6'],
				(double)$sql->request("select sum(c1a1+c1a2+c1a3+c1a4+c1a5+c1a6) as tc from ventilation where id_ventilation=:idvent", array('idvent' => $vent['id_ventilation']))->fetch()['tc'],
				(double)$vent['c2a1'],
				(double)$vent['c2a2'],
				(double)$vent['c2a3'],
				(double)$vent['c2a4'],
				(double)$sql->request("select sum(c2a1+c2a2+c2a3+c2a4) as tc from ventilation where id_ventilation=:idvent", array('idvent' => $vent['id_ventilation']))->fetch()['tc'],
				(double)$vent['c3a1'],
				(double)$vent['c3a2'],
				(double)$vent['c3a3'],
				(double)$vent['c3a4'],
				(double)$vent['c3a5'],
				(double)$vent['c3a6'],
				(double)$vent['c3a7'],
				(double)$sql->request("select sum(c3a1+c3a2+c3a3+c3a4+c3a5+c3a6+c3a7) as tc from ventilation where id_ventilation=:idvent", array('idvent' => $vent['id_ventilation']))->fetch()['tc'],
				(double)$vent['c4a1'],
				(double)$vent['c4a2'],
				(double)$vent['c4a3'],
				(double)$vent['c4a4'],
				(double)$vent['c4a5'],
				(double)$sql->request("select sum(c4a1+c4a2+c4a3+c4a4+c4a5) as tc from ventilation where id_ventilation=:idvent", array('idvent' => $vent['id_ventilation']))->fetch()['tc'],
				(double)$vent['c5a1'],
				(double)$vent['c5a2'],
				(double)$sql->request("select sum(c5a1+c5a2) as tc from ventilation where id_ventilation=:idvent", array('idvent' => $vent['id_ventilation']))->fetch()['tc'],
				(double)$vent['c6a1'],
				(double)$vent['c6a2p1'],
				(double)$vent['c6a2p2'],
				(double)$vent['c6a2p3'],
				(double)$vent['c6a2p4'],
				(double)$vent['c6a2p5'],
				(double)$vent['c6a3'],
				(double)$vent['c6a4'],
				(double)$vent['c6a5'],
				(double)$vent['c6a6'],
				(double)$vent['c6a7'],
				(double)$vent['c6a8'],
				(double)$sql->request("select sum(c6a1+c6a2p1+c6a2p2+c6a2p3+c6a2p4+c6a2p5+c6a3+c6a4+c6a5+c6a6+c6a7+c6a8) as tc from ventilation where id_ventilation=:idvent", array('idvent' => $vent['id_ventilation']))->fetch()['tc'],
				(double)$vent['c7a1'],
				(double)$vent['c7a1'],
				(double)$vent['total'],
			);
$consomme = array();
$cpt=0;
//chapitre 1
for($i=1;$i<=6;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'1\' and art=:art and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'art' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=6;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
//fin chapitre 1
//chapitre 2
for($i=1;$i<=4;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'2\' and art=:art and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'art' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=4;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
//fin chapitre 2
//chapitre 3
for($i=1;$i<=7;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'3\' and art=:art and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'art' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=7;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
//fin chapitre 3
//chapitre 4
for($i=1;$i<=5;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'4\' and art=:art and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'art' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=5;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
//fin chapitre 4
//chapitre 5
for($i=1;$i<=2;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'5\' and art=:art and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'art' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=2;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
//fin chapitre 5
//chapitre 6
$consomme[$cpt] = (double)0;
$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'6\' and art=\'1\' and valide=\'1\')', 
					array('idc' => $compte['id_compte'], 'annee' => $vent['annee']));
while(($bon=$list_bon->fetch())){
	$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
	$nature = array(explode("#%", $bon['nature']));
	$prix = array(explode("#%", $facture['prix_unitaire']));
	$somme = (double)0;
	for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
		$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
	}
	$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
	$consomme[$cpt] = $consomme[$cpt] + $somme;
}
$cpt++;
//chapitre 6 article 2	
for($i=1;$i<=5;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'6\' and art=\'2\' and par=:par and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'par' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=5;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
//fin chapitre 6 article 2
//chapitre 6 article 3 - 8
for($i=3;$i<=8;$i++,$cpt++){
	$consomme[$cpt] = (double)0;
	$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'6\' and art=:art and valide=\'1\')', 
						array('idc' => $compte['id_compte'], 'annee' => $vent['annee'], 'art' => $i));
	while(($bon=$list_bon->fetch())){
		$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
		$nature = array(explode("#%", $bon['nature']));
		$prix = array(explode("#%", $facture['prix_unitaire']));
		$somme = (double)0;
		for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
			$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
		}
		$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
		$consomme[$cpt] = $consomme[$cpt] + $somme;
	}
}
$consomme[$cpt] = (double)0;
for($i=1;$i<=12;$i++){
	$consomme[$cpt] = $consomme[$cpt] + $consomme[$cpt-$i];
}
$cpt++;
// fin chapitre 6
//chapitre 7
$consomme[$cpt] = (double)0;
$list_bon = $sql->request('select * from bon where id_compte=:idc and annee=:annee and id_facture in (select id_facture from facture where chap=\'7\' and valide=\'1\')', 
					array('idc' => $compte['id_compte'], 'annee' => $vent['annee']));
while(($bon=$list_bon->fetch())){
	$facture = $sql->request('select * from facture where id_facture=:id', array('id' => $bon['id_facture']))->fetch();
	$nature = array(explode("#%", $bon['nature']));
	$prix = array(explode("#%", $facture['prix_unitaire']));
	$somme = (double)0;
	for($j=0,$k=1;$j<count($prix[0]);$j++,$k+=2){
		$somme = $somme + (double)$prix[0][$j] * $nature[0][$k];
	}
	$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
	$consomme[$cpt] = $consomme[$cpt] + $somme;
}
$consomme[$cpt+1] = $consomme[$cpt]; $cpt++;
$consomme[$cpt] = (double)0;
$consomme[$cpt] = $consomme[$cpt] + $consomme[6] + $consomme[11] + $consomme[19] + $consomme[25] + $consomme[28] + $consomme[42] + $consomme[44];
	
	echo '
	<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Taux Epargne de Laboratoire '.$sql->request('select nom_labo from labo where id_labo=:id', array('id' => $vent['id_labo']))->fetch()['nom_labo'].' en '.$_POST['annee'].'</h4>
				</div>
				<div class="modal-body">
		<style type="text/css">
${demo.css}
		</style>
		
<script src="js/charts/exporting.js"></script>
		<script type="text/javascript">
$(function () {

    var colors = Highcharts.getOptions().colors,
        categories = [\'Chapitre I<br />('.number_format($ventile[6]-$consomme[6], 2, ',', ' ').')\', 
					\'Chapitre II<br />('.number_format($ventile[11]-$consomme[11], 2, ',', ' ').')\', 
					\'Chapitre III<br />('.number_format($ventile[19]-$consomme[19], 2, ',', ' ').')\', 
					\'Chapitre IV<br />('.number_format($ventile[25]-$consomme[25], 2, ',', ' ').')\', 
					\'Chapitre V<br />('.number_format($ventile[28]-$consomme[28], 2, ',', ' ').')\',
 					\'Chapitre VI<br />('.number_format($ventile[41]-$consomme[41], 2, ',', ' ').')\', 
					\'Chapitre VII<br />('.number_format($ventile[43]-$consomme[43], 2, ',', ' ').')\'],
        data = [{
            y: '.sprintf("%.2f", (($ventile[6]-$consomme[6]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[0],
            drilldown: {
                name: \'ChapitreI Reste\',
                categories: [\'Article 1('.number_format($ventile[0]-$consomme[0], 2, ',', ' ').')\', 
							\'Article 2('.number_format($ventile[1]-$consomme[1], 2, ',', ' ').')\', 
							\'Article 3('.number_format($ventile[2]-$consomme[2], 2, ',', ' ').')\', 
							\'Article 4('.number_format($ventile[3]-$consomme[3], 2, ',', ' ').')\', 
							\'Article 5('.number_format($ventile[4]-$consomme[4], 2, ',', ' ').')\', 
							\'Article 6('.number_format($ventile[5]-$consomme[5], 2, ',', ' ').')\'],
                data: [';
					if($ventile[6]-$consomme[6] != 0){
						echo sprintf("%.2f", (($ventile[0]-$consomme[0]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[1]-$consomme[1]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[2]-$consomme[2]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[3]-$consomme[3]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[4]-$consomme[4]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[5]-$consomme[5]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0);
					}
				echo '],
                color: colors[0]
            }
        }, {
            y: '.sprintf("%.2f", (($ventile[11]-$consomme[11]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[1],
            drilldown: {
                name: \'ChapitreII Reste\',
                categories: [\'Article 1('.number_format($ventile[7]-$consomme[7], 2, ',', ' ').')\', 
							\'Article 2('.number_format($ventile[8]-$consomme[8], 2, ',', ' ').')\', 
							\'Article 3('.number_format($ventile[9]-$consomme[9], 2, ',', ' ').')\', 
							\'Article 4('.number_format($ventile[10]-$consomme[10], 2, ',', ' ').')\'],
                data: [';
					if($ventile[11]-$consomme[11] != 0){
						echo sprintf("%.2f", (($ventile[7]-$consomme[7]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[8]-$consomme[8]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[9]-$consomme[9]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[10]-$consomme[10]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0).','.(0.0).','.(0.0).','.(0.0);
					}
				echo '],
                color: colors[1]
            }
        }, {
            y: '.sprintf("%.2f", (($ventile[19]-$consomme[19]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[2],
            drilldown: {
                name: \'ChapitreIII Reste\',
                categories: [\'Article 1('.number_format($ventile[12]-$consomme[12], 2, ',', ' ').')\', 
							\'Article 2('.number_format($ventile[13]-$consomme[13], 2, ',', ' ').')\', 
							\'Article 3('.number_format($ventile[14]-$consomme[14], 2, ',', ' ').')\', 
							\'Article 4('.number_format($ventile[15]-$consomme[15], 2, ',', ' ').')\', 
							\'Article 5('.number_format($ventile[16]-$consomme[16], 2, ',', ' ').')\', 
							\'Article 6('.number_format($ventile[17]-$consomme[17], 2, ',', ' ').')\', 
							\'Article 7('.number_format($ventile[18]-$consomme[18], 2, ',', ' ').')\'],
                data: [';
					if($ventile[19]-$consomme[19] != 0){
						echo sprintf("%.2f", (($ventile[12]-$consomme[12]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[13]-$consomme[13]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[14]-$consomme[14]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[15]-$consomme[15]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[16]-$consomme[16]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[17]-$consomme[17]) * 100.0 / ($ventile[44]-$consomme[44]))).', 
						'.sprintf("%.2f", (($ventile[18]-$consomme[18]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0);
					}
				echo '],
                color: colors[2]
            }
        }, {
            y: '.sprintf("%.2f", (($ventile[25]-$consomme[25]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[3],
            drilldown: {
                name: \'ChapitreIV Reste\',
                categories: [\'Article 1('.number_format($ventile[20]-$consomme[20], 2, ',', ' ').')\', 
							\'Article 2('.number_format($ventile[21]-$consomme[21], 2, ',', ' ').')\', 
							\'Article 3('.number_format($ventile[22]-$consomme[22], 2, ',', ' ').')\', 
							\'Article 4('.number_format($ventile[23]-$consomme[23], 2, ',', ' ').')\', 
							\'Article 5('.number_format($ventile[24]-$consomme[24], 2, ',', ' ').')\'],
                data: [';
					if($ventile[25]-$consomme[25] != 0){
						echo sprintf("%.2f", (($ventile[20]-$consomme[20]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[21]-$consomme[21]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[22]-$consomme[22]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[23]-$consomme[23]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[24]-$consomme[24]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0);
					}
				echo '],
                color: colors[3]
            }
        }, {
            y: '.sprintf("%.2f", (($ventile[28]-$consomme[28]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[4],
            drilldown: {
                name: \'ChapitreV Reste\',
                categories: [\'Article 1('.number_format($ventile[26]-$consomme[26], 2, ',', ' ').')\', 
							\'Article 2('.number_format($ventile[27]-$consomme[27], 2, ',', ' ').')\'],
                data: [';
					if($ventile[28]-$consomme[28] != 0){
						echo sprintf("%.2f", (($ventile[26]-$consomme[26]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[27]-$consomme[27]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0).','.(0.0);
					}
				echo '],
                color: colors[4]
            }
        }, {
            y: '.sprintf("%.2f", (($ventile[41]-$consomme[41]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[5],
            drilldown: {
                name: \'ChapitreVI Reste\',
                categories: [\'Article 1('.number_format($ventile[29]-$consomme[29], 2, ',', ' ').')\', 
							\'Article 2('.number_format(($ventile[30]+$ventile[31]+$ventile[32]+$ventile[33]+$ventile[34]-$consomme[30]-$consomme[31]-$consomme[32]-$consomme[33]-$consomme[34]), 2, ',', ' ').')\', 
							\'Article 3('.number_format($ventile[35]-$consomme[35], 2, ',', ' ').')\', 
							\'Article 4('.number_format($ventile[36]-$consomme[36], 2, ',', ' ').')\', 
							\'Article 5('.number_format($ventile[37]-$consomme[37], 2, ',', ' ').')\', 
							\'Article 6('.number_format($ventile[38]-$consomme[38], 2, ',', ' ').')\', 
							\'Article 7('.number_format($ventile[39]-$consomme[39], 2, ',', ' ').')\', 
							\'Article 8('.number_format($ventile[40]-$consomme[40], 2, ',', ' ').')\'],
                data: [';
					if($ventile[41]-$consomme[41] != 0){
						echo sprintf("%.2f", (($ventile[29]-$consomme[29]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[30]+$ventile[31]+$ventile[32]+$ventile[33]+$ventile[34]-$consomme[30]-$consomme[31]-$consomme[32]-$consomme[33]-$consomme[34]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[35]-$consomme[35]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[36]-$consomme[36]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[37]-$consomme[37]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[38]-$consomme[38]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[39]-$consomme[39]) * 100.0 / ($ventile[44]-$consomme[44]))).',
						'.sprintf("%.2f", (($ventile[40]-$consomme[40]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0).','.(0.0);
					}
				echo '],
                color: colors[5]
            }
        }, {
            y: '.sprintf("%.2f", (($ventile[43]-$consomme[43]) * 100.0 / ($ventile[44]-$consomme[44]))).',
            color: colors[6],
            drilldown: {
                name: \'ChapitreVII Reste\',
                categories: [\'Article 1('.number_format($ventile[42]-$consomme[42], 2, ',', ' ').')\'],
                data: [';
					if($ventile[43]-$consomme[43] != 0){
						echo sprintf("%.2f", (($ventile[42]-$consomme[42]) * 100.0 / ($ventile[44]-$consomme[44])));
					}
					else{
						echo (0.0);
					}
				echo '],
                color: colors[6]
            }
        }],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart
    $(\'#container\').highcharts({
        chart: {
            type: \'pie\'
        },
        title: {
            text: \'\'
        },
        yAxis: {
            title: {
                text: \'Total percent market share\'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: [\'50%\', \'50%\']
            }
        },
        tooltip: {
            valueSuffix: \'%\'
        },
        series: [{
            name: \'Reste\',
            data: browserData,
            size: \'70%\',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: \'white\',
                distance: -30
            }
        }, {
            name: \'Reste\',
            data: versionsData,
            size: \'100%\',
            innerSize: \'80%\',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? \'<b>\' + this.point.name + \':</b> \' + this.y + \'%\'  : null;
                }
            }
        }]
    });
});
		</script>
		


<div id="container" style="width: 750px; height: 400px; margin: 0 auto"></div>
</div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>
	';
}
}


else if(isset($_POST['paye'])){
	$labo = $sql->request('select * from labo where id_labo=:id', array('id' => $_POST['id_labo']))->fetch();
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $labo['id_compte']))->fetch();
	$total=$compte['airr_cours']+$compte['airr']+$compte['airr_mois'];
	
	echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Quittance Client N° '.$compte['id_compte'].'</h2>
				</div>
				<div class="modal-body">
				<p>
<table border="0">
<tbody>
<tr>
<td><label for="user_d"><h3>Dérniere mois payé  : </h3></label></td>
<td><input type="text" class="form-control input-large" readonly name="user_d" id="user_d" value="'.$compte['der_mois_p'].'" style="display:inline;margin-left:15px;"/></td>
</tr>
<tr>
<td><label for="nom_d"><h3>Dérniere année payé : </h3></label></td>
<td><input type="text" class="form-control input-large"  readonly name="nom_d" id="nom_d" value="'.$compte['der_annee_p'].'" style="display:inline;margin-left:15px;"/></td>
</tr>
<tr>
<td><label for="prenom_d"><h3>Arriéré :</h3></label></td>
<td><input type="text" class="form-control input-large" readonly name="date_nec" id="date_nec" value="'.$compte['airr'].' DA" style="display:inline;margin-left:15px;"/></td>
</tr>

<tr>
<td><label for="prenom_d"><h3>Loyer En Cours  : </h3></label></td>
<td><input type="text" class="form-control input-large" readonly name="loyer" id="loyer" value="'.$compte['airr_mois'].'" style="display:inline;margin-left:15px;"/></td>

</tr>
<tr>
<td><label for="prenom_d"><h3>Chrgs En Cours  : </h3></label></td>
<td><input type="text" class="form-control input-large" readonly name="chrg" id="chrg" value="700 DA" style="display:inline;margin-left:15px;"/></td>
</tr>

<tr>
<td><label for="prenom_d"><h3>Nombre de Mois  : </h3></label></td>
<td><input type="number" class="form-control input-large" name="nbrm" id="nbrm" value="1" style="display:inline;margin-left:15px;"/></td>

</tr>
<tr>
<td> </td>
<td style="text-align: center;">&nbsp;&nbsp;<a id="app" href="#portlet-config2"  data-toggle="modal" class="btn btn-circle red"><i class="fa fa-plus"></i> Appliquer Nbre Mois  </a></td>
</tr>
</tbody>
</table>
<!-- pagebreak --></p>


					<p>
<table border="0">
<tbody>
					
					<tr><td><label for="prenom_d"><h3>Montatnt HT : </h3></label></td><td><input type="text" class="form-control input-large" name="mht" id="mht" readonly value="0" style="display:inline;margin-left:15px;"/></td></tr>
					<tr><td><label for="prenom_d"><h3>Taux TVA : </h3></label></td><td><input type="text" class="form-control input-large" name="fonct" id="fonct" readonly value="9%" style="display:inline;margin-left:15px;"/></td></tr>
					<tr><td><label for="prenom_d"><h3>Montant TVA : </h3></td><td></label><input type="text" class="form-control input-large" name="mtva" id="mtva" readonly value="0" style="display:inline;margin-left:15px;"/></div></td></tr>
					<tr><td><label for="prenom_d"><h3>Pénalité De Retard   : </h3></label></td><td><input type="text" class="form-control input-large" name="der_mois_p" id="der_mois_p" readonly value="0.00 DA" style="display:inline;margin-left:15px;"/></td></tr>
					<tr><td><label for="prenom_d"><h3>Montant TTC : </h3></label></td><td><input type="text" class="form-control input-large" name="mttc" id="mttc" readonly value="'.$compte['der_annee_p'].'" style="display:inline;margin-left:15px;"/></td></tr>
					<tr><td><label for="prenom_d"><h3>Timbre : </h3></label></td><td><input type="text" class="form-control input-large" name="der_annee_p" id="der_annee_p" readonly value="29.00 DA" style="display:inline;margin-left:15px;"/></td></tr>
					<tr><td><label for="prenom_d"><h3>Montant a Payer : </h3></label></td><td><input type="text" class="form-control input-large" name="mp" id="mp" readonly value="" style="display:inline;margin-left:15px;"/></td></tr>
					
	</tbody>
</table>
<!-- pagebreak --></p>
<p>&nbsp;</p>				
					
					
					
				 </div>
				<div class="modal-footer">
					<a id="submitPaye" href="#" class="btn btn-circle green"><i class="fa fa-plus"></i> Enregistrer</a>
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
					<script src=\'js/modif_gfl.js\'></script>
				</div>
			</div>';
}


else if(isset($_POST['suppFourni'])){
	$fournisseur = $sql->request('select * from compte where id_compte=:id', array('id' => $_POST['suppFourni']))->fetch();
	$sql->request('update compte set supp=1 where id_compte=:id', array('id' => $_POST['suppFourni']));
	
	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			
				$gfl = $sql->request('select * from compte where id_compte!=:id', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										
										'idr' => $y['id_compte'],
										'notif' => 'Suppression fournisseur: '.$fournisseur['nom'],
										'icon' => 'fa fa-plus'
									));
				}
		}
}



else if(isset($_POST['ajout'])){
	echo '<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h2 class="modal-title" align="center">Ajouter Nouveau Client</h4>
				</div>
				<div class="modal-body">
					<div><label for="auser_d"><h3>Nom d\'utilisateur : </h3></label><input type="text" class="form-control input-large" name="auser_d" id="auser_d" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="auser_d"><h3>Code Client : </h3></label><input type="text" class="form-control input-large" name="code" id="code" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="nom_d"><h3>Nom : </h3></label><input type="text" class="form-control input-large" name="anom_d" id="anom_d" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Prénom : </h3></label><input type="text" class="form-control input-large" name="aprenom_d" id="aprenom_d" value="" style="display:inline;margin-left:15px;"/></div>
					
					
					<div><label for="prenom_d"><h3>Date de naisssance : </h3></label><input type="date" class="form-control input-large" name="adate_nec" id="adate_nec" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Lieu NESS : </h3></label><input type="text" class="form-control input-large" name="aemail" id="aemail" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="commune"><h3>commune : </h3></label><input type="text" class="form-control input-large" name="acommune" id="acommune" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="cite"><h3>cité : </h3></label><input type="text" class="form-control input-large" name="acite" id="acite" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Type de logement : </h3></label><input type="text" class="form-control input-large" name="atyp" id="atyp" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>N° Batiment: </h3></label><input type="text" class="form-control input-large" name="an_batiment" id="an_batiment" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>N°D\'appartement  : </h3></label><input type="text" class="form-control input-large" name="aappartement" id="aappartement" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="preno"><h3>Prenom Pere  : </h3></label><input type="text" class="form-control input-large" name="surf" id="surf" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="preno"><h3>Date D\'occupation  : </h3></label><input type="date" class="form-control input-large" name="occup" id="occup" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Sexe  : </h3></label><input type="text" class="form-control input-large" name="sexe" id="sexe" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Loyer Mensuel : </h3></label><input type="text" class="form-control input-large" name="tela" id="tela" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Dérniere mois payé  : </h3></label><input type="text" class="form-control input-large" name="ader_mois_p" id="ader_mois_p" value="" style="display:inline;margin-left:15px;"/></div>
					<div><label for="prenom_d"><h3>Dérniere année payé : </h3></label><input type="text" class="form-control input-large" name="ader_annee_p" id="ader_annee_p" value="" style="display:inline;margin-left:15px;"/></div>
				 </div>
				<div class="modal-footer">
					<a id="submitAjoutLabo" href="#" class="btn btn-circle green"><i class="fa fa-plus"></i> Ajouter</a>
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
					<script src=\'js/modif_gfl.js\'></script>
				</div>
			</div>';
}
else if(isset($_POST['submitModifLabo'])){
	$sql->request('update compte set username=:username,nom=:nom,prenom=:prenom,date_nec=:date_nec,commune=:commune,cite=:cite,n_batiment=:n_,der_mois_p=:der_mois,der_annee_p=:der_annee,nbre_enf=:air,appartement=:appartement,typee=:typ,email=:email,fonction=:fonct,tel=:tel where id_compte=:id',
				array(
					'username' => $_POST['username'],
					'nom' => $_POST['nom'],
					'prenom' => $_POST['prenom'],
					'date_nec' => $_POST['date_nec'],
					'commune' => $_POST['commune'],
					'cite' => $_POST['cite'],
					'n_' => $_POST['n_batiment'],
					'der_mois' => $_POST['der_mois_p'],	
					'der_annee' => $_POST['der_annee_p'],
					'air' => $_POST['airr'],
					'appartement' => $_POST['appartement'],
					'typ' => $_POST['typ'],
					'email' => $_POST['email'],
					'fonct' => $_POST['fonct'],
					'tel' => $_POST['tel'],
					'id' => $_POST['submitModifLabo'],

										
				));
	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$other = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$other->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Edition directeur de Laboratoire:'.$sql->request('select nom_labo from labo where id_compte=:id', array('id' => $_POST['submitModifLabo']))->fetch()['nom_labo'],
										'icon' => 'fa fa-edit'
									));
				}
		}
}
else if(isset($_POST['verif_u'])){
	if($sql->request('select * from compte where username=:user', array('user' => $_POST['verif_u']))->fetch() == null &&
		$sql->request('select * from labo where nom_labo=:labo', array('labo' => strtoupper($_POST['verif_l'])))->fetch() == null){
			echo '0';
	}
	else{
		echo '1';
	}
}
else if(isset($_POST['verif_mu'])){
	if($sql->request('select * from compte where username=:user', array('user' => $_POST['verif_mu']))->fetch() == null){
			echo '0';
	}
	else{
		echo '1';
	}
}





else if(isset($_POST['submitAjoutLabo'])){
	$var=generateRandomString($length =8);
	$sql->request('insert into compte (id_compte,username,password,nom,prenom,grade,gfl,exe,date_nec,email,commune,typee,n_batiment,der_mois_p,der_annee_p,nbre_enf,appartement,cite,paye,date_occup,airr_cours,airr_mois,pen,fonction,surf,tel,Code_client,l_nec,presume,annee_p,sexe,sf,prenom_pere,nom_mere,prenom_mere,nom_conj,prenom_conj,date_necc,l_necc,revenu_conj,prenom_perec,nom_merec,prenom_merec,password_app) values(DEFAULT,:username,PASSWORD(:pass),:nom,:prenom,\'Directeur\',0,:exe,:date,:email,:comune,:typ,:bat,:der_mois,:der_annee_p,:air,:ap,:cit,\'En Dette\',:date,0,:telp,0,:air,0,:telp,:code,:email,"","","","",:surf,"","","","","","","","","","",:passs)',
					array(                                                                                                                                                                                                                 
						'username' => $_POST['ausername'],                                                                             													
						'pass' => md5($var),
						'nom' => $_POST['nom'],
						'prenom' => $_POST['prenom'],
						'exe' => $sql->request('select exe from compte', null)->fetch()['exe'],
						'date' => $_POST['date_nec'],
						'email' => $_POST['email'],
						'comune' => $_POST['commune'],
						'typ' => $_POST['atyp'],
						'bat' => $_POST['an_batiment'],
						'der_mois' => $_POST['ader_mois_p'],
						'der_annee_p' => $_POST['der_annee_p'],
						'air' => $_POST['air'],
						'ap' => $_POST['appt'],
						'ap' => $_POST['appt'],
						'cit' => $_POST['city'],
						'surf' => $_POST['su'],
						'occ' => $_POST['oc'],
						'telp' => $_POST['tela'],
						'passs' => $var,
						'code' => $_POST['codee'], 
						'sexe' => $_POST['sexe']
						
				));
				
				
	$sql->request('insert into tokens values(:idc,DEFAULT,DEFAULT,DEFAULT)', 
					array(
						'idc' => $sql->request('select id_compte from compte where username=:user', array('user' => $_POST['ausername']))->fetch()['id_compte']
					));
	$sql->request('insert into labo values(DEFAULT,:idc,:nom,:nomc,:annee,0,0)',
					array(
						'idc' => $sql->request('select id_compte from compte where username=:user', array('user' => $_POST['ausername']))->fetch()['id_compte'],
						'nom' => $_POST['nom'],
						'nomc' => $_POST['nom'],
						'annee' => $_POST['air']
				));
	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$other = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
			while(($y=$other->fetch())){
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
								array(
									'ide' => $compte['id_compte'],
									'idr' => $y['id_compte'],
									'notif' => 'Ajout directeur et Laboratoire:'.$sql->request('select nom_labo from labo where id_compte=(select id_compte from compte where username=:name)', array('name' => $_POST['username']))->fetch()['nom_labo'],
									'icon' => 'fa fa-plus'
								));
			}
			$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
								array(
									'ide' => $compte['id_compte'],
									'idr' => $sql->request('select id_compte from compte where username=:name', array('name' => $_POST['ausername']))->fetch()['id_compte'],
									'notif' => 'Bienvenue à notre site OPGI',
									'icon' => 'fa fa-info'
								));
		}
}


	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$other = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
			while(($y=$other->fetch())){
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
								array(
									'ide' => $compte['id_compte'],
									'idr' => $y['id_compte'],
									'notif' => 'Ajout client: avec success',
									'icon' => 'fa fa-plus'
								));
			}
			$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
								array(
									'ide' => $compte['id_compte'],
									'idr' => 1,
									'notif' => 'Bienvenue à notre site OPGI',
									'icon' => 'fa fa-info'
								));
		}

else if(isset($_POST['reintialise'])){
	$sql->request('update compte set password=PASSWORD(:pass) where id_compte=(select id_compte from labo where id_labo=:id)',
					array('pass' => md5('gfl'), 'id' => $_POST['id_labo']));
	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
								array(
									'ide' => $compte['id_compte'],
									'idr' => $sql->request('select id_compte from labo where id_labo=:id', array('id' => $_POST['id_labo']))->fetch()['id_compte'],
									'notif' => 'Mot de Passe Reintialiser : Changer Le !',
									'icon' => 'fa fa-info'
								));
		}
}
else if(isset($_POST['reintialisegfl'])){
	$sql->request('update compte set password=PASSWORD(:pass) where id_compte=:id',
					array('pass' => md5('gfl'), 'id' => $_POST['idgfl']));
	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
								array(
									'ide' => $compte['id_compte'],
									'idr' => $_POST['idgfl'],
									'notif' => 'Mot de Passe Reintialiser : Changer Le !',
									'icon' => 'fa fa-info'
								));
		}
}
else if(isset($_POST['submitModifPass'])){
	if($sql->request('select * from compte where id_compte=:id and password=PASSWORD(:pass)', array('id' => $_POST['idc'], 'pass' => md5($_POST['a_pass'])))->fetch() != null){
		$sql->request('update compte set password=PASSWORD(:pass) where id_compte=:id', array('pass' => md5($_POST['n_pass']), 'id' => $_POST['idc']));
		echo '1';
	}
	else{
		echo '0';
	}
}
else if(isset($_POST['valider'])){
	$labo = $sql->request('select * from labo where id_labo=:id', array('id' => $_POST['id_labo']))->fetch();
	$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $labo['id_compte']))->fetch();
	
	

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}







?>
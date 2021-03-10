<?php
include_once("chiffre_en_lettre.php");
include_once("../class/database.class.php");
$sql = new database();

function modifier_p_charge($idf){
	$cpt = 2;
	$bdd = new database();
	$bon = $bdd->request('select * from bon where id_facture=:id', array('id' => $idf))->fetch();
	$facture = $bdd->request('select * from facture where id_facture=:id', array('id' => $idf))->fetch();
	$somme = 0;
	$nature = array(explode("#%", $bon['nature']));
	$prix = array(explode("#%", $facture['prix_unitaire']));
	for($i=0,$j=1;$i<count($prix[0]);$i++,$j+=2){
		$somme = $somme + (double)$prix[0][$i] * (double)$nature[0][$j];
	}
	$somme = $somme * (1.0 + (double)$facture['tva'] / 100.0);
	$ancien_solde = 0.0;
	$ancien_facture = $bdd->request('select min(nsolde) as min_nsolde from charge where id_bon in (select id_bon from bon where annee=:annee and id_facture in (select id_facture from facture where id_facture!=:idf and chap=:chap and art=:art and par=:par) and id_compte=:idc)',
						array(
							'annee' => $bon['annee'],
							'idf' => $idf,
							'chap' => $facture['chap'],
							'art' => $facture['art'],
							'par' => $facture['par'],
							'idc' => $bon['id_compte']
						));
	if(($f=$ancien_facture->fetch()['min_nsolde'])){
		$ancien_solde = (double)$f;
	}
	else{
		if($facture['chap'] == 6 && $facture['art'] == 2){
			$requete = 'select c'.$facture['chap'].'a'.$facture['art'].'p'.$facture['par'].' from ventilation where id_labo=(select id_labo from labo where id_compte=:id)';
			$ancien_solde = (double)$bdd->request($requete, array('id' => $bon['id_compte']))->fetch()['c'.$facture['chap'].'a'.$facture['art'].'p'.$facture['par']];
		}
		else{
			$requete = 'select c'.$facture['chap'].'a'.$facture['art'].' from ventilation where id_labo=(select id_labo from labo where id_compte=:id)';
			$ancien_solde = (double)$bdd->request($requete, array('id' => $bon['id_compte']))->fetch()['c'.$facture['chap'].'a'.$facture['art']];
		}
	}
	if(($x=$bdd->request('select num_charge from charge where nsolde=(select min(nsolde) from charge where id_bon in (select id_bon from bon where annee=:annee and id_facture in (select id_facture from facture where id_facture!=:idf and chap=:chap and art=:art and par=:par) and id_compte=:idc))',
												array(
													'annee' => $bon['annee'],
													'idf' => $idf,
													'chap' => $facture['chap'],
													'art' => $facture['art'],
													'par' => $facture['par'],
													'idc' => $bon['id_compte']
												))->fetch())){
		$cpt = (int)$x['num_charge']+1;
	}
	$bdd->request('update charge set num_charge=:num,asolde=:a,nsolde=:n where id_bon=:id',
				array(
					'num' => $cpt,
					'a' => $ancien_solde,
					'n' => $ancien_solde - $somme,
					'id' => $bon['id_bon']
				));
}

if(isset($_POST['aff'])){
	$facture = $sql->request('select *, date_format(date, "%d-%m-%Y") as dat from facture where id_facture=:id', array('id' => $_POST['aff']))->fetch();
	$bon = $sql->request('select * from bon where id_facture=:id', array('id' => $_POST['aff']))->fetch();
	$fournisseur = $sql->request('select * from fournisseur where id_fournisseur=:id', array('id' => $bon['id_fournisseur']))->fetch();
	$labo = $sql->request('select nom_labo from labo where id_compte=:id', array('id' => $bon['id_compte']))->fetch()['nom_labo'];
	$somme = 0;
	$nature = array(explode("#%", $bon['nature']));
	$prix = array(explode("#%", $facture['prix_unitaire']));
	$ref = explode("#%", $facture['ref']);
	for($i=0,$j=1;$i<count($prix[0]);$i++,$j+=2){
		$somme = $somme + (double)$prix[0][$i] * (double)$nature[0][$j];
	}
	echo '
		<p style="font-size:x-large;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$fournisseur['nom'].'</P>
		<div style="display:inline-block;margin-right:25%;vertical-align:top;">
			<p style="font-size:11px;">
				Adresse : '.$fournisseur['adresse'].'<br/>
				TEL : '.$fournisseur['tel'].'<br/>
				FAX : '.$fournisseur['fax'].'<br/>
				RIB : '.$fournisseur['rib'].'<br/>
				RC : '.$fournisseur['rc'].'<br/>
				NIF : '.$fournisseur['nif'].'<br/>
				NIS : '.$fournisseur['nis'].'<br/>
				AI : '.$fournisseur['ai'].'<br/>
				Banque : '.$fournisseur['banque'].'
			</p>
		</div>
		<div style="display:inline-block;vertical-align:top;">
			<p style="font-size:12px;">
				Réference : '.$facture['num_facture'].'<br/>
				Date : '.$facture['dat'].'<br/>
				Mantant : '.sprintf("%.2f", $somme * (1.0 + (double)$facture['tva'] / 100.0)).'<br/>
				Client : LAB<br/>
				Echéance : '.$facture['dat'].'<br/>
			</p>
		</div>
		<p style="font-size:20px;" align="center">FACTURE N° : '.$facture['num_facture'].'</p>
		<p style="font-size:12px;">
			Réf : LAB '.$labo.'/USTHB<br/>
			Adresse : B.P 32 EL-ALIA 16111 BAB-EZZOUAR ALGER
		</p>
		<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;"}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 8px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 8px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg .tg-k6pi{font-size:14px}
		.tg .tg-3sk9{font-weight:bold;font-size:14px}
		</style>
		<table class="tg" width="100%">
		  <tr>
			<th class="tg-3sk9">Référence</th>
			<th class="tg-3sk9" width="45%">Désignation</th>
			<th class="tg-3sk9">Qté</th>
			<th class="tg-3sk9" width="20%">Prix Unitaire</th>
			<th class="tg-3sk9" width="20%">Montant HT</th>
			<th class="tg-3sk9">TVA</th>
		  </tr>
		  ';
	for($i=0,$j=0;$i<count($nature[0]);$i+=2,$j++){
		echo'<tr><td class="tg-k6pi">'.$ref[$j].'</td>
			<td class="tg-k6pi">'.$nature[0][$i].'</td>
			<td class="tg-k6pi" align="center">'.$nature[0][$i+1].'</td>
			<td class="tg-k6pi" align="center">'.number_format($prix[0][$j], 2, ',', ' ').'</td>
			<td class="tg-k6pi" align="center">'.number_format((double)$prix[0][$j] * (double)$nature[0][$i+1], 2, ',', ' ').'</td>
			<td class="tg-k6pi" align="center">'.$facture['tva'].'</td>
		  </tr>';
	}
	echo '</table><br />
		<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg .tg-3sk9{font-weight:bold;font-size:12px}
		</style>
		<table class="tg" width="100%">
		  <tr>
			<th class="tg-3sk9">TOTAL HT</th>
			<th class="tg-3sk9">TOTAL TVA</th>
			<th class="tg-3sk9">TOTAL T.T.C</th>
			<th class="tg-3sk9">NET A PAYER</th>
		  </tr>
		  <tr>
			<td class="tg-031e">'.number_format($somme, 2, ',', ' ').'</td>
			<td class="tg-031e">'.number_format($somme * (double)$facture['tva'] / 100.0, 2, ',', ' ').'</td>
			<td class="tg-031e">'.number_format($somme * (1.0 + (double)$facture['tva'] / 100.0), 2, ',', ' ').'</td>
			<td class="tg-031e">'.number_format($somme * (1.0 + (double)$facture['tva'] / 100.0), 2, ',', ' ').'</td>
		  </tr>
		</table><br />
		<pre style="display: inline-block;white-space:pre-wrap;">Arreté la présente facture à la somme de : <br /><strong>'.int2str(sprintf("%.2f",$somme * (1.0 + (double)$facture['tva'] / (double)100))).'</strong></pre><br />
	';
}
else if(isset($_POST['valideFacture'])){
	if($sql->request('select num_facture from facture where id_facture=:id', array('id' => $_POST['valideFacture']))->fetch()['num_facture']!='0'){
		$sql->request('update facture set valide="1" where id_facture=:id', array('id' => $_POST['valideFacture']));
		$x = $sql->request('select num_bon,annee from bon where id_facture=:id', array('id' => $_POST['valideFacture']))->fetch();
		echo $x['num_bon'].'/'.$x['annee'].'.'.$sql->request('select num_facture from facture where id_facture=:id', array('id' => $_POST['valideFacture']))->fetch()['num_facture'];
		
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$b = $sql->request('select * from bon where id_facture=:id', array('id' => $_POST['valideFacture']))->fetch();
			$gfl = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Validation facture de Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-info'
									));
				}
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $b['id_compte'],
										'notif' => 'Validation facture de Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-info'
									));
		}
	}
	else{
		echo 'valideno';
	}
}
else if(isset($_POST['modif'])){
	$facture = $sql->request('select *,date_format(date, "%d-%m-%Y") as dat from facture where id_facture=:id', array('id' => $_POST['modif']))->fetch();
	$bon = $sql->request('select * from bon where id_facture=:id', array('id' => $_POST['modif']))->fetch();
	$num = $bon['num_bon'].'/'.$bon['annee'];
	$nom = $sql->request('select nom from fournisseur where id_fournisseur=:id', array('id' => $bon['id_fournisseur']))->fetch()['nom'];
	$adresse = $sql->request('select adresse from fournisseur where id_fournisseur=:id', array('id' => $bon['id_fournisseur']))->fetch()['adresse'];
	$nature = explode("#%", $bon['nature']);
	$prix = explode("#%", $facture['prix_unitaire']);
	$ref = explode("#%", $facture['ref']);
	$observ = explode("#%", $facture['observ']);
	$nchap = array('0', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII');
	
	echo '<div class="madal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right:15px"></button>
		<h2 align="center">Edition Facture de Bon de Commande N° <span id="m_num_bon">'.$num.'</span></h2></div><div class="modal-body">
		<div><label for="mnum_facture"><h3>N° Facture : </h3></label><input type="text" class="form-control input-xlarge" name="mnum_facture" id="mnum_facture" value="'.$facture['num_facture'].'" style="display:inline;margin-left:15px;" /></div>
		<div><label for="chap"><h3>Chapitre et Article : </h3></label>
<select name="chap" id="chap" class="form-control input-medium" style="display:inline;margin-left:15px;">
  <optgroup label="Chapitre I">
<option value="1.1.0"> Article 1</option>
<option value="1.2.0"> Article 2</option>
<option value="1.3.0"> Article 3</option>
<option value="1.4.0"> Article 4</option>
<option value="1.5.0"> Article 5</option>
<option value="1.6.0"> Article 6</option>
  </optgroup>
    <optgroup label="Chapitre II">
<option value="2.1.0"> Article 1</option>
<option value="2.2.0"> Article 2</option>
<option value="2.3.0"> Article 3</option>
<option value="2.4.0"> Article 4</option>
 </optgroup>
  <optgroup label="Chapitre III">
<option value="3.1.0"> Article 1</option>
<option value="3.2.0"> Article 2</option>
<option value="3.3.0"> Article 3</option>
<option value="3.4.0"> Article 4</option>
<option value="3.5.0"> Article 5</option>
<option value="3.6.0"> Article 6</option>
<option value="3.7.0"> Article 7</option>
 </optgroup>
  <optgroup label="Chapitre IV">
<option value="4.1.0"> Article 1</option>
<option value="4.2.0"> Article 2</option>
<option value="4.3.0"> Article 3</option>
<option value="4.4.0"> Article 4</option>
<option value="4.5.0"> Article 5</option>
 </optgroup>
  <optgroup label="Chapitre V">
<option value="5.1.0"> Article 1</option>
<option value="5.2.0"> Article 2</option>
 </optgroup>
  <optgroup label="Chapitre VI">
<option value="6.1.0"> Article 1</option>
  <optgroup label="Article 2">
	<option value="6.2.1">Paragraphe 1</option>
	<option value="6.2.2">Paragraphe 2</option>
	<option value="6.2.3">Paragraphe 3</option>
	<option value="6.2.4">Paragraphe 4</option>
	<option value="6.2.5">Paragraphe 5</option>
</optgroup>
<option value="6.3.0"> Article 3</option>
<option value="6.4.0"> Article 4</option>
<option value="6.5.0"> Article 5</option>
<option value="6.6.0"> Article 6</option>
<option value="6.7.0"> Article 7</option>
<option value="6.8.0"> Article 8</option>
 </optgroup>
<optgroup label="Chapitre VII">
<option value="7.1.0">Article 1</option>
</optgroup></select>
<input type="text" id="rchap" readonly class="form-control input-large" style="display:inline;margin-left:15px;" value="Chapitre '.$nchap[$facture['chap']].' Article '.$facture['art'];
if($facture['par'] != 0){
	echo ' Pargraphe '.$facture['par'];
}
echo '" /><input type="hidden" id="hchap" value="'.$facture['chap'].'.'.$facture['art'].'.'.$facture['par'].'"/></div>
<div><label for="mn_fournisseur"><h3>Fournisseur : </h3></label><input type="text" class="form-control input-xlarge" name="mn_fournisseur" id="mn_fournisseur" value="'.$nom.'" style="display:inline;margin-left:15px;" readonly /></div>
<div><label for="ma_fournisseur"><h3>Adresse :</h3></label><input type="text" class="form-control input-xlarge" name="ma_fournisseur" id="ma_fournisseur" readonly value="'.$adresse.'" style="display:inline;margin-left:15px;" /></div>
<div><label for="tva"><h3>TVA : </h3></label><select class="form-control input-xsmall" name="tva" id="tva" style="display:inline;margin-left:15px;">';
switch($facture['tva']){
	case 7: echo '<option id="tva" value="7">7 %</option><option id="tva" value="17">17%</option><option id="tva" value="0">0 %</option></select>'; break;
	case 17: echo '<option id="tva" value="17">17%</option><option id="tva" value="7">7 %</option><option id="tva" value="0">0 %</option></select>'; break;
	default: echo '<option id="tva" value="0">0 %</option><option id="tva" value="7">7 %</option><option id="tva" value="17">17%</option></select>';
}
echo '<div><label for="chap"><h3>Type : </h3></label>
<select name="type" id="type" class="form-control input-xsmall" style="display:inline;margin-left:15px;">';
if($facture['type'] == "FNR"){
	echo '<option value="FNR">FNR</option><option value="PNR">PNR</option></select></div>';
}
else{
	echo '<option value="PNR">PNR</option><option value="FNR">FNR</option></select></div>';
}
echo '
<div><label for="objet"><h3>Objet de Paiement :</h3></label><input type="text" class="form-control input-xlarge" name="objet" id="objet" placeholder="objet de paiement" value="'.$facture['objet'].'" style="display:inline;margin-left:15px;" /></div>
<div><label for="ca"><h3>Nombre Cértificat Administratif :</h3></label><input type="number" class="form-control input-xsmall" name="ca" id="ca" min="0" max="9" value="'.$facture['ca'].'" style="display:inline;margin-left:15px;" /></div>
<div><label for="pv"><h3>Nombre PV de Choix :</h3></label><input type="number" class="form-control input-xsmall" name="pv" id="pv" min="0" max="9" value="'.$facture['pv'].'" style="display:inline;margin-left:15px;" /></div>
<div><label for="con"><h3>Nombre Contrat :</h3></label><input type="number" class="form-control input-xsmall" name="con" id="con" min="0" max="9" value="'.$facture['con'].'" style="display:inline;margin-left:15px;" /></div>
<label for="date"><h3>Date : </h3></label>
<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="-365d" style="display:inline-block;margin-left:15px;">	
<input type="text" class="form-control input-small" readonly value="'.$facture['dat'].'" id="date"/>
<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
</div>
	<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg .tg-hgcj{font-weight:bold;text-align:center}
	</style>
	<table class="tg" id="mta"><thead><tr>
	<th class="tg-hgcj"><input id="mcg_vent" type="checkbox"></th>
	<th class="tg-hgcj" width="200px">Référence</th>
	<th class="tg-hgcj" width="500px">Désignation</th>
	<th class="tg-hgcj" width="85px">Qté</th>
	<th class="tg-hgcj" width="125px">px unitaire</th>
	<th class="tg-hgcj" width="150px">Observation</th>
	</tr></thead><tbody>';
	for($i=0,$j=0;$i<count($nature);$i+=2,$j++){
		echo 
			'<tr>
				<td class="tg-031e"><input name="mc_vent" id="mc_vent" type="checkbox" /></td>
				<td class="tg-031e"><input type="text" class="form-control" name="ref" id="ref" value="'.$ref[$j].'" /></td>
				<td class="tg-031e"><input type="text" class="form-control" name="mn_nature" id="mn_nature" value="'.$nature[$i].'" readonly /></td>
				<td class="tg-031e"><input type="number" step="1" class="form-control" name="mnbr_q" id="mnbr_q" value="'.$nature[$i+1].'" readonly /></td>
				<td class="tg-031e"><input type="number" step="0.01" class="form-control" name="mp" id="mp" value="'.$prix[$j].'" /></td>
				<td class="tg-031e"><input type="text" class="form-control" name="observ" id="observ" value="'.$observ[$j].'" /></td>
			</tr>';
	}
	echo '</tbody>
				</table><br />
			<input type="hidden" id="idf" value="'.$facture['id_facture'].'" />
		   </p>
		  </div><div class="modal-footer">
			<a id="ajoutInvent" href="#portlet-config2" data-toggle="modal" class="btn btn-circle blue" style="margin-left:10px;"><i class="fa fa-plus"></i> Ajouter Inventaire </a>
			<a id="submitModifFacture" href="#" class="btn btn-circle green" ><i class="fa fa-plus"></i> Enregistrer</a>
			<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
		  </div><script src=\'js/modif_facture.js\'></script>
		  <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		  <script src="js/components-pickers.js"></script>
		  <script>jQuery(document).ready(function() { ComponentsPickers.init(); });</script>';
}
else if(isset($_POST['submitModifFacture'])){
	if(strtotime($_POST['date']) < strtotime($sql->request('select date from bon where id_facture=:id', array('id' => $_POST['idf']))->fetch()['date'])){
		echo 'error';
	}
	else{
		$prix = "";
		$ref = "";
		$observ = "";
		
		for($i=1;isset($_POST['prix'.$i]);$i++){
			$prix .= $_POST['prix'.$i]."#%";
			$ref .= $_POST['ref'.$i]."#%";
			$observ .= $_POST['observ'.$i]."#%";
		}
		$prix = substr($prix, 0, -2);
		$ref = substr($ref, 0, -2);
		$observ = substr($observ, 0, -2);
		
		$facture = $sql->request('update facture set num_facture=:num,ref=:ref,prix_unitaire=:prix,observ=:observ,tva=:tva,chap=:chap,art=:art,par=:par,date=:date,objet=:objet,ca=:ca,pv=:pv,con=:con,type=:type where id_facture=:idf',
								array(
									'num' => $_POST['num'],
									'ref' => $ref,
									'prix' => $prix,
									'observ' => $observ,
									'tva' => $_POST['tva'],
									'chap' => $_POST['chap'],
									'art' => $_POST['art'],
									'par' => $_POST['par'],
									'date' => date('Y-m-d', strtotime($_POST['date'])),
									'objet' => $_POST['objet'],
									'ca' => $_POST['ca'],
									'pv' => $_POST['pv'],
									'con' => $_POST['con'],
									'type' => $_POST['type'],
									'idf' => $_POST['idf'])
								)
							;
		modifier_p_charge($_POST['idf']);
		
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$b = $sql->request('select * from bon where id_facture=:id', array('id' => $_POST['idf']))->fetch();
			$gfl = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Edition facture de Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-edit'
									));
				}
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $b['id_compte'],
										'notif' => 'Edition facture de Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-edit'
									));
		}
	}
}
?>

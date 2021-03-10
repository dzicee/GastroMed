<?php
	include_once("chiffre_en_lettre.php");
	include_once("../class/database.class.php");
	$sql = new database();
	
	function creer_num_mandat(){
		$sql = new database();
		$x = $sql->request("select max(num_mandat) as maxmandat from mandat where annee=:annee", array('annee' => $sql->request('select exe from compte', null)->fetch()['exe']));
		if(($y=$x->fetch())){
			return ($y['maxmandat']+1).'/'.$sql->request('select exe from compte', null)->fetch()['exe'];
		}
		else{
			return '1/'.$sql->request('select exe from compte', null)->fetch()['exe'];
		}
	}
	
	if(isset($_POST['a_fournisseur'])){
		echo $sql->request('select adresse from fournisseur where nom=:nom', array('nom' => $_POST['a_fournisseur']))->fetch()['adresse'];
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
	
	
	
	
	else if(isset($_POST['modifBon'])){
		$y = $sql->request('select *,date_format(date, "%d-%m-%Y") as dat from bon where id_bon=:id', array('id' => $_POST['modifBon']))->fetch();
		$num = $y['num_bon'].'/'.$y['annee'];
		$labo = $sql->request('select nom_labo from labo where id_compte=:id', array('id' => $y['id_compte']))->fetch()['nom_labo'];
		$nom = $sql->request('select nom from fournisseur where id_fournisseur=:id', array('id' => $y['id_fournisseur']))->fetch()['nom'];
		$adresse = $sql->request('select adresse from fournisseur where id_fournisseur=:id', array('id' => $y['id_fournisseur']))->fetch()['adresse'];
		$nature = explode("#%", $y['nature']);
		echo '<div class="madal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right:15px"></button>
			<h2 align="center">Modifier Bon de Commande N° <span id="m_num_bon">'.$num.'</span></h2></div><div class="modal-body"><p><table width="100%">
			<tr><td width="18%"><h3>Laboratoire :</h3></td><td><select class="form-control input-small" name="m_labo" id="m_labo">
			<option id="m_labo" value="'.$labo.'">'.$labo.'</option>';
		if($_POST['gfl'] == 1){
			$z = $sql->request('select nom_labo from labo where nom_labo!=:nom', array('nom' => $labo));
			while(($t=$z->fetch())){
				echo '<option id="m_labo" value="'.$t['nom_labo'].'">'.$t['nom_labo'].'</option>';
			}
		}
		echo '</select></td></tr><tr><td width="18%"><h3>Fournisseur : </h3></td><td><select class="form-control input-medium" name="mn_fournisseur" id="mn_fournisseur">
		<option value="'.$nom.'" id="mn_fournisseur">'.$nom.'</option>';
		$z = $sql->request('select nom from fournisseur where nom!=:nom', array('nom' => $nom));
		while(($t=$z->fetch())){
			echo '<option value="'.$t['nom'].'" id="mn_fournisseur">'.$t['nom'].'</option>';
		}
		echo '</select></td></tr><tr><td></td><td><a href="#portlet-config2" data-toggle="modal" class="btn btn-circle blue"><i class="fa fa-plus"></i> Ajouter Fournisseur </a></td></tr>
				<tr><td><h3>Adresse :</h3></td><td><input type="text" class="form-control input-xlarge" name="ma_fournisseur" id="ma_fournisseur" readonly
		value="'.$adresse.'"/></td></tr>
		<tr><td><h3>Date : </h3></td>
		<td><div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="-365d" style="display:inline-block;margin-left:0px;">	
		<input type="text" class="form-control input-small" readonly value="'.$y['dat'].'" id="mdate"/>
		<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
		</div></td></tr></table><br />
		<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;margin-left:auto;margin-right:auto;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg .tg-hgcj{font-weight:bold;text-align:center}
		</style>
		<table class="tg" id="mta"><thead><tr>
		<th class="tg-hgcj"><input id="mcg_fournisseur" type="checkbox"></th>
		<th class="tg-hgcj" width="600px">Nature des fournitures et travaux commandés</th>
		<th class="tg-hgcj">Quantité</th>
		</tr></thead><tbody>';
		for($i=0;$i<count($nature);$i+=2){
			echo '<tr><td class="tg-031e"><input name="mc_fournisseur" id="mc_fournisseur" type="checkbox" /></td><td class="tg-031e"><input type="text" class="form-control" name="mn_nature" id="mn_nature" value="'.$nature[$i].'" /></td><td class="tg-031e"><input type="number" step="1" class="form-control" name="mnbr_q" id="mnbr_q" value="'.$nature[$i+1].'" /></td></tr>';
		}
		echo '</tbody>
					</table><br />
					<div align="center">
					<a class="btn btn-circle green" id="majout_p"><i class="fa fa-plus"></i> Nouveau Produit</a>
					<a class="btn btn-circle red" id="msupp_p"><i class="fa fa-times"></i> Supprimer Produit</a>
					</div>
					<input type="hidden" name="mcpt_nature" id="mcpt_nature" value="'.(count($nature)/2).'" />
			   </p>
			  </div><div class="modal-footer">
				<a id="submitModifBon" href="#" class="btn btn-circle green" ><i class="fa fa-plus"></i> Modifier</a>
				<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
			  </div><script src=\'js/modif_bon.js\'></script>
		  <script>jQuery(document).ready(function() { ComponentsPickers.init(); });</script>';
	}
	else if(isset($_POST['affBon'])){
		$x = $sql->request("select * from bon where id_bon=:idbon", array('idbon' => $_POST['affBon']));
		$y = $x->fetch();
		$z = $sql->request("select nom, adresse from fournisseur where id_fournisseur=:id", array('id' => $y['id_fournisseur']));
		$t = $z->fetch();
		$tbon = array($y['num_bon'].'/'.$y['annee'], $t['nom'], $t['adresse']);
		array_push($tbon, explode("#%", $y['nature']));
		$x = $sql->request("select * from facture where facture.id_facture=:id", array("id" => $y["id_facture"]));
		$t=$x->fetch();
		$tbon2 = array($t['tva']);
		array_push($tbon2, explode("#%", $t['prix_unitaire']));
		$observ = explode("#%", $t['observ']);
		$compte = $sql->request('select * from compte where id_compte=:id', array('id' => $y['id_compte']))->fetch();
		$x1 = $sql->request("select * from bon where id_bon=:idbon", array('idbon' => $_POST['affBon']))->fetch();
		echo '
				<img src="images/tete_usthb.jpg" style="display:block;margin-left:auto;margin-right:auto;" />
				<h2 align="center">وصل الايجار</h2>
				
				<h1 align="center">Quittance de Loyer</span></h1><br />
				<table class="tg1">
				  <tr>
					<td class="tg1-1031e" >Unité : '.$x1['unite'].'</td>
				  </tr>
				  <tr></tr>
				  <tr>
					<td class="tg1-1031e">Régie : '.$x1['regie'].'</td>
				  </tr>
				  <tr>
					<td class="tg1-1031e">Commune : '.$compte['commune'].'</td>
				  </tr>
				</table><br />
				
				  ';
				  
				  echo '
				  
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:17px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:17px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-yg9r{font-weight:bold;font-size:18px;border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-b4to{font-weight:bold;font-size:24px;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-l0cn{font-size:18px;border-color:inherit;text-align:right;vertical-align:top}
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-fuxe{font-size:18px;border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-spag{font-weight:bold;font-size:22px;border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-2xbj{font-weight:bold;font-size:18px;border-color:inherit;text-align:center;vertical-align:top}
.tg .tg-eqm3{font-size:20px;border-color:inherit;text-align:left;vertical-align:top}
.tg .tg-7jts{font-size:18px;border-color:inherit;text-align:center;vertical-align:top}
</style>
<table class="tg">
  
  <tr>
    <td class="tg-fuxe" colspan="4"><span style="font-weight:bold">Code : 1</span><br></td>
    <td class="tg-spag" colspan="3">N°:    '.$x1['id_bon'].'                                                         </td>
    <td class="tg-yg9r" colspan="3">Date:    <span style="font-weight:bold">'.$x1['date'].'</span>                                                      </td>
  </tr>
  <tr>
    <td class="tg-fuxe" colspan="3"><span style="font-weight:700">Nom &amp; Prénom:       </span><br><br><span style="font-weight:700">    </span><span style="font-weight:bold"> '.$compte['nom'].' '.$compte['prenom'].'    </span><span style="font-weight:700">                                                   </span><br></td>
    <td class="tg-2xbj">Nature</td>
    <td class="tg-2xbj">Type</td>
    <td class="tg-2xbj">Bloc</td>
    <td class="tg-2xbj">Etage</td>
    <td class="tg-yg9r">N°</td>
    <td class="tg-2xbj">Cons</td>
    <td class="tg-yg9r">période :                            </td>
  </tr>
  <tr>
    <td class="tg-fuxe" colspan="3"><span style="font-weight:bold">Cité :&nbsp;'.$compte['cite'].'</span><br><span style="font-weight:bold">....</span></td>
    <td class="tg-p8sp"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 7</td>
    <td class="tg-p8sp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$compte['typee'].'</td>
    <td class="tg-p8sp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$compte['n_batiment'].'</td>
    <td class="tg-p8sp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$compte['etage'].'</td>
    <td class="tg-p8sp">&nbsp;&nbsp;&nbsp;'.$compte['appartement'].'</td>
    <td class="tg-p8sp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12</td>
    <td class="tg-yg9r" rowspan="2">Du: <br>'.$x1['du'].'                                         <br><br>Au:    <br>'.$x1['au'].'                                      </td>
  </tr>
  <tr>
    <td class="tg-7jts" colspan="2"><span style="font-weight:bold">Loyer Principale</span></td>
    <td class="tg-2xbj">Abatt.</td>
    <td class="tg-yg9r">Charges Locatives</td>
    <td class="tg-yg9r">Loyer à payer</td>
    <td class="tg-yg9r">Cautions de garantie</td>
    <td class="tg-yg9r">Frais de formalité</td>
    <td class="tg-2xbj" colspan="2">Frais divers</td>
  </tr>
  <tr>
    <td class="tg-p8sp" colspan="2" rowspan="2"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$compte['airr_mois'].' DA</td>
    <td class="tg-p8sp" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;22</td>
    <td class="tg-p8sp" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;700 DA</td>
    <td class="tg-p8sp" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;44</td>
    <td class="tg-p8sp" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;55</td>
    <td class="tg-p8sp" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;66<br></td>
    <td class="tg-p8sp" colspan="2" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;77</td>
    <td class="tg-2xbj">Nombre de mois</td>
  </tr>
  <tr>
    <td class="tg-eqm3"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$x1['mois'].'</td>
  </tr>
  <tr>
    <td class="tg-l0cn" colspan="2"><span style="font-weight:bold">Antérieure</span></td>
    <td class="tg-2xbj">Précedent</td>
    <td class="tg-2xbj">Pénalité</td>
    <td class="tg-2xbj">En Cours</td>
    <td class="tg-2xbj">Avances</td>
    <td class="tg-2xbj">Complément</td>
    <td class="tg-yg9r">Taxe</td>
    <td class="tg-yg9r">Timbre </td>
    <td class="tg-2xbj">Total à payer</td>
  </tr>
  <tr>
    <td class="tg-yg9r">L</td>
    <td class="tg-eqm3" rowspan="2">&nbsp;&nbsp;31222222</td>
    <td class="tg-eqm3" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;123</td>
    <td class="tg-eqm3" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1245</td>
    <td class="tg-eqm3" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1266</td>
    <td class="tg-eqm3" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0000000</td>
    <td class="tg-eqm3" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;00000</td>
    <td class="tg-eqm3" rowspan="2">9%</td>
    <td class="tg-fuxe" rowspan="2">29.00 DA</td>
    <td class="tg-b4to" rowspan="2">'.$x1['nature'].' DA </td>
  </tr>
  <tr>
    <td class="tg-yg9r">C</td>
  </tr>
</table>


				<br>
				<br>
				<address style="text-align:center;">Le Caissier '.$sql->request('select nom_labo from labo where id_compte=:id', array('id' => $y['id_compte']))->fetch()['nom_labo'].'</address>
				<br>
				<br>
				<br>
				<p style="font-size: medium">La présente quittance est arretée à la somme de :</p>
		';
	}
	else if(isset($_POST['submitAjoutBon'])){
		$produit = "";
		$prix = "";
		$ref = "";
		$observ = "";
		
		for($i=1;isset($_POST['produit'.$i]);$i++){
			$produit .= $_POST['produit'.$i]."#%".$_POST['quantite'.$i]."#%";
			$prix .= "0#%";
			$ref .= " #%";
			$observ .= " #%";
		}
		$produit = substr($produit, 0, -2);
		$prix = substr($prix, 0, -2);
		$ref = substr($ref, 0, -2);
		$observ = substr($observ, 0, -2);
		
	
		$sql->request('insert into bon values(DEFAULT,:id_fa,:id_f,:id_c,:num_b,:nature,:annee,:date,"ss","sss","1993-02-02","1993-02-02")',
					array('id_fa' => 12,
							'id_f' => 12,
							'id_c' => 3,
							'num_b' => 88,
							'nature' =>  "ss",
							'annee' =>  "ss",
							'date' =>  "1993-02-02",
					)
		);
		
		
		//ajouter notification
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$b = $sql->request('select * from bon where id_bon=(select max(id_bon) as maxbon from bon)', null)->fetch();
			if($compte['gfl']){
				$gfl = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Creation Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-plus'
									));
				}
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $sql->request('select id_compte from labo where nom_labo=:nom_labo', array('nom_labo' => $_POST['labo']))->fetch()['id_compte'],
										'notif' => 'Creation Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-plus'
									));
			}
			else{
				$gfl = $sql->request('select * from compte where gfl=1', null);
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Creation Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-plus'
									));
				}
			}
		}
	}
	else if(isset($_POST['submitModifBon'])){
		$y = $sql->request('select * from bon where num_bon=:num and annee=:annee', array('num' => explode("/", $_POST['num'])[0], 'annee' => explode("/", $_POST['num'])[1]))->fetch();
		$produit = "";
		$prix = "";
		$ref = "";
		$observ = "";
		
		for($i=1;isset($_POST['produit'.$i]);$i++){
			$produit .= $_POST['produit'.$i]."#%".$_POST['quantite'.$i]."#%";
			$prix .= "0#%";
			$ref .= " #%";
			$observ .= " #%";
		}
		$produit = substr($produit, 0, -2);
		$prix = substr($prix, 0, -2);
		$ref = substr($ref, 0, -2);
		$observ = substr($observ, 0, -2);
		
		$sql->request('update bon set id_fournisseur=:idf,id_compte=:idc,nature=:nature,date=:date where id_bon=:idb',
					array(
						'idf' => $sql->request('select id_fournisseur from fournisseur where nom=:nom', array('nom' => $_POST['nom']))->fetch()['id_fournisseur'],
						'idc' => $sql->request('select id_compte from labo where nom_labo=:nom', array('nom' => $_POST['labo']))->fetch()['id_compte'],
						'nature' => $produit,
						'idb' => $y['id_bon'],	
						'date' => date('Y-m-d', strtotime($_POST['date']))
					));
		$sql->request('update facture set ref=:ref,prix_unitaire=:prix,observ=:observ where id_facture=:id', array('ref' => $ref, 'prix' => $prix, 'id' => $y['id_facture'], 'observ' => $observ));
		
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$b = $sql->request('select * from bon where id_bon=:id', array('id' => $y['id_bon']))->fetch();
			if($compte['gfl']){
				$gfl = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Modification Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-edit'
									));
				}
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $sql->request('select id_compte from labo where nom_labo=:nom_labo', array('nom_labo' => $_POST['labo']))->fetch()['id_compte'],
										'notif' => 'Modification Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-edit'
									));
			}
			else{
				$gfl = $sql->request('select * from compte where gfl=1', null);
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Modification Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-edit'
									));
				}
			}
		}
	}
	else if(isset($_POST['suppBon'])){
		$b = $sql->request('select * from bon where id_bon=:id', array('id' => $_POST['suppBon']))->fetch();
		$f = $sql->request('select id_facture from bon where id_bon=:id', array('id' => $_POST['suppBon']))->fetch()['id_facture'];
		$sql->request('delete from facture where id_facture=:id', array('id' => $f));
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			$gfl = $sql->request('select * from compte where gfl=1', null);
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Suppression Bon de Commande N:'.$b['num_bon'].'/'.$b['annee'],
										'icon' => 'fa fa-times'
									));
				}
		}
	}
	else if(isset($_POST['ajoutFourni'])){
		$sql->request('insert into fournisseur values(DEFAULT,:nom,:rc,:nif,:ai,:nis,:fax,:adresse,:email,:tel,:nif,:rib,:rip,:rc,:nif,:nif,:nif,:ccp,:banque,0)', array(
			'nom' => $_POST['nom'],
			'adresse' => $_POST['adresse'],
			'email' => $_POST['email'],
			'tel' => $_POST['tel'],
			'fax' => $_POST['fax'],
			'rib' => $_POST['rib'],
			'rip' => $_POST['rip'],
			'rc' => $_POST['rc'],
			'nif' => $_POST['nif'],
			'ai' => $_POST['ai'],
			'nis' => $_POST['nis'],
			'ccp' => $_POST['ccp'],
			'banque' => $_POST['banque'],
		));
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			if($compte['gfl']){
				$gfl = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Ajout nouvelle demande: votre Demande a été créée  '.$_POST['nom'],
										'icon' => 'fa fa-plus'
									));
				}
				$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $sql->request('select id_compte from labo where nom_labo=:nom_labo', array('nom_labo' => $_POST['labo']))->fetch()['id_compte'],
										'notif' => 'Ajout nouvelle demande: votre Demande a été créée '.$_POST['nom'],
										'icon' => 'fa fa-plus'
									));
			}
			else{
				$gfl = $sql->request('select * from compte where gfl=1', null);
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Ajout nouvelle demande: votre Demande a été créée  '.$_POST['nom'],
										'icon' => 'fa fa-plus'
									));
				}
			}
		}
	}
?>
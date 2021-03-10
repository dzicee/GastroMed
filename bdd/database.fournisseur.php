<?php
include_once("../class/database.class.php");
$sql = new database();

if(isset($_POST['affFourni'])){
	$fournisseur = $sql->request('select * from fournisseur where id_fournisseur=:id', array('id' => $_POST['affFourni']))->fetch();
	$fournisseur1 = $sql->request('select * from compte where n_batiment=:id AND appartement=:ii', array('id' =>$fournisseur['n_batiment'],'ii' =>$fournisseur['apartement'] ))->fetch();
	
	
	
	echo '
			<div class="modal-content">
				
					
					<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:18px;padding:08px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg th{font-family:Arial, sans-serif;font-size:18px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
.tg .tg-rsk4{font-weight:bold;font-size:18px;font-family:Tahoma, Geneva, sans-serif !important;;background-color:#efefef;border-color:#000000;text-align:center;vertical-align:top}
.tg .tg-8u4t{font-weight:bold;font-size:18px;font-family:Tahoma, Geneva, sans-serif !important;;background-color:#efefef;border-color:#000000;text-align:center}
.tg .tg-6pcl{font-weight:bold;font-size:20px;font-family:"Times New Roman", Times, serif !important;;background-color:#efefef;border-color:#000000;text-align:center}
.tg .tg-i6qf{font-weight:bold;font-size:18px;font-family:"Times New Roman", Times, serif !important;;background-color:#efefef;border-color:#000000;text-align:center;vertical-align:top}
</style>
<table class="tg" align="center">
<tr>
    <th class="tg-6pcl" colspan="2"><span style="text-decoration:underline">Demande Client</span></th>
  </tr>
  <tr>
    <th class="tg-8u4t">Nom & Prenom</th>
    <th class="tg-8u4t">'.$fournisseur1['nom'].' ' .$fournisseur1['prenom'].'</th>
  </tr>
  <tr>
    <td class="tg-8u4t">Commune</td>
    <td class="tg-8u4t">'.$fournisseur1['commune'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">Cite</td>
    <td class="tg-rsk4">'.$fournisseur1['cite'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">N°Batiment</td>
    <td class="tg-rsk4">'.$fournisseur['n_batiment'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">N°Appartement</td>
    <td class="tg-rsk4">'.$fournisseur['apartement'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">Type Demande</td>
    <td class="tg-rsk4">'.$fournisseur['banque'].'</td>
  </tr>
  <tr>
    <td class="tg-i6qf">Explication </td>
    <td class="tg-rsk4">'.$fournisseur['rip'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">Téléphone</td>
    <td class="tg-rsk4">'.$fournisseur1['tel'].'</td>
  </tr>
  
  
  <tr>
    <td class="tg-rsk4">Date De Rendez Vous</td>
    <td class="tg-rsk4">'.$fournisseur['dat'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">Heure Debut Rendez Vous </td>
    <td class="tg-rsk4">'.$fournisseur['hd'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">Heure Fin rendez vous</td>
    <td class="tg-rsk4">'.$fournisseur['hf'].'</td>
  </tr>
  <tr>
  ';
  if($fournisseur['banque']== "Demande Paiement")echo'
    <td class="tg-rsk4">Nombre de Mois</td>
    <td class="tg-rsk4">'.$fournisseur['email'].'</td>
  </tr>
  <tr>
    <td class="tg-rsk4">Montant</td>
    <td class="tg-rsk4">'.$fournisseur['adresse'].' DA</td>
  </tr>
 
</table>
					
	
				
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
			</div>';
	else echo'
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
				</div>
				</div>';
	
				
			
	
	
}
else if(isset($_POST['suppFourni'])){
	$fournisseur = $sql->request('select * from fournisseur where id_fournisseur=:id', array('id' => $_POST['suppFourni']))->fetch();
	$sql->request('update fournisseur set supp=1 where id_fournisseur=:id', array('id' => $_POST['suppFourni']));
	
	if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
			
				$gfl = $sql->request('select * from compte where id_compte!=:id', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Suppression de la demande, la demandea  a été traité avec succes: '.$fournisseur1['username'],
										'icon' => 'fa fa-plus'
									));
				}
		}
}


else if(isset($_POST['valide'])){
	
	$gfl = $sql->request('select * from compte where id_compte!=:id', array('id' => $fournisseur1['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $fournisseur1['id_compte'],
										'idr' => $fournisseur1['id_compte'],
										'notif' => 'Votre demande va être pris en charge par nos agents ',
										'icon' => 'fa fa-plus'
									));
				}
}



else if(isset($_POST['modifFourni'])){
	$fournisseur = $sql->request('select * from fournisseur where id_fournisseur=:id', array('id' => $_POST['modifFourni']))->fetch();
	$banque = array(' ','BNA 216-291', 'BEA 216-292', 'CPA 216-293', 'BADR 216-294', 'BDL 216-295', 'BARAKA 216-296', 'SGA 216-299', 'ABC 216-302', 'CAB 216-303', 'ABA 216-305', 'AMANA BANK NAT EXIS 216-306');
	echo '
		<div class="madal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right:15px"></button>
				<h2 align="center">Edition Fournisseur '.$fournisseur['nom'].'</h2>
			</div>
			  <div class="modal-body">
				<p><table width="100%">
				   <tr><td width="25%"><h3>Nom :</h3></td><td><input class="form-control input-xlarge" name="man_fournisseur" id="man_fournisseur" value="'.$fournisseur['nom'].'" type="text"></td></tr>
				   <tr><td><h3>Adresse :</h3></td><td><input class="form-control input-xlarge" name="maa_fournisseur" id="maa_fournisseur" value="'.$fournisseur['adresse'].'" type="text"></td></tr>
				   <tr><td><h3>Email :</h3></td><td><input class="form-control input-xlarge" name="mae_fournisseur" id="mae_fournisseur" value="'.$fournisseur['email'].'" type="text"></td></tr>
				   <tr><td><h3>Téléphone :</h3></td><td><input class="form-control input-xlarge" name="mat_fournisseur" id="mat_fournisseur" value="'.$fournisseur['tel'].'" type="text"></td></tr>
				   <tr><td><h3>Fax :</h3></td><td><input class="form-control input-xlarge" name="maf_fournisseur" id="maf_fournisseur" value="'.$fournisseur['fax'].'" type="text"></td></tr>
				   <tr><td><h3>RIB :</h3></td><td><input class="form-control input-xlarge" name="mar_fournisseur" id="mar_fournisseur" value="'.$fournisseur['rib'].'" type="text"></td></tr>
				   <tr><td><h3>Explication :</h3></td><td><input class="form-control input-xlarge" name="map_fournisseur" id="map_fournisseur" value="'.$fournisseur['rip'].'" type="text"></td></tr>
				   <tr><td><h3>RC :</h3></td><td><input class="form-control input-xlarge" name="mac_fournisseur" id="mac_fournisseur" value="'.$fournisseur['rc'].'" type="text"></td></tr>
				   <tr><td><h3>NIF :</h3></td><td><input class="form-control input-xlarge" name="mani_fournisseur" id="mani_fournisseur" value="'.$fournisseur['nif'].'" type="text"></td></tr>
				   <tr><td><h3>AI :</h3></td><td><input class="form-control input-xlarge" name="mai_fournisseur" id="mai_fournisseur" value="'.$fournisseur['ai'].'" type="text"></td></tr>
				   <tr><td><h3>NIS :</h3></td><td><input class="form-control input-xlarge" name="mans_fournisseur" id="mans_fournisseur" value="'.$fournisseur['nis'].'" type="text"></td></tr>
				   <tr><td><h3>CCP :</h3></td><td><input class="form-control input-xlarge" name="mccp_fournisseur" id="mccp_fournisseur" value="'.$fournisseur['ccp'].'" type="text"></td></tr>
				   <tr><td><h3>Banque : </h3><td><select class="form-control input-medium" name="mbanque" id="mbanque">
				   <option id="mbanque" value="'.$fournisseur['banque'].'">'.$fournisseur['banque'].'</option>';
				   for($i=0;$i<count($banque);$i++){
					   if($banque[$i] != $fournisseur['banque']){
						   echo '<option id="mbanque" value="'.$banque[$i].'">'.$banque[$i].'</option>';
					   }
				   }
				   echo '</select></td></tr>
				 </div>
				 <input type="hidden" name="id_f" id="id_f" value="'.$fournisseur['id_fournisseur'].'" />
			   </table></p>
			  </div>
			  <div class="modal-footer">
				<a href="#" class="btn btn-circle green" id="modifFourni"><i class="fa fa-plus"></i> Enregistrer</a>
				<a href="#" data-dismiss="modal" class="btn btn-circle red"><i class="fa fa-times"></i> Fermer</a>
			  </div>
			  <script src="./js/modif_fournisseur.js"></script>
	';
}
else if(isset($_POST['submitModifFourni'])){
	$sql->request('update fournisseur set nom=:nom,adresse=:adresse,email=:email,tel=:tel,fax=:fax,rib=:rib,rip=:rip,rc=:rc,nif=:nif,ai=:ai,nis=:nis,ccp=:ccp,banque=:banque where id_fournisseur=:id', array(
			'nom' => $_POST['nom'],
			'adresse' => $_POST['adresse'],
			'email' => $_POST['email'],
			'tel' => $_POST['tel'],
			'fax' => $_POST['fax'],
			'rib' => $_POST['rib'],
			'rip' => $_POST['rip'],
			'rc' => $_POST['rc'],
			'nif' => $_POST['nis'],
			'ai' => $_POST['ai'],
			'nis' => $_POST['nis'],
			'ccp' => $_POST['ccp'],
			'banque' => $_POST['banque'],
			'id' => $_POST['submitModifFourni']
		));
		if(isset($_COOKIE['token_agfl'])){
			$compte = $sql->request('select * from compte where id_compte=(select id_compte from tokens where token=:token)', array('token' => $_COOKIE['token_agfl']))->fetch();
				$gfl = $sql->request('select * from compte where id_compte!=:id and gfl=1', array('id' => $compte['id_compte']));
				while(($y=$gfl->fetch())){
					$sql->request('insert into notification values(DEFAULT,:ide,:idr,:notif,NOW(),:icon,0)',
									array(
										'ide' => $compte['id_compte'],
										'idr' => $y['id_compte'],
										'notif' => 'Modification fournisseur: '.$_POST['nom'],
										'icon' => 'fa fa-edit'
									));
				}
		}
}
?>
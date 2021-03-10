<?php
class bon implements document
{
	private $user;
	public $bdd;
	public $exist_vent;
	
	public function __construct($user){
		$this->user = $user;
		if($this->user->gfl){
			$this->bdd = $this->user->sql->request('select *, date_format(date, "%d-%m-%Y") as dat from bon order by date desc, num_bon desc', NULL);
			$this->exist_vent = 1;
		}
		else{
			$this->bdd = $this->user->sql->request('select *, date_format(date, "%d-%m-%Y") as dat from bon where bon.id_compte = (select id_compte from compte where (compte.id_compte = :id_compte)) order by date desc, num_bon desc',
							array('id_compte' => $this->user->id_compte));
			if($this->user->sql->request('select * from ventilation where id_labo=(select id_labo from labo where id_compte=:id) and annee=:annee', array('id' => $this->user->id_compte, 'annee' => $this->user->exe))->fetch()){
				$this->exist_vent = 1;
			}
			else{
				$this->exist_vent = 0;
			}
		}
	}
	
	public function creer_num_bon(){
		$x = $this->user->sql->request("select max(num_bon) as maxbon from bon where annee=:annee", array('annee' => $this->user->exe));
		if(($y=$x->fetch())){
			return ($y['maxbon']+1).'/'.$this->user->exe;
		}
		else{
			return '1/'.$this->user->exe;
		}
	}
	
	public function liste_fournisseurs(){
		$texte = '<tr><td width="18%"><h3>Fournisseur : </h3></td><td><select class="form-control input-medium" name="n_fournisseur" id="n_fournisseur">';
		$texte2 = '<tr><td><h3>Adresse :</h3></td><td><input type="text" class="form-control input-xlarge" name="a_fournisseur" id="a_fournisseur" readonly
					value="'.$this->user->sql->request('select adresse from fournisseur where id_fournisseur=:id', array('id' => '1'))->fetch()['adresse'].'" /></td></tr>';
		$x = $this->user->sql->request('select nom from fournisseur', null);
		while(($y=$x->fetch())){
			$texte .= '<option value="'.$y['nom'].'" id="n_fournisseur">'.$y['nom'].'</option>';
		}
		$texte .= '</select></td></tr><tr><td></td><td><a href="#portlet-config2" data-toggle="modal" class="btn btn-circle blue"><i class="fa fa-plus"></i> Ajouter Fournisseur </a></td></tr>';
		return $texte.$texte2;
	}
	
	public function liste_labo(){
		if($this->user->gfl){
			$x = $this->user->sql->request('select nom_labo from labo', null);
		}
		else{
			$x = $this->user->sql->request('select nom_labo from labo where labo.id_compte=:id', array('id' => $this->user->id_compte));
		}
		$texte = '<tr>
					<td><h3>Laboratoire :</h3></td>
					<td><select class="form-control input-small" name="a_labo" id="a_labo">';
		while(($y = $x->fetch())){
			$texte .= '<option id="a_labo" value="'.$y['nom_labo'].'">'.$y['nom_labo'].'</option>';
		}
		$texte .= '</select></td></tr>';
		return $texte;
	}
}
?>

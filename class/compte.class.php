<?php
session_start();
class compte
{
	public $id_compte;
	public $username;
	public $nom;
	public $prenom;
	public $grade;
	public $code_patient;
	public $labo;
	public $gfl;
	public $exe;
	public $jeton;
	public $connected;
	public $sql;
	public $email;
	public $commune;
	public $cite;
	public $date_nec;
	public $n_batiment;
	public $appartement;
	public $airr;
	public $der_mois_p;
	public $der_annee_p;
	public $typee;
	public $surf;
	public $date_occup;
	public $airr_cours;
	public $airr_mois;
	public $pen;
	public $nbre_enf;
	public $fonction;
	public $retard;
	public $tel;
	public $Code_client;
	public $l_nec;
	public $presume;
	public $annee_p;
	public $sexe;
	public $sf;
	public $prenom_pere;
	public $nom_mere;
	public $prenom_mere;
	public $nom_conj;
	public $prenom_conj;
	public $date_necc;
	public $l_necc;
	public $revenu_conj;
	public $prenom_perec;
	public $nom_merec;
	public $prenom_merec;
	public $password_app;
	public $surface;
	public $typologie;
	public $prix_logement;
	public $ilot;
	public $remise_cle;
	public $acte_vsp;
	public $acte_def;
	public $dec_aide;
	public $dossierCNL;
	public $dossierOPGI;
	public $aideCNL;
	public $montantaideCNL;
	public $apportpers;
	public $versement;
	public $contraintebenif;
	public $IntituletProjet;
	public $mesure;
		public $dateCNL;
			public $numCNL;
			public $etage;




	public function __construct(){
		$nb_args = func_num_args();
		$args = func_get_args();
		if (method_exists($this,$constructeur='__construct'.$nb_args)) {
            call_user_func_array(array($this,$constructeur),$args);
        }
	}
	//pas de connexion
	private function __construct0(){
		$this->connected = 0; // pas encore connecté
	}
	//connexion avec jeton => jeton n'a pas encore expiré
	private function __construct1($jeton){
		$this->sql = new database();
		$data = $this->sql->request('select * from gastromed.tokens where tokens.token=:token', array('token' => $jeton));
		if(($d=$data->fetch())){
			if(($d['token']==$jeton) && (time()-$d['time'] <= 3600 * 3) && ($d['IP'] == $_SERVER['REMOTE_ADDR'])){
				$d = $this->sql->request('select * from gastromed.compte where compte.id_compte=:id_compte', array('id_compte' => $d['id_compte']))->fetch();
				$this->define_compte($d);
			}
			else{
				$this->connected = 0; // fin de session
			}
		}
		else{
			$this->connected = 0;
		}
	}

	//connexion avec username et mot de passe
	private function __construct2($username, $password){
		$this->sql = new database();
		$data = $this->sql->request('select * from gastromed.compte where username = :username and password = PASSWORD(:password)',
									array('username' => $username, 'password' => md5($password)));
		if(($d = $data->fetch()) != NULL){
			$this->define_compte($d);
		}
		else{
			$this->connected = 2; // erreur motpasse ou nom d'utilisateur
		}
	}

	private function define_compte($d){
		$this->jeton = new token($d);
		$this->username = $d['username'];
		$this->nom = $d["nom"];
		$this->prenom = $d['prenom'];
		$this->grade = $d['grade'];
		$this->id_compte = $d['id_compte'];
		$this->gfl = $d['gfl'];
	
		$this->email = $d['email'];
	
		$this->fonction= $d['fonction'];
	
	
	
		
		$this->sexe= $d['sexe'];
		$this->sf= $d['sf'];
	
		$this->password_app= $d['password_app'];
		




		$data = $this->sql->request('SELECT nom_labo FROM labo where labo.id_compte = :id', array('id' => $this->id_compte));
		if(($d=$data->fetch())) { $this->labo = $d['nom_labo']; }
		$this->connected = 1; // connexion OK
	}

	public function isConnected(){
		return $this->connected;
	}
}
?>

<?php
class database{
	
	public $sql;
	
	public function __construct(){
		try{
			$this->sql = new PDO('mysql:host=localhost;dbname=gastromed;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}catch(Exception $e){ }
	}
	
	function request($requete, $tab){
		$req = $this->sql->prepare($requete); 
		$req->execute($tab);
		return $req;
	}
	function execc($requete){
		$req = $this->sql->query($requete); 
		
		return $req;
	}

	function clearRequest($req){
		$req->closeCursor();
	}
}
?>

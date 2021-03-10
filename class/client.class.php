<?php

class client
{
	public $bdd;
	private $user;
	
	public function __construct($user){
		$this->user = $user;
		if($this->user->gfl){
			$this->bdd = $this->user->sql->request('select * from client', null);
		}
		else{
			$this->bdd = $this->user->sql->request("select * from client where id_compte=:annee", array('annee' => $this->user->id_compte));
		}
}
}
?>

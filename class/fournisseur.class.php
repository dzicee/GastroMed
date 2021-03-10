<?php
class fournisseur
{
	public $bdd;
	private $user;
	
	public function __construct($user){
		$this->user = $user;
		$this->bdd = $this->user->sql->request('select * from fournisseur where supp=0', null);
	}
}
?>
<?php
class facture implements document
{
	private $user;
	public $bdd;
	
	public function __construct($user){
		$this->user = $user;
		if($this->user->gfl){
			$this->bdd = $this->user->sql->request('select *, date_format(date, "%d-%m-%Y") as dat from facture order by id_facture desc', NULL);
		}
		else{
			$this->bdd = $this->user->sql->request('select *, date_format(date, "%d-%m-%Y") as dat from facture where id_facture in (select id_bon from bon where id_compte=:id)order by id_facture desc', array('id' => $this->user->id_compte));
		}
	}
}
?>
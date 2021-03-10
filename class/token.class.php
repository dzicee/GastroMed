<?php
class token
{
	public $lastUpdate;
	public $tokenString;

	public function __construct($d){
		$sql = new database();
		$this->lastUpdate = time();
        $this->tokenString = md5($this->filtrer($d['username']).$this->lastUpdate);
		$sql->request('update gastromed.tokens set token=:token, time=:time, ip=:ip where id_compte=:id_compte',
				array('token' => $this->tokenString,
						'time' => $this->lastUpdate,
						'ip' => $_SERVER['REMOTE_ADDR'],
						'id_compte' => $d['id_compte']
				));
		setcookie('token_agfl', $this->tokenString, time() + 3600 * 3, null, null, false, true);
	}
	
	public function filtrer($VAL)
	{
		// Filtrage de Securité
		$VAL = explode("'",$VAL)[0];
		return htmlspecialchars($VAL);
	}
}
?>
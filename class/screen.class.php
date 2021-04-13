<?php
class screen
{
	private $user;
	public $doc;
	
	public function __construct($user){
		$this->user = $user;
	}
	
	public function __tostring(){
		if($this->user->connected == 0){
			return (string)include_once('./page/login.php');
		}
		else if($this->user->connected == 2){
			return (string)include_once("error.html") ;
		}
		else{
			if(isset($_GET['message'])){
				$this->doc = new message($this->user);
				return (string)include_once("./page/message.php");
			}
			else if(isset($_GET['notif'])){
				$this->doc = new notification($this->user);
				return (string)include_once("./page/notification.php");
			}
			else if(isset($_GET['ventilation'])){
				$this->doc = new ventilation($this->user);
				return (string)include_once("./page/ventilation.php");
			}
			else if(isset($_GET['hist'])){
				$this->doc = new bon($this->user);
				return (string)include_once('./page/bon.php');
			}
			else if(isset($_GET['lsp'])){
				$this->doc = new bon($this->user);
				return (string)include_once('./page/lsp.php');
			}
			else if(isset($_GET['infosLSP'])){
				$this->doc = new bon($this->user);
				return (string)include_once('./page/infosLSP.php');
			}
			else if(isset($_GET['facture'])){
				$this->doc = new facture($this->user);
				return (string)include_once('./page/facture.php');
			}
			else if(isset($_GET['mandat'])){
				if($this->user->gfl){
					$this->doc = new mandat($this->user);
					return (string)include_once('./page/mandat.php');
				}
				else{
					return (string)include_once('./page/error_incompatibilite.html');
				}
			}
			else if(isset($_GET['inventaire'])){
				$this->doc = new inventaire($this->user);
				return (string)include_once('./page/inventaire.php');
			}
			else if(isset($_GET['engagement_compte'])){
				$this->doc = new p_compte($this->user);
				return (string)include_once('./page/p_compte.php');
			}
			else if(isset($_GET['engagement_charge'])){
				$this->doc = new p_charge($this->user);
				return (string)include_once('./page/p_charge.php');
			}
			else if(isset($_GET['patients'])){

				return (string)include_once('./page/patients.php');
			}
			else if(isset($_GET['co'])){

				return (string)include_once('./page/const.php');
			}
			else if(isset($_GET['detail_app'])){

				return (string)include_once('./page/detail_appart.php');
			}
			else if(isset($_GET['modifLSP'])){

				return (string)include_once('./page/modif_clientLSP.php');
			}
			else if(isset($_GET['pdf'])){

				return (string)include_once('./page/pdf.php');
			}
			
			else if(isset($_GET['add_patient'])){

				return (string)include_once('./page/add_patient.php');
			}
			else if(isset($_GET['add'])){

				return (string)include_once('./page/add.php');
			}
			else if(isset($_GET['patient'])){

				return (string)include_once('./page/patient.php');
			}
			else if(isset($_GET['search'])){

				return (string)include_once('./page/search.php');
			}
			else if(isset($_GET['pdflsp'])){

				return (string)include_once('./page/pdfLSP.php');
			}
			else if(isset($_GET['modif'])){

				return (string)include_once('./page/modif_client.php');
			}
			else if(isset($_GET['homeA'])){

				return (string)include_once('./page/home_arab.php');
			}
			else if(isset($_GET['homea'])){

				return (string)include_once('./page/homea.php');
			}
			else if(isset($_GET['ta'])){

				return (string)include_once('./page/tamazight.php');
			}
			else if(isset($_GET['modifc'])){

				return (string)include_once('./page/modif_client.php');
			}
			else if(isset($_GET['infos'])){

				return (string)include_once('./page/infos.php');
			}
			else if(isset($_GET['dmd'])){

				return (string)include_once('./page/dmd_client.php');
			}
			else if(isset($_GET['quittance'])){

				return (string)include_once('./page/quittance.php');
			}
			else if(isset($_GET['client_q'])){

				return (string)include_once('./page/client_quittance.php');
			}
			else if(isset($_GET['contrat'])){

				return (string)include_once('./page/contrat.php');
			}
			else if(isset($_GET['im'])){

				return (string)include_once('./page/import.php');
			}
			else if(isset($_GET['prj'])){

				return (string)include_once('./page/projets.php');
			}
				else if(isset($_GET['prjl'])){

				return (string)include_once('./page/projet.php');
			}
			else if(isset($_GET['client'])){
				if($this->user->gfl){
					$this->doc = new client($this->user);
					return (string)include_once('./page/client.php');
				}
				
				
			}
			else if(isset($_GET['st'])){
				if($this->user->gfl){
					$this->doc = new client($this->user);
					return (string)include_once('./page/stat.php');
				}
				
			}
			
			else if(isset($_GET['dc'])){
				if($this->user->gfl){
					$this->doc = new fournisseur($this->user);
					return (string)include_once('./page/fournisseur.php');
				}
				else{
					return (string)include_once('./page/error_incompatibilite.html');
				}
			}
			
			else if($this->user->gfl){
				return (string)include_once("./page/home_gfl.php");
			}
			
			else return (string)include_once("./page/home.php");
		}
	}
	
	public function getUser(){
		return $this->user;
	}
}
?>
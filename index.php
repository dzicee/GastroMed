<?php
include_once("./class/classe.class.php");

$AGENT =  $_SERVER['HTTP_USER_AGENT'];
if($AGENT  == "Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko"){
	header("Location:./page/error_browser.html");
}
else{
	
	if(isset($_GET['logout'])){
		$_SESSION = array();
		session_destroy();
		setcookie("token_agfl", "", time()+3600, null, null, false, true);
		unset($user);
		header("Location:index.php");
	}
	else if(isset($_POST['login'])){
		$user = new compte($_POST['username'], $_POST['password']);
	}
	else if(isset($_COOKIE['token_agfl']) && $_COOKIE['token_agfl']!=""){
		$user = new compte($_COOKIE['token_agfl']); 
	}
	else{
		$user = new compte();
	}
	
	$afficher = new screen($user);
	echo $afficher;
}
?>
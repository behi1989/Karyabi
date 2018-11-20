<?php
session_start();
ob_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/config.php';

function AutoLoad($className){
	if (file_exists(ROOT . 'inc_func/class.' . $className . '.php')){
		require_once ROOT . 'inc_func/class.' . $className . '.php';
	}
}
spl_autoload_register('AutoLoad');
require_once ROOT . 'inc_func/jdf.php';
require_once ROOT . 'inc_func/set-config.php';

error_reporting(0);
if(!isset($_SERVER['HTTP_REFERER'])){
	exit();
}

if (!isset($_SESSION['usrLogin']) || $_SESSION['usrLogin'] == ""){
	header("location:../index.php");
	exit();
}else{
	
if (isset($_GET["action"])){
	if($_GET["action"]=="delete"){
		$id = $_GET['id'];
		$DB = new DB();
		$User = new User();
		$res = $User->UserMessageDelete($id);
		if($res){
			header("location:./userprofile.php");
			exit();	
		}
	}else{
		header("location:./userprofile.php");
		exit();
	}
}else{
	header("location:./userprofile.php");
	exit();
}
	
}
?>
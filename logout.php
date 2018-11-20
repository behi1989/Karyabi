<?php

session_start();
ob_start();
require_once str_replace('\\','/',dirname(__FILE__)).'/config.php';

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

date_default_timezone_set("Asia/Tehran");
$User = new User();
$lastvisit = time();
$lasttime = date("H:i");
$id = $_GET['id'];
$resl = $User->UpdateUserLastvisit($lastvisit,$lasttime,$id);
unset($_SESSION['usrLogin']);
session_destroy();
setcookie("usr" , "" , time()-60*60*24*3, "/","", 0);
setcookie("psw", "" , time()-60*60*24*3, "/","", 0);
sleep(3);
header("location:./index.php");
exit();

?>
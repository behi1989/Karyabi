<?php

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

 
	if(isset($_GET['action'])){
		 if($_GET['action']=="active"){
			 $code = $_GET['code'];
			 $User = new User();
			 $res = $User->SelectEmailCode($code);
			 foreach($res as $rows){
				$res = $rows['_emailCode'];
			}
			 if($res == $code){
				 echo '<div class="alert alert-success">ایمیل شما تایید شد.بعد از چند لحظه به پنل کاربری هدایت می شوید.لطفا شکیبا باشید...</div>';
				 echo "<script>setTimeout(\"location.href = './userprofile.php';\",3000);</script>";
				 $rest = $User->UpdateEmailUser($code);
			 }
			 else{
				 echo '<div class="alert alert-warning">ایمیل شما تایید نشد.مجددا تلاش کنید</div>';
				 echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>";
			 }
		 }
	 }
	else{
		header("../userlogin.php");
		exit();
	}

	if (isset($_GET['actions'])){
		if($_GET['actions']=="update"){
			$code2 = $_GET['code2'];
			$User = new User();
			$ress = $User->SelectEmailCode($code2);
			 foreach($ress as $rows){
				$ress = $rows['_emailCode'];
				$passs = $rows['_password'];
			}
			 if($ress == $code2){
				 echo '<div class="alert alert-success">تا لحظاتی دیگر به پنل کاربری هدایت می شوید و می توانید کلمه عبور جدید برای خود ثبت کنید</div>';
				 echo "<script>setTimeout(\"location.href = './userchangepass.php';\",3000);</script>";
			 }else{
				 echo '<div class="alert alert-warning">کد امنیتی شما تایید نشد.مجددا تلاش کنید</div>';
				 echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>";
			 }
		}
	}
?>
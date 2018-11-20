<?php
//check login cookie
error_reporting(0);

$servername = "localhost";
$dbname = "__db_job";
$username = "root";
$password = "behi1989";

	if(isset($_COOKIE['Cookiecode'])) {
		$connection = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$sql=$connection->prepare('SELECT * FROM `__tbl_user` WHERE `_setCookie`=:cookie');
		$res = $sql->execute(array(
		":cookie"=>$cookiecode
		));
		print_r($res);
		foreach($res as $rows){
			$usrname = $rows['_username'];
		}
		print_r($username);
		if($res == $_COOKIE['Cookiecode']){
			$_SESSION['usrLogin'] = $usrname;
		}else{
			
		}	
}

?>




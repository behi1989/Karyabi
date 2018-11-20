<?php
error_reporting(0);

	class Admin extends DB{
		
	//Read Admin
	public function ReadAdmin(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_admin` ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
		
	public function ReadAdmin2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_admin`  ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
		
	// Change ID to adminType
	public function adminsType($adminID = NULL){
		$sql = $this->connection->prepare("SELECT * FROM `_admintype` WHERE (`_adminID` = $adminID) ");
		$sql->execute();
		foreach ($sql as $rows){
			$admin = $rows['_adminType'];
		}
		return($admin);
	}
		
		//Insert Admin
	public function InsertAdmin($name,$email,$pass,$tel,$ostan,$city,$date,$adminID,$level){
		$sql = $this->connection->prepare("INSERT INTO `_tbl_admin` (`_name`,`_email`,`_password`,`_tel`,`_ostan`,`_city`,`_cDate`,`_adminID`,`_level`) VALUES (:name,:email,:pass,:tel,:ostan,:city,:cDate,:adminID,:level) ");
			if ($sql->execute(array(
			":name"=>$name,
			":email"=>$email,
			":pass"=>$pass,
			":tel"=>$tel,
			":ostan"=>$ostan,
			":city"=>$city,
			":cDate"=>$date,
			":adminID"=>$adminID,
			":level"=>$level
		))){
			return($sql);
		}
	}
		
	//Delete Admin
	public function DeleteAdmin($id){
		$sql = $this->connection->prepare("DELETE FROM `_tbl_admin` WHERE `_id`=$id");
			if($sql->execute()){
				return($sql);
			}
	}
		
	public function AdminLogin($email,$password){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_admin` WHERE (`_email`=:email AND `_password`=:password)");
		if($sql->execute(array(
		":email"=>$email,
		":password"=>$password
		))){
			return ($sql);
		}
	}
	
	public function UpdateAdminCookie($Cookiecode,$id){
		$sql = $this->connection->prepare("UPDATE `_tbl_admin` SET `_cookiecode`=:setcookie WHERE `_id`=:id");
		if($sql->execute(array(
			":setcookie"=>$Cookiecode,
			":id"=>$id
		))){
			return($sql);
		}
	}
		
	public function SelectLoginAdmin($email){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_admin` WHERE `_email`=:email");
		if($sql->execute(array(
		":email"=>$email
		))){
			return ($sql);
		}
	}
		
	public function SelectAdminById($id){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_admin` WHERE `_id`=:id");
		if($sql->execute(array(
		":id"=>$id
		))){
			return ($sql);
		}
	}
		
	public function UpdateAdminPass($newpass,$id){
		$sql = $this->connection->prepare("UPDATE `_tbl_admin` SET `_password`=:passwrod WHERE `_id`=:ids");
		if($sql->execute(array(
			":passwrod"=>$newpass,
			":ids"=>$id
		))){
			return($sql);
		}
	}
		
	public function UpdateAdminAccess($access,$id){
		$sql = $this->connection->prepare("UPDATE `_tbl_admin` SET `_level` =:level WHERE `_id`=$id");
		if($sql->execute(array(
			":level"=>$access
		))){
			return($sql);
		}
	}
}
?>
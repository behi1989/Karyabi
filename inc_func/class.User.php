<?php
error_reporting(0);

class User extends DB{
	public function ReadUser(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_userType`=1 ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadUser2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_userType`=1 ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function UserCount(){
		$sql = $this->connection->prepare("SELECT COUNT(`_id`) FROM `__tbl_user` WHERE `_userType`=1");
		$sql->execute();
		$res = $sql->fetchColumn();
		return($res);
	}
	
	public function TaeedUser($taeed,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_taeed`=:taeed WHERE `_id`=:id ");
		$sql->execute(array(
		":taeed"=>$taeed,
		":id"=>$id
		));
		return($sql);
	}
	
	public function DeleteUser($id){
		$sql = $this->connection->prepare("DELETE FROM `__tbl_user` WHERE `_id`=$id");
		if($sql->execute()){
			return($sql);
		}
	}
	
	public function AddUser($fname,$username,$password,$email,$cdate,$usertype,$emailcode){
		$sql = $this->connection->prepare("INSERT INTO `__tbl_user` (`_fname`,`_username`,`_password`,`_email`,`_Cdate`,`_userType`,`_emailCode`) VALUES (:fname,:username,:password,:email,:cdate,:usertype,:emailcode)");
		if($sql->execute(array(
		":fname"=>$fname,
		":username"=>$username,
		":password"=>$password,
		":email"=>$email,
		":cdate"=>$cdate,
		":usertype"=>$usertype,
		":emailcode"=>$emailcode
		))){
			return(1018);
		}else{
			return(1008);
		}
	}
	
	public function SelectLoginUser($username){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_username`=:username");
		if($sql->execute(array(
		":username"=>$username
		))){
			return ($sql);
		}
	}
	
	public function SelectUserById($id){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_id`=:id");
		if($sql->execute(array(
		":id"=>$id
		))){
			return ($sql);
		}
	}
	
	public function UserLogin($usrname,$psw){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE (`_username`=:username AND `_password`=:password)");
		if($sql->execute(array(
		":username"=>$usrname,
		":password"=>$psw
		))){
			return ($sql);
		}
	}
	
	public function SelectEmailUser($email){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_email`=:email");
		if($sql->execute(array(
			":email"=>$email
		))){
			return($sql);
		}
	}
	
	public function UpdateEmailUser($emailcode){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_taeed`=1 WHERE `_emailCode`=:emailcode");
		if($sql->execute(array(
			":emailcode"=>$emailcode
		))){
			return($sql);
		}
	}
	
	public function SelectEmailCode($emailcode){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_emailCode`=:emailcode");
		if($sql->execute(array(
			":emailcode"=>$emailcode
		))){
			return($sql);
		}
	}
	
	public function UpdateUserCookie($Cookiecode,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_setCookie`=:setcookie WHERE `_id`=:id");
		if($sql->execute(array(
			":setcookie"=>$Cookiecode,
			":id"=>$id
		))){
			return($sql);
		}
	}
	
	public function UpdateUserProfile($fname,$mobile,$ostan,$city,$coname,$cotel,$coemail,$coweb,$coaddress,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_fname`=:fname , `_mobile`=:mobile , `_ostan`=:ostan , `_city`=:city , `_coName`=:coname , `_coTel`=:cotel , `_coEmail`=:coemail , `_coWeb`=:coweb , `_coAddress`=:coaddress  WHERE `_id`=:id");
		if($sql->execute(array(
			":fname"=>$fname,
			":mobile"=>$mobile,
			":ostan"=>$ostan,
			":city"=>$city,
			":coname"=>$coname,
			":cotel"=>$cotel,
			":coemail"=>$coemail,
			":coweb"=>$coweb,
			":coaddress"=>$coaddress,
			":id"=>$id
		))){
			return($sql);
		}
	}
	
	public function UpdateUserLastvisit($ldate,$ltime,$ids){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_Ldate`=:ldate , `_Ltime`=:ltime WHERE `_id`=:ids");
		if($sql->execute(array(
			":ldate"=>$ldate,
			":ltime"=>$ltime,
			":ids"=>$ids
		))){
			return($sql);
		}
	}
	
	public function UpdateUserPass($newpass,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_password`=:passwrod WHERE `_id`=:ids");
		if($sql->execute(array(
			":passwrod"=>$newpass,
			":ids"=>$id
		))){
			return($sql);
		}
	}
	
	public function CheckCookie($Cookiecode){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_setCookie`=:cookiecode");
		if($sql->execute(array(
			":cookiecode"=>$Cookiecode
		))){
			return($sql);
		}
	}
	
	public function UserMessage(){
		$sql = $this->connection->prepare("SELECT * FROM `_user_message` ORDER BY `_messageID` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function UserMessageDelete($id){
		$sql = $this->connection->prepare("DELETE FROM `_user_message` WHERE `_messageID`=$id");
		if($sql->execute()){
			return($sql);
		}
	}
	
	public function UpdateUserPic($imgname,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_avatar`=:avatar WHERE `_id`=:id");
		$sql->execute(array(
		":avatar"=>$imgname,
		":id"=>$id
		));
		if($sql){
			return($sql);
		}
	}
}
?>
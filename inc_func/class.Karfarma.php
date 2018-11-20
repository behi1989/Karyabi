<?php
error_reporting(0);

class Karfarma extends DB{
	
	public function ReadKarfarma(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_userType`=2 ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadKarfarma2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_user` WHERE `_userType`=2 ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function TaeedKarfarma($taeed,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_user` SET `_taeed`=:taeed WHERE `_id`=:id ");
		$sql->execute(array(
		":taeed"=>$taeed,
		":id"=>$id
		));
		return($sql);
	}
	
	public function AddKarfarma($fname,$username,$password,$email,$cdate,$usertype,$emailcode){
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
	
	public function DeleteKarfarma($id){
		$sql = $this->connection->prepare("DELETE FROM `__tbl_user` WHERE `_id`=$id");
		if($sql->execute()){
			return($sql);
		}
	}
	
	public function KarfarmaCount(){
		$sql = $this->connection->prepare("SELECT COUNT(`_id`) FROM `__tbl_user` WHERE `_userType`=2");
		$sql->execute();
		$res = $sql->fetchColumn();
		return($res);
	}
}
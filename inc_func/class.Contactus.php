<?php
error_reporting(0);

class Contactus extends DB{
	
	public function SendPM($name,$mobile,$email,$title,$type,$text,$cdate,$stutus,$usrid){
		$sql = $this->connection->prepare("INSERT INTO `_tbl_contactus` (`_name`, `_mobile`, `_email`, `_title`, `_adminType`, `_text`,`_cDate`,`_stutus`,`_usrID`) VALUES (:name,:mobile,:email,:title,:type,:text,:cdate,:stutus,:usrid)");
		if ($sql->execute(array(
		":name"=>$name,
		":mobile"=>$mobile,
		":email"=>$email,
		":title"=>$title,
		":type"=>$type,
		":text"=>$text,
		":cdate"=>$cdate,
		":stutus"=>$stutus,
		":usrid"=>$usrid
		))){
			return($sql);
		}
	}
	
	public function ReadTicketByUsrID($usrid){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_usrID`=$usrid ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadTicketByUsrID2($where,$limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE $where ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadTicketManager(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_adminType`=0 ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadTicketManager2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_adminType`=0 ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}

	public function ReadTicketSupport(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_adminType`=1 ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}	
	
	public function ReadTicketSupport2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_adminType`=1 ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadTicketAds(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_adminType`=2 ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadTicketAds2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_adminType`=2 ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadTicketById($id){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_contactus` WHERE `_id`=$id");
		$sql->execute();
		return($sql);
	}
	
	public function DeleteTicket($id){
		$sql = $this->connection->prepare("DELETE FROM `_tbl_contactus` WHERE `_id`=$id");
		if($sql->execute()){
			return($sql);
		}
	}
	
	public function UpdateTicket1($id,$adminanswer,$dateM){
		$sql = $this->connection->prepare("UPDATE `_tbl_contactus` SET `_stutus`=1 , `_adminAnswer`=:adminanswer , `_aDate`=:aDate WHERE `_id`=$id");
		if($sql->execute(array(
			":adminanswer"=>$adminanswer,
			":aDate"=>$dateM
		))){
			return($sql);
		}
	}


}
?>
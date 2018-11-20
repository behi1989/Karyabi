<?php
error_reporting(0);

class Adv extends DB{
	
	public function ReadAdv(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
	
	public function ReadAdv2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function LastAdv(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` ORDER BY `_id` DESC LIMIT 1");
		$sql->execute();
		return($sql);
	}

	public function ReadMainAdv(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` RAND() LIMIT 3 ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadAdvByID($id){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` WHERE $id ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
	
	public function ShowAdvInNews(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` WHERE `_advPayState`=0 AND `_advType`=2  ORDER BY RAND() LIMIT 4");
		$sql->execute();
		return($sql);
	}
	
	public function ShowAdvInJobs(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` WHERE `_advPayState`=0 AND `_advType`=1  ORDER BY RAND() LIMIT 3");
		$sql->execute();
		return($sql);
	}
	
	public function ShowAdvInMain(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_adv` WHERE `_advPayState`=0 AND `_advType`=0  ORDER BY RAND() LIMIT 3");
		$sql->execute();
		return($sql);
	}
	
	public function InsertAdv ($advPic,$advAddDate,$advAddTime,$advCustomerID,$advCustomerName,$advCustomerTel,$advCustomerAddress,$advPayState,$advRecivePay,$advRecivebank,$advType){
		$sql = $this->connection->prepare("INSERT INTO `_tbl_adv` (`_advPic`,`_advAddDate`,`_advAddTime`,`_advCustomerID`,`_advCustomerName`,`_advCustomerTel`,`_advCustomerAddress`,`_advPayState`,`_advRecivePay`,`_advRecivebank`,`_advType`) VALUES (:advPic,:advAddDate,:advAddTime,:advCustomerID,:advCustomerName,:advCustomerTel,:advCustomerAddress,:advPayState,:advRecivePay,:advRecivebank,:advType) ");
		$sql->execute(array(
			":advPic"=>$advPic,
			":advAddDate"=>$advAddDate,
			":advAddTime"=>$advAddTime,
			":advCustomerID"=>$advCustomerID,
			":advCustomerName"=>$advCustomerName,
			":advCustomerTel"=>$advCustomerTel,
			":advCustomerAddress"=>$advCustomerAddress,
			":advPayState"=>$advPayState,
			":advRecivePay"=>$advRecivePay,
			":advRecivebank"=>$advRecivebank,
			":advType"=>$advType
		));
			return($sql);
	}
	
		//Delete news
	public function DeleteAdv($id){
		$sql = $this->connection->prepare("DELETE FROM `_tbl_adv` WHERE(`_id`=$id)");
		$sql->execute();
		return($sql);
	}
	
	public function UpdateAdv ($advPic,$advAddDate,$advAddTime,$advCustomerName,$advCustomerTel,$advCustomerAddress,$advPayState,$advRecivePay,$advRecivebank,$advType,$idadv){
		$sql = $this->connection->prepare("UPDATE `_tbl_adv` SET `_advPic`=:advPic , `_advAddDate`=:advAddDate , `_advAddTime`=:advAddTime , `_advCustomerName`=:advCustomerName , `_advCustomerTel`=:advCustomerTel , `_advCustomerAddress`=:advCustomerAddress , `_advPayState`=:advPayState , `_advRecivePay`=:advRecivePay , `_advRecivebank`=:advRecivebank , `_advType`=:advType WHERE(`_id`=$idadv) ");
		if ($sql->execute(array(
			":advPic"=>$advPic,
			":advAddDate"=>$advAddDate,
			":advAddTime"=>$advAddTime,
			":advCustomerName"=>$advCustomerName,
			":advCustomerTel"=>$advCustomerTel,
			":advCustomerAddress"=>$advCustomerAddress,
			":advPayState"=>$advPayState,
			":advRecivePay"=>$advRecivePay,
			":advRecivebank"=>$advRecivebank,
			":advType"=>$advType
		))){
			return($sql);
		}
	}
	
}
?>
<?php
error_reporting(0);

class ViewAD extends DB{
	
	//Read Ads
	public function ReadAds(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadAds2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadusrJob($where,$limit){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE $where ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadusrrowsJob($where){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE $where ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
	
	public function ReadDayAds(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE (`_advPay`=1 AND `_advTaeed`=1) ORDER BY `_id` DESC LIMIT 10");
		$sql->execute();
		return($sql);
	}
		//Read Ads
	public function ReadAdds($id=NULL){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE `_id`=:id");
		$sql->execute(array(
		":id"=>$id
		));
		return($sql);
	}
	// Load adv from db
	public function ViewADs($advtaeed = NULL , $start = NULL , $end = NULL ){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE (`_advTaeed`=$advtaeed) ORDER BY `_id` DESC LIMIT $start,$end ");
		$sql->execute();
		return($sql);
	}
	public function ViewCount(){
		$sql = $this->connection->prepare("SELECT COUNT(`_id`) FROM `__tbl_add_job`");
		$sql->execute();
		$res = $sql->fetchColumn();
		return($res);
	}
	// Paging
	public function ViewADsPaging($advtaeed = NULL){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE (`_advTaeed`=$advtaeed) ORDER BY `_id` DESC");
		$sql->execute();
		return $sql->rowcount();
	}

	// Change ID to gender name
	public function gender($genderID = NULL){
		$sql = $this->connection->prepare("SELECT * FROM `_gender` WHERE (`_idGender`=$genderID)");
		$sql->execute();
		foreach ($sql as $rows){
			$genderName = $rows['_gender'];
		}
		return($genderName);
	}
	//Change ID to bime name
	public function bime($bimeID = NULL){
		$sql = $this->connection->prepare("SELECT * FROM `_tblbime` WHERE (`_idBime`=$bimeID)");
		$sql->execute();
		foreach ($sql as $rows){
			$bimeName = $rows['_bime'];
		}
		return($bimeName);
	}
	//Change ID to khedmat name
	public function khedmat($khedmatID = NULL){
		$sql = $this->connection->prepare("SELECT * FROM `_khedmat` WHERE (`_idKhedmat`=$khedmatID)");
		$sql->execute();
		foreach ($sql as $rows){
			$khedmatName = $rows['_khedmat'];
		}
		return($khedmatName);
	}
	//Change ID to married name
	public function married($marriedID = NULL){
		$sql = $this->connection->prepare("SELECT * FROM `_tblmarried` WHERE (`_idMarried`=$marriedID)");
		$sql->execute();
		foreach ($sql as $rows){
			$marriedName = $rows['_married'];
		}
		return($marriedName);
	}
	
	//Insert Ads
	public function InsertAD ($title,$coname,$bossname,$address,$tel,$mobile,$email,$web,$jobreq,$edu,$degree,$sience,$reqno,$export,$gender,$age,$married,$bime,$khedmat,$ayabzahab,$worktime,$workpay,$workcity,$taeed,$pay,$advType,$date,$time,$expalin,$advUser,$advUserid){
		$sql = $this->connection->prepare("INSERT INTO `__tbl_add_job` (`_jobTitle`,`_coName`,`_bossName`,`_coAddress`,`_coTel`,`_mobile`,`_coEmail`,`_coWeb`,`_jobReq`,`_edu`,`_degree`,`_sience`,`_reqNo`,`_export`,`_gender`,`_age`,`_married`,`_bime`,`_khedmat`,`_ayabzahab`,`_workTime`,`_workPay`,`_workCity`,`_advTaeed`,`_advPay`,`_advType`,`_addDate`,`_advTime`,`_explain` , `_advUser` , `_advUserID`) VALUES (:title,:coname,:bossname,:address,:tel,:mobile,:email,:web,:jobreq,:edu,:degree,:sience,:reqno,:export,:gender,:age,:married,:bime,:khedmat,:ayabzahab,:worktime,:workpay,:workcity,:taeed,:pay,:advType,:date,:time,:expalin,:advuser,:advuserid) ");
		$sql->execute(array(
			":title"=>$title,
			":coname"=>$coname,
			":bossname"=>$bossname,
			":address"=>$address,
			":tel"=>$tel,
			":mobile"=>$mobile,
			":email"=>$email,
			":web"=>$web,
			":jobreq"=>$jobreq,
			":edu"=>$edu,
			":degree"=>$degree,
			":sience"=>$sience,
			":reqno"=>$reqno,
			":export"=>$export,
			":gender"=>$gender,
			":age"=>$age,
			":married"=>$married,
			":bime"=>$bime,
			":khedmat"=>$khedmat,
			":ayabzahab"=>$ayabzahab,
			":worktime"=>$worktime,
			":workpay"=>$workpay,
			":workcity"=>$workcity,
			":taeed"=>$taeed,
			":pay"=>$pay,
			":advType"=>$advType,
			":date"=>$date,
			":time"=>$time,
			":expalin"=>$expalin,
			":advuser"=>$advUser,
			":advuserid"=>$advUserid
		));
			return($sql);
	}

	public function ReadDayAdsTop(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_add_job` WHERE (`_advPay`=1 AND `_advTaeed`=1 AND `_advType`=1) ORDER BY `_id` DESC LIMIT 10");
		$sql->execute();
		return($sql);
	}
	
	//Delete Ads
	public function DeleteAD($id){
		$sql = $this->connection->prepare("DELETE FROM `__tbl_add_job` WHERE(`_id`=$id)");
		$sql->execute();
		return($sql);
	}
	
	//Edit Ads
	public function EditAD ($title,$coname,$bossname,$address,$tel,$mobile,$email,$web,$jobreq,$edu,$degree,$sience,$reqno,$export,$gender,$age,$married,$bime,$khedmat,$ayabzahab,$worktime,$workpay,$workcity,$date,$time,$expalin,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_add_job` SET `_jobTitle`=:title , `_coName`=:coname , `_bossName`=:bossname , `_coAddress`=:address , `_coTel`=:tel , `_mobile`=:mobile , `_coEmail`=:email , `_coWeb`=:web , `_jobReq`=:jobreq , `_edu`=:edu , `_degree`=:degree , `_sience`=:sience , `_reqNo`=:reqno , `_export`=:export , `_gender`=:gender , `_age`=:age , `_married`=:married , `_bime`=:bime , `_khedmat`=:khedmat , `_ayabzahab`=:ayabzahab , `_workTime`=:worktime , `_workPay`=:workpay , `_workCity`=:workcity , `_addDate`=:date , `_advTime`=:time , `_explain`=:expalin WHERE (`_id`=$id) ");
		if ($sql->execute(array(
			":title"=>$title,
			":coname"=>$coname,
			":bossname"=>$bossname,
			":address"=>$address,
			":tel"=>$tel,
			":mobile"=>$mobile,
			":email"=>$email,
			":web"=>$web,
			":jobreq"=>$jobreq,
			":edu"=>$edu,
			":degree"=>$degree,
			":sience"=>$sience,
			":reqno"=>$reqno,
			":export"=>$export,
			":gender"=>$gender,
			":age"=>$age,
			":married"=>$married,
			":bime"=>$bime,
			":khedmat"=>$khedmat,
			":ayabzahab"=>$ayabzahab,
			":worktime"=>$worktime,
			":workpay"=>$workpay,
			":workcity"=>$workcity,
			":date"=>$date,
			":time"=>$time,
			":expalin"=>$expalin
		))){
			return($sql);
		}
	}
	
	//Update view Ads
	public function UpdateViewAds ($advview,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_add_job` SET `_advView`=:advView WHERE (`_id`=$id) ");
		if ($sql->execute(array(
			":advView"=>$advview
		))){
			return($sql);
		}
	}
	
	public function UpdateViewAdsTaeed ($taeed,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_add_job` SET `_advTaeed`=:advTaeed WHERE (`_id`=$id) ");
		if ($sql->execute(array(
			":advTaeed"=>$taeed
		))){
			return($sql);
		}
	}
	
	public function UpdateViewAdsVijeh ($vijeh,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_add_job` SET `_advType`=:advType WHERE (`_id`=$id) ");
		if ($sql->execute(array(
			":advType"=>$vijeh
		))){
			return($sql);
		}
	}
}
?>
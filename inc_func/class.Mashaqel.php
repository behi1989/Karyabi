<?php
error_reporting(0);

class Mashaqel extends DB{
	
	public function ReadMashaqel(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadMashaqel2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadMainMashaqel(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` WHERE (`_paystate`=0 AND `_taeed`=1) ORDER BY `_id` DESC LIMIT 12");
		$sql->execute();
		return($sql);
	}
	
	public function ReadLastMashaqel(){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` WHERE (`_paystate`=0 AND `_taeed`=1) ORDER BY rand() DESC LIMIT 4");
		$sql->execute();
		return($sql);
	}
	
	public function ReadRndMashaqel($s){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` WHERE (`_paystate`=0 AND `_taeed`=1) LIMIT $s");
		$sql->execute();
		return($sql);
	}
	
	public function ReadRndsMashaqel($d){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` WHERE (`_paystate`=0 , `_id` > $d)  LIMIT 4");
		$sql->execute();
		return($sql);
	}
	
	public function MashaqelCount(){
		$sql = $this->connection->prepare("SELECT COUNT(`_id`) FROM `__tbl_mashaqel`");
		$sql->execute();
		$res = $sql->fetchColumn();
		return($res);
	}
	
	public function ReadMashaqelByID($id){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` WHERE $id ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
	
	public function ReadMashaqelByID2($where,$limit){
		$sql = $this->connection->prepare("SELECT * FROM `__tbl_mashaqel` WHERE $where ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function InsertMashaqel ($coname,$coadmin,$cdate,$ctime,$cotel,$coaddress,$txt1,$txt2,$txt3,$coimage,$imgmore1,$explain,$paystate,$recivepay,$recivebank){
		$sql = $this->connection->prepare("INSERT INTO `__tbl_mashaqel` (`_coname`,`_coAdmin`,`_Cdate`,`_Ctime`,`_coTel`,`_coAddress`,`_txt1`,`_txt2`,`_txt3`,`_coImage`,`_imgmore1`,`_explain`,`_paystate`,`_recivepay`,`_recivebank`) VALUES (:coname,:coadmin,:cdate,:ctime,:cotel,:coaddress,:txt1,:txt2,:txt3,:coimage,:imgmore1,:explain,:paystate,:recivepay,:recivebank) ");
		$sql->execute(array(
			":coname"=>$coname,
			":coadmin"=>$coadmin,
			":cdate"=>$cdate,
			":ctime"=>$ctime,
			":cotel"=>$cotel,
			":coaddress"=>$coaddress,
			":txt1"=>$txt1,
			":txt2"=>$txt2,
			":txt3"=>$txt3,
			":coimage"=>$coimage,
			":imgmore1"=>$imgmore1,
			":explain"=>$explain,
			":paystate"=>$paystate,
			":recivepay"=>$recivepay,
			":recivebank"=>$recivebank
		));
			return($sql);
	}
	
	public function InsertMashaqelUser ($coname,$coadmin,$cdate,$ctime,$cotel,$coaddress,$txt1,$txt2,$txt3,$coimage,$imgmore1,$explain,$paystate,$idusr){
		$sql = $this->connection->prepare("INSERT INTO `__tbl_mashaqel` (`_coname`,`_coAdmin`,`_Cdate`,`_Ctime`,`_coTel`,`_coAddress`,`_txt1`,`_txt2`,`_txt3`,`_coImage`,`_imgmore1`,`_explain`,`_paystate`,`_userID`) VALUES (:coname,:coadmin,:cdate,:ctime,:cotel,:coaddress,:txt1,:txt2,:txt3,:coimage,:imgmore1,:explain,:paystate,:usrid) ");
		$sql->execute(array(
			":coname"=>$coname,
			":coadmin"=>$coadmin,
			":cdate"=>$cdate,
			":ctime"=>$ctime,
			":cotel"=>$cotel,
			":coaddress"=>$coaddress,
			":txt1"=>$txt1,
			":txt2"=>$txt2,
			":txt3"=>$txt3,
			":coimage"=>$coimage,
			":imgmore1"=>$imgmore1,
			":explain"=>$explain,
			":paystate"=>$paystate,
			":usrid"=>$idusr
		));
			return($sql);
	}

	public function DeleteMashaqel($id){
		$sql = $this->connection->prepare("DELETE FROM `__tbl_mashaqel` WHERE(`_id`=$id)");
		$sql->execute();
		return($sql);
	}
	
	public function UpdateMashaqel ($coname,$coadmin,$cdate,$ctime,$cotel,$coaddress,$txt1,$txt2,$txt3,$coimage,$imgmore1,$explain,$paystate,$recivepay,$recivebank,$idMM){
		$sql = $this->connection->prepare("UPDATE `__tbl_mashaqel` SET `_coname`=:coname , `_coAdmin`=:coadmin , `_Cdate`=:cdate , `_Ctime`=:ctime , `_coTel`=:cotel , `_coAddress`=:coaddress , `_txt1`=:txt1 , `_txt2`=:txt2 , `_txt3`=:txt3 , `_coImage`=:coimage , `_imgmore1`=:imgmore1 , `_explain`=:explain , `_paystate`=:paystate , `_recivepay`=:recivepay , `_recivebank`=:recivebank WHERE(`_id`=$idMM) ");
		if ($sql->execute(array(
			":coname"=>$coname,
			":coadmin"=>$coadmin,
			":cdate"=>$cdate,
			":ctime"=>$ctime,
			":cotel"=>$cotel,
			":coaddress"=>$coaddress,
			":txt1"=>$txt1,
			":txt2"=>$txt2,
			":txt3"=>$txt3,
			":coimage"=>$coimage,
			":imgmore1"=>$imgmore1,
			":explain"=>$explain,
			":paystate"=>$paystate,
			":recivepay"=>$recivepay,
			":recivebank"=>$recivebank
		))){
			return($sql);
		}
	}
	
	public function UpdateMashaqelusr ($coname,$coadmin,$cdate,$ctime,$cotel,$coaddress,$txt1,$txt2,$txt3,$coimage,$imgmore1,$explain,$idMM){
		$sql = $this->connection->prepare("UPDATE `__tbl_mashaqel` SET `_coname`=:coname , `_coAdmin`=:coadmin , `_Cdate`=:cdate , `_Ctime`=:ctime , `_coTel`=:cotel , `_coAddress`=:coaddress , `_txt1`=:txt1 , `_txt2`=:txt2 , `_txt3`=:txt3 , `_coImage`=:coimage , `_imgmore1`=:imgmore1 , `_explain`=:explain WHERE(`_id`=$idMM) ");
		if ($sql->execute(array(
			":coname"=>$coname,
			":coadmin"=>$coadmin,
			":cdate"=>$cdate,
			":ctime"=>$ctime,
			":cotel"=>$cotel,
			":coaddress"=>$coaddress,
			":txt1"=>$txt1,
			":txt2"=>$txt2,
			":txt3"=>$txt3,
			":coimage"=>$coimage,
			":imgmore1"=>$imgmore1,
			":explain"=>$explain
		))){
			return($sql);
		}
	}
	
	public function UpdateMashaqelView ($visited,$idMM){
		$sql = $this->connection->prepare("UPDATE `__tbl_mashaqel` SET `_visited`=:visited WHERE(`_id`=$idMM) ");
		if ($sql->execute(array(
			":visited"=>$visited
		))){
			return($sql);
		}
	}
	
	public function UpdateMashaqeTaeed ($taeed,$id){
		$sql = $this->connection->prepare("UPDATE `__tbl_mashaqel` SET `_taeed`=:taeed WHERE(`_id`=$id) ");
		if ($sql->execute(array(
			":taeed"=>$taeed
		))){
			return($sql);
		}
	}
}
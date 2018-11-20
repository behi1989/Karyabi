<?php
error_reporting(0);

class Cinema extends DB{

	public function ReadMovie(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_cinema` ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
		
	public function ReadMovie2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_cinema` ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadMovieByID($where){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_cinema` WHERE $where ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
	
	public function InsertMovie ($movieName,$movieDirector,$movieActor,$moviePlayTime,$moviePay,$cinemaName,$cinemaTel,$cinemaAddress,$cinemaChair,$movieSans,$moviePic,$explain,$endPlayTime){
		$sql = $this->connection->prepare("INSERT INTO `_tbl_cinema` (`_movieName`,`_movieDirector`,`_movieActor`,`_moviePlayTime`,`_moviePay`,`_cinemaName`,`_cinemaTel`,`_cinemaAddress`,`_cinemaNumChair`,`_movieSans`,`_moviePic`,`_explain`,`_endPlayTime`) VALUES (:movieName,:movieDirector,:movieActor,:moviePlayTime,:moviePay,:cinemaName,:cinemaTel,:cinemaAddress,:cinemaNumChair,:movieSans,:moviePic,:explain,:endPlayTime) ");
		$sql->execute(array(
			":movieName"=>$movieName,
			":movieDirector"=>$movieDirector,
			":movieActor"=>$movieActor,
			":moviePlayTime"=>$moviePlayTime,
			":moviePay"=>$moviePay,
			":cinemaName"=>$cinemaName,
			":cinemaTel"=>$cinemaTel,
			":cinemaAddress"=>$cinemaAddress,
			":cinemaNumChair"=>$cinemaChair,
			":movieSans"=>$movieSans,
			":moviePic"=>$moviePic,
			":explain"=>$explain,
			":endPlayTime"=>$endPlayTime
		));
			return($sql);
	}
	
	public function DeleteMovie($id){
		$sql = $this->connection->prepare("DELETE FROM `_tbl_cinema` WHERE(`_id`=$id)");
		$sql->execute();
		return($sql);
	}
	
	
	public function UpdateMovie ($emoviename,$emoviedirector,$emovieactor,$emovieplaytime,$moviePay,$ecinemaname,$ecinematel,$ecinemaaddress,$ecinmachair,$ecinemasans,$filenamesmove,$emovieexplain,$idemov){
		$sql = $this->connection->prepare("UPDATE `_tbl_cinema` SET `_movieName`=:movieName , `_movieDirector`=:movieDirector , `_movieActor`=:movieActor , `_moviePlayTime`=:moviePlayTime , `_moviePay`=:moviePay , `_cinemaName`=:cinemaName , `_cinemaTel`=:cinemaTel , `_cinemaAddress`=:cinemaAddress , `_cinemaNumChair`=:cinemaNumChair , `_movieSans`=:movieSans , `_moviePic`=:moviePic , `_explain`=:explain WHERE(`_id`=$idemov) ");
		if ($sql->execute(array(
			":movieName"=>$emoviename,
			":movieDirector"=>$emoviedirector,
			":movieActor"=>$emovieactor,
			":moviePlayTime"=>$emovieplaytime,
			":moviePay"=>$moviePay,
			":cinemaName"=>$ecinemaname,
			":cinemaTel"=>$ecinematel,
			":cinemaAddress"=>$ecinemaaddress,
			":cinemaNumChair"=>$ecinmachair,
			":movieSans"=>$ecinemasans,
			":moviePic"=>$filenamesmove,
			":explain"=>$emovieexplain
		))){
			return($sql);
		}
	}
	
	public function UpdateMovieEndPlay ($movieendplay,$idm){
		$sql = $this->connection->prepare("UPDATE `_tbl_cinema` SET `_endPlayTime`=:endPlayTime WHERE(`_id`=$idm) ");
		if ($sql->execute(array(
			":endPlayTime"=>$movieendplay
		))){
			return($sql);
		}
	}
	
	public function ReadCinemaName(){
		$sql = $this->connection->prepare("SELECT * FROM `tbl_cinema_extra`");
		$sql->execute();
		return($sql);
	}
	public function ReadCinemaName2($where){
		$sql = $this->connection->prepare("SELECT * FROM `tbl_cinema_extra` WHERE $where");
		$sql->execute();
		return($sql);
	}
}
?>
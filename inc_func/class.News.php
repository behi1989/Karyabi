<?php
error_reporting(0);

class News extends DB{

	public function ReadNews(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` ORDER BY `_id` DESC LIMIT 10 ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadNewss(){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` ORDER BY `_id` DESC");
		$sql->execute();
		return($sql);
	}
	
	public function ReadNewss2($limit){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` ORDER BY `_id` DESC $limit ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadEventNews($id){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` WHERE $id ORDER BY `_id` DESC LIMIT 20 ");
		$sql->execute();
		return($sql);
	}
	
	public function ReaIDNews($id){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` WHERE $id ORDER BY `_id` DESC ");
		$sql->execute();
		return($sql);
	}
	
	public function ReadSliderNews($id){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` WHERE $id ORDER BY `_id` DESC LIMIT 8 ");
		$sql->execute();
		return($sql);
	}
	
	//Delete news
	public function DeleteNews($id){
		$sql = $this->connection->prepare("DELETE FROM `_tbl_news` WHERE(`_id`=$id)");
		$sql->execute();
		return($sql);
	}
	
		public function ReadNewsByid($id=NULL){
		$sql = $this->connection->prepare("SELECT * FROM `_tbl_news` WHERE `_id`=:id");
		$sql->execute(array(
		":id"=>$id
		));
		return($sql);
	}
	
	public function UpdateNews ($newstitle,$newstext,$newspic,$newssource,$newsdate,$newstime,$newswritter,$newskey,$newsstype,$idU){
		$sql = $this->connection->prepare("UPDATE `_tbl_news` SET `_newsTitle`=:newstitle , `_newsText`=:newstext , `_newsPic`=:newspic , `_newsSource`=:newssource , `_newsAddDate`=:newsdate , `_newsAddTime`=:newstime , `_newsWritter`=:newswritter , `_newsKey`=:newskey , `_newsType`=:newsstype WHERE(`_id`=$idU) ");
		if ($sql->execute(array(
			":newstitle"=>$newstitle,
			":newstext"=>$newstext,
			":newspic"=>$newspic,
			":newssource"=>$newssource,
			":newsdate"=>$newsdate,
			":newstime"=>$newstime,
			":newswritter"=>$newswritter,
			":newskey"=>$newskey,
			":newsstype"=>$newsstype
		))){
			return($sql);
		}
	}
	
		//Insert Ads
	public function InsertNews ($newsititle,$newsitext,$newsipic,$newsisource,$newsidate,$newsitime,$newsiwritter,$newsikey,$newssitype){
		$sql = $this->connection->prepare("INSERT INTO `_tbl_news` (`_newsTitle`,`_newsText`,`_newsPic`,`_newsSource`,`_newsAddDate`,`_newsAddTime`,`_newsWritter`,`_newsKey`,`_newsType`) VALUES (:newsititle,:newsitext,:newsipic,:newsisource,:newsidate,:newsitime,:newsiwritter,:newsikey,:newssitype) ");
		$sql->execute(array(
			":newsititle"=>$newsititle,
			":newsitext"=>$newsitext,
			":newsipic"=>$newsipic,
			":newsisource"=>$newsisource,
			":newsidate"=>$newsidate,
			":newsitime"=>$newsitime,
			":newsiwritter"=>$newsiwritter,
			":newsikey"=>$newsikey,
			":newssitype"=>$newssitype
		));
			return($sql);
	}
	
		public function UpdateNewsVisit ($newsvisit,$idv){
		$sql = $this->connection->prepare("UPDATE `_tbl_news` SET `_newsVisited`=:newsvisit WHERE(`_id`=$idv) ");
		if ($sql->execute(array(
			":newsvisit"=>$newsvisit
		))){
			return($sql);
		}
	}
}
?>
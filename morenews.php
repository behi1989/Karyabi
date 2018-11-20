<?php require_once('./inc_theme/headerP.php') ?>
<?php require_once('./inc_theme/modal.php') ?>

<?php 
if(!isset($_GET['id'])){
	header("location:index.php");
	exit();
}else{
$id = check_safe_get($_GET['id']);
$where = "`_id`=$id";
$DB = new DB();
$News = new News();
$resN = $News->ReadEventNews($where);
foreach($resN as $rowsN)
	{
		$newsvisit = $rowsN['_newsVisited'];
?>
    <!-- More Interview -->
    <section id="more-interview">
    	<div class="container text-center">
    		<div class="row">
    			<div id="right-interview" class="col-xs-12 col-md-8">
						<div class="panel">
							<div class="panel-heading">
								<div class="panel-title">
									<h4><?php echo $rowsN['_newsTitle']; ?></h4>
								</div>
								
							</div>
							<div class="panel-footer">
								<label style="padding-left: 20px;"><i class="fa fa-calendar"></i> <?php echo jdate("y/m/d",$rowsN['_newsAddDate']); ?></label>
								<label style="padding-left: 20px;"><i class="fa fa-clock-o"></i> <?php echo $rowsN['_newsAddTime']; ?></label>
								<label style="padding-left: 20px;"><i class="fa fa-eye"></i> <?php echo $rowsN['_newsVisited']+1; ?></label>
								<label style="padding-left: 20px;"><i class="fa fa-comment"></i> <?php echo $rowsN['_newsCommentCount']; ?></label>
							</div>
							<div class="panel-body text-center">
								<div class="row">
									<div class="panel-imgs col-xs-12">
										<a href="#"><img src="./_upload/<?php echo $rowsN['_newsPic']; ?>" class="img-responsive text-center"></a>
									</div>
								</div>
								<div class="panel-text">
									<p><?php echo $rowsN['_newsText']; ?></p>
								</div>
								<div class="panel-bottom panel-footer" style="margin-top: 20px">
								<div class="panel-refrence">
									<label class="label-primary"><h5>منبع خبر</h5></label>
									<label class="label-default"><h5><?php echo $rowsN['_newsSource']; ?></h5></label>
								</div>
								<div class="panel-tag">
									<label class="label-success"><h5>کلیدواژه ها</h5></label>
<?php 
	$strkey = explode("،",$rowsN['_newsKey']);
	foreach($strkey as $items){
		if($items!=''){
			echo '<label class="label-default"><h5>'.$items.'</h5></label>'.' ';
		}
			
	}
								
?>	
								</div>
								<div class="panel-tag">
									<label class="label-primary"><h5>انتشار خبر توسط</h5></label>
									<label class="label-default"><h5><?php echo $rowsN['_newsWritter']; ?></h5></label>
								</div>
								</div>
							</div>

						</div>
    			</div>
    			<div id="left-adv" class="col-md-4 text-right">
    				<div class="advert-img">
<?php
$DB = new DB();
$Adv = new Adv();
$rec = $Adv->ShowAdvInNews();
foreach($rec as $rows)
{
?>
    					<a href="#"><img src="_upload/adv/news/<?php echo $rows['_advPic']; ?>" class="img-responsive"></a>
<?php
}
?>
    				</div>
    			</div>
    		</div>
    	</div>
    	
    </section>
<?php
$resN = $News->UpdateNewsVisit($newsvisit+1,$id);
	 }
}
?>
    
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>

	</body>
</html>

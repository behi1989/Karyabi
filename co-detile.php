<?php require_once('./inc_theme/headerP.php') ?>
<?php require_once('./inc_theme/modal.php') ?>
<?php
if(!isset($_GET['id'])){
	header("location:index.php");
	exit();
}else{
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$id = check_safe_get($_GET['id']);
	$where = "`_id`=".$id;
	$res = $Mashaqel->ReadMashaqelByID($where);
	foreach($res as $rows)
	{
	$views = $rows['_visited']; 

	
?>
<!-- Company adv -->
	<section id="company-detile">
		<div class="container text-center">
			<div class="row">
				<div class="side-text col-md-8 col-xs-12">
					<span>
						<h2><?php echo $rows['_coname']; ?></h2>
					</span>
					<div style="width: 100%;min-height: 50px;height: auto" class="panel panel-bottom">
						<h3><?php echo $rows['_txt1']; ?></h3>
					</div>
					<div style="width: 100%;min-height: 50px;height: auto" class="panel panel-bottom">
						<h3><?php echo $rows['_txt2']; ?></h3>
					</div>
					<div style="width: 100%;min-height: 50px;height: auto" class="panel panel-bottom">
						<h3><?php echo $rows['_txt3']; ?></h3>
					</div>
					<div style="width: 100%;min-height: 50px;height: auto;direction: rtl" class="panel">
						<h3><?php echo $rows['_explain']; ?></h3>
					</div>
				</div>
				<div class="side-pic col-md-4 text-center">
					<img src="./_upload/mashaqel/<?php echo $rows['_coImage']; ?>" style="width: 250px;height: 250px" class="img-responsive">
					<?php
	 					if(!empty($rows['_imgmore1'])){
							echo '<img src="./_upload/mashaqel/'. $rows['_imgmore1'] .'" style="width: 250px;max-height:480px" class="img-responsive">';
						}
	 				?>
					
				</div>
			</div>
		</div>
	</section>
<?php
	}
	$views = $views+1;
	$view = $Mashaqel->UpdateMashaqelView($views,$id);
 }
?>
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>   
    
  </body>
</html>
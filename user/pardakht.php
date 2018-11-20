<?php require_once('./inc_theme/header.php') ?>
<?php require_once('../inc_theme/modal.php') ?>
<?php
error_reporting(0);
if(!isset($_SERVER['HTTP_REFERER'])){
	exit();
}

if (!isset($_SESSION['usrLogin']) || $_SESSION['usrLogin'] == ""){
	header("location:../index.php");
	exit();
}
?>

<?php
if(isset($_GET['job_id']))
{
?>
<section id="pardakht-job">
	<div class="container">
		<div class="row">
		<div style="margin: 20px 0">
			<div class="panel" style="height: auto;margin: auto;direction: rtl;min-height: 420px;box-shadow: 0px 0px 3px #888888;max-width: 600px">
    			<div class="panel-body text-center" style="margin-top: 20px">
<?php
if(isset($_GET['job_id'])){
	$DB = new DB();
	$ViewAD = new ViewAD();
	$job_id = check_safe_get($_GET['job_id']);
	$resJob = $ViewAD->ReadAdds($job_id);
	foreach($resJob as $rows)
	{						
?>
   					<br>
    				<p>شماره ثبت آگهی : <?php echo "<span style=color:#44BBFF>".$rows['_id']."</span>"; ?></p>
    				<p>عنوان آگهی : <?php echo "<span style=color:#44BBFF>".$rows['_jobTitle']."</span>"; ?></p>
    				<p>ثبت شده توسط : <?php echo "<span style=color:#44BBFF>".$rows['_bossName']."</span>"; ?></p>
    				<p>وضعیت آگهی : <?php if($rows['_advPay']==0){echo "<span style=color:#FC575E>در حال حاضر آگهی عادی است</span>";}else if($rows['_advPay']==1){echo "<span style=color:#53DF83>در حال حاضر آگهی ویژه است</span>";}; ?></p>
    				<p>انتخاب نوع ثبت آگهی</p>
    				<select id="payidjob" class="form-control" style="max-width: 250px">
    					<option>انتخاب کنید...</option>
    					<option value="1">ثبت یک هفته ای - 150,000 ریال</option>
    					<option value="2">ثبت دو هفته ای - 250,000 ریال</option>
    					<option value="3">ثبت یک ماهه - 400,000 ریال</option>
    				</select>
    				<p></p>
    				<p>تاریخ ثبت : <?php echo "<span style=color:#44BBFF> ".jdate('Y/m/d',time())."</span>"; ?></p>
    				<p>جمع هزینه قابل پرداخت : <label id="paysjob" style=color:#FC575E>-</label></p>
    				<br>
    				<input type="submit" class="btn btn-success" id="btn-pardakhtjob" name="btn-pardakhtjob" value="پرداخت می کنم" >
<?php
	}
}
?>
    			</div>
			</div>
			</div>
		</div>
	</div>
</section>
<?php
}else if(isset($_GET['mashaqel_id']))
{
?>

<section id="pardakht-m">
	<div class="container">
		<div class="row">
		<div style="margin: 20px 0">
			<div class="panel" style="height: auto;margin: auto;direction: rtl;min-height: 420px;box-shadow: 0px 0px 3px #888888;max-width: 600px">
    			<div class="panel-body text-center" style="margin-top: 20px">
<?php
if(isset($_GET['mashaqel_id'])){
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$Mashaqel_id = check_safe_get($_GET['mashaqel_id']);
	$where = "`_id`=".$Mashaqel_id;
	$resMashaqel = $Mashaqel->ReadMashaqelByID($where);
	foreach($resMashaqel as $rows)
	{						
?>
   					<br>
    				<p>شماره ثبت بنر شغلی : <?php echo "<span style=color:#44BBFF>".$rows['_id']."</span>"; ?></p>
    				<p>عنوان بنر شغلی : <?php echo "<span style=color:#44BBFF>".$rows['_coname']."</span>"; ?></p>
    				<p>ثبت شده توسط : <?php echo "<span style=color:#44BBFF>".$rows['_coAdmin']."</span>"; ?></p>
    				<p>وضعیت بنر شغلی : <?php if($rows['_paystate']==0){echo "<span style=color:#FC575E>در حال حاضر غیر فعال است</span>";}else if($rows['_paystate']==1){echo "<span style=color:#53DF83>در حال حاضر فعال است</span>";}; ?></p>
    				<p>انتخاب نوع ثبت بنر شغلی</p>
    				<select id="payid" class="form-control" style="max-width: 250px">
    					<option>انتخاب کنید...</option>
    					<option value="1">ثبت یک ماهه - 125,000 ریال</option>
    					<option value="2">ثبت سه ماهه - 375,000 ریال</option>
    					<option value="3">ثبت شش ماهه - 750,000 ریال</option>
    					<option value="4">ثبت یک ساله - 1,500,000 ریال</option>
    				</select>
    				<p></p>
    				<p>تاریخ ثبت : <?php echo "<span style=color:#44BBFF> ".jdate('Y/m/d',time())."</span>"; ?></p>
   					<p>جمع هزینه قابل پرداخت : <label id="pays" style=color:#FC575E>-</label></p>
    				<br>
    				<input type="submit" class="btn btn-success" id="btn-pardakhtjob" name="btn-pardakhtjob" value="پرداخت می کنم" >
<?php
	}
}
?>
    			</div>
			</div>
			</div>
		</div>
	</div>
</section>

<?php
}
?>


<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('../inc_theme/jquerylink.php') ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#payidjob").change(function(){
		var SelectPay = $('#payidjob').find(":selected").val();
		if(SelectPay==1){
			$("#paysjob").text("150,000 ریال");
		}else if(SelectPay==2){
			$("#paysjob").text("250,000 ریال");
		}else if(SelectPay==3){
			$("#paysjob").text("400,000 ریال");
		}
	})

})
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#payid").change(function(){
		var SelectPay = $('#payid').find(":selected").val();
		if(SelectPay==1){
			$("#pays").text("125,000 ریال");
		}else if(SelectPay==2){
			$("#pays").text("375,000 ریال");
		}else if(SelectPay==3){
			$("#pays").text("750,000 ریال");
		}else if(SelectPay==4){
			$("#pays").text("1,500,000 ریال");
		}
	})

})
</script>   
  </body>
</html>
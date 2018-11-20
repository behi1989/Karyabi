<?php
ob_start();
session_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/config.php';
function Autoload($className){
	if (file_exists(ROOT . 'inc_func/class.' . $className . '.php')){
		require_once ROOT . 'inc_func/class.' . $className . '.php';
	}
}
spl_autoload_register('Autoload');
require_once ROOT . 'inc_func/jdf.php';
require_once ROOT . 'inc_func/set-config.php';

if(!isset($_SERVER['HTTP_REFERER'])){
	exit('<h3 style=color:blue;text-align:center>چنین صفحه ای وجود ندارد یا دسترسی به آن برای شما مجاز نمی باشد</h3><h4 style=color:blue;text-align:center><a href=./dashboard.php>برگشت به پنل</a></h4>');
}
?>

<?php
if (isset($_SESSION['adminLogin'])){
	if($_SESSION['adminLogin'] != ""){
		$Admin = new Admin();
		$session = $_SESSION['adminLogin'];
		$res = $Admin->SelectLoginAdmin($session);
		foreach($res as $rows){
			$idd = $rows['_id'];
			$level = $rows['_level'];
		}
	}
}
?>

<?php
$status = NULL;
$action = NULL;
$idU = NULL;
if(isset($_GET['status'])){
	$status = $_GET['status'];
}
if(isset($_GET['action'])){
	$action = $_GET['action'];
	$idU = $_GET['id'];
}
		  
if($status == "disp")
{
echo '<table class="table table-hover">';
	echo '<thead style="background: #444;color: #FFF">';
			echo '<th style="text-align: right;width: 150px;padding: 10px">ردیف</th>';
			echo '<th style="text-align: right">عنوان خبر</th>';
			echo '<th style="text-align: right">نویسنده</th>';
			echo '<th style="text-align: right">تاریخ</th>';
			echo '<th style="text-align: right">عملیات</th>';
			echo '</thead>';
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['pagenews'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pagenews'];
	}
	if (isset($_GET['pagenews']) ){
		if($_GET['pagenews'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pagenews'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;	

$i = 1;
$DB = new DB();
$News = new News();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$resA = $News->ReadNewss2($limit);
foreach($resA as $rowsA)
{
	$idA = $rowsA['_id'];
		echo "<tr>";
		echo "<td>";
			echo intval($record_per_page*($page-1))+$i++;
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		echo "<td>"; ?>
			<div id="newstitle<?php echo $rowsA['_id']; ?>"> <?php echo $rowsA['_newsTitle']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="newswritter<?php echo $rowsA['_id']; ?>"> <?php echo $rowsA['_newsWritter']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="newsdate<?php echo $rowsA['_id']; ?>"> <?php echo jdate('y/m/d',$rowsA['_newsAddDate']); ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<input type="button" class="btn btn-info" id="<?php echo $rowsA['_id']; ?>" name="<?php echo $rowsA['_id']; ?>" value="ویرایش" onClick="update1(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rowsA['_id']; ?>" name="<?php echo $rowsA['_id']; ?>" value="حذف" onClick="delete1(this.id)">
		<?php echo "</td>";
		echo "</tr>";		
	}
	echo "</table>";
	$News = new News();
	$resall = $News->ReadNewss();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linknews' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست اخبار و رویداد ها : ".$getpage." از ".$total_pages."</p>";
	
}	
?>


<?php
if($action == "update")
{ 
		$DB = new DB();
		$News = new News();
		$resU = $News->ReadNewsByid($idU);
		foreach($resU as $rowsU)
		{
			$idNU = $rowsU['_id'];
?>	
	<div class="panel panel-default fade in collapse" id="p_closes" style="height: auto;text-align: right;margin-top: 60px">
  	<div class="panel-heading alert-dismissable">
  	ویرایش اخبار
  	<a data-toggle="collapse" href="#p_closes" class="close pull-left" >&times</a>
  	</div>
  	<div class="panel-body">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="upload-target" onsubmit="upload_start();">
	<table class="table table-hover">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
		<div id="resNewsU"></div>
			<tbody dir="rtl">
			
				<input type="hidden" name="idU" id="idU" value="<?php echo ($idNU); ?>" class="form-control">
				<tr>
					<td>عنوان خبر</td>
					<td><input type="text" name="newstitle" value="<?php echo $rowsU['_newsTitle']; ?>" id="newstitle" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن خبر</td>
					<td><textarea name="newsText" id="newsText" class="form-control" style="min-height: 200px"><?php echo $rowsU['_newsText']; ?></textarea>
					</td>
				</tr>
				
				<tr>
					<td>منبع خبر</td>
					<td><input type="text" name="newssource" value="<?php echo $rowsU['_newsSource']; ?>" id="newssource" class="form-control"></td>
				</tr>
				
				<tr>
					<td>نویسنده خبر</td>
					<td><input type="text" name="newswritter" value="<?php echo $rowsU['_newsWritter']; ?>" id="newswritter" class="form-control"></td>
				</tr>
				
				<tr>
					<td>کلیدواژه خبر<p style="color: red">جدا سازی با (ویرگول ،)</p></td>
					<td><input type="text" name="newskey" value="<?php echo $rowsU['_newsKey']; ?>" id="newskey" class="form-control"></td>
				</tr>
				
				<tr>
					<td>انتخاب نوع خبر</td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="newstype" name="newstype">
						<option value="<?php echo $rowsU['_newsType']; ?>"><?php if($rowsU['_newsType']==4){echo "درج شده در اخبار";} else if($rowsU['_newsType']==1){echo "درج شده در رویداد های گیلان"; }else if($rowsU['_newsType']==2){echo "درج شده در رویداد و اسلایدر";}else if($rowsU['_newsType']==3){ echo "درج شده در اخبار و اسلایدر";} ?></option>
						<option value="4">درج در اخبار</option>
						<option value="1">درج در رویداد های گیلان</option>
						<option value="2">درج در رویداد و اسلایدر</option>
						<option value="3">درج در اخبار و اسلایدر</option>
					</select> 
					</span>
					</td>
				</tr>
				
			
				<tr>
					<td>تصویر خبر</td>
					<td>
					<span class="col-md-3 pull-right">
						<img src="../_upload/<?php echo $rowsU['_newsPic']; ?>" id="newsimg" style="width: 200px;height: 200px;">
					</span>
					<span class="col-md-6 pull-right">
						<input name="user-file" id="user-file" type="file" class="btn btn-primary form-control">
					</span>
					
					
					</td>
				</tr>
			
				
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="editNU" name="editNU" class="btn btn-success" value="ویرایش خبر"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="upload-form"></div>
		<iframe id="upload-target" name="upload-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
		</div>
		</div>
<?php

		}
	}				
?>

<?php
$statuss = NULL;
$actionadv = NULL;
$idadv = NULL;
if(isset($_GET['statuss'])){
	$statuss = $_GET['statuss'];
}
if(isset($_GET['actionadv'])){
	$actionadv = $_GET['actionadv'];
	$idadv = $_GET['id'];
}
if($statuss == "dissp")
{
echo '<table class="table table-hover">';
	echo '<thead style="background: #444;color: #FFF">';
			echo '<th style="text-align: right">Id مشتری</th>';
			echo '<th style="text-align: right">نام مشتری</th>';
			echo '<th style="text-align: right">شماره تماس</th>';
			echo '<th style="text-align: right">آدرس مشتری</th>';
			echo '<th style="text-align: right">تاریخ</th>';
			echo '<th style="text-align: right">ساعت</th>';
			echo '<th style="text-align: right">وضعیت</th>';
			echo '<th style="text-align: right">رسید پرداخت</th>';
			echo '<th style="text-align: right">بانک</th>';
			echo '<th style="text-align: right">محل تبلیغ</th>';
			echo '<th style="text-align: right">عملیات</th>';
			echo '</thead>';
	
$record_per_page = 10;
$page = null;
$output = '';
if($_GET['pageadvs'] == "undefined"){
	$getpage = 1;
}else{
	$getpage = $_GET['pageadvs'];
}
if (isset($_GET['pageadvs']) ){
	if($_GET['pageadvs'] == "undefined"){
		$page = 1;
	}else{
		$page = $_GET['pageadvs'];	
	}
}else{
	$page = 1;
}
	
	$start_from = ($page - 1) * $record_per_page;

$DB = new DB();
$Adv = new Adv();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$resAdv = $Adv->ReadAdv2($limit);
foreach($resAdv as $rowsAdv)
{
	$idAdv = $rowsAdv['_id'];
		echo "<tr>";
		echo "<td style='display:none'>"; 
			echo $rowsAdv['_id']; 
		echo "</td>";
		echo "<td>"; ?>
			<div id="customerId<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advCustomerID']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="customername<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advCustomerName']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="customertel<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advCustomerTel']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="customeraddress<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advCustomerAddress']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="advdate<?php echo $rowsAdv['_id']; ?>"> <?php echo jdate('y/m/d',$rowsAdv['_advAddDate']); ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="advtime<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advAddTime']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="advpaystate<?php echo $rowsAdv['_id']; ?>"> <?php if($rowsAdv['_advPayState'] == 0){echo "<p style=color:green>پرداخت شده</p>";}else if($rowsAdv['_advPayState'] == 1){echo "<p style=color:red>پرداخت نشده</p>";} ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="advrecivepay<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advRecivePay']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="advrecivebank<?php echo $rowsAdv['_id']; ?>"> <?php echo $rowsAdv['_advRecivebank']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="advplace<?php echo $rowsAdv['_id']; ?>"> <?php if($rowsAdv['_advType'] == 0){echo "صفحه اصلی";}else if($rowsAdv['_advType'] == 1){echo "صفحه کاریابی";}else if($rowsAdv['_advType'] == 2){echo "صفحه اخبار";} else if($rowsAdv['_advType'] == 3){echo "سایر صفحات";} ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<input type="button" class="btn btn-info" id="<?php echo $rowsAdv['_id']; ?>" name="<?php echo $rowsAdv['_id']; ?>" value="ویرایش" onClick="updateadv(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rowsAdv['_id']; ?>" name="<?php echo $rowsAdv['_id']; ?>" value="حذف" onClick="deleteadv(this.id)">
		<?php echo "</td>";
		echo "</tr>";		
	
	}
	echo "</table>";
	
	$DB = new DB();
	$Adv = new Adv();
	$resall = $Adv->ReadAdv();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkadv' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست تبلیغات : ".$getpage." از ".$total_pages."</p>";
}	
?>

<?php
if($actionadv == "updateadv")
{ 
		$DB = new DB();
		$Adv = new Adv();
		$advwhere = "`_id`=".$idadv;
		$resUAdv = $Adv->ReadAdvByID($advwhere);
		foreach($resUAdv as $rowsUAdv)
		{
			$idNAdv = $rowsUAdv['_id'];
?>	
	
	<div class="panel panel-default fade in collapse" id="p_closes" style="height: auto;text-align: right;margin-top: 60px">
  	<div class="panel-heading alert-dismissable">
  	ویرایش تبلیغات
  	<a data-toggle="collapse" href="#p_closes" class="close pull-left" >&times</a>
  	</div>
  	<div class="panel-body">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="adv-target" onsubmit="update_adv();">
	<table class="table table-hover">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
		<div id="resNewsU"></div>
			<tbody dir="rtl">
			
				<input type="hidden" name="idNAdv" id="idNAdv" value="<?php echo ($idNAdv); ?>" class="form-control">
				<tr>
					<td>Id مشتری</td>
					<td><input type="text" name="customId" value="<?php echo $rowsUAdv['_advCustomerID']; ?>" id="customId" disabled class="form-control"></td>
				</tr>
				
				<tr>
					<td>نام مشتری</td>
					<td><input type="text" name="customname" id="customname" value="<?php echo $rowsUAdv['_advCustomerName']; ?>" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>شماره تماس</td>
					<td><input type="text" name="customtel" value="<?php echo $rowsUAdv['_advCustomerTel']; ?>" id="customtel" class="form-control"></td>
				</tr>
				
				<tr>
					<td>آدرس مشتری</td>
					<td><input type="text" name="customaddress" value="<?php echo $rowsUAdv['_advCustomerAddress']; ?>" id="customaddress" class="form-control"></td>
				</tr>
				
				<tr>
					<td>وضعیت پرداخت</td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="customtype" name="customtype">
						<option value="<?php echo $rowsUAdv['_advPayState']; ?>"><?php if($rowsUAdv['_advPayState']==0){echo "پرداخت شده";} else if($rowsUAdv['_advPayState']==1){echo "پرداخت نشده";} ?></option>
						<option value="0">پرداخت شده</option>
						<option value="1">پرداخت نشده</option>
					</select> 
					</span>
					</td>
				</tr>
				
				<tr>
					<td>رسید پرداخت</td>
					<td><input type="text" name="advrecivepays" value="<?php echo $rowsUAdv['_advRecivePay']; ?>" id="advrecivepays" class="form-control"></td>
				</tr>
				
				<tr>
					<td>بانک</td>
					<td><input type="text" name="advpaybanks" value="<?php echo $rowsUAdv['_advRecivebank']; ?>" id="advpaybanks" class="form-control"></td>
				</tr>
				
				<tr>
					<td>محل نمایش تبلیغ</td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="advplaces" name="advplaces">
						<option value="<?php echo $rowsUAdv['_advType']; ?>"><?php if($rowsUAdv['_advType']==0){echo "صفحه اصلی";} else if($rowsUAdv['_advType']==1){echo "صفحه کاریابی";} else if($rowsUAdv['_advType']==2){echo "صفحه اخبار";} else if($rowsUAdv['_advType']==3){echo "سایر صفحات";} ?></option>
						<option value="0">صفحه اصلی</option>
						<option value="1">صفحه کاریابی</option>
						<option value="2">صفحه اخبار</option>
						<option value="3">سایر صفحات</option>
					</select> 
					</span>
					</td>
				</tr>
			
				<tr>
					<td>تصویر تبلیغ</td>
					<td>
					<span class="col-md-3 pull-right">
						<img src="<?php
						if($rowsUAdv['_advType']==0){echo "../_upload/adv/main/".$rowsUAdv['_advPic'];
						}else if($rowsUAdv['_advType']==1){echo "../_upload/adv/ads/".$rowsUAdv['_advPic'];
						}else if($rowsUAdv['_advType']==2){echo "../_upload/adv/news/".$rowsUAdv['_advPic'];
						}else if($rowsUAdv['_advType']==3){echo "../_upload/adv/other/".$rowsUAdv['_advPic'];}?> " id="advimgs" style="width: 200px;height: 200px;">
					</span>
					<span class="col-md-6 pull-right">
						<input name="adv-file" id="adv-file" type="file" class="btn btn-primary form-control">
					</span>
					
					
					</td>
				</tr>
			
				
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="editadv" name="editadv" class="btn btn-success" value="ویرایش تبلیغ"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="adv-update"></div>
		<iframe id="adv-target" name="adv-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
		</div>
	</div>
<?php

		}
	}				
?>



<?php

$statusu = NULL;;
if(isset($_GET['statusu'])){
	$statusu = $_GET['statusu'];
}
if($statusu == "dispu"){

	echo "<table class='table table-hover'>";
	echo "<thead style='background: #444;color: #FFF;direction: rtl'>";
	echo "<tr>";
	echo "<th style='text-align: right'>ردیف</th>";
	echo "<th style='text-align: right'>شناسه آگهی</th>";
	echo "<th style='text-align: right'>عنوان آگهی</th>";
	echo "<th style='text-align: right'>درخواست دهنده</th>";
	echo "<th style='text-align: right'>شماره تماس</th>";
	echo "<th style='text-align: right'>تاریخ درج آگهی</th>";
	echo "<th style='text-align: right'>وضعیت</th>";
	echo "<th style='text-align: right'>آگهی ویژه</th>";
	echo "<th style='text-align: right'>عملیات</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<div id='resedel'></div>";
	echo "<tbody style='direction: rtl'>";
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['pagejob'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pagejob'];
	}
	if (isset($_GET['pagejob']) ){
		if($_GET['pagejob'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pagejob'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	
	$i = 1;
	$DB = new DB();
	$ViewAD = new ViewAD();
	$limit = "LIMIT ".$start_from.",".$record_per_page;
	$res = $ViewAD->ReadAds2($limit);
	foreach($res as $rows){
		echo "<tr>";
		echo "<td>"; 
			echo intval($record_per_page*($page-1))+$i++;
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcoid<?php echo $rows['_id']; ?>"> <?php echo "<p style='color:orange'>".$rows['_id']."</p>"; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="jobtitle<?php echo $rows['_id']; ?>"> <?php echo $rows['_jobTitle']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="jobconamecc<?php echo $rows['_id']; ?>"> <?php echo $rows['_bossName']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="jobtelcc<?php echo $rows['_id']; ?>"> <?php echo $rows['_coTel']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="date<?php echo $rows['_id']; ?>"> <?php echo jdate('y/m/d',$rows['_addDate']); ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="jobstate<?php echo $rows['_id']; ?>"> <?php if($rows['_advTaeed']==0){echo "<p style=color:red>تایید نشده</p>";} else if($rows['_advTaeed']==1){echo "<p style=color:green>تایید شده</p>";} ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="jobvije<?php echo $rows['_id']; ?>"> <?php if($rows['_advType']==0){echo "<p style=color:red>-</p>";} else if($rows['_advType']==1){echo "<p style=color:green>ویژه</p>";} ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<input type="button" class="btn btn-info" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="ویرایش" onClick="updateadvu(this.id)">
		<?php if($rows['_advTaeed']==0){?>
			<input type="button" class="btn btn-success" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="تایید" onClick="taeedadvu(this.id)">
		<?php }else if($rows['_advTaeed']==1){ ?>
			<input type="button" class="btn btn-warning" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="تعلیق" onClick="taliqdvu(this.id)">
		<?php } ?>
			<input type="button" class="btn btn-warning" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="ویژه" onClick="vijehadvu(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deleteadvu(this.id)">
		<?php echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	
	
	$ViewAD = new ViewAD();
	$resall = $ViewAD->ReadAds();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkjob' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست آگهي : ".$getpage." از ".$total_pages."</p>";
	
}
?>										
		
	
	


<?php
$actionu = NULL;
$idadvu = NULL;
if(isset($_GET['actionu'])){
	$actionu = $_GET['actionu'];
	$idadvu = $_GET['id'];
}
if($actionu == "updateu")
{
		$DB = new DB();
		$ViewAD = new ViewAD();
		$ressu = $ViewAD->ReadAdds($idadvu);
		foreach($ressu as $rows)
		{ 
?>	
	
	<div class="panel panel-default fade in collapse" id="p_close" style="height: auto;text-align: right;margin-top: 60px">
  	<div class="panel-heading alert-dismissable">
  	ویرایش آگهی
  	<a data-toggle="collapse" href="#p_close" class="close pull-left" >&times</a>
  	</div>
  	<div class="panel-body">
	<table class="table table-hover" style="direction: rtl">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
			<tbody dir="rtl">
				<input type="hidden" name="uuid" id="uuid" value="<?php echo ($idadvu); ?>" class="form-control">
				<tr>
					<td>عنوان آگهی</td>
					<td><input type="text" name="titleu" value="<?php echo $rows['_jobTitle'] ?>" id="titleu" class="form-control"></td>
				</tr>
				<tr>
					<td>نام شرکت</td>
					<td><input type="text" name="conameu" value="<?php echo $rows['_coName'] ?>" id="conameu" class="form-control"></td>
				</tr>
				<tr>
					<td>نام درخواست دهنده</td>
					<td><input type="text" name="bossnameu" value="<?php echo $rows['_bossName'] ?>" id="bossnameu" class="form-control"></td>
				</tr>
				<tr>
					<td>آدرس شرکت</td>
					<td><input type="text" name="coAddressu" value="<?php echo $rows['_coAddress'] ?>" id="coAddressu" class="form-control"></td>
				</tr>
				<tr>
					<td>تلفن</td>
					<td><input type="text" name="telu" value="<?php echo $rows['_coTel'] ?>" id="telu" class="form-control"></td>
				</tr>
				<tr>
					<td>موبایل</td>
					<td><input type="text" name="mobileu" value="<?php echo $rows['_mobile'] ?>" id="mobileu" class="form-control"></td>
				</tr>
				<tr>
					<td>ایمیل</td>
					<td><input type="text" name="emailu" value="<?php echo $rows['_coEmail'] ?>" id="emailu" class="form-control"></td>
				</tr>
				<tr>
					<td>وب سایت</td>
					<td><input type="text" name="webu" value="<?php echo $rows['_coWeb'] ?>" id="webu" class="form-control"></td>
				</tr>
				<tr>
					<td>شغل درخواستی</td>
					<td><input type="text" name="jobrequ" value="<?php echo $rows['_jobReq'] ?>" id="jobrequ" class="form-control"></td>
				</tr>
				<tr>
					<td>تحصیلات</td>
					<td><input type="text" name="eduu" value="<?php echo $rows['_edu'] ?>" id="eduu" class="form-control"></td>
				</tr>
				<tr>
					<td>رشته تحصیلی</td>
					<td><input type="text" name="degreeu" value="<?php echo $rows['_degree'] ?>" id="degreeu" class="form-control"></td>
				</tr>
				<tr>
					<td>گرایش</td>
					<td><input type="text" name="sienceu" value="<?php echo $rows['_sience'] ?>" id="sienceu" class="form-control"></td>
				</tr>
				<tr>
					<td>تعداد نیرو</td>
					<td><input type="text" name="reqnou" value="<?php echo $rows['_reqNo'] ?>" id="reqnou" class="form-control"></td>
				</tr>
				<tr>
					<td>تخصص</td>
					<td><input type="text" name="exportu" value="<?php echo $rows['_export'] ?>" id="exportu" class="form-control"></td>
				</tr>
				<tr>
					<td>جنسیت</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="genderu" id="genderu" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
						<option value="<?php echo $rows['_gender'] ?>"><?php if($rows['_gender']==0){echo '';} else {echo $ViewAD->gender($rows['_gender']);} ?></option>
						<option value="1">مرد</option>
						<option value="2">زن</option>
						<option value="3">مرد یا زن</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>سن مورد نیاز</td>
					<td><input type="text" name="ageu" value="<?php echo $rows['_age'] ?>" id="ageu" class="form-control"></td>
				</tr>
				<tr>
					<td>تاهل</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="marriedu" id="marriedu" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
						<option value="<?php echo $rows['_married'] ?>"><?php if($rows['_married']==0){echo '';} else {echo $ViewAD->married($rows['_married']);} ?></option>
						<option value="1">مجرد</option>
						<option value="2">متاهل</option>
						<option value="3">فرقی نمی کند</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>وضعیت بیمه</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="bimeu" id="bimeu" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
						<option value="<?php echo $rows['_bime'] ?>"><?php if($rows['_bime']==0){echo '';} else {echo $ViewAD->bime($rows['_bime']);} ?></option>
						<option value="1">دارد</option>
						<option value="2">ندارد</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>وضعیت نظام وظیفه</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="khedmatu" id="khedmatu" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
						<option value="<?php echo $rows['_khedmat'] ?>"><?php if($rows['_khedmat']==0){echo '';} else {echo $ViewAD->khedmat($rows['_khedmat']);} ?></option>
						<option value="1">پایان خدمت</option>
						<option value="2">معاف</option>
						<option value="3">در حال خدمت</option>
						<option value="4">معاف تحصیلی</option>
						<option value="5">نیاز نیست</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>ایاب و ذهاب</td>
					<td><input type="text" name="ayabzahabu" value="<?php echo $rows['_ayabzahab'] ?>" id="ayabzahabu" class="form-control"></td>
				</tr>
				<tr>
					<td>زمان کار</td>
					<td><input type="text" name="worktimeu" value="<?php echo $rows['_workTime'] ?>" id="worktimeu" class="form-control"></td>
				</tr>
				<tr>
					<td>حقوق پرداختی</td>
					<td><input type="text" name="workpayu" value="<?php echo $rows['_workPay'] ?>" id="workpayu" class="form-control"></td>
				</tr>
				<tr>
					<td>شهر محل کار</td>
					<td><input type="text" name="workcityu" value="<?php echo $rows['_workCity'] ?>" id="workcityu" class="form-control"></td>
				</tr>
				<tr>
					<td>توضیحات</td>
					<td><input type="text" name="expalinu" value="<?php echo $rows['_explain'] ?>" id="expalinu" class="form-control"></td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align: left">
						<button type="submit" id="<?php echo $idadvu; ?>" name="editad" onClick="updateuv(this.id)" class="btn btn-success"><i class="fa fa-refresh"></i>&nbsp; ویرایش آگهی</button>
					</td>
				</tr>	
							
<?php
		}
	echo "</tbody>";
	echo "</table>";
	echo "<div id='uresedu'></div>";
	echo "</div>";
	echo "</div>";
	}				
?>

	
<?php

$statusM = NULL;;
if(isset($_GET['statusM'])){
	$statusM = $_GET['statusM'];
}
if($statusM == "dispM"){

	echo "<table class='table table-hover' style='direction: rtl'>";
	echo "<thead style='background: #444;color: #FFF;direction: rtl'>";
	echo "<tr>";
	echo "<th style='text-align: right'>ردیف</th>";
	echo "<th style='text-align: right'>شناسه بنر</th>";
	echo "<th style='text-align: right'>نام شرکت</th>";
	echo "<th style='text-align: right'>درخواست دهنده</th>";
	echo "<th style='text-align: right'>شماره تماس</th>";
	echo "<th style='text-align: right'>آدرس</th>";
	echo "<th style='text-align: right'>وضعیت</th>";
	echo "<th style='text-align: right'>وضعیت پرداخت</th>";
	echo "<th style='text-align: right'>تاریخ ثبت</th>";
	echo "<th style='text-align: right'>عملیات</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<div id='resMdel'></div>";
	echo "<tbody style='direction: rtl'>";
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['pagemashaqel'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pagemashaqel'];
	}
	if (isset($_GET['pagemashaqel']) ){
		if($_GET['pagemashaqel'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pagemashaqel'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	
	$i = 1;
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$limit = "LIMIT ".$start_from.",".$record_per_page;
	$resM = $Mashaqel->ReadMashaqel2($limit);
	foreach($resM as $rows){
		echo "<tr>";
		echo "<td>"; 
			echo intval($record_per_page*($page-1))+$i++;
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcoid<?php echo $rows['_id']; ?>"> <?php echo "<p style='color:orange'>".$rows['_id']."</p>"; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mconame<?php echo $rows['_id']; ?>"> <?php echo $rows['_coname']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcoadmin<?php echo $rows['_id']; ?>"> <?php echo $rows['_coAdmin']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcotel<?php echo $rows['_id']; ?>"> <?php echo $rows['_coTel']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcoaddress<?php echo $rows['_id']; ?>"> <?php echo $rows['_coAddress']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcopaystate<?php echo $rows['_id']; ?>"><?php if($rows['_taeed']==0){echo "<p style='color:red'>تایید نشده</p>";}else if($rows['_taeed']==1){echo "<p style='color:green'>تایید شده</p>";} ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcopaystate<?php echo $rows['_id']; ?>"><?php if($rows['_paystate'] == 0){echo "<p style='color:green'>پرداخت شده</p>";}else if($rows['_paystate'] == 1){echo "<p style='color:red'>پرداخت نشده</p>";} ?></div>
		<?php echo "</td>";
		echo "<td>"; ?>
			<div id="Mdate<?php echo $rows['_id']; ?>"> <?php echo jdate('y/m/d',$rows['_Cdate']); ?></div>
		<?php echo "</td>";
		echo "<td>"; ?>
		<?php if($rows['_taeed']==0){?>
			<input type="button" class="btn btn-success" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="تایید" onClick="taeedM(this.id)">
		<?php }else if ($rows['_taeed']==1){ ?>
			<input type="button" class="btn btn-warning" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="تعلیق" onClick="taliqM(this.id)">
		<?php } ?>
			
			<input type="button" class="btn btn-info" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="ویرایش" onClick="updateM(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deleteM(this.id)">
		<?php echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	
	$Mashaqel = new Mashaqel();
	$resall = $Mashaqel->ReadMashaqel();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkmashaqel' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست مشاغل : ".$getpage." از ".$total_pages."</p>";
	
}
?>										
		
	
	

<?php
$actionM = NULL;
if(isset($_GET['actionM'])){
	$actionM = $_GET['actionM'];
	$idM = $_GET['id'];
}
if($actionM == "updateM")
{ 
		$DB = new DB();
		$Mashaqel = new Mashaqel();
		$Mwhere = "`_id`=".$idM;
		$resUM = $Mashaqel->ReadMashaqelByID($Mwhere);
		foreach($resUM as $rowsUM)
		{
			$idMco = $rowsUM['_id'];
?>	
	
	<div class="panel panel-default fade in collapse" id="p_close" style="height: auto;text-align: right;margin-top: 60px">
  	<div class="panel-heading alert-dismissable">
  	ویرایش مشاغل
  	<a data-toggle="collapse" href="#p_close" class="close pull-left" >&times</a>
  	</div>
  	<div class="panel-body">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="Mashqelum-target" onsubmit="update_Mu();">
	<table class="table table-hover">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
		<div id="resMU"></div>
			<tbody dir="rtl">
			
				<input type="hidden" name="idMM" id="idMM" value="<?php echo ($idMco); ?>" class="form-control">
				<tr>
					<td>نام شرکت</td>
					<td><input type="text" name="Mconames" value="<?php echo $rowsUM['_coname']; ?>" id="Mconames" class="form-control"></td>
				</tr>
				
				<tr>
					<td>مدیر شرکت</td>
					<td><input type="text" name="Mcoadmins" id="Mcoadmins" value="<?php echo $rowsUM['_coAdmin']; ?>" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>شماره تماس</td>
					<td><input type="text" name="Mcotels" value="<?php echo $rowsUM['_coTel']; ?>" id="Mcotels" class="form-control"></td>
				</tr>
				
				<tr>
					<td>آدرس درخواست دهنده</td>
					<td><input type="text" name="Mcoadres" value="<?php echo $rowsUM['_coAddress']; ?>" id="Mcoadres" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن اول</td>
					<td><input type="text" name="Mtxts1" value="<?php echo $rowsUM['_txt1']; ?>" id="Mtxts1" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن دوم</td>
					<td><input type="text" name="Mtxts2" value="<?php echo $rowsUM['_txt2']; ?>" id="Mtxts2" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن سوم</td>
					<td><input type="text" name="Mtxts3" value="<?php echo $rowsUM['_txt3']; ?>" id="Mtxts3" class="form-control"></td>
				</tr>
				
				<tr>
					<td>توضیحات</td>
					<td><input type="text" name="Mexplains" value="<?php echo $rowsUM['_explain']; ?>" id="Mexplains" class="form-control"></td>
				</tr>
				
				<tr>
					<td>وضعیت پرداخت</td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="Mpaystates" name="Mpaystates">
						<option value="<?php echo $rowsUM['_paystate']; ?>"><?php if($rowsUM['_paystate']==0){echo "پرداخت شده";} else if($rowsUM['_paystate']==1){echo "پرداخت نشده";} ?></option>
						<option value="0">پرداخت شده</option>
						<option value="1">پرداخت نشده</option>
					</select> 
					</span>
					</td>
				</tr>
				
				<tr>
					<td>رسید پرداخت</td>
					<td><input type="text" name="Mrecivepays" value="<?php echo $rowsUM['_recivepay']; ?>" id="Mrecivepays" class="form-control"></td>
				</tr>
				
				<tr>
					<td>پرداخت در بانک</td>
					<td><input type="text" name="Mrecivebanks" value="<?php echo $rowsUM['_recivebank']; ?>" id="Mrecivebanks" class="form-control"></td>
				</tr>
			
				<tr>
					<td>تصویر اصلی</td>
					<td>
					<span class="col-md-3 pull-right">
						<img src="../_upload/mashaqel/<?php echo $rowsUM['_coImage']; ?>" id="Mimg1" style="width: 200px;height: 200px;">
					</span>
					<span class="col-md-6 pull-right">
						<input name="Mashqelu-file" id="Mashqelu-file" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
				
				<tr>
					<td>تصویر بنر</td>
					<td>
					<span class="col-md-3 pull-right">
					<?php
						if(!empty($rowsUM['_imgmore1'])){
							echo '<img src="../_upload/mashaqel/'.$rowsUM['_imgmore1'].'" id="Mimg2" style="width: 200px;height: 200px;">';	
						}else{
							echo '<img src="../img/empty.png" id="Mimg2" style="width: 200px;height: 200px;">';
						}
					?>
					</span>
					<span class="col-md-6 pull-right">
						<input name="Mashqelu1-file" id="Mashqelu1-file" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="editM" name="editM" class="btn btn-success" value="ویرایش مشاغل"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="Mashaqelus-update"></div>
		<iframe id="Mashqelum-target" name="Mashqelum-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
		</div>
		</div>
<?php

		}
	}				
?>


<?php
$statusticket = NULL;
if(isset($_GET['statusticket'])){
	$statusticket = $_GET['statusticket'];
}
if($statusticket == "dispticket")
{
echo '<table class="table table-hover">';
	echo '<thead style="background: #444;color: #FFF">';
		echo '<th style="text-align: right">ردیف</th>';
		echo '<th style="text-align: right">عنوان تیکت</th>';
		echo '<th style="text-align: right">نام فرستنده</th>';
		echo '<th style="text-align: right">ایمیل فرستنده</th>';
		echo '<th style="text-align: right">شماره تماس</th>';
		echo '<th style="text-align: right">تاریخ ارسال</th>';
		echo '<th style="text-align: right">وضعیت تیکت</th>';
		echo '<th style="text-align: right">عملیات</th>';
	echo '</thead>';
	echo '<tbody>';

	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['paget1'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['paget1'];
	}
	if (isset($_GET['paget1']) ){
		if($_GET['paget1'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['paget1'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	
$i = 1;
$DB = new DB();
$Contactus = new Contactus();
$limit = "LIMIT ".$start_from.",".$record_per_page;	
$restiket = $Contactus->ReadTicketManager2($limit);
foreach($restiket as $rows)
{
		echo "<tr>";
		echo "<td>";
			echo intval($record_per_page*($page-1))+$i++;
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		echo "<td>"; ?>
			<div id="tikettitle<?php echo $rows['_id']; ?>"> <?php echo $rows['_title']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketname<?php echo $rows['_id']; ?>"> <?php echo $rows['_name']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="ticketemail<?php echo $rows['_id']; ?>"> <?php echo $rows['_email']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketmobile<?php echo $rows['_id']; ?>"> <?php echo $rows['_mobile']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="tiketdate<?php echo $rows['_id']; ?>"> <?php echo jdate('y/m/d',$rows['_cDate']); ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketstutus<?php echo $rows['_id']; ?>"> <?php if($rows['_stutus']==0){echo '<p style=color:red>خوانده نشده</p>';} else if($rows['_stutus']==1){echo '<p style=color:green>پاسخ داده شده</p>';} ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<input type="button" class="btn btn-success" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="پاسخ" onClick="answer(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deletet(this.id)">
		<?php echo "</td>";
		echo "</tr>";		
	}
		echo '</tbody>';
	echo '</table>';
	
	$Contactus = new Contactus();
	$resall = $Contactus->ReadTicketManager();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkt1' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست پیام ها : ".$getpage." از ".$total_pages."</p>";
}
?>




<?php
$statustickets = NULL;
if(isset($_GET['statustickets'])){
	$statustickets = $_GET['statustickets'];
}
if($statustickets == "disptickets")
{
echo '<table class="table table-hover">';
	echo '<thead style="background: #444;color: #FFF">';
		echo '<th style="text-align: right">ردیف</th>';
		echo '<th style="text-align: right">عنوان تیکت</th>';
		echo '<th style="text-align: right">نام فرستنده</th>';
		echo '<th style="text-align: right">ایمیل فرستنده</th>';
		echo '<th style="text-align: right">شماره تماس</th>';
		echo '<th style="text-align: right">تاریخ ارسال</th>';
		echo '<th style="text-align: right">وضعیت تیکت</th>';
		echo '<th style="text-align: right">عملیات</th>';
	echo '</thead>';
	echo '<tbody>';
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['paget2'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['paget2'];
	}
	if (isset($_GET['paget2']) ){
		if($_GET['paget2'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['paget2'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;

$i = 1;
$DB = new DB();
$Contactus = new Contactus();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$restikets = $Contactus->ReadTicketSupport2($limit);
foreach($restikets as $rows)
{
		echo "<tr>";
		echo "<td>"; 
			echo intval($record_per_page*($page-1))+$i++; 
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		echo "<td>"; ?>
			<div id="tikettitle<?php echo $rows['_id']; ?>"> <?php echo $rows['_title']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketname<?php echo $rows['_id']; ?>"> <?php echo $rows['_name']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="ticketemail<?php echo $rows['_id']; ?>"> <?php echo $rows['_email']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketmobile<?php echo $rows['_id']; ?>"> <?php echo $rows['_mobile']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="tiketdate<?php echo $rows['_id']; ?>"> <?php echo jdate('y/m/d',$rows['_cDate']); ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketstutus<?php echo $rows['_id']; ?>"> <?php if($rows['_stutus']==0){echo '<p style=color:red>خوانده نشده</p>';} else if($rows['_stutus']==1){echo '<p style=color:green>پاسخ داده شده</p>';} ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<input type="button" class="btn btn-success" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="پاسخ" onClick="answers(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deletets(this.id)">
		<?php echo "</td>";
		echo "</tr>";		
	}
		echo '</tbody>';
	echo '</table>';
	
	$Contactus = new Contactus();
	$resall = $Contactus->ReadTicketSupport();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkt2' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست پیام ها : ".$getpage." از ".$total_pages."</p>";
}	
?>




<?php
$statusticketa = NULL;
if(isset($_GET['statusticketa'])){
	$statusticketa = $_GET['statusticketa'];
}
if($statusticketa == "dispticketa")
{
echo '<table class="table table-hover">';
	echo '<thead style="background: #444;color: #FFF">';
		echo '<th style="text-align: right">ردیف</th>';
		echo '<th style="text-align: right">عنوان تیکت</th>';
		echo '<th style="text-align: right">نام فرستنده</th>';
		echo '<th style="text-align: right">ایمیل فرستنده</th>';
		echo '<th style="text-align: right">شماره تماس</th>';
		echo '<th style="text-align: right">تاریخ ارسال</th>';
		echo '<th style="text-align: right">وضعیت تیکت</th>';
		echo '<th style="text-align: right">عملیات</th>';
	echo '</thead>';
	echo '<tbody>';

	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['paget2'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['paget2'];
	}
	if (isset($_GET['paget2']) ){
		if($_GET['paget2'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['paget2'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	
$i = 1;
$DB = new DB();
$Contactus = new Contactus();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$restikets = $Contactus->ReadTicketAds2($limit);
foreach($restikets as $rows)
{
		echo "<tr>";
		echo "<td>"; 
			echo intval($record_per_page*($page-1))+$i++; 
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		echo "<td>"; ?>
			<div id="tikettitle<?php echo $rows['_id']; ?>"> <?php echo $rows['_title']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="ticketname<?php echo $rows['_id']; ?>"> <?php echo $rows['_name']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="ticketemail<?php echo $rows['_id']; ?>"> <?php echo $rows['_email']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketmobile<?php echo $rows['_id']; ?>"> <?php echo $rows['_mobile']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="tiketdate<?php echo $rows['_id']; ?>"> <?php echo jdate('y/m/d',$rows['_cDate']); ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="ticketstutus<?php echo $rows['_id']; ?>"> <?php if($rows['_stutus']==0){echo '<p style=color:red>خوانده نشده</p>';} else if($rows['_stutus']==1){echo '<p style=color:green>پاسخ داده شده</p>';} ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<input type="button" class="btn btn-success" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="پاسخ" onClick="answera(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deleteta(this.id)">
		<?php echo "</td>";
		echo "</tr>";		
	}
		echo '</tbody>';
	echo '</table>';
	$Contactus = new Contactus();
	$resall = $Contactus->ReadTicketAds();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkt3' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست پیام ها : ".$getpage." از ".$total_pages."</p>";
}	
?>

<?php
$statusmodal = NULL;
if(isset($_GET['statusmodal'])){
	$statusmodal = $_GET['statusmodal'];

$idmodal = NULL;
if($statusmodal == "dispmodal")
{
if(isset($_GET['idmodal'])){
$idmodal = $_GET['idmodal'];
}
$DB = new DB();
$Contactus = new Contactus();
$restiketsid = $Contactus->ReadTicketById($idmodal);
foreach($restiketsid as $rows)
{

		echo '<div class="modal-dialog" style="direction: rtl;text-align: right;max-width: 500px;">';
     		echo '<div class="modal-content ss1">';
                echo '<div class="modal-header">';
                     echo '<button type="button" class="close pull-left" data-dismiss="modal">&times;</button>';
                     echo '<h4 style="color: #2CC990">فرم پاسخ به پیام</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
					echo '<div class="form-group">';
					   echo '<label style="color:blue">نام فرستنده : '.$rows["_name"].'</label>';
					echo '</div>';
					echo '<div class="form-group">';
					   echo '<label style="color:blue">تاریخ ارسال : '.jdate('y/m/d',$rows["_cDate"]).'</label>';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<label>متن پیام</label>';
						echo '<textarea class="form-control" id="usrpm" name="usrpm" style="min-height: 100px">'.$rows["_text"].'</textarea>';
					echo '</div>';
               		echo '<div class="form-group">';
						echo '<label>پاسخ پیام</label>';
						echo '<textarea class="form-control" id="adminpm" name="adminpm" style="min-height: 100px">'.$rows["_adminAnswer"].'</textarea>';
					echo '</div>';
               echo '<input type="button" class="btn btn-info" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="ارسال پاسخ" onClick="updAd(this.id)">';
      		echo '</div> ';
		echo '</div>';
}
}
}
?>


<?php
$statusmodals = NULL;
if(isset($_GET['statusmodals'])){
	$statusmodals = $_GET['statusmodals'];

$idmodals = NULL;
if($statusmodals == "dispmodals")
{
if(isset($_GET['idmodals'])){
$idmodals = $_GET['idmodals'];
}
$DB = new DB();
$Contactus = new Contactus();
$restiketsids = $Contactus->ReadTicketById($idmodals);
foreach($restiketsids as $rows)
{

		echo '<div class="modal-dialog" style="direction: rtl;text-align: right;max-width: 500px;">';
     		echo '<div class="modal-content ss1">';
                echo '<div class="modal-header">';
                     echo '<button type="button" class="close pull-left" data-dismiss="modal">&times;</button>';
                     echo '<h4 style="color: #2CC990">فرم پاسخ به پیام</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
					echo '<div class="form-group">';
					   echo '<label style="color:blue">نام فرستنده : '.$rows["_name"].'</label>';
					echo '</div>';
					echo '<div class="form-group">';
					   echo '<label style="color:blue">تاریخ ارسال : '.jdate('y/m/d',$rows["_cDate"]).'</label>';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<label>متن پیام</label>';
						echo '<textarea class="form-control" id="usrpm2" name="usrpm2" style="min-height: 100px">'.$rows["_text"].'</textarea>';
					echo '</div>';
               		echo '<div class="form-group">';
						echo '<label>پاسخ پیام</label>';
						echo '<textarea class="form-control" id="adminpm2" name="adminpm2" style="min-height: 100px">'.$rows["_adminAnswer"].'</textarea>';
					echo '</div>';
               echo '<input type="button" class="btn btn-info" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="ارسال پاسخ" onClick="updS(this.id)">';
                echo '</div>';
      		echo '</div> ';
		echo '</div>';
}
}
}
?>


<?php
$statusmodall = NULL;
if(isset($_GET['statusmodall'])){
	$statusmodall = $_GET['statusmodall'];

$idmodall = NULL;
if($statusmodall == "dispmodall")
{
if(isset($_GET['idmodall'])){
$idmodall = $_GET['idmodall'];
}
$DB = new DB();
$Contactus = new Contactus();
$restiketsidl = $Contactus->ReadTicketById($idmodall);
foreach($restiketsidl as $rows)
{

		echo '<div class="modal-dialog" style="direction: rtl;text-align: right;max-width: 500px;">';
     		echo '<div class="modal-content ss1">';
                echo '<div class="modal-header">';
                     echo '<button type="button" class="close pull-left" data-dismiss="modal">&times;</button>';
                     echo '<h4 style="color: #2CC990">فرم پاسخ به پیام</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
					echo '<div class="form-group">';
					   echo '<label style="color:blue">نام فرستنده : '.$rows["_name"].'</label>';
					echo '</div>';
					echo '<div class="form-group">';
					   echo '<label style="color:blue">تاریخ ارسال : '.jdate('y/m/d',$rows["_cDate"]).'</label>';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<label>متن پیام</label>';
						echo '<textarea class="form-control" id="usrpm1" name="usrpm1" style="min-height: 100px">'.$rows["_text"].'</textarea>';
					echo '</div>';
               		echo '<div class="form-group">';
						echo '<label>پاسخ پیام</label>';
						echo '<textarea class="form-control" id="adminpm1" name="adminpm1" style="min-height: 100px">'.$rows["_adminAnswer"].'</textarea>';
					echo '</div>';
               echo '<input type="button" class="btn btn-info" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="ارسال پاسخ" onClick="updA(this.id)">';
                echo '</div>';
      		echo '</div> ';
		echo '</div>';
}
}
}
?>


<?php
if(isset($_GET['statusticketread'])){

$counter = 0;
$DB = new DB();
$Contactus = new Contactus();
$tiket = $Contactus->ReadTicketManager();
foreach($tiket as $rows)
{
	if($rows['_stutus']==0){
		$counter++;
	}
}
if($counter!=0){
	echo '<i class="fa fa-ticket"></i>&nbsp; تیکت های بخش مدیریت <span class="badge" style="padding:5px;color:#fff;background:#E8253D">'.$counter.'&nbsp;پیام جدید</span>';
}else{
	echo '<i class="fa fa-ticket"></i>&nbsp; تیکت های بخش مدیریت <span class="badge" style="padding:5px;color:#fff;background:#E8253D"></span>';
}
}
?>


<?php
if(isset($_GET['statusticketread1'])){

$counter = 0;
$DB = new DB();
$Contactus = new Contactus();
$tiket1 = $Contactus->ReadTicketSupport();
foreach($tiket1 as $rows)
{
	if($rows['_stutus']==0){
		$counter++;
	}
}
if($counter!=0){
	echo '<i class="fa fa-ticket"></i>&nbsp; تیکت های بخش پشتیبانی فنی <span class="badge" style="padding:5px;color:#fff;background:#E8253D">'.$counter.'&nbsp;پیام جدید</span>';
}else{
	echo '<i class="fa fa-ticket"></i>&nbsp; تیکت های بخش پشتیبانی فنی <span class="badge" style="padding:5px;color:#fff;background:#E8253D"></span>';
}
}
?>


<?php
if(isset($_GET['statusticketread2'])){

$counter = 0;
$DB = new DB();
$Contactus = new Contactus();
$tiket1 = $Contactus->ReadTicketAds();
foreach($tiket1 as $rows)
{
	if($rows['_stutus']==0){
		$counter++;
	}
}
if($counter!=0){
	echo '<i class="fa fa-ticket"></i>&nbsp; تیکت های بخش تبلیغات <span class="badge" style="padding:5px;color:#fff;background:#E8253D">'.$counter.'&nbsp;پیام جدید</span>';
}else{
	echo '<i class="fa fa-ticket"></i>&nbsp; تیکت های بخش تبلیغات <span class="badge" style="padding:5px;color:#fff;background:#E8253D"></span>';
}
}
?>


<?php
$statustusr = NULL;
if(isset($_GET['statususr'])){
	$statustusr = $_GET['statususr'];
}
if($statustusr == "dispusr")
{
	echo '<table class="table table-hover">';
		echo'<thead style="background: #444;color: #FFF">';
		echo'<tr>';
			echo'<th style="text-align: right">ردیف</th>';
			echo'<th style="text-align: right">نام و نام خانوادگی</th>';
			echo'<th style="text-align: right">نام کاربری</th>';
			echo'<th style="text-align: right">ایمیل کاربر</th>';
			echo'<th style="text-align: right">شماره موبایل</th>';
			echo'<th style="text-align: right">استان/شهر</th>';
			echo'<th style="text-align: right">تاریخ ایجاد حساب</th>';
			echo'<th style="text-align: right">وضعیت</th>';
			echo'<th style="text-align: right">عملیات</th>';
		echo'</tr>';
		echo'</thead>';
		echo'<tbody>';
	
$record_per_page = 10;
$page = null;
$output = '';
if($_GET['pageusr'] == "undefined"){
	$getpage = 1;
}else{
	$getpage = $_GET['pageusr'];
}
if (isset($_GET['pageusr']) ){
	if($_GET['pageusr'] == "undefined"){
		$page = 1;
	}else{
		$page = $_GET['pageusr'];	
	}
}else{
	$page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$User = new User();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$resusr = $User->ReadUser2($limit);
$i = 1;
foreach($resusr as $rows)
{
	echo'<tr>';

		echo '<th scope="row" style="text-align: right">'.intval($record_per_page*($page-1)+$i++).'</th>';
		echo'<td>'.$rows['_fname'].'</td>';
		echo'<td>'.$rows['_username'].'</td>';
		echo'<td>'.$rows['_email'].'</td>';
		echo'<td>'.$rows['_mobile'].'</td>';
		echo'<td>'.$rows['_ostan'].'/'.$rows['_city'].'</td>';
		echo'<td>'.jdate('y/m/d',$rows['_Cdate']).'</td>';
		echo'<td>';
		if($rows['_taeed']==1){echo "<p style=color:green>تایید</p>";}else{echo "<p style=color:orange>تعلیق</p>";}
		echo'</td>';
		echo'<td>';
		echo '<input type="button" class="btn btn-info" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="تایید" onClick="usrTaeed(this.id)">&nbsp';
		echo '<input type="button" class="btn btn-warning" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="تعلیق" onClick="usrTaliq(this.id)">&nbsp';
		echo '<input type="button" class="btn btn-danger" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="حذف" onClick="usrdelete(this.id)">';
		echo'</td>';
	echo'</tr>';
	
}
	echo'</tbody>';
	echo'</table>';
	
	$User = new User();
	$resall = $User->ReadUser();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkusr' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست کاربران : ".$getpage." از ".$total_pages."</p>";
}
?>


<?php
$statuskarfarma = NULL;
if(isset($_GET['statuskarfarma'])){
	$statuskarfarma = $_GET['statuskarfarma'];
}
if($statuskarfarma == "dispkarfarma")
{
	echo '<table class="table table-hover">';
		echo'<thead style="background: #444;color: #FFF">';
		echo'<tr>';
			echo'<th style="text-align: right">ردیف</th>';
			echo'<th style="text-align: right">نام و نام خانوادگی</th>';
			echo'<th style="text-align: right">نام کاربری</th>';
			echo'<th style="text-align: right">ایمیل کاربر</th>';
			echo'<th style="text-align: right">شماره موبایل</th>';
			echo'<th style="text-align: right">استان/شهر</th>';
			echo'<th style="text-align: right">تاریخ ایجاد حساب</th>';
			echo'<th style="text-align: right">وضعیت</th>';
			echo'<th style="text-align: right">عملیات</th>';
		echo'</tr>';
		echo'</thead>';
		echo'<tbody>';
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['pagekarfrma'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pagekarfrma'];
	}
	if (isset($_GET['pagekarfrma']) ){
		if($_GET['pagekarfrma'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pagekarfrma'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;	

$Karfarma = new Karfarma();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$resk = $Karfarma->ReadKarfarma2($limit);
$i = 1;
foreach($resk as $rows)
{
	echo'<tr>';
		echo '<th scope="row" style="text-align: right">'.intval($record_per_page*($page-1)+$i++).'</th>';
		echo'<td>'.$rows['_fname'].'</td>';
		echo'<td>'.$rows['_username'].'</td>';
		echo'<td>'.$rows['_email'].'</td>';
		echo'<td>'.$rows['_mobile'].'</td>';
		echo'<td>'.$rows['_ostan'].'/'.$rows['_city'].'</td>';
		echo'<td>'.jdate('y/m/d',$rows['_Cdate']).'</td>';
		echo'<td>';
		if($rows['_taeed']==1){echo "<p style=color:green>تایید</p>";}else{echo "<p style=color:orange>تعلیق</p>";}
		echo'</td>';
		echo'<td>';
		echo '<input type="button" class="btn btn-info" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="تایید" onClick="karfarmaTaeed(this.id)">&nbsp';
		echo '<input type="button" class="btn btn-warning" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="تعلیق" onClick="karfarmaTaliq(this.id)">&nbsp';
		echo '<input type="button" class="btn btn-danger" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="حذف" onClick="karfarmadelete(this.id)">';
		echo'</td>';
	echo'</tr>';
	
}
	echo'</tbody>';
	echo'</table>';
	
	$Karfarma = new Karfarma();
	$resall = $Karfarma->ReadKarfarma();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkkarfrma' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست کارفرمایان : ".$getpage." از ".$total_pages."</p>";
}
?>


<?php
$statusadmin = NULL;
if(isset($_GET['statusadmin'])){
	$statusadmin = $_GET['statusadmin'];
}
if($statusadmin == "dispadmin")
{
	echo'<table class="table table-hover">';
		echo'<thead style="background: #444;color: #FFF">';
		echo'<tr>';
			echo'<th style="text-align: right">ردیف</th>';
			echo'<th style="text-align: right">نام و نام خانوادگی</th>';
			echo'<th style="text-align: right">ایمیل ادمین</th>';
			echo'<th style="text-align: right">شماره تماس</th>';
			echo'<th style="text-align: right">استان/شهر</th>';
			echo'<th style="text-align: right">تاریخ شروع کار</th>';
			echo'<th style="text-align: right">مسئول</th>';
			echo'<th style="text-align: right">دسترسی</th>';
			echo'<th style="text-align: right">وضعیت</th>';
			echo'<th style="text-align: right">عملیات</th>';
		echo'</tr>';
		echo'</thead>';
		echo'<tbody>';
	
	$record_per_page = 3;
	$page = null;
	if($_GET['pageadmin'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pageadmin'];
	}
	if (isset($_GET['pageadmin']) ){
		if($_GET['pageadmin'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pageadmin'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;

$DB = new DB();
$Admin = new Admin();
$limit = "LIMIT ".$start_from.",".$record_per_page;	
$resadmin = $Admin->ReadAdmin2($limit);
$i = 1;
foreach($resadmin as $rows)
	{
	echo'<tr>';
		echo '<th scope="row" style="text-align: center">'.intval($record_per_page*($page-1)+$i++).'</th>';
		echo'<td>'.$rows['_name'].'</td>';
		echo'<td>'.$rows['_email'].'</td>';
		echo'<td>'.$rows['_tel'].'</td>';
		echo'<td>'.$rows['_ostan'].'/'.$rows['_city'].'</td>';
		echo'<td>'.jdate('y/m/d',$rows['_cDate']).'</td>';
		echo'<td>'.$Admin->adminsType($rows['_adminID']).'</td>';
		echo'<td>';
		if($rows['_status']==1){echo "<p style=color:green>آنلاین</p>";}else{echo "<p style=color:red>آفلاین</p>";}
		echo'</td>';
		if($level==1){
		echo'<td>';
			if($rows['_level']==1){
				echo '<input type="button" class="btn btn-success" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="دسترسی  کامل" onClick="adminAllLevel(this.id)">&nbsp;';
			}else if($rows['_level']==2){
				echo '<input type="button" class="btn btn-warning" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="دسترسی محدود" onClick="adminLimitLevel(this.id)">';
			}
		echo'</td>';
		};
		
		if($level==1){
		echo'<td>';
			echo '<input type="button" class="btn btn-danger" id="'.$rows["_id"].'" name="'.$rows["_id"].'" value="حذف" onClick="admindelete(this.id)">'; 
		echo'</td>';
		}else if($level==2){
		echo'<td>';
			echo '<input type="button" class="btn btn-danger" disabled value="حذف">';
		echo'</td>';
		};

		
	echo'</tr>';
	}
		echo'</tbody>';
	echo'</table>';
	
	$DB = new DB();
	$Admin = new Admin();
	$resadmin = $Admin->ReadAdmin();
	$total_record = $resadmin->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkadmin' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."لیست مدیران : ".$getpage." از ".$total_pages."</p>";
}
?>
 

<?php
$statusmovie = NULL;
$actionmovie = NULL;
$idadv = NULL;
if(isset($_GET['statusmovie'])){
	$statusmovie = $_GET['statusmovie'];
}
if(isset($_GET['actionmovie'])){
	$actionmovie = $_GET['actionmovie'];
	$idmovie = $_GET['id'];
}
if($statusmovie == "dispmovie")
{
echo '<table class="table table-hover">';
	echo '<thead style="background: #444;color: #FFF">';
		echo '<th style="text-align: right">ردیف</th>';
		echo '<th style="text-align: right">نام فیلم</th>';
		echo '<th style="text-align: right">کارگردان فیلم</th>';
		echo '<th style="text-align: right">اکران فیلم در</th>';
		echo '<th style="text-align: right">تاریخ اکران فیلم</th>';
		echo '<th style="text-align: right">وضعیت فیلم</th>';
		echo '<th style="text-align: right">توضیحات</th>';
		echo '<th style="text-align: right">عملیات</th>';
		echo '</thead>';
	
$record_per_page = 10;
$page = null;
$output = '';
if($_GET['pagemovie'] == "undefined"){
	$getpage = 1;
}else{
	$getpage = $_GET['pagemovie'];
}
if (isset($_GET['pagemovie']) ){
	if($_GET['pagemovie'] == "undefined"){
		$page = 1;
	}else{
		$page = $_GET['pagemovie'];	
	}
}else{
	$page = 1;
}
	
	$start_from = ($page - 1) * $record_per_page;

$DB = new DB();
$Cinema = new Cinema();
$limit = "LIMIT ".$start_from.",".$record_per_page;
$resMovie = $Cinema->ReadMovie2($limit);
$i = 1;
foreach($resMovie as $rows)
{
	$idmovv = $rows['_id'];
		echo "<tr>";
	
		echo '<th scope="row" style="text-align: right">'.intval($record_per_page*($page-1)+$i++).'</th>';
		
		echo "<td>"; ?>
			<div id="movname<?php echo $rows['_id']; ?>"> <?php echo $rows['_movieName']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="movdirector<?php echo $rows['_id']; ?>"> <?php echo $rows['_movieDirector']; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="movcinemaname<?php echo $rows['_id']; ?>"> <?php if($rows['_cinemaName'] == 1){echo "سینما سپید رود سالن اول";}else if($rows['_cinemaName'] == 2){echo "سینما سپید رود سالن دوم";}else if($rows['_cinemaName'] == 3){echo "سینما 22 بهمن";}else if($rows['_cinemaName'] == 4){echo "سینما میرزا کوچک خان";}; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<div id="movekran<?php echo $rows['_id']; ?>"> <?php echo $rows['_moviePlayTime']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="movexplain<?php echo $rows['_id']; ?>"> <?php if($rows['_endPlayTime']==0){echo "<p style=color:green>در حال اکران</p>";} else if($rows['_endPlayTime']==1){echo "<p style=color:red>اتمام اکران</p>";}; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="movexplain<?php echo $rows['_id']; ?>"> <?php if(empty($rows['_explain'])){echo "ندارد";}else{echo $rows['_explain'];}; ?></div>
		<?php echo "</td>";
	
		echo "<td>"; ?>
			<input type="button" class="btn btn-warning" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="اتمام اکران" onClick="movieEndPlayTime(this.id)">
			<input type="button" class="btn btn-success" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="تمدید اکران" onClick="movieRenewPlayTime(this.id)">
			<input type="button" class="btn btn-info" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="ویرایش" onClick="updatemovie(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deletemovie(this.id)">
		<?php echo "</td>";
		echo "</tr>";		
	
	}
	echo "</table>";
	
	$DB = new DB();
	$Cinema = new Cinema();
	$resall = $Cinema->ReadMovie();
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkmovie' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."ليست فیلم های سینما : ".$getpage." از ".$total_pages."</p>";
}	
?>


<?php
if($actionmovie == "updatemovie")
{ 
		$DB = new DB();
		$Cinema = new Cinema();
		$emovwhere = "`_id`=".$idmovie;
		$resUmov = $Cinema->ReadMovieByID($emovwhere);
		foreach($resUmov as $rows)
		{
			$idmovi = $rows['_id'];
?>	
	
	<div class="panel panel-default fade in collapse" id="p_closes" style="height: auto;text-align: right;margin-top: 60px">
  	<div class="panel-heading alert-dismissable">
  	ویرایش فیلم سینما
  	<a data-toggle="collapse" href="#p_closes" class="close pull-left" >&times</a>
  	</div>
  	<div class="panel-body">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="emovie-target" onsubmit="update_movie();">
	<table class="table table-hover">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
		<div id="resNewsU"></div>
			<tbody dir="rtl">
			
				<input type="hidden" name="idemov" id="idemov" value="<?php echo ($idmovi); ?>" class="form-control">
				<tr>
					<td>نام فیلم</td>
					<td><input type="text" name="emoviename" value="<?php echo $rows['_movieName']; ?>" id="emoviename" class="form-control"></td>
				</tr>
				
				<tr>
					<td>نام کارگردان فیلم</td>
					<td><input type="text" name="emoviedirector" id="emoviedirector" value="<?php echo $rows['_movieDirector']; ?>" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>نام بازیگران فیلم</td>
					<td><input type="text" name="emovieactor" value="<?php echo $rows['_movieActor']; ?>" id="emovieactor" class="form-control"></td>
				</tr>
				
				<tr>
					<td>زمان اکران فیلم</td>
					<td><input type="text" name="emovieplaytime" value="<?php echo $rows['_moviePlayTime']; ?>" id="emovieplaytime" class="form-control"></td>
				</tr>
				
				<tr>
					<td>قیمت بلیط</td>
					<td><input type="text" name="emoviepay" value="<?php echo $rows['_moviePay']; ?>" id="emoviepay" class="form-control"></td>
				</tr>
				
				<tr>
					<td>اکران در</td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="ecinemaname" name="ecinemaname">
						<option value="<?php echo $rows['_cinemaName']; ?>"><?php if($rows['_cinemaName']==1){echo "سینما سپید رود سالن اول";} else if($rows['_cinemaName']==2){echo "سینما سپید رود سالن دوم";} else if($rows['_cinemaName']==3){echo "سینما 22 بهمن";} else if($rows['_cinemaName']==4){echo "سینما میرزا کوچک خان";} ?></option>
							<option value="1">سینما سپید رود سالن اول</option>
							<option value="2">سینما سپید رود سالن دوم</option>
							<option value="3">سینما 22 بهمن</option>
							<option value="4">سینما میرزا کوچک خان</option>
					</select> 
					</span>
					</td>
				</tr>
				
				<tr>
					<td>شماره تماس سینما</td>
					<td><input type="text" name="ecinematel" value="<?php echo $rows['_cinemaTel']; ?>" id="ecinematel" class="form-control"></td>
				</tr>
				
				<tr>
					<td>آدرس سینما</td>
					<td><input type="text" name="ecinemaaddress" value="<?php echo $rows['_cinemaAddress']; ?>" id="ecinemaaddress" class="form-control"></td>
				</tr>
				
				<tr>
					<td>تعداد صندلی سینما</td>
					<td><input type="text" name="ecinmachair" value="<?php echo $rows['_cinemaNumChair']; ?>" id="ecinmachair" class="form-control"></td>
				</tr>
				
				<tr>
					<td>سانس های سینما</td>
					<td><textarea name="ecinemasans" id="ecinemasans" class="form-control" style="min-height: 100px;"><?php echo ($rows['_movieSans']); ?></textarea></td>
				</tr>
				
				<tr>
					<td>توضیحات</td>
					<td><input type="text" name="emovieexplain" value="<?php echo $rows['_explain']; ?>" id="emovieexplain" class="form-control"></td>
				</tr>
			
				<tr>
					<td>تصویر فیلم</td>
					<td>
					<span class="col-md-3 pull-right">
						<img src="<?php echo "../_upload/cinema/".$rows['_moviePic']; ?>" id="emovieimgs" style="width: 200px;height: 200px;">
					</span>
					<span class="col-md-6 pull-right">
						<input name="emovie-file" id="emovie-file" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
			
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="editmovie" name="editmovie" class="btn btn-success" value="ویرایش فیلم"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="movie-update"></div>
		<iframe id="emovie-target" name="emovie-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
		</div>
	</div>
<?php

		}
	}				
?>


<?php
if(isset($_POST['idh'])){
	$idh = $_POST['idh'];
	$DB = new DB();
	$Cinema = new Cinema();
	$where = "`_cinemaID`=".$idh;
	$resC = $Cinema->ReadCinemaName2($where);
	foreach($resC as $rowsq)
	{
	echo ($rowsq['_cinemaName']."|".$rowsq['_cinemaTel']."|".$rowsq['_cinemaAddress']."|".$rowsq['_cinemaChairNo']."|".$rowsq['_cinemaPay']."|".$rowsq['_cinemaOffDay']);
	}
}				
?>
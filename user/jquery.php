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

error_reporting(0);
if(!isset($_SERVER['HTTP_REFERER'])){
	exit();
}

	if(isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$usrname = $_SESSION['usrLogin'];
	}
		$DB = new DB();
		$User = new User();
		$resusrs = $User->SelectLoginUser($usrname);
		foreach($resusrs as $rows){
			$usrid = $rows['_id'];
			
		}
	}

?>
<?php
$status = NULL;
if(isset($_GET['status'])){
	$status = $_GET['status'];
}
$id = NULL;
$action = NULL;
$actions = NULL;
if(isset($_GET['action'])){
	$action = $_GET['action'];
	$id = ($_GET['id']);
}

?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="<?php echo DESC ?>">
    <meta name="Keywords" content="<?php echo KEY ?>">

    <!-- Bootstrap -->
    <link href="<?php echo ADDRESS ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/main-css.css">
  </head>
  

  <body>
  	
<?php
if (!isset($_SESSION['usrLogin']) || $_SESSION['usrLogin'] == ""){
	header("location:../index.php");
	exit();
}
?>  	
	
<?php
if(isset($_GET['status'])){
	$status = $_GET['status'];
}
if(isset($_GET['action'])){
	$action = $_GET['action'];
}
if($status == "disp"){
	
	echo "<table class='table table-hover' style='direction: rtl'>";
	echo "<thead style='background: #444;color: #FFF;direction: rtl'>";
	echo "<tr>";
	echo "<th style='text-align: right'>ردیف</th>";
	echo "<th style='text-align: right'>شناسه</th>";
	echo "<th style='text-align: right'>عنوان آگهی</th>";
	echo "<th style='text-align: right'>تاریخ درج</th>";
	echo "<th style='text-align: right'>وضعیت</th>";
	echo "<th style='text-align: right'>نوع آگهی</th>";
	echo "<th style='text-align: right'>عملیات</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<div id='resedel'></div>";
	echo "<tbody>";
	
	$i = 1;
	$DB = new DB();
	$User = new User();
	$usr_name = $_SESSION['usrLogin'];
	$resusr = $User->SelectLoginUser($usr_name);
	foreach($resusr as $rowsusr){
		$usrid = $rowsusr['_id'];
	}
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['page'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['page'];
	}
	if (isset($_GET['page']) ){
		if($_GET['page'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['page'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	$ViewAD = new ViewAD();
	$where = "`_advUserID`='".$usrid."'";
	$limit = "LIMIT ".$start_from.",".$record_per_page;
	$res = $ViewAD->ReadusrJob($where,$limit);

	foreach($res as $rows){
		echo "<tr>";
		echo "<td>";
			echo intval($record_per_page*($page-1))+$i++;
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mconid<?php echo $rows['_id']; ?>"> <?php echo "<p style='color:orange'>".$rows['_id']."</p>"; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="jobtitle<?php echo $rows['_id']; ?>"> <?php echo $rows['_jobTitle']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="date<?php echo $rows['_id']; ?>"> <?php echo jdate('Y/m/d',$rows['_addDate']); ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
		<?php 
		if($rows['_advTaeed']==0){
			echo '<p style=color:orange>تایید نشده</p>';
		}else if($rows['_advTaeed']==1){
			echo '<p style=color:green>تایید شده</p>';
		}?>
		<?php echo "</td>";
		
		echo "<td>";
		if($rows['_advPay']==0){
			echo'<input type="button" class="btn btn-success" id="'.$rows['_id'].'" value="تبدیل به ویژه" onClick="payadvjob(this.id);">';
		}else{
			echo "<p style='color:orange'>ویژه</p>";
		}?>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<input type="button" class="btn btn-info" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="ویرایش" onclick="update1s(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onclick="delete1(this.id)">
		<?php echo "</td>";
		echo "</tr>";
			
	}
	echo "</tbody>";
	echo "</table>";

	
	$ViewAD = new ViewAD();
	$where = "`_advUserID`='".$usrid."'";
	$resall = $ViewAD->ReadusrrowsJob($where);
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linka' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."لیست آگهی : ".$getpage." از ".$total_pages."</p>";
	
}
?>										
	
	
<?php
if($action == "update")
{
		$DB = new DB();
		$ViewAD = new ViewAD();
		$ress = $ViewAD->ReadAdds($id);
		foreach($ress as $rows)
		{ 
?>	
	
	<div class="col-md-12">
	<div class="panel panel-default fade in collapse" id="p_close" style="height: auto;text-align: right;margin-top: 10px">
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
				<input type="hidden" name="id" id="id" value="<?php echo ($id); ?>" class="form-control">
				<tr>
					<td>عنوان آگهی</td>
					<td><input type="text" name="title" value="<?php echo $rows['_jobTitle'] ?>" id="title" class="form-control"></td>
				</tr>
				<tr>
					<td>نام شرکت</td>
					<td><input type="text" name="coname" value="<?php echo $rows['_coName'] ?>" id="coname" class="form-control"></td>
				</tr>
				<tr>
					<td>نام درخواست دهنده</td>
					<td><input type="text" name="bossname" value="<?php echo $rows['_bossName'] ?>" id="bossname" class="form-control"></td>
				</tr>
				<tr>
					<td>آدرس شرکت</td>
					<td><input type="text" name="coAddress" value="<?php echo $rows['_coAddress'] ?>" id="coAddress" class="form-control"></td>
				</tr>
				<tr>
					<td>تلفن</td>
					<td><input type="text" name="tel" value="<?php echo $rows['_coTel'] ?>" id="tel" class="form-control"></td>
				</tr>
				<tr>
					<td>موبایل</td>
					<td><input type="text" name="mobile" value="<?php echo $rows['_mobile'] ?>" id="mobile" class="form-control"></td>
				</tr>
				<tr>
					<td>ایمیل</td>
					<td><input type="text" name="email" value="<?php echo $rows['_coEmail'] ?>" id="email" class="form-control"></td>
				</tr>
				<tr>
					<td>وب سایت</td>
					<td><input type="text" name="web" value="<?php echo $rows['_coWeb'] ?>" id="web" class="form-control"></td>
				</tr>
				<tr>
					<td>شغل درخواستی</td>
					<td><input type="text" name="jobreq" value="<?php echo $rows['_jobReq'] ?>" id="jobreq" class="form-control"></td>
				</tr>
				<tr>
					<td>تحصیلات</td>
					<td><input type="text" name="edu" value="<?php echo $rows['_edu'] ?>" id="edu" class="form-control"></td>
				</tr>
				<tr>
					<td>رشته تحصیلی</td>
					<td><input type="text" name="degree" value="<?php echo $rows['_degree'] ?>" id="degree" class="form-control"></td>
				</tr>
				<tr>
					<td>گرایش</td>
					<td><input type="text" name="sience" value="<?php echo $rows['_sience'] ?>" id="sience" class="form-control"></td>
				</tr>
				<tr>
					<td>تعداد نیرو</td>
					<td><input type="text" name="reqno" value="<?php echo $rows['_reqNo'] ?>" id="reqno" class="form-control"></td>
				</tr>
				<tr>
					<td>تخصص</td>
					<td><input type="text" name="export" value="<?php echo $rows['_export'] ?>" id="export" class="form-control"></td>
				</tr>
				<tr>
					<td>جنسیت</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="gender" id="gender" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
						<option value="<?php echo $rows['_gender'] ?>"><?php if($rows['_gender']==0){echo '';} else {echo $ViewAD->gender($rows['_gender']);} ?></option>
						<option value="1">مرد</option>
						<option value="2">زن</option>
						<option value="3">مرد یا زن</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>سن مورد نیاز</td>
					<td><input type="text" name="age" value="<?php echo $rows['_age'] ?>" id="age" class="form-control"></td>
				</tr>
				<tr>
					<td>تاهل</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="married" id="married" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
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
					<select class="btn btn-block dropdown form-control" name="bime" id="bime" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
						<option value="<?php echo $rows['_bime'] ?>"><?php if($rows['_bime']==0){echo '';} else {echo $ViewAD->bime($rows['_bime']);} ?></option>
						<option value="1">دارد</option>
						<option value="2">ندارد</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>وضعیت نظام وظیفه</td>
					<td>
					<select class="btn btn-block dropdown form-control" name="khedmat" id="khedmat" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
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
					<td><input type="text" name="ayabzahab" value="<?php echo $rows['_ayabzahab'] ?>" id="ayabzahab" class="form-control"></td>
				</tr>
				<tr>
					<td>زمان کار</td>
					<td><input type="text" name="worktime" value="<?php echo $rows['_workTime'] ?>" id="worktime" class="form-control"></td>
				</tr>
				<tr>
					<td>حقوق پرداختی</td>
					<td><input type="text" name="workpay" value="<?php echo $rows['_workPay'] ?>" id="workpay" class="form-control"></td>
				</tr>
				<tr>
					<td>شهر محل کار</td>
					<td><input type="text" name="workcity" value="<?php echo $rows['_workCity'] ?>" id="workcity" class="form-control"></td>
				</tr>
				<tr>
					<td>توضیحات</td>
					<td><input type="text" name="expalin" value="<?php echo $rows['_explain'] ?>" id="expalin" class="form-control"></td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align: left">
						<button type="submit" id="<?php echo $id; ?>" name="editad" onClick="update(this.id)" class="btn btn-success"><i class="fa fa-refresh"></i>&nbsp; ویرایش آگهی</button>
					</td>
				</tr>	
							
<?php
		}
	echo "</tbody>";
	echo "</table>";
	echo '<div id="resedu"></div>';
	echo "</div>";
	echo "</div>";
	echo "</div>";
	
}
?>
		

<?php
$statususrmessage = NULL;
if(isset($_GET['statususrmessage'])){
	$statususrmessage = $_GET['statususrmessage'];
}
				
if($statususrmessage == "dispusrmessage"){
	echo '<table class="table table-hover" style="direction: rtl">';             		
	echo '<thead style="background: #444;color: #FFF;direction: rtl">';					
	echo '<tr>';
	echo '<th style="text-align: right">ردیف</th>';							
	echo '<th style="text-align: right">عنوان پیام</th>';
	echo '<th style="text-align: right">تاریخ ارسال</th>';
	echo '<th style="text-align: right">تاریخ پاسخ دهی</th>';
	echo '<th style="text-align: right">مشاهده پاسخ</th>';
	echo '<th style="text-align: right">عملیات</th>';							
	echo '</tr>';						
	echo '</thead>';				
	echo '<tbody>';
	
	
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
	
	$f = 1;
	$DB = new DB();
	$Contactus = new Contactus();
	$where = "`_usrID`='".$usrid."'";
	$limit = "LIMIT ".$start_from.",".$record_per_page;
	$resCu = $Contactus->ReadTicketByUsrID2($where,$limit);
	foreach($resCu as $rowss){
		
	echo '<tr>';
	echo '<th scope="row" style="text-align: right">'.intval($record_per_page*($page-1)+$f++).'</th>';
	echo '<td style="text-align: right">'.$rowss['_title'].'</td>';							
	echo '<td style="text-align: right">'.jdate('y/m/d',$rowss['_cDate']).'</td>';
	echo '<td style="text-align: right">'.jdate('y/m/d',$rowss['_aDate']).'</td>';
	if($rowss['_adminAnswer'] != ""){
	echo '<td style="text-align: right">';
	echo'<input type="button" class="btn btn-info" id="'.$rowss['_id'].'" value="مشاهده" onClick="ShowMessage(this.id)">';	
	echo '</td>';
	}else{
	echo '<td><p style="color:#FF770B">در انتظار پاسخ</p></td>';
	}
	echo '<td style="text-align: right">';
	echo '<input type="button" class="btn btn-danger" id="'.$rowss['_id'].'" name="'.$rowss['_id'].'" value="حذف" onClick="deleteusr(this.id)">';
	echo '</td>';							
	echo '</tr>';						

	}
	echo '</tbody>';
	echo '</table>';
	
	$ViewAD = new ViewAD();
	$Contactus = new Contactus();
	$resall = $Contactus->ReadTicketByUsrID($usrid);
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linku' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."لیست پیام ها : ".$getpage." از ".$total_pages."</p>";
}
?>
		
<?php
$statusmodalmsg = NULL;
if(isset($_GET['statusmodalmsg'])){
	$statusmodalmsg = $_GET['statusmodalmsg'];
	
$idMessage = NULL;	
if($statusmodalmsg == "dispmodalmsg"){
	if(isset($_GET['idmodalmsg'])){
		$idMessage = $_GET['idmodalmsg'];
	}
$DB = new DB();
$Contactus = new Contactus();
$restiketsid = $Contactus->ReadTicketById($idMessage);
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
					   echo '<label style="color:blue">تاریخ پاسخ : '.jdate('y/m/d',$rows["_aDate"]).'</label>';
					echo '</div>';
					echo '<div class="form-group">';
						echo '<label>متن پیام شما</label>';
						echo '<textarea class="form-control" id="usrpm" name="usrpm" style="min-height: 100px">'.$rows["_text"].'</textarea>';
					echo '</div>';
               		echo '<div class="form-group">';
						echo '<label>پاسخ پیام</label>';
						echo '<textarea class="form-control" id="adminpm" name="adminpm" style="min-height: 100px">'.$rows["_adminAnswer"].'</textarea>';
					echo '</div>';
               echo '<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>';
      		echo '</div> ';
		echo '</div>';
	}
   }
}				
				
?>


<?php
$statuskarmessage = NULL;
if(isset($_GET['statuskarmessage'])){
	$statuskarmessage = $_GET['statuskarmessage'];
}
			
if($statuskarmessage == "dispkarmessage"){
	echo '<table class="table table-hover" style="direction: rtl">';             		
	echo '<thead style="background: #444;color: #FFF;direction: rtl">';					
	echo'<tr>';
	echo '<th style="text-align: right">ردیف</th>';							
	echo '<th style="text-align: right">عنوان پیام</th>';
	echo '<th style="text-align: right">تاریخ ارسال</th>';
	echo '<th style="text-align: right">تاریخ پاسح دهی</th>';
	echo '<th style="text-align: right">مشاهده پاسخ</th>';
	echo '<th style="text-align: right">عملیات</th>';							
	echo '</tr>';						
	echo '</thead>';				
	echo '<tbody>';
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['pagekar'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pagekar'];
	}
	if (isset($_GET['pagekar']) ){
		if($_GET['pagekar'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pagekar'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	
	
	$f = 1;
	$DB = new DB();
	$Contactus = new Contactus();
	$where = "`_usrID`='".$usrid."'";
	$limit = "LIMIT ".$start_from.",".$record_per_page;
	$resCu = $Contactus->ReadTicketByUsrID2($where,$limit);
	foreach($resCu as $rowss){
		
	echo '<tr>';
	echo '<th scope="row" style="text-align: right">'.intval($record_per_page*($page-1)+$f++).'</th>';						
	echo '<td style="text-align: right">'.$rowss['_title'].'</td>';							
	echo '<td style="text-align: right">'.jdate('y/m/d',$rowss['_cDate']).'</td>';
	echo '<td style="text-align: right">'.jdate('y/m/d',$rowss['_aDate']).'</td>';
	if($rowss['_adminAnswer'] != ""){
	echo '<td style="text-align: right">';
	echo'<input type="button" class="btn btn-info" id="'.$rowss['_id'].'" value="مشاهده" onClick="ShowMessage(this.id)">';	
	echo '</td>';
	}else{
	echo '<td><p style="color:orange">در انتظار پاسخ</p></td>';
	}
	echo '<td style="text-align: right">';
	echo '<input type="button" class="btn btn-danger" id="'.$rowss['_id'].'" name="'.$rowss['_id'].'" value="حذف" onClick="deletekarfarma(this.id)">';
	echo '</td>';							
	echo '</tr>';						

	}
	echo '</tbody>';
	echo '</table>';
	
	$DB = new DB();
	$Contactus = new Contactus();
	$resall = $Contactus->ReadTicketByUsrID($usrid);
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkkar' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."لیست پیام ها : ".$getpage." از ".$total_pages."</p>";
}
?>


<?php

$statusmashaqell = NULL;;
if(isset($_GET['statusmashaqell'])){
	$statusmashaqell = $_GET['statusmashaqell'];
}
if($statusmashaqell == "dispmashaqell"){

	echo "<table class='table table-hover' style='direction: rtl'>";
	echo "<thead style='background: #444;color: #FFF;direction: rtl'>";
	echo "<tr>";
	echo "<th style='text-align: right'>ردیف</th>";
	echo "<th style='text-align: right'>شناسه</th>";
	echo "<th style='text-align: right'>عنوان</th>";
	echo "<th style='text-align: right'>تاریخ ثبت</th>";
	echo "<th style='text-align: right'>اعتبار</th>";
	echo "<th style='text-align: right'>روز باقیمانده</th>";
	echo "<th style='text-align: right'>بازدید</th>";
	echo "<th style='text-align: right'>وضعیت</th>";
	echo "<th style='text-align: right'>پرداخت</th>";
	echo "<th style='text-align: right'>عملیات</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<div id='resMdel'></div>";
	echo "<tbody style='direction: rtl'>";
	
	$record_per_page = 10;
	$page = null;
	$output = '';
	if($_GET['pagework'] == "undefined"){
		$getpage = 1;
	}else{
		$getpage = $_GET['pagework'];
	}
	if (isset($_GET['pagework']) ){
		if($_GET['pagework'] == "undefined"){
			$page = 1;
		}else{
			$page = $_GET['pagework'];	
		}
	}else{
		$page = 1;
	}
	
	$start_from = ($page - 1) * $record_per_page;
	
	
	$i = 1;
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$wheret = "`_userID`=".$usrid;
	$limit = "LIMIT ".$start_from.",".$record_per_page;	
	$resM = $Mashaqel->ReadMashaqelByID2($wheret,$limit);
	
	foreach($resM as $rows){
		echo "<tr>";
		echo "<td>";
		echo intval($record_per_page*($page-1))+$i++;
		echo"</td>";
		echo "<td style='display:none'>"; 
			echo $rows['_id']; 
		echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mconid<?php echo $rows['_id']; ?>"> <?php echo "<p style='color:orange'>".$rows['_id']."</p>"; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mconame1<?php echo $rows['_id']; ?>"> <?php echo $rows['_coname']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="McoCdate1<?php echo $rows['_id']; ?>"> <?php echo jdate('y/m/d',$rows['_Cdate']); ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="McovalidDay<?php echo $rows['_id']; ?>"> <?php echo $rows['_validDay']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="McopassedDay<?php echo $rows['_id']; ?>"> <?php echo $rows['_passedDay']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcovisited<?php echo $rows['_id']; ?>" style="color:#F0340F"> <?php echo $rows['_visited']; ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcopaystate<?php echo $rows['_id']; ?>"><?php if($rows['_taeed']==0){echo "<p style='color:red'>تایید نشده</p>";}else if($rows['_taeed']==1){echo "<p style='color:green'>تایید شده</p>";} ?></div>
		<?php echo "</td>";
		
		echo "<td>"; ?>
			<div id="Mcopaystate1<?php echo $rows['_id']; ?>"> <?php if($rows['_paystate'] == 0){echo "<p style='color:green'>پرداخت شده</p>";}else if($rows['_paystate'] == 1){echo "<input type='button' class='btn btn-success' id='".$rows['_id']."' onClick='payMashaqel(this.id)' value='پرداخت'>";} ?></div>
		<?php echo "</td>";
		echo "<td>"; ?>
			<input type="button" class="btn btn-info" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="ویرایش" onClick="updateMashaqell(this.id)">
			<input type="button" class="btn btn-danger" id="<?php echo $rows['_id']; ?>" name="<?php echo $rows['_id']; ?>" value="حذف" onClick="deleteMashaqell(this.id)">
		<?php echo "</td>";
		echo "</tr>";
	}
	echo'</tbody>';
	echo '</table>';
	
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$wheret = "`_userID`=".$usrid;
	$resall = $Mashaqel->ReadMashaqelByID($wheret);
	$total_record = $resall->rowCount();
	$total_pages = ceil($total_record/$record_per_page);
	echo '<div class="page-header"></div>';
	for($i_p=1; $i_p<=$total_pages; $i_p++){
		echo "
		<div class='pull-left pagination_add'>
		<span class='pagination_linkm' style='cursor:pointer;padding:6px 12px;margin:5px;list-style:none;border:1px solid #ccc' id='".$i_p."'>".$i_p."</span>
		</div>
		";
	}echo "<p class='pull-right' > "."لیست مشاغل : ".$getpage." از ".$total_pages."</p>";
	
}
?>										

<?php
$actionMashaqell = NULL;
if(isset($_GET['actionMashaqell'])){
	$actionMashaqell = $_GET['actionMashaqell'];
	$idMashaqell = $_GET['id'];
}
if($actionMashaqell == "updateMashaqell")
{ 
		$DB = new DB();
		$Mashaqel = new Mashaqel();
		$Mwheret = "`_id`=".$idMashaqell;
		$resUMt = $Mashaqel->ReadMashaqelByID($Mwheret);
		foreach($resUMt as $rowsUM)
		{
			$idMashaqell1 = $rowsUM['_id'];
?>	
	<div class="col-md-12">
	<div class="panel panel-default fade in collapse" id="p_closes" style="height: auto;text-align: right;margin-top: 10px">
  	<div class="panel-heading alert-dismissable">
  	ویرایش بنر شغلی
  	<a data-toggle="collapse" href="#p_closes" class="close pull-left" >&times</a>
  	</div>
  	<div class="panel-body">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="Mashqelum-targett" onsubmit="update_Mu();">
	<table class="table table-hover" style="direction: rtl">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
		<div id="resMU"></div>
			<tbody dir="rtl">
			
				<input type="hidden" name="idMMt" id="idMMt" value="<?php echo ($idMashaqell1); ?>" class="form-control">
				<tr>
					<td>نام شرکت</td>
					<td><input type="text" name="Mconamest" value="<?php echo $rowsUM['_coname']; ?>" id="Mconamest" class="form-control"></td>
				</tr>
				
				<tr>
					<td>مدیر شرکت</td>
					<td><input type="text" name="Mcoadminst" id="Mcoadminst" value="<?php echo $rowsUM['_coAdmin']; ?>" class="form-control">
					</td>
				</tr>
				
				<tr>
					<td>شماره تماس</td>
					<td><input type="text" name="Mcotelst" value="<?php echo $rowsUM['_coTel']; ?>" id="Mcotelst" class="form-control"></td>
				</tr>
				
				<tr>
					<td>آدرس درخواست دهنده</td>
					<td><input type="text" name="Mcoadrest" value="<?php echo $rowsUM['_coAddress']; ?>" id="Mcoadrest" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن اول</td>
					<td><input type="text" name="Mtxts1t" value="<?php echo $rowsUM['_txt1']; ?>" id="Mtxts1t" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن دوم</td>
					<td><input type="text" name="Mtxts2t" value="<?php echo $rowsUM['_txt2']; ?>" id="Mtxts2t" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن سوم</td>
					<td><input type="text" name="Mtxts3t" value="<?php echo $rowsUM['_txt3']; ?>" id="Mtxts3t" class="form-control"></td>
				</tr>
				
				<tr>
					<td>توضیحات</td>
					<td><input type="text" name="Mexplainst" value="<?php echo $rowsUM['_explain']; ?>" id="Mexplainst" class="form-control"></td>
				</tr>
			
				<tr>
					<td>تصویر اصلی</td>
					<td>
					<span class="col-md-6 pull-right">
						<img src="../_upload/mashaqel/<?php echo $rowsUM['_coImage']; ?>" id="Mimg1t" style="width: 200px;height: 200px;">
					</span>
					<span class="col-md-6 pull-right">
						<input name="Mashqelu-filet" id="Mashqelu-filet" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
				
				<tr>
					<td>تصویر بنر</td>
					<td>
					<span class="col-md-6 pull-right">
					<?php
						if(!empty($rowsUM['_imgmore1'])){
							echo '<img src="../_upload/mashaqel/'.$rowsUM['_imgmore1'].'" id="Mimg2t" style="width: 200px;height: 200px;">';	
						}else{
							echo '<img src="../img/empty.png" id="Mimg2t" style="width: 200px;height: 200px;">';
						}
					?>
						
					</span>
					<span class="col-md-6 pull-right">
						<input name="Mashqelu1-filet" id="Mashqelu1-filet" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="editMt" name="editMt" class="btn btn-success" value="ویرایش مشاغل"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		
		<div style="text-align:right" class="alert" id="Mashaqelus-updatet"></div>
		<iframe id="Mashqelum-targett" name="Mashqelum-targett" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
		</div>
		</div>
		</div>
<?php

		}
	}				
?>		
	
  </body> 
</html>


<?php
session_start();
ob_start();
require_once str_replace('\\','/',dirname(dirname(dirname(__FILE__)))).'/config.php';

function AutoLoad($className){
	if (file_exists(ROOT . 'inc_func/class.' . $className . '.php')){
		require_once ROOT . 'inc_func/class.' . $className . '.php';
	}
}
spl_autoload_register('AutoLoad');
require_once ROOT . 'inc_func/jdf.php';
require_once ROOT . 'inc_func/set-config.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>پنل مدیر</title>

    <!-- Bootstrap -->
    <link href="<?php echo ADDRESS ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/admin-css.css">
	<link href="../../img/NR4.png" rel="shortcut icon">
	<style type="text/css">
		#ed a:hover{
			color: #337ab7 !important;
		}  
	</style>
		<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
  </head>
 		

  <body>
	
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo ADDRESS ?>index.php">پنل نیاز رشت <i class="fa fa-wordpress"></i></a>
        </div>
         <div>
          	<ul>
          		<li class="user" style="width: 100px;">
<?php if(!isset($_SESSION['adminLogin']) || ($_SESSION['adminLogin'] == '')){?>
          			<a href="#"><i class="fa fa-user fa-2x"></i></a>
<?php } else if(isset($_SESSION['adminLogin']) && ($_SESSION['adminLogin'] != '')) { ?>
         		 <div class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o fa-2x"></i></a>
                   	<div class="dropdown-menu" style="padding: 10px;direction: rtl;min-width: 170px">
<?php
	if (isset($_SESSION['adminLogin'])){
	if($_SESSION['adminLogin'] != ""){
		$Admin = new Admin();
		$session = $_SESSION['adminLogin'];
		$res = $Admin->SelectLoginAdmin($session);
		foreach($res as $rows){
			$nmae = $rows['_name'];
			$email = $rows['_email'];
			$ids = $rows['_id'];
			
			if($email == $session){
?>																				
					<div style="text-align: right">
						<span><label style="color: #3498DB">مدیر سایت: </label> <a style="color: orangered"><?php echo $rows['_name']; ?></a></span>
						
					</div>
					<div id="ed" style="text-align: right">
						<a href="./admins.php" id="loginedit" style="color: #4CD4B0">پنل ادمین</a>
					</div>
					
					<button class="btn btn-primary btn-block" type="button" style="margin-top: 10px" onclick="window.location='../logout.php?id=<?php echo $rows['_id']; ?>'"><i class="fa fa-sign-out"></i> خروج</button>
<?php
			}
		}
	}
}
?>       
            		</div>
            	</div>		
<?php } ?>        			
          		</li>
          	</ul>
          
          </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div id="navbar" class="navbar-collapse collapse col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="<?php echo ADDRESS ?>admin/dashboard.php"><i class="fa fa-desktop fa-2x"></i>&nbsp; پیشخوان<span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo ADDRESS ?>admin/news.php"><i class="fa fa-newspaper-o fa-2x"></i>&nbsp; مدیریت اخبار و رویداد</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/cinema.php"><i class="fa fa-film fa-2x"></i>&nbsp; مدیریت بخش سینما</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/edit-job.php"><i class="fa fa-list-alt fa-2x"></i>&nbsp; مدیریت بخش آگهی</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/edit-co.php"><i class="fa fa-photo fa-2x"></i>&nbsp; مدیریت بخش مشاغل</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/adv.php"><i class="fa fa-bullhorn fa-2x"></i>&nbsp; مدیریت تبلیغات</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/ticket.php"><i class="fa fa-ticket fa-2x"></i>&nbsp; مدیریت تیکت ها</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/users.php"><i class="fa fa-users fa-2x"></i>&nbsp; مدیریت کاربران</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/admins.php"><i class="fa fa-user fa-2x"></i>&nbsp; وضعیت مدیران</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/pay.php"><i class="fa fa-dollar fa-2x"></i>&nbsp; امور مالی</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/setting.php"><i class="fa fa-cogs fa-2x"></i>&nbsp; تنظیمات پنل</a></li>
            <li><a href="<?php echo ADDRESS ?>admin/report.php"><i class="fa fa-pie-chart fa-2x"></i>&nbsp; گزارشات</a></li>
          </ul>
        </div>
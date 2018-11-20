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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="<?php echo DESC ?>">
    <meta name="Keywords" content="<?php echo KEY ?>">
	<title><?php echo TITLE ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo ADDRESS ?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/main-css.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ADDRESS ?>css/animate.css"> 
    <link href="./img/NR4.png" rel="shortcut icon">
    
  </head>
  <body>	
<!-- Header -->
	 <header id="header" style="min-height: 90px">
           <nav id="top-nav" class="navbar navbar-fixed-top text-center">
			  <div class="container-fluid">
				<div class="navbar-headersd">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#rst">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
          			
          	   <div id="rst" class="navbar-collapse collapse">
				  <ul class="navbar-nav pull-right clearfix">
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>">
		  					<div><i class="fa fa-home fa-2x"></i></div>
							<div>صفحه اصلی</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>adverting.php">
		  					<div><i class="fa fa-bullhorn fa-2x"></i></div>
							<div>تبلیغات</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>job.php">
		  					<div><i class="fa fa-tasks fa-2x"></i></div>
							<div>آگهی کاریابی</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>morecompany.php">
		  					<div><i class="fa fa-user-md fa-2x"></i></div>
							<div>مشاغل</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>blocked.php">
		  					<div><i class="fa fa-building fa-2x"></i></div>
							<div>سازمان ها</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>blocked.php">
		  					<div><i class="fa fa-map-signs fa-2x"></i></div>
							<div>گردشگری گیلان</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>about.php">
		  					<div><i class="fa fa-address-card-o fa-2x"></i></div>
							<div>درباره ما</div>
			  			</a>
			  		</li>
			  		<li class="pull-right">
						<a href="<?php echo ADDRESS ?>contactus.php">
		  					<div><i class="fa fa-volume-control-phone fa-2x"></i></div>
							<div>تماس با ما</div>
			  			</a>
			  		</li>
				  </ul>
			   </div>
		      </div>
          				<div class="login">
<?php if(!isset($_SESSION['usrLogin']) || ($_SESSION['usrLogin'] == '')){?> 
					<a href="#" id="myModallink" class="loginmodal"><i class="fa fa-user fa-2x" data-toggle="modal" data-target="#myModal"></i></a>
<?php } else if(isset($_SESSION['usrLogin']) && ($_SESSION['usrLogin'] != '')) { ?>
				<div class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o fa-2x"></i></a>
                   	<div class="dropdown-menu">
<?php
	if (isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$User = new User();
		$session = $_SESSION['usrLogin'];
		$res = $User->SelectLoginUser($session);
		foreach($res as $rows){
			$unmae = $rows['_username'];
			$ids = $rows['_id'];
			
			if($unmae == $session){
?>																				
                   		<div>
                   			<?php
							if(!empty($rows['_avatar'])){
								echo "<img src='user/img/".$rows['_avatar']."' style='width: 50px;height: 50px;border-radius: 50%'>";
							}else{
								echo "<img src='user/img/no-user-image.gif' style='width: 50px;height: 50px;border-radius: 50%'>";
							}
							?>
                   			
                   			<?php echo $rows['_fname']; ?>
                   		</div>
                    	<a href="./user/userprofile.php" id="loginedit">ویرایش پنل کاربری</a>
                    	<button class="btn btn-primary btn-block" type="button" style="margin-top: 10px" onclick="window.location='./logout.php?id=<?php echo $rows['_id']; ?>'">خروج</button>
<?php
			}
		}
	}
}
?>       
            		</div>
            	</div>		
<?php } ?>
	      	</div>
           </nav>
</header>
   
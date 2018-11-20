<?php
session_start();
ob_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/config.php';

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
	<script>$("canvas").scrollTop(0);</script>
  <body>
	
<!-- Header -->
	 <header id="header">
          
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
						<a href="#" id="contact-uslink" class="gocontactus">
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
      
          	 <canvas class='connecting-dots'></canvas>
          	
          	<section id="site-title" >
           		<div class="container text-center">
           			<div class="row">
           			
           				<div class="hd-back" style="height: 55px;padding: 5px" >
							<div class="ttl">
								<span id="ityped"></span>
							</div>
           				</div>
           				<div class="hd-back" >
           				<div class="ttl">
           					<h2 class="wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">Niaze Rasht | نیاز رشت</h2>
           				</div>
           				<div class="col-md-3 col-xs-12"></div>
           				<div class="search col-md-6 col-xs-12">
           				<div class="input-group wow fadeInDown" data-wow-duration="1s" data-wow-delay="1s">	
           					<div class="input-group-btn">
           						<button class="btn" id="btn-submit" type="submit"><i class="fa fa-search"></i></button>
							</div>
							<input type="search" class="form-control txt-search" placeholder="کلمه یا حرفی برای یافتن آگهی های استخدامی وارد کنید ...">
           				</div>
           				</div>
           				<div class="col-md-3 col-xs-12"></div>
           				<div class="col-md-12" >
           					<div class="social wow fadeIn" data-wow-duration="1s" data-wow-delay="1.5s">
  								<a href="#" class="link facebook" target="_parent"><span class="fa fa-facebook-square"></span></a>
  								<a href="#" class="link twitter" target="_parent"><span class="fa fa-twitter"></span></a>
  								<a href="#" class="link google-plus" target="_parent"><span class="fa fa-google-plus-square"></span></a>
							</div>
           				</div>
           				</div>
           				
           				<div class="go-down col-xs-12 wow fadeInDown" data-wow-duration="1s" data-wow-delay="2.5s"><a id="sliderslink" class="goslider" href="#"><i class="glyphicon glyphicon-menu-down" style="font-size: 30px"></a></i></div>
           		</div>
           </section>
</header>



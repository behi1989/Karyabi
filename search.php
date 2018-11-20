<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>موسسه کاریابی نیاز رشت</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/main-css.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css"> 
    <link href="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-8/16/Addons-icon.png" rel="shortcut icon">
    
  </head>
  
  <body>

<!-- Login form -->
 	 <div id="myModal" class="modal fade"  role="dialog">
     	<div class="modal-dialog" style="max-width: 450px">
        
     		<div class="modal-content ss1">
            
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color: #2CC990">ورود به پنل کاربری</h4>
                </div>
                
                <div class="modal-body">
                    <form action="login.php" method="post" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="usrname" placeholder="نام کاربری">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="psw" placeholder="کلمه عبور">
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" value="" checked><label>به خاطر بسپار</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">ورود</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>
                    	<button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#forgetpass">کلمه عبور را فراموش کردم</button>
                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegModal" data-dismiss="modal">ایجاد حساب کاربری</button>
                    </p>
                </div>
      		</div> 
		</div>
	</div>
	
<!-- Register form -->
  	 <div id="RegModal" class="modal fade"  role="dialog">
     	<div class="modal-dialog" style="max-width: 400px">
        
     		<div class="modal-content ss2">
            
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color: #1DABB8">ایجاد حساب کاربری</h4>
                </div>
                
                <div class="modal-body">
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="نام و نام خانوادگی">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="نام کاربری">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="emails" name="emails" placeholder="پست الکترونیکی">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="pass1" name="pass1" placeholder="کلمه عبور">
                        </div>
                    </form>
                </div>
        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="registerr" id="registerr" data-dismiss="modal">ثبت نام</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#myModal"> ورود به پنل کاربری</button>
                </div>
                
      		</div>
            
		</div>
	</div>	

<!-- Forget Pass -->
	 <div id="forgetpass" class="modal fade"  role="dialog">
     	<div class="modal-dialog" style="max-width: 450px">
        
     		<div class="modal-content ss3">
            
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color: #FF5A1E">بازیابی کلمه عبور</h4>
                </div>
                
                <div class="modal-body">
                    <form action="login.php" method="post" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" id="emails" placeholder="پست الکترونیکی">
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">بازیابی کلمه عبور</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>
                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegModal" data-dismiss="modal">ایجاد حساب کاربری</button>
                    	<button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#myModal"> ورود به پنل کاربری</button>
                    </p>
                </div>
      		</div> 
		</div>
	</div>
	
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
				  <ul class="navbar-nav pull-right">
					<li>
						<a href="contactus.php" id="contact-uslink" class="gocontactus">
		  					<div><i class="fa fa-headphones fa-2x"></i></div>
							<div>تماس با ما</div>
			  			</a>
			  		</li>
					<li>
						<a href="about.php">
		  					<div><i class="fa fa-address-card-o fa-2x"></i></div>
							<div>درباره ما</div>
			  			</a>
			  		</li>
					<li>
						<a href="blocked.php">
		  					<div><i class="fa fa-building fa-2x"></i></div>
							<div>شرکت ها</div>
			  			</a>
			  		</li>
					<li>
						<a href="blocked.php">
		  					<div><i class="fa fa-th fa-2x"></i></div>
							<div>مشاغل</div>
			  			</a>
			  		</li>
			  		<li>
						<a href="blocked.php">
		  					<div><i class="fa fa-list-ul fa-2x"></i></div>
							<div>آگهی کاریابی</div>
			  			</a>
			  		</li>
			  		<li>
						<a href="blocked.php">
		  					<div><i class="fa fa-bullhorn fa-2x"></i></div>
							<div>تبلیغات</div>
			  			</a>
			  		</li>
			  		<li>
						<a href="http://www.niazerasht.ir">
		  					<div><i class="fa fa-home fa-2x"></i></div>
							<div>صفحه اصلی</div>
			  			</a>
			  		</li>
				  </ul>
			   </div>
		      </div>
          			<div class="login">
						<a href="#" id="myModallink" class="loginmodal"><i class="fa fa-user fa-2x" data-toggle="modal" data-target="#myModal"></i></a>
	      			</div>
           </nav>
</header>

<!-- Search -->
	<section id="search">
		<div class="container text-center">
			<div class="row">
			<div class="pnl-search">
				<div class="panel-heading">
					<h5>جستجوی آگهی و مشاغل</h5>
				</div>
				<div class="search col-md-6 pull-right">
					<div class="input-group" style="direction: ltr">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary">جستجو کن</button>
						</div><input type="text" class="form-control" placeholder="کلمه یا حرفی را برای یافتن آگهی استخدامی وارد نمایید" style="direction: rtl">
					</div>
				</div>
				<div class="result-search">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ردیف</th>
								<th>عنوان آگهی</th>
								<th>توضیحات</th>
								<th>تاریخ</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>استخدام مهندس پلیمر در رشت</td>
								<td>شامل بیمه + پاداش</td>
								<td>1396/04/11</td>
							</tr>
							<tr>
								<td>2</td>
								<td>استخدام مهندس پلیمر در رشت</td>
								<td>شامل بیمه + پاداش</td>
								<td>1396/04/11</td>
							</tr>
							<tr>
								<td>3</td>
								<td>استخدام مهندس پلیمر در رشت</td>
								<td>شامل بیمه + پاداش</td>
								<td>1396/04/11</td>
							</tr>
							<tr>
								<td>4</td>
								<td>استخدام مهندس پلیمر در رشت</td>
								<td>شامل بیمه + پاداش</td>
								<td>1396/04/11</td>
							</tr>
						</tbody>
					</table>
				</div>
				
			</div>
			</div>
		</div>
	</section>

  	<!-- footer -->
	<footer id="footer">
    	<div class="container text-center">
        	<div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-logo">
                        <a href="index.php"><h2 class="logo-txt">نیاز رشت</h2></a>
                        <a href="index.php"><h6 class="logo-txt">تبلیغات/استخدام و کاریابی</h6></a>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-logo">
                        <h4 class="footer-text">در شبکه های اجتماعی دنبال کنید</h4>
                        <div class="footer-img">
                        	<ul>
                            	<li class="facebook"><a href="https://www.facebook.com/niazerasht"><i class="fa fa-facebook-square"></i></a></li>
                                <li class="twitter"><a href="https://twitter.com/niazerasht"><i class="fa fa-twitter-square"></i></a></li>
                                <li class="instagram"><a href="http://instagram.com/niazerasht"><i class="fa fa-instagram"></i></a></li>
                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                                <li class="telegram"><a href="http://telegram.me/niazerasht"><i class="fa fa-telegram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-logo text-center">
                        <h4 class="footer-text">عضویت در خبرنامه</h4>
                        <div class="input-group">
                            <div class="input-group-btn">
                            	<button class="btn" id="btn-submits" type="submit">ارسال</button>
                            </div>
                            <input class="form-control" id="txt-email" type="text" placeholder="ایمیل خود را وارد کنید...">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-logos">
                        <h5 class="footer-text">مختصری از نیاز رشت</h5>
                        <p class="mini-about text-justify">
                        	وب سایت نیاز رشت در سال 1396 تاسیس شده است. فعالیت های این وب سایت بیشتر در حوزه کاریابی و تبلیغات بصورت درون شهری، فضای مجازی و ... می باشد. 
                        </p>
                    </div>
                </div>

            </div>
            
        </div>
        <span class="go-top">
            <a href="#top"><i class="fa fa-chevron-circle-up"></i></a>
        </span>
        <span class="text-center">
        <h6 class="footer-copyright"><i class="fa fa-copyright"></i> Copyright 2017 &nbsp; طراحی توسعه و پشتیبانی توسط تیم طراحی و توسعه رش بیت</h6>
        </span>
    </footer>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nicescroll.js"></script>
    
    <!-- wow animation -->
    <script>
		new WOW().init();
	</script>
    
<!-- Go top -->
	<script>
    	$(document).ready(function(){
     
        // hide #back-top first
        $(".go-top").hide();
         
        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 250) {
                    $('.go-top').fadeIn();
                } else {
                    $('.go-top').fadeOut();
                }
         });
     
        // scroll body to 0px on click
		$('.go-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
        });    
    	});
    </script>
	
	<!-- NiceScroll -->
    <script>
    $(document).ready(function(){
		$("html").niceScroll({
        preservenativescrolling: false,
        cursorwidth: '12px',
        cursorborder: 'none',
        cursorborderradius:'0px',
        cursorcolor:"#3F4D58",
        background:"#999999",
		zindex:'9999999'
        });
    });
    </script> 
    
    	<!-- Login Modal -->
	<script>
	$(document).ready(function(){
  		var loginmodal = function(id) {
		id = id.replace("link", "");
			$("html, body").animate({scrollTop: $("#" + id).offset().top});
  		}
   
  		$('.loginmodal').on("click", function(e){
    	e.preventDefault();
    	loginmodal($(this).attr("id")); 
  		});
	});
	</script>
    
  </body>
</html>
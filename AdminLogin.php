<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>پنل ورود مدیر</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/admin.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Login Panel -->
   <div class="container">
    <div class="container">
	 <div class="form-signin">
      <div class="panel panel-primary">
      	<div class="panel-heading">
        	<h4 class="form-signin-heading">ورود به پنل</h4>
        </div>
        <div class="panel-body">
           	<div id="adminresualt">
           		
           	</div>
            <input type="email" id="inputEmail" class="form-control" placeholder="ایمیل" autofocus>
            <br>
            <input type="password" id="inputPassword" class="form-control" placeholder="کلمه عبور">
            <div class="checkbox">
            <input type="checkbox" value="" class="check-box" id="Rcheck"><label class="check-txt">مرا به خاطر بسپار</label>  
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="adminslogin" >ورود</button>
        </div>
      </div>
	 </div>
    </div>
  </div> 
  <!-- /container -->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Ajax Send Value --> 
  <script type="text/javascript">
		$(document).ready(function(){
			$("#adminslogin").click(function(){
				var AdminEmail = $("#inputEmail").val();
				var AdminPass = $("#inputPassword").val();
				var AdminRemember = $("#Rcheck").is(":checked");
				if(AdminRemember){
					AdminRemember = "1";
				} else {
					AdminRemember = "0";
				}
				var Asend = true;
				$.post("./inc_func/set-ajax.php",{AdminEmail:AdminEmail,AdminPass:AdminPass,AdminRemember:AdminRemember,Asend:Asend},function(data){
					$("#adminresualt").show();
					$("#adminresualt").html(data);
					if($("#adminresualt [data-success]").attr("data-success") === "true") {
						$("#inputEmail").val("");
						$("#inputPassword").val("");
					}
				});
			});
		});
	  </script>
	
  </body>
</html>
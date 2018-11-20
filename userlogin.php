<?php include('./inc_theme/headerP.php') ?>
<?php include('./inc_theme/modal.php') ?>
<?php
	if (isset($_SESSION['usrLogin']) && $_SESSION['usrLogin'] != ""){
	header("location:./user/userprofile.php");
	exit();
}
?>
<!-- User Login -->
	<section id="userlogin">
		<div class="container text-center">
			<div class="form-signin" style="margin-top: 20px">
      <div class="panel panel-primary" style="height: auto">
      	<div class="panel-heading">
        	<h4 class="form-signin-heading">ورود به پنل</h4>
        </div>
        
        <div class="panel-body">
           <div id="usrmsg"></div>
            <label for="inputUsername" class="sr-only">نام کاربری</label>
            <input type="text" id="inputusrnu" name="inputusrnu" class="form-control" placeholder="نام کاربری" autofocus>
            <label for="inputPassword" class="sr-only">کلمه عبور</label>
            <input type="password" id="inputPaswordu" name="inputPaswordu" class="form-control" placeholder="کلمه عبور">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="uchkbox" name="uchkbox" value="remember-me" class="check-box"><label class="check-txt">مرا به خاطر بسپار</label>
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" id="usrlogn" name="usrlogn">ورود</button>
            <h5><a href="#" data-toggle="modal" data-target="#RegModal" data-dismiss="modal">ایجاد حساب کاربری</a></h5>
            <h5><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgetpass">رمز عبور را فراموش کردم</a></h5>
        </div>
      </div>
      </div>
		</div>
	</section>

<?php include('./inc_theme/footer.php') ?>
<?php include('./inc_theme/jquerylink.php') ?>
   <script type="text/javascript">
		$(document).ready(function(){
			$("#usrlogn").click(function(){
				var usernmaeu = $("#inputusrnu").val();
				var userPassu = $("#inputPaswordu").val();
				var userRememberu = $("#uchkbox").is(":checked");
				if(userRememberu){
					userRememberu = "1";
				} else {
					userRememberu = "0";
				}
				var Usend = true;
				$.post("./inc_func/set-ajax.php",{usernmaeu:usernmaeu,userPassu:userPassu,userRememberu:userRememberu,Usend:Usend},function(data){
					$("#usrmsg").show();
					$("#usrmsg").html(data);
					if($("#usrmsg [data-success]").attr("data-success") === "true") {
						$("#inputusrnu").val("");
						$("#inputPaswordu").val("");
					}
				});
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
<?php
error_reporting(0);

?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ADDRESS ?>js/bootstrap.min.js"></script>
  	<script src="<?php echo ADDRESS ?>js/numscroller-1.0.js"></script>
    <script src="<?php echo ADDRESS ?>js/wow.min.js"></script>
    <script src="<?php echo ADDRESS ?>js/nicescroll.js"></script>
    <script src="<?php echo ADDRESS ?>js/ityped.min.js"></script>
	<script src="<?php echo ADDRESS ?>js/canvas.js"></script>
	<!-- Main text animation -->
   	<script type="text/javascript">
		ityped.init('#ityped', {
			strings:['پرتال نیازمندی های استان گیلان','استخدام و کاریابی','تبلیغات و بازاریابی','آشنایی با مناطق دیدنی و گردشگری گیلان','معرفی سازمان ها ، ادارات و شرکت ها','اطلاع رسانی فیلم های سینما و کنسرت ها','آگاهی از اخبار و رویداد های استان'],
			startDelay: 300,
			typeSpeed:200,
			showCursor:false,
			loop: true
		});
	</script>
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
    <!-- Go Contact-us -->
	<script>
	$(document).ready(function(){
  		var gocontactus = function(id) {
		id = id.replace("link", "");
			$("html, body").animate({scrollTop: $("#" + id).offset().top-95});
  		}
   
  		$('.gocontactus').on("click", function(e){
    	e.preventDefault();
    	gocontactus($(this).attr("id")); 
  		});
	});
	</script>
	<!-- NiceScroll Document -->
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
    <!-- NiceScroll fix-panel -->
    <script>
	$(document).ready(function(){		
        $("div.fix-panel").niceScroll({
			preservenativescrolling: false,
			cursortop:'0px',
			cursorright:'0px',
			cursorborder:'none',
			cursorborderradius:'1px',
			cursorclear:'both',
			cursorvisibility:'hidden',
			cursorzindex:'-99999',
			cursorposition:'fixed',
			cursorfixed: true,
			});
    });
	</script>
    <!-- GO Down -->
    <script>
	$(document).ready(function(){
  		var goslider = function(id) {
		id = id.replace("link", "");
			$("html, body").animate({scrollTop: $("#" + id).offset().top-90});
  		}
   
  		$('.goslider').on("click", function(e){
    	e.preventDefault();
    	goslider($(this).attr("id")); 
  		});
	});
	</script>
	<!-- GO To Job -->
    <script>
	$(document).ready(function(){
  		var gojob = function(id) {
		id = id.replace("link", "");
			$("html, body").animate({scrollTop: $("#" + id).offset().top-90});
  		}
   
  		$('.gojob').on("click", function(e){
    	e.preventDefault();
    	gojob($(this).attr("id")); 
  		});
	});
	</script>
	<!-- GO To Co advs -->
	    <script>
	$(document).ready(function(){
  		var gocoadvs = function(id) {
		id = id.replace("link", "");
			$("html, body").animate({scrollTop: $("#" + id).offset().top-110});
  		}
   
  		$('.gocoadvs').on("click", function(e){
    	e.preventDefault();
    	gocoadvs($(this).attr("id")); 
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
	<!-- Tooltip -->
    <script>
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- bhoechie-tab -->
	<script>
	$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    	});
	});	
	</script>
	<!-- Ajax - Insert -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#insert").click(function(){
				var fname = $(".fname").val();
				var uname = $(".uname").val();
				var emails = $(".email1").val();
				var pass = $(".pass1").val();
				var usertype = $(".usertype").val();
				var send = true;
				$.post("./inc_func/set-ajax.php",{firstname:fname,username:uname,email:emails,password:pass,usertype:usertype,isend:send},function(data){
					$(".msg_error").show();
					$(".msg_error").html(data);
					if($(".msg_error [data-success]").attr("data-success") === "true") {
						$(".fname").val("");
						$(".uname").val("");
						$(".email1").val("");
						$(".pass1").val("");
						$(".usertype").val(0);
					}
				});
			});
		});
	</script>
	<!-- Ajax - Login -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".logins").click(function(){
				var usrname = $("#usrname").val();
				var psw = $("#psw").val();
				var remember =$("#chkbox").is(":checked");
				if(remember){
					remember = "1";
				} else {
					remember = "0";
				}
				var send = true;
				$.post("./inc_func/set-ajax.php",{usrname:usrname,psw:psw,remember:remember,lsend:send},function(data){
					$(".msg_error2").show();
					$(".msg_error2").html(data);
					if($(".msg_error2 [data-success]").attr("data-success") === "true") {
						$("#usrname").val("");
						$("#psw").val("");
					}
				});
			});
		});
	</script>
	<!-- Ajax - Forget pass -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#recoverpass").click(function(){
				var email = $("#email2").val();
				var send = true;
				$.post("./inc_func/set-ajax.php",{femail:email,fsend:send},function(data){
					$(".msg_error3").show();
					$(".msg_error3").html(data);
					if($(".msg_error3 [data-success]").attr("data-success") === "true") {
						$("#email2").val("");
					}
				});
			});
		});
	</script>
	<!-- Ajax - karfarma profile edit -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#usredit").click(function(){
				var fnames = $("#fname").val();
				var unames = $("#uname").val();
				var emailss = $("#emaile").val();
				var mobile = $("#mobile").val();
				var ostan = $("#ostan").val();
				var city = $("#city").val();
				var coname = $("#coname").val();
				var cotel = $("#cotel").val();
				var coemail = $("#coemail").val();
				var coweb = $("#coweb").val();
				var coaddress = $("#coaddress").val();
				var ide = $("#ide").val();
				var esend = true;
				
				$.post("../inc_func/set-ajax.php",{fnames:fnames,unames:unames,emailss:emailss,mobile:mobile,ostan:ostan,city:city,coname:coname,cotel:cotel,coemail:coemail,coweb:coweb,coaddress:coaddress,ide:ide,esend:esend},function(data){
					$("#editres").show();
					$("#editres").html(data);
					if($("#editres [data-success]").attr("data-success") === "true") {
						$("#image").val("");
					}
				});
			});
		});
	</script>
	<!-- Ajax - user profile edit -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#usrsedit").click(function(){
				var fnameu = $("#fnameu").val();
				var unameu = $("#unameu").val();
				var emailsu = $("#emaileu").val();
				var mobileu = $("#mobileu").val();
				var ostanu = $("#ostanu").val();
				var cityu = $("#cityu").val();
				var ideu = $("#ideu").val();
				var esendu = true;
				
				$.post("../inc_func/set-ajax.php",{fnameu:fnameu,unameu:unameu,emailsu:emailsu,mobileu:mobileu,ostanu:ostanu,cityu:cityu,ideu:ideu,esendu:esendu},function(data){
					$("#editresu").show();
					$("#editresu").html(data);
					if($("#editresu [data-success]").attr("data-success") === "true") {
						$("#image").val("");
					}
				});
			});
		});
	</script>
	<!-- Ajax - karfarma edit pass -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#eidtpass").click(function(){
				var oldpass = $("#oldpass").val();
				var newpass = $("#newpass").val();
				var newpasss = $("#newpasss").val();
				var idk = $("#idk").val();
				var edsend = true;
				$.post("../inc_func/set-ajax.php",{oldpass:oldpass,newpass:newpass,newpasss:newpasss,idk:idk,edsend:edsend},function(data){
					$("#editpassres").show();
					$("#editpassres").html(data);
					if($("#editpassres [data-success]").attr("data-success") === "true") {
						$("#oldpass").val("");
						$("#newpass").val("");
						$("#newpasss").val("");
					}
				});
			});
		});
	</script>
	<!-- Ajax - user edit pass -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#eidtpassu").click(function(){
				var oldpassu = $("#oldpassu").val();
				var newpassu = $("#newpassu").val();
				var newpasssu = $("#newpasssu").val();
				var ideu = $("#idu").val();
				var edsendu = true;
				$.post("../inc_func/set-ajax.php",{oldpassu:oldpassu,newpassu:newpassu,newpasssu:newpasssu,ideu:ideu,edsendu:edsendu},function(data){
					$("#editpassresu").show();
					$("#editpassresu").html(data);
					if($("#editpassresu [data-success]").attr("data-success") === "true") {
						$("#oldpassu").val("");
						$("#newpassu").val("");
						$("#newpasssu").val("");
					}
				});
			});
		});
	</script>
	
	<script type="text/javascript">
		$("#create").click(function(){
			$(".fname").val("");
			$(".uname").val("");
			$(".email1").val("");
			$(".pass1").val("");
			$(".usertype").val(0);
			$(".msg_error").hide();
		});
	</script>
	<script type="text/javascript">
		$("#creates").click(function(){
			$(".fname").val("");
			$(".uname").val("");
			$(".email1").val("");
			$(".pass1").val("");
			$(".usertype").val(0);
			$(".msg_error").hide();
		});
	</script>
	<script type="text/javascript">
		$("#Loginn").click(function(){
			$("#usrname").val("");
			$("#psw").val("");
			$(".msg_error2").hide();
		});
	</script>
	<script type="text/javascript">
		$("#forget").click(function(){
			$("#emails").val("");
			$(".msg_error3").hide();
			$(".fname").val("");
			$(".uname").val("");
			$(".email1").val("");
			$("#email2").val("");
			$(".pass1").val("");
			$(".usertype").val(0);
			$(".msg_error").hide();
		});
	</script>
	<script type="text/javascript">
		$("#myModallink").click(function(){
			$("#emails").val("");
			$(".msg_error3").hide();
			$(".fname").val("");
			$(".uname").val("");
			$(".email1").val("");
			$(".pass1").val("");
			$(".usertype").val(0);
			$(".msg_error").hide();
			$(".msg_error2").hide();
			$("#email2").val("");
			$(".msg_error3").hide();
		});
	</script>
	<!-- Ajax - contact us -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#Csendcontact").click(function(){
				var ussrid = $("#Cid").val(); 
				var email = $("#Cemail").val();
				var mobile = $("#Cmobile").val();
				var name = $("#Cname").val();
				var type = $("#Ctype").val();
				var title = $("#Ctitle").val();
				var text = $("#Ctxt").val();
				var cSend = true;
				$.post("./inc_func/set-ajax.php",{ussrid:ussrid,email:email,mobile:mobile,name:name,type:type,title:title,text:text,cSend:cSend},function(data){
					$("#contactres").show();
					$("#contactres").html(data);
					if($("#contactres [data-success]").attr("data-success") === "true") {
					 $("#Ctype").val(0);	
					 $("#Ctitle").val("");
					 $("#Ctxt").val("");
					}
				});
			});
		});
	</script>
	
	
	
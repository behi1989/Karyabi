<?php require_once('./inc_theme/headerP.php') ?>
<?php require_once('./inc_theme/modal.php') ?>

<!-- Company adv -->
	<section id="company-adv">
		<div class="container-fluid text-center">
			<div class="back-adv text-center col-md-4 col-sm-6 pull-right">
				<h3>کسب و  کار خود را به دیگران معرفی کنید</h3>
<?php
if (isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$User = new User();
		$session = $_SESSION['usrLogin'];
		$res = $User->SelectLoginUser($session);
		foreach($res as $rows){
			$unmae = $rows['_username'];
			$ids = $rows['_id'];
		}
			if($unmae == $session){	
?>
				<button type="button" class="btn pull-left" id="btn-sabt1" onClick="window.location='./user/userprofile.php'"><i class="fa fa-angle-left" ></i>&nbsp; ثبت در پروفایل</button>
<?php
		}
	}
}else
{
?>
	<button type="button" class="btn pull-left" data-toggle="modal" data-target="#RegModal" id="btn-sabt1"><i class="fa fa-angle-left" ></i>&nbsp; عضو شوید</button>
<?php	
}
?>
			</div>
		</div>
	</section>
	<section id="company-advert">
		<div class="container text-center">
			<div class="row" style="padding: 0 50px">
			
			<div class="last-mashaqel" style="float: right;position: relative;width: 100%">
			<div class="head-mashaqel" style="width:100%;text-align:right;margin-top:-20px;margin-bottom:-15px;direction: rtl">
					<div class="page-header text-right" style="border-color:#8657DB">
						<h4>مشاغل تصادفی</h4>
					</div>
			</div>
<?php
$DB = new DB();
$Mashaqel = new Mashaqel();	
$resM = $Mashaqel->ReadLastMashaqel();
foreach($resM as $rows)
{
?>				
				<div class="col-md-3 col-sm-6">
					<div class="img-thumbss">
						<img src="./_upload/mashaqel/<?php echo $rows['_coImage']; ?>" style="width: 250px;height: 250px;" class="img-responsive">
						<figcaption>
							<h3><?php echo $rows['_coname']; ?></h3>
							<p>تعداد بازدید : <?php echo $rows['_visited']; ?> <i class="glyphicon glyphicon-stats"></i><br><a href="./co-detile.php?id=<?php echo $rows['_id']; ?>">مشاهده جزییات <i class="glyphicon glyphicon-menu-down"></i></a></p>
						</figcaption>	
					</div>
				</div>
<?php
}
?>
			</div>
			<div class="rand-mashaqel" style="float: right;position: relative;width: 100%">
			<div class="head-mashaqel" style="width:100%;text-align:right;margin-top:10px;margin-bottom:-15px;direction: rtl">
					<div class="page-header text-right" style="border-color:#8657DB">
						<h4>لیست مشاغل</h4>
					</div>
			</div>
			
<?php
$DB = new DB();
$Mashaqel = new Mashaqel();
$limit = 8;
$resM = $Mashaqel->ReadRndMashaqel($limit);
$Mid = '';
foreach($resM as $rows)
{
?>				
				<div class="col-md-3 col-sm-6">
				
							<div class="img-thumbss">
								<img src="./_upload/mashaqel/<?php echo $rows['_coImage']; ?>" style="width: 250px;height: 250px;" class="img-responsive">
							<figcaption>
								<h3><?php echo $rows['_coname']; ?></h3>
								<p>تعداد بازدید : <?php echo $rows['_visited']; ?> <i class="glyphicon glyphicon-stats"></i><br><a href="./co-detile.php?id=<?php echo $rows['_id']; ?>">مشاهده جزییات <i class="glyphicon glyphicon-menu-down"></i></a></p>
							</figcaption>	
							</div>
				
				</div>
<?php
$Mid = $rows['_id'];
}
?>
				</div>
			
<?php
$Mashaqel = new Mashaqel();
$resC = $Mashaqel->MashaqelCount();
if($resC >= 8)
{
?>
				<div class="more-adv col-xs-12">
					<span><i class="glyphicon glyphicon-menu-down" name="btn-more" id="btn-mor"  data-toggle="tooltip" data-placement="top" data-mid="<?php echo $Mid; ?>" title="مشاهده بیشتر"></i></span>
				</div>
<?php
}
?>
			</div>
		</div>
	</section>
 	
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-sabt").click(function(){
		$(".fname").val("");
		$(".uname").val("");
		$(".email1").val("");
		$(".pass1").val("");
		$(".usertype").val(0);
		$(".msg_error").hide();
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#btn-mor',function(){
			var last_Mid = $(this).data('mid');
			var lmd = true;
			$.ajax({
				url:"./inc_func/set-ajax.php",
				method:"POST",
				data:{last_Mid:last_Mid,lmd:lmd},
				dataType:"Text",
				success:function(data){
					if(data != ''){
						$(".more-adv").remove();
						$(".rand-mashaqel").append(data);
					}else{
						$(".more-adv").hide();
					}
				}
			});
		});
	});
</script>
 
  </body>
</html>
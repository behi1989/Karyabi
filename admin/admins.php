<?php require_once('./inc_theme/header.php') ?>
<?php
if (isset($_SESSION['adminLogin'])){
	if($_SESSION['adminLogin'] != ""){
		$Admin = new Admin();
		$session = $_SESSION['adminLogin'];
		$res = $Admin->SelectLoginAdmin($session);
		foreach($res as $rows){
			$idd2 = $rows['_id'];
			$level = $rows['_level'];
		}
	}
}
?>
  <!-- Modal -->
  <div class="modal fade" id="msgModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="direction: rtl">
        <div class="modal-header">
          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
          <p class="modal-title" style="color: red">حذف</p>
        </div>
        <div class="modal-body">
          <p class="alert" style="color: green">حذف با موفقیت انجام شد</p>
          <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
        </div>
      </div>
    </div>
  </div>
    
        <div class="col-sm-9 col-md-10 main">
				<div id="editjob">
					
				<section>
					<div class="row">
						<div class="addadmin">
						<div id="msgadmin"></div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>ثبت ادمین جدید</h4>
						</div>
						<div class="panel-body">
						
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<input type="text" name="adname" id="adname" placeholder="نام و نام خانوادگی" class="form-control">
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<input type="text" name="ademail" id="ademail" placeholder="ایمیل" class="form-control">
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<input type="text" name="adpass" id="adpass" placeholder="رمز عبور" class="form-control">
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<input type="text" name="adtel" id="adtel" placeholder="شماره تماس" class="form-control">
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<input type="text" name="adostan" id="adostan" placeholder="استان" class="form-control">
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<input type="text" name="adcity" id="adcity" placeholder="شهر" class="form-control">
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<select class="btn btn-block dropdown form-control" name="admintype" id="admintype" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
									<option value="1">مدیر سایت</option>
									<option value="2">مدیر پشتیبان سایت</option>
									<option value="3">مدیر تبلیغات</option>
								</select>
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
								<select class="btn btn-block dropdown form-control" name="adlevel" id="adlevel" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
									<option value="1">دسترسی کامل</option>
									<option value="2">دسترسی محدود</option>
								</select>
							</div>
							<div class="col-md-4 pull-right" style="padding: 5px 15px">
							<?php
							if($level==1){
								echo '<button type="submit" name="adsubmit" id="adsubmit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; ثبت مدیر</button>';
							}else if($level==2){
								echo '<button type="submit" disabled class="btn btn-success"><i class="fa fa-check"></i>&nbsp; ثبت مدیر</button>';
							}
							?>
								
							</div>
							
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>تغییر کلمه عبور</h4>
						</div>
						<div class="panel-body">
							<input type="hidden" id="adminid" name="adminid" value="<?php echo $idd2 ?>">
							<div class="col-md-3 pull-right" style="padding: 5px 15px">
								<input type="text" name="oldpasss" id="oldpasss" placeholder="کلمه عبور قبلی" class="form-control">
							</div>
							<div class="col-md-3 pull-right" style="padding: 5px 15px">
								<input type="text" name="newpasss" id="newpasss" placeholder="کلمه عبور جدید" class="form-control">
							</div>
							<div class="col-md-3 pull-right" style="padding: 5px 15px">
								<input type="text" name="r_newpass" id="r_newpass" placeholder="تکرار کلمه عبور جدید" class="form-control">
							</div>
							<div class="col-md-3 pull-right" style="padding: 5px 15px">
								<button type="submit" name="chngpasssubmit" id="chngpasssubmit" class="btn btn-warning"><i class="fa fa-refresh"></i>&nbsp; تغییر کلمه عبور</button>
							</div>
						</div>
					</div>
						</div>
					</div>
			  	</section>

					<div id="adminshow" style="margin-top: -20px"></div>

				</div>
        </div>
	  </div>
	</div>
<?php include('./inc_theme/jquery.php') ?>
 
<script type="text/javascript">
	resualtadmin()
	function resualtadmin(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusadmin=dispadmin&pageadmin="+page,false);
		xmlhttp.send(null);
		document.getElementById("adminshow").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkadmin', function(){
			var page = $(this).attr("id");
			resualtadmin(page);
		});
</script>
<script type="text/javascript">
	function admindelete(id){
		var adminid = id;
		var admindsend = true;
		$.post("set-ajax.php",{adminid:adminid,admindsend:admindsend},function(data){
			$("#msgModal").modal('show');
			
		});
		resualtadmin();
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#adsubmit").click(function(){
			var adname = $("#adname").val();
			var ademail = $("#ademail").val();
			var adpass = $("#adpass").val();
			var adtel = $("#adtel").val();
			var adostan = $("#adostan").val();
			var adcity = $("#adcity").val();
			var admintype = $("#admintype").val();
			var adlevel = $("#adlevel").val();
			var adminsend = true;
			$.post("./set-ajax.php",{adname:adname,ademail:ademail,adpass:adpass,adtel:adtel,adostan:adostan,adcity:adcity,admintype:admintype,adlevel:adlevel,adminsend:adminsend},function(data){
				$("#msgadmin").html(data);
				if($("#msgadmin [data-success]").attr("data-success") === "true") {
					$("#adname").val('');
					$("#ademail").val('');
					$("#adpass").val('');
					$("#adtel").val('');
					$("#adostan").val('');
					$("#adcity").val('');
					$("#admintype").val(1);
					$("#adlevel").val(1);
				}
			});
			resualtadmin();
		});
	});
</script>
<script type="text/javascript">
	$("#chngpasssubmit").click(function(){
		var old_pass = $("#oldpasss").val();
		var new_pass = $("#newpasss").val();
		var rnew_pass = $("#r_newpass").val();
		var adminid = $("#adminid").val();
		var btnchangepass = true;
		$.post("./set-ajax.php",{old_pass:old_pass,new_pass:new_pass,rnew_pass:rnew_pass,adminid:adminid,btnchangepass:btnchangepass},function(data){
			$("#msgadmin").html(data);
			if($("#msgadmin [data-success]").attr("data-success") === "true") {
					$("#oldpasss").val('');
					$("#newpasss").val('');
					$("#r_newpass").val('');
				}
		});
	});
</script>	
<script type="text/javascript">
	function adminAllLevel(id){
		var admin_id = id;
		var sendadminaccess = true;
		$.post("./set-ajax.php",{admin_id:admin_id,sendadminaccess:sendadminaccess},function(data){
			resualtadmin();
		});
	}
	
	function adminLimitLevel(id){
		var admin_ids = id;
		var sendadminaccesss = true;
		$.post("./set-ajax.php",{admin_ids:admin_ids,sendadminaccesss:sendadminaccesss},function(data){
			resualtadmin();
		});
	}
</script>	
  </body>
</html>
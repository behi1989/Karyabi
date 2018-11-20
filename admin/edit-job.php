<?php include('./inc_theme/header.php') ?>

<?php
if (isset($_SESSION['adminLogin'])){
	if($_SESSION['adminLogin'] != ""){
		$Admin = new Admin();
		$session = $_SESSION['adminLogin'];
		$res = $Admin->SelectLoginAdmin($session);
		foreach($res as $rows){
			$idd = $rows['_id'];
		}
	}
}
?>       
          <!-- Delete Modal -->
  <div class="modal fade" id="msgModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="direction: rtl">
        <div class="modal-header">
          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
          <p class="modal-title" style="color: red">پیغام حذف</p>
        </div>
        <div class="modal-body">
          <p class="alert" style="color: green">حذف با موفقیت انجام شد</p>
          <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
        </div>
      </div>
    </div>
  </div>
       
        <div class="col-sm-9 col-md-10 main">
          <ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#addjob"><i class="fa fa-plus-circle"></i>&nbsp; درج آگهی</a></li>
				<li><a data-toggle="tab" href="#editjob"><i class="fa fa-refresh"></i>&nbsp; ویرایش آگهی</a></li>
		  </ul>
			 <div class="tab-content">
				<div id="addjob" class="tab-pane fade in active">
				  <div class="col-md-6 col-xs-12 pull-right">
          		<table class="table table-hover">
							<thead style="background: #444;color: #FFF">
							<tr>
								<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
								<th style="text-align: center">توضیحات</th>
							</tr>
							</thead>
							<tbody>
								<input type="hidden" id="idd" name="idd" value="<?php echo $idd; ?>">
								<tr>
									<td>عنوان آگهی &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="title" id="title" class="form-control"></td>
								</tr>
								<tr>
									<td>نام شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="coname" id="coname" class="form-control"></td>
								</tr>
								<tr>
									<td>نام درخواست دهنده &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="bossname" id="bossname" class="form-control"></td>
								</tr>
								<tr>
									<td>آدرس شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="coAddress" id="coAddress" class="form-control"></td>
								</tr>
								<tr>
									<td>تلفن &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="tel" id="tel" class="form-control"></td>
								</tr>
								<tr>
									<td>موبایل</td>
									<td><input type="text" name="mobile" id="mobile" class="form-control"></td>
								</tr>
								<tr>
									<td>ایمیل</td>
									<td><input type="text" name="email" id="email" class="form-control"></td>
								</tr>
								<tr>
									<td>وب سایت</td>
									<td><input type="text" name="web" id="web" class="form-control"></td>
								</tr>
								<tr>
									<td>شغل درخواستی &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="jobreq" id="jobreq" class="form-control"></td>
								</tr>
								<tr>
									<td>تحصیلات &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="edu" id="edu" class="form-control"></td>
								</tr>
								<tr>
									<td>رشته تحصیلی</td>
									<td><input type="text" name="degree" id="degree" class="form-control"></td>
								</tr>
								<tr>
									<td>گرایش</td>
									<td><input type="text" name="sience" id="sience" class="form-control"></td>
								</tr>
								<tr>
									<td>تعداد نیرو &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="reqno" id="reqno" class="form-control"></td>
								</tr>
								<tr>
									<td>تخصص &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="export" id="export" class="form-control"></td>
								</tr>
								<tr>
									<td>جنسیت &nbsp;<strong style="color: red">*</strong></td>
									<td>
									<select class="btn btn-block dropdown form-control" name="gender" id="gender" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
										<option value="1">مرد</option>
										<option value="2">زن</option>
										<option value="3">مرد یا زن</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>سن مورد نیاز &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="age" id="age" class="form-control"></td>
								</tr>
								<tr>
									<td>تاهل &nbsp;<strong style="color: red">*</strong></td>
									<td>
									<select class="btn btn-block dropdown form-control" name="married" id="married" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
										<option value="1">مجرد</option>
										<option value="2">متاهل</option>
										<option value="3">فرقی نمی کند</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>وضعیت بیمه &nbsp;<strong style="color: red">*</strong></td>
									<td>
									<select class="btn btn-block dropdown form-control" name="bime" id="bime" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
										<option value="1">دارد</option>
										<option value="2">ندارد</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>وضعیت نظام وظیفه &nbsp;<strong style="color: red">*</strong></td>
									<td>
									<select class="btn btn-block dropdown form-control" name="khedmat" id="khedmat" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
										<option value="1">پایان خدمت</option>
										<option value="2">معاف</option>
										<option value="3">در حال خدمت</option>
										<option value="4">معاف تحصیلی</option>
										<option value="5">نیاز نیست</option>
									</select>
									</td>
								</tr>
								<tr>
									<td>ایاب و ذهاب &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="ayabzahab" id="ayabzahab" class="form-control"></td>
								</tr>
								<tr>
									<td>زمان کار &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="worktime" id="worktime" class="form-control"></td>
								</tr>
								<tr>
									<td>حقوق پرداختی &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="workpay" id="workpay" class="form-control"></td>
								</tr>
								<tr>
									<td>شهر محل کار &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" name="workcity" id="workcity" class="form-control"></td>
								</tr>
								<tr>
									<td>توضیحات</td>
									<td><input type="text" name="expalin" id="expalin" class="form-control"></td>
								</tr>
								<tr>
									<td></td>
									<td style="text-align: left">
										<button type="submit" name="insertadvs" id="insertadvs" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; ثبت آگهی</button>
									</td>
								</tr>
							</tbody>
						</table>
         			<div id="resins"></div>
          	</div>
				</div>

				<div id="editjob" class="tab-pane fade">
				<div class="search col-md-6 pull-right" style="padding: 10px 0px;">
					<div class="input-group" style="direction: ltr;">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary">جستجو کن</button>
						</div><input type="text" class="form-control" placeholder="جستجو..." style="direction: rtl">
					</div>
				</div>
				<div id="resualtuadv"></div>
				<div id="resedituadv"></div>
				</div>
			</div>
        </div>

<?php require_once('./inc_theme/jquery.php') ?>

<script type="text/javascript">
		resualtadvu()
		function resualtadvu(page){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?statusu=dispu&pagejob="+page,false);
			xmlhttp.send(null);
			document.getElementById("resualtuadv").innerHTML = xmlhttp.responseText;
		}
			$(document).on('click', '.pagination_linkjob', function(){
			var page = $(this).attr("id");
			resualtadvu(page);
		});
</script>
<script type="text/javascript">		
		function updateadvu(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?id="+id+"&actionu=updateu",false);
			xmlhttp.send(null);
			document.getElementById("resedituadv").innerHTML = xmlhttp.responseText;
		}
			
		function deleteadvu(id){
			var iduu = id;
			var dadvsend = true;
			$.post("set-ajax.php",{iduu:iduu,dadvsend:dadvsend},function(data){
				$("#msgModal").modal("show");
			});
			resualtadvu()
		}
		
	</script>
	
	<script type="text/javascript">
	function updateuv(id){
		var uuid = id;
		var utitle = $("#titleu").val();
		var uconame = $("#conameu").val();
		var ubossname = $("#bossnameu").val();
		var ucoAddress = $("#coAddressu").val();
		var utel = $("#telu").val();
		var umobile = $("#mobileu").val();
		var uemail = $("#emailu").val();
		var uweb = $("#webu").val();
		var ujobreq = $("#jobrequ").val();
		var uedu = $("#eduu").val();
		var udegree = $("#degreeu").val();
		var usience = $("#sienceu").val();
		var ureqno = $("#reqnou").val();
		var uexports = $("#exportu").val();
		var ugender = $("#genderu").val();
		var uage = $("#ageu").val();
		var umarried = $("#marriedu").val();
		var ubime = $("#bimeu").val();
		var ukhedmat = $("#khedmatu").val();
		var uayabzahab = $("#ayabzahabu").val();
		var uworktime = $("#worktimeu").val();
		var uworkpay = $("#workpayu").val();
		var uworkcity = $("#workcityu").val();
		var uexpalin = $("#expalinu").val();
		var uesend = true;
		$.post("set-ajax.php",{uuid:uuid,utitle:utitle,uconame:uconame,ubossname:ubossname,ucoAddress:ucoAddress,utel:utel,umobile:umobile,uemail:uemail,uweb:uweb,ujobreq:ujobreq,uedu:uedu,udegree:udegree,usience:usience,ureqno:ureqno,uexports:uexports,ugender:ugender,uage:uage,umarried:umarried,ubime:ubime,ukhedmat:ukhedmat,uayabzahab:uayabzahab,uworktime:uworktime,uworkpay:uworkpay,uworkcity:uworkcity,uexpalin:uexpalin,uesend:uesend},function(data){
			$("#uresedu").show();
			$("#uresedu").html(data);
		});
		resualtadvu();
	}
	</script>
	
	
<script type="text/javascript">
$(document).ready(function(){
	$("#insertadvs").click(function(){
		var title = $("#title").val();
		var coname = $("#coname").val();
		var bossname = $("#bossname").val();
		var coAddress = $("#coAddress").val();
		var tel = $("#tel").val();
		var mobile = $("#mobile").val();
		var email = $("#email").val();
		var web = $("#web").val();
		var jobreq = $("#jobreq").val();
		var edu = $("#edu").val();
		var degree = $("#degree").val();
		var sience = $("#sience").val();
		var reqno = $("#reqno").val();
		var exports = $("#export").val();
		var gender = $("#gender").val();
		var age = $("#age").val();
		var married = $("#married").val();
		var bime = $("#bime").val();
		var khedmat = $("#khedmat").val();
		var ayabzahab = $("#ayabzahab").val();
		var worktime = $("#worktime").val();
		var workpay = $("#workpay").val();
		var workcity = $("#workcity").val();
		var expalin = $("#expalin").val();
		var idd = $("#idd").val();
		var sendav = true;
		$.post("./set-ajax.php",{title:title,coname:coname,bossname:bossname,coAddress:coAddress,tel:tel,mobile:mobile,email:email,web:web,jobreq:jobreq,edu:edu,degree:degree,sience:sience,reqno:reqno,exports:exports,gender:gender,age:age,married:married,bime:bime,khedmat:khedmat,ayabzahab:ayabzahab,worktime:worktime,workpay:workpay,workcity:workcity,expalin:expalin,idd:idd,sendav:sendav},function(data){
			$("#resins").html(data);
			if($("#resins [data-success]").attr("data-success") === "true") {
					$("#title").val("");
					$("#coname").val("");
					$("#bossname").val("");
					$("#coAddress").val("");
					$("#tel").val("");
					$("#web").val("");
					$("#mobile").val("");
					$("#email").val("");
					$("#jobreq").val("");
					$("#edu").val("");
					$("#degree").val("");
					$("#sience").val("");
					$("#reqno").val("");
					$("#export").val("");
					$("#gender").val(1);
					$("#age").val("");
					$("#married").val(1);
					$("#bime").val(1);
					$("#khedmat").val(1);
					$("#ayabzahab").val("");
					$("#worktime").val("");
					$("#workpay").val("");
					$("#workcity").val("");
					$("#expalin").val("");
					$("#idd").val("");
					
				}
			resualtadvu();
		});
	});
});
</script>
<script type="text/javascript">
	function taeedadvu(id){
		var jobid = id;
		var sendjobid = true;
		$.post("./set-ajax",{jobid:jobid,sendjobid:sendjobid},function(data){
			resualtadvu();
		});
	}
	
	function taliqdvu(id){
		var jobidt = id;
		var sendjobidt = true;
		$.post("./set-ajax",{jobidt:jobidt,sendjobidt:sendjobidt},function(data){
			resualtadvu();
		});
	}
</script>
<script type="text/javascript">
	function vijehadvu(id){
		var jobids = id;
		var sendjobids = true;
		$.post("./set-ajax",{jobids:jobids,sendjobids:sendjobids},function(data){
			resualtadvu();
		});
	}
</script>
  </body>
</html>

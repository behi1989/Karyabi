<?php require_once('./inc_theme/header.php') ?>
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
				<li class="active"><a data-toggle="tab" href="#ManageAdv"><i class="fa fa-server"></i>&nbsp; مدیریت تبلیغات</a></li>
				<li><a data-toggle="tab" href="#InsertAdv"><i class="fa fa-plus-circle"></i>&nbsp; درج تبلیغات</a></li>
		  </ul>
		 <div class="tab-content">
			<div id="ManageAdv" class="tab-pane fade in active">
				<div style="margin-top: 20px">
					<div id="resualtAdv"></div>
					<div id="resadvdel"></div>
					<div id="reseditAdv"></div>
				</div>
					
			</div>

			<div id="InsertAdv" class="tab-pane fade in">
				<div style="margin: 20px">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="adv-target" onsubmit="insert_adv();">
	<table class="table table-hover">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 200px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
			<tbody dir="rtl">
				<tr>
					<td>شماره کاربری سفارش دهنده &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="advcustomerid" id="advcustomerid" class="form-control"></td>
				</tr>
				
				<tr>
					<td>نام سفارش دهنده &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="advcustomername" id="advcustomername" class="form-control"></td>
				</tr>
				
				<tr>
					<td>تلفن سفارش دهنده &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="advcustomertel" id="advcustomertel" class="form-control"></td>
				</tr>
				
				<tr>
					<td>آدرس سفارش دهنده &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="advcustomeraddress" id="advcustomeraddress" class="form-control"></td>
				</tr>
				
				<tr>
					<td>وضعیت پرداخت تبلیغ &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="advpaystate" name="advpaystate">
						<option value="0">پرداخت شده</option>
						<option value="1">پرداخت نشده</option>
						</select> 
					</span>
					</td>
				</tr>
								
				<tr>
					<td>رسید پرداخت</td>
					<td><input type="text" name="advrecivepay" id="advrecivepay" class="form-control"></td>
				</tr>
				
				<tr>
					<td>پرداخت در بانک</td>
					<td><input type="text" name="advrecivebank" id="advrecivebank" class="form-control"></td>
				</tr>
				
				<tr>
					<td>انتخاب محل تبلیغ &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="advtype" name="advtype">
						<option value="0">درج در صفحه اصلی (سایز 60*468)</option>
						<option value="1">درج در صفحه کاریابی(سایز 250*300)</option>
						<option value="2">درج در صفحه اخبار(سایز 240*120)</option>
						<option value="3">درج در سایر صفحات (سایز 240*120)</option>
					</select> 
					</span>
					</td>
				</tr>
				
				<tr>
					<td>تصویر تبلیغ &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-3 pull-right">
						<div id="advpic"></div>
					</span>
					<span class="col-md-6 pull-right">
						<input name="adv-file" id="adv-file" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
			
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="advInsert" name="advInsert" class="btn btn-success" value="درج تبلیغ"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="adv-insert"></div>
		<iframe id="adv-target" name="adv-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
				</div>
			</div>

		</div>

		</div>
		
  
<?php require_once('./inc_theme/jquery.php') ?> 
<script type="text/javascript">
	resualtadv()
	function resualtadv(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statuss=dissp&pageadvs="+page,false);
		xmlhttp.send(null);
		document.getElementById("resualtAdv").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkadv', function(){
			var page = $(this).attr("id");
			resualtadv(page);
		});
</script>
<script type="text/javascript">
		function deleteadv(id){
		var idadv = id;
		var advdsend = true;
		$.post("set-ajax.php",{idadv:idadv,advdsend:advdsend},function(data){
			$("#msgModal").modal("show");
		});
		resualtadv()
	}		
		function updateadv(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?id="+id+"&actionadv=updateadv",false);
			xmlhttp.send(null);
			document.getElementById("reseditAdv").innerHTML = xmlhttp.responseText;
	}
</script>
	
<script type="text/javascript">
function insert_adv(){
      document.getElementById('upload-iprocess').style.visibility = 'visible';
      return true;
}

function Insert_advEnd(check_advEnd){
      var server_advresponse = '';
      if (check_advEnd == 1){
         server_advresponse = '<div class="alert alert-success alert-dismissable" style="color:white">تبلیغ با موفقیت ثبت شد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  $("#advcustomerid").val("");
		  $("#advcustomername").val("");
		  $("#advcustomertel").val("");
		  $("#advcustomeraddress").val("");
		  $("#advpaystate").val(0);
		  $("#advrecivepay").val("");
		  $("#advrecivebank").val("");
		  $("#advtype").val(0);
		  resualtadv();
      }
      else {
         server_advresponse = '<div class="alert alert-danger alert-dismissable" style="color:white">متاسفانه تبلیغ ثبت نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		 
      }
     
      document.getElementById('adv-insert').innerHTML = server_advresponse;
      return true;
	  }
</script>
<script>
$("#adv-file").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#advpic");
            image_holder.empty();
 
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
					"style": "width:200px;height:200px"
                }).appendTo(image_holder);
 
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });
</script>


<script type="text/javascript">
function update_adv(){
      document.getElementById('upload-process').style.visibility = 'visible';
      return true;
}

function advedit_end(check_edit){
      var server_responseedit = '';
      if (check_edit == 1){
         server_responseedit = '<div class="alert alert-success alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر با موفقیت انجام شد <a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtadv();
      }
      else {
         server_responseedit = '<div class="alert alert-danger alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر متاسفانه انجام نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtadv();
      }
     
      document.getElementById('adv-update').innerHTML = server_responseedit;
      return true;
	resualtadv();
}
</script>  

  </body>
</html>

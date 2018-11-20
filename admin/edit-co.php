<?php require_once('./inc_theme/header.php') ?>
      
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
				<li class="active"><a data-toggle="tab" href="#addjob"><i class="fa fa-plus-circle"></i>&nbsp; درج مشاغل</a></li>
				<li><a data-toggle="tab" href="#editjob"><i class="fa fa-refresh"></i>&nbsp; ویرایش مشاغل</a></li>
		  </ul>
			 <div class="tab-content">
				<div id="addjob" class="tab-pane fade in active">
				  <div class="col-md-6 col-xs-12 pull-right">
         			<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="mashaqel-target" onsubmit="insert_mashaqel();">
          			<table class="table table-hover">
							<thead style="background: #444;color: #FFF">
							<tr>
								<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
								<th style="text-align: center">توضیحات</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td>نام شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mconame" name="Mconame" class="form-control"></td>
								</tr>
								<tr>
									<td>مدیر شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mcoadmin" name="Mcoadmin" class="form-control"></td>
								</tr>
								<tr>
									<td>تلفن شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mcotel" name="Mcotel" class="form-control"></td>
								</tr>
								<tr>
									<td>آدرس شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="McoAddress" name="McoAddress" class="form-control"></td>
								</tr>
								<tr>
									<td>متن اول &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mtxt1" name="Mtxt1" class="form-control"></td>
								</tr>
								<tr>
									<td>متن دوم</td>
									<td><input type="text" id="Mtxt2" name="Mtxt2" class="form-control"></td>
								</tr>
								<tr>
									<td>متن سوم</td>
									<td><input type="text" id="Mtxt3" name="Mtxt3" class="form-control"></td>
								</tr>
								<tr>
									<td>تصویر اصلی &nbsp;<strong style="color: red">*</strong></td>
									<td>
										<input name="Mcoimg-file" id="Mcoimg-file" type="file" class="btn btn-primary form-control">
										<span class="help-block">
											<p style="color: red">لطفا تصویر با سایز کمتر از 300kb  انتخاب کنید</p>
											<p style="color: red">ابعاد تصویر 250*300 باشد.</p>
										</span>
									</td>
								</tr>
								<tr>
									<td>تصویر بنر</td>
									<td>
										<input name="Mcoimgs-file" id="Mcoimgs-file" type="file" class="btn btn-primary form-control">
										<span class="help-block">
											<p style="color: red">لطفا تصویر با سایز کمتر از 300kb  انتخاب کنید</p>
											<p style="color: red">ابعاد تصویر در سایز بنر باشد.</p>
										</span>
									</td>
								</tr>
								<tr>
									<td>توضیحات</td>
									<td><input type="text" id="Mcoexplain" name="Mcoexplain" class="form-control"></td>
								</tr>
								<tr>
									<td>وضعیت پرداخت &nbsp;<strong style="color: red">*</strong></td>
									<td>
										<select class="form-control" id="Mcopaystate" name="Mcopaystate">
											<option value="0">پرداخت شده</option>
											<option value="1">پرداخت نشده</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>رسید پرداخت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mcorecivepay" name="Mcorecivepay" class="form-control"></td>
								</tr>
								<tr>
									<td>پرداخت در بانک &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mcorecivebank" name="Mcorecivebank" class="form-control"></td>
								</tr>
								<tr>
									<td></td>
									<td style="text-align: left">
										<button type="submit" class="btn btn-success" id="ins-mashaqel" name="ins-mashaqel"><i class="fa fa-check"></i>&nbsp; ثبت آگهی</button>
									</td>
								</tr>
							</tbody>
						</table>
					  </form>
         			<div style="text-align:right" class="alert" id="mashaqel-insert"></div>
					<iframe id="mashaqel-target" name="mashaqel-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
          			</div>
          			<div class="edit-pic col-md-6 text-center">
          				<div class="row">
          					<label style="float: right;padding: 30px">تصویر اول</label>
							<div class="img-responsive" id="Mimg1" style="float: left;padding: 30px"></div>
          				</div>
          				<div class="row">
          					<label style="float: right;padding: 30px">تصویر دوم</label>
          					<div class="img-responsive" id="Mimg2" style="float: left;padding: 30px"></div>
          				</div>
          			</div>
				</div>
				
				<div id="editjob" class="tab-pane fade">
					<div>
				<div class="search col-md-4 pull-right" style="padding: 10px 0px;">
					<div class="input-group" style="direction: ltr">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary">جستجو کن</button>
						</div><input type="text" class="form-control" placeholder="جستجو..." style="direction: rtl">
					</div>
				</div>
						<div id="resualtMashaqel"></div>
						<div id="reseditMashaqel"></div>
					</div>

				</div>
			</div>
        </div>
	  </div>
	</div>
   
<?php require_once('./inc_theme/jquery.php') ?>
<script type="text/javascript">
	resualtMashaqel()
	function resualtMashaqel(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusM=dispM&pagemashaqel="+page,false);
		xmlhttp.send(null);
		document.getElementById("resualtMashaqel").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkmashaqel', function(){
			var page = $(this).attr("id");
			resualtMashaqel(page);
		});
</script>
<script type="text/javascript">
		function deleteM(id){
			var idM = id;
			var Mdsend = true;
			$.post("set-ajax.php",{idM:idM,Mdsend:Mdsend},function(data){
				$("#msgModal").modal("show");
			});
			resualtMashaqel()
	}		
		function updateM(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?id="+id+"&actionM=updateM",false);
			xmlhttp.send(null);
			document.getElementById("reseditMashaqel").innerHTML = xmlhttp.responseText;
	}
	function taeedM(id){
			var idt = id;
			var Mtaeed = true;
			$.post("set-ajax.php",{idt:idt,Mtaeed:Mtaeed},function(data){
			
			});
			resualtMashaqel()
	}
	function taliqM(id){
			var idta = id;
			var Mttaeed = true;
			$.post("set-ajax.php",{idta:idta,Mttaeed:Mttaeed},function(data){
			
			});
			resualtMashaqel()
	}
</script>


<script type="text/javascript">
function Insert_Resmashaqel(check_MashaqelEnd){
      var server_Mresponse = '';
      if (check_MashaqelEnd == 1){
         server_Mresponse = '<div class="alert alert-success" style="color:white">بنر شغلی با موفقیت ثبت شد<\/div>';
		  $("#Mconame").val("");
		  $("#Mcoadmin").val("");
		  $("#Mcotel").val("");
		  $("#McoAddress").val("");
		  $("#Mtxt1").val("");
		  $("#Mtxt2").val("");
		  $("#Mtxt3").val("");
		  $("#Mcoexplain").val("");
		  $("#Mcorecivepay").val("");
		  $("#Mcorecivebank").val("");
		  $("#Mcopaystate").val(0);
      }
      else {
         server_Mresponse = '<div class="alert alert-danger" style="color:white">متاسفانه بنر شغلی ثبت نشد<\/div>';
		 
      }
     
      document.getElementById('mashaqel-insert').innerHTML = server_Mresponse;
      return true;
	  }
</script>
<script>
$("#Mcoimg-file").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#Mimg1");
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
<script>
$("#Mcoimgs-file").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#Mimg2");
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
function update_Mu(){
      document.getElementById('upload-process').style.visibility = 'visible';
      return true;
}

function Medit_end(check_editM){
      var server_responseMedit = '';
      if (check_editM == 1){
         server_responseMedit = '<div class="alert alert-success alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر با موفقیت انجام شد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtMashaqel();
      }
      else {
         server_responseMedit = '<div class="alert alert-danger alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر متاسفانه انجام نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtMashaqel();
      }
     
      document.getElementById('Mashaqelus-update').innerHTML = server_responseMedit;
      return true;
	resualtMashaqel();
}
</script> 
  </body>
</html>

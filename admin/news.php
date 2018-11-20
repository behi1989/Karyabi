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
				<li class="active"><a data-toggle="tab" href="#ManageNews"><i class="fa fa-server"></i>&nbsp; مدیریت خبر و رویداد ها</a></li>
				<li><a data-toggle="tab" href="#InsertNews"><i class="fa fa-plus-circle"></i>&nbsp; درج خبر و رویداد</a></li>
		  </ul>
		 <div class="tab-content">
			<div id="ManageNews" class="tab-pane fade in active">
				<div style="margin-top: 20px">
					<div id="resualtNews"></div>
					<div id="reseditNews"></div>
				</div>
					
			</div>

			<div id="InsertNews" class="tab-pane fade in">
				<div style="margin: 20px">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="upload-itarget" onsubmit="upload_istart();">
	<table class="table table-hover">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
		<div id="resNewsI"></div>
			<tbody dir="rtl">
				<tr>
					<td>عنوان خبر &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="newsititle" id="newsititle" class="form-control"></td>
				</tr>
				
				<tr>
					<td>متن خبر &nbsp;<strong style="color: red">*</strong></td>
					<td><textarea name="newsiText" id="newsiText" class="form-control ckeditor"></textarea></td>
				</tr>
				
				<tr>
					<td>منبع خبر &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="newsisource" id="newsisource" class="form-control"></td>
				</tr>
				
				<tr>
					<td>نویسنده خبر &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="newsiwritter" id="newsiwritter" class="form-control"></td>
				</tr>
				
				<tr>
					<td>کلیدواژه های خبر &nbsp;<strong style="color: red">*</strong><p style="color: red">جدا سازی با (ویرگول ،)</p></td>
					<td><input type="text" name="newsikey" id="newsikey" class="form-control"></td>
				</tr>
				
				<tr>
					<td>انتخاب نوع خبر &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-4 pull-right">
					<select class="form-control" id="newsitype" name="newsitype">
						<option value="4">درج در اخبار</option>
						<option value="1">درج در رویداد های گیلان</option>
						<option value="2">درج در رویداد و اسلایدر</option>
						<option value="3">درج در اخبار و اسلایدر</option>
					</select> 
					</span>
					</td>
				</tr>
				
				<tr>
					<td>تصویر خبر &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-3 pull-right">
						<div id="newsimgi"></div>
					</span>
					<span class="col-md-6 pull-right">
						<input name="user-ifile" id="user-ifile" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>
			
				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="editNI" name="editNI" class="btn btn-success" value="درج خبر"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="upload-iform"></div>
		<iframe id="upload-itarget" name="upload-itarget" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
				</div>
			</div>

		</div>

		</div>
		
  
<?php require_once('./inc_theme/jquery.php') ?> 
<script type="text/javascript">
	resualtNews()
	function resualtNews(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?status=disp&pagenews="+page,false);
		xmlhttp.send(null);
		document.getElementById("resualtNews").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linknews', function(){
			var page = $(this).attr("id");
			resualtNews(page);
		});
</script>
<script type="text/javascript">
		function delete1(id){
		var id = id;
		var dsend = true;
		$.post("set-ajax.php",{id:id,dsend:dsend},function(data){
			$("#msgModal").modal("show");
		});
		resualtNews();
	}		
		function update1(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?id="+id+"&action=update",false);
			xmlhttp.send(null);
			document.getElementById("reseditNews").innerHTML = xmlhttp.responseText;
	}
		
</script>
	
	
	
<script type="text/javascript">
function upload_istart(){
      document.getElementById('upload-iprocess').style.visibility = 'visible';
      return true;
}

function upload_iend(check_iupload){
      var server_iresponse = '';
      if (check_iupload == 1){
         server_iresponse = '<div class="alert alert-success alert-dismissable" style="color:white">درج خبر با موفقیت انجام شد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  $("#newsititle").val("");
		  $("#newsiText").val("");
		  $("#newsisource").val("");
		  $("#newsiwritter").val("");
		  $("#newsikey").val("");
		  $("#newsitype").val(0);
		  resualtNews();
      }
      else {
         server_iresponse = '<div class="alert alert-danger alert-dismissable" style="color:white">متاسفانه درج خبر انجام نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		 resualtNews();
      }
     
      document.getElementById('upload-iform').innerHTML = server_iresponse;
      return true;
	  resualtNews();
}
</script>
<script>
$("#user-ifile").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#newsimgi");
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
function upload_start(){
      document.getElementById('upload-process').style.visibility = 'visible';
      return true;
}

function upload_end(check_upload){
      var server_response = '';
      if (check_upload == 1){
         server_response = '<div class="alert alert-success alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر با موفقیت انجام شد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtNews();
      }
      else {
         server_response = '<div class="alert alert-danger alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر متاسفانه انجام نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtNews();
      }
     
      document.getElementById('upload-form').innerHTML = server_response;
      return true;
	resualtNews();
}
</script>  

  </body>
</html>

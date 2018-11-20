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
				
				<li class="active"><a data-toggle="tab" href="#Insertmovie"><i class="fa fa-plus-circle"></i>&nbsp; درج فیلم جدید</a></li>
				<li><a data-toggle="tab" href="#Managemovie"><i class="fa fa-server"></i>&nbsp; مدیریت فیلم ها</a></li>
		  </ul>
<div class="tab-content">

	<div id="Insertmovie" class="tab-pane fade in active">
	<div style="margin: 20px">
	<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="movie-target" onsubmit="insert_movie();">
	<table class="table table-hover" style="direction: rtl">
		<thead style="background: #444;color: #FFF;direction: rtl">
			<tr>
				<th style="text-align: center;width: 200px;padding: 10px">عنوان</th>
				<th style="text-align: center">توضیحات</th>
			</tr>
		</thead>
			<tbody dir="rtl">
				<tr>
					<td>نام فیلم &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="moviename" id="moviename" class="form-control"></td>
				</tr>
				
				<tr>
					<td>کارگردان فیلم &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="moviedirector" id="moviedirector" class="form-control"></td>
				</tr>
				
				<tr>
					<td>بازیگران فیلم &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="movieactor" id="movieactor" class="form-control"></td>
				</tr>
				
				<tr>
					<td>زمان اکران &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="movieplaytime" id="movieplaytime" class="form-control"></td>
				</tr>

				<tr>
					<td>اکران در سینما &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-4 pull-right">
						<select class="form-control" id="cinemaname" name="cinemaname">
						<option value="0">انتخاب سینما</option>
<?php
$DB = new DB();
$Cinema = new Cinema();
$resC = $Cinema->ReadCinemaName();
foreach($resC as $rowsq)
{
?>
				
				<?php echo '<option id="'.$rowsq['_cinemaID'].'" value="'.$rowsq['_cinemaID'].'">'.$rowsq['_cinemaName'].'</option>'; ?>
<?php	
	}
?>							
						</select> 
					</span>
					</td>
				</tr>

				<tr>
					<td>شماره تماس سینما</td>
					<td><input type="text" name="cinematel" id="cinematel" class="form-control"></td>
				</tr>
				
				<tr>
					<td>آدرس سینما</td>
					<td><input type="text" name="cinemaaddress" id="cinemaaddress" class="form-control"></td>
				</tr>
				
				<tr>
					<td>تعداد صندلی سینما</td>
					<td><input type="text" name="cinemachairno" id="cinemachairno" class="form-control"></td>
				</tr>
				
				<tr>
					<td>قیمت بلیط &nbsp;<strong style="color: red">*</strong></td>
					<td><input type="text" name="moviepay" id="moviepay" class="form-control"></td>
				</tr>
				
				<tr>
					<td>سانس های سینما &nbsp;<strong style="color: red">*</strong></td>
					<td><textarea name="cinemasans" id="cinemasans" class="form-control" style="min-height: 100px;"></textarea></td>
				</tr>
				
				<tr>
					<td>توضیحات</td>
					<td><input type="text" name="movieexplain" id="movieexplain" class="form-control"></td>
				</tr>
				
				<tr>
					<td>تصویر فیلم &nbsp;<strong style="color: red">*</strong></td>
					<td>
					<span class="col-md-3 pull-right">
						<div id="moviepic"></div>
					</span>
					<span class="col-md-6 pull-right">
						<input name="movie-file" id="movie-file" type="file" class="btn btn-primary form-control">
					</span>
					</td>
				</tr>

				<tr>
					<td></td>
					<td style="text-align: left">
						<input type="submit" id="movieInsert" name="movieInsert" class="btn btn-success" value="درج فیلم"> 
					</td>
				</tr>
		</tbody>
		</table>
		</form>
		<div style="text-align:right" class="alert" id="movie-insert"></div>
		<iframe id="movie-target" name="movie-target" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
		</div>
	</div>
			
			<div id="Managemovie" class="tab-pane fade in">
				<div style="margin-top: 20px">
					<div id="resualtMovie"></div>
					<div id="resadvdel"></div>
					<div id="reseditMovie"></div>
				</div>
					
			</div>

</div>

</div>
		
  
<?php require_once('./inc_theme/jquery.php') ?> 

<script type="text/javascript">
$(document).ready(function(){
	$("#cinemaname").change(function(){
		var id = $(this).val();
		var datastring = 'idh='+id;
		$.ajax({
			type: "POST",
			url: "./jquery.php",
			data: datastring,
			catch: false,
			success: function(data){
				if(data==0){
					document.getElementById("cinematel").value = "لطفا نام سینما را انتخاب کنید";
					document.getElementById("cinemaaddress").value = "لطفا نام سینما را انتخاب کنید";
					document.getElementById("cinemachairno").value = "لطفا نام سینما را انتخاب کنید";
					document.getElementById("moviepay").value = "لطفا نام سینما را انتخاب کنید";
				}else{
				var cinema = data;
				var c = cinema.split("|");
				document.getElementById("cinematel").value = c[1];
				document.getElementById("cinemaaddress").value = c[2];
				document.getElementById("cinemachairno").value = c[3];
				document.getElementById("moviepay").value = c[4]+ " - " +c[5];	
				}
				
			}
		});
	});
});
</script>

<script type="text/javascript">
	resualtmovie()
	function resualtmovie(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusmovie=dispmovie&pagemovie="+page,false);
		xmlhttp.send(null);
		document.getElementById("resualtMovie").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkmovie', function(){
			var page = $(this).attr("id");
			resualtmovie(page);
		});
</script>
<script type="text/javascript">
		function deletemovie(id){
		var idmov = id;
		var movdsend = true;
		$.post("set-ajax.php",{idmov:idmov,movdsend:movdsend},function(data){
			$("#msgModal").modal("show");
		});
		resualtmovie();
		}	
	
		function updatemovie(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?id="+id+"&actionmovie=updatemovie",false);
			xmlhttp.send(null);
			document.getElementById("reseditMovie").innerHTML = xmlhttp.responseText;
		}
	
		function movieEndPlayTime(id){
			var idmovieendplay = id;
			var sendmovieendplay = true;
			$.post("./set-ajax.php",{idmovieendplay:idmovieendplay,sendmovieendplay:sendmovieendplay},function(data){
				
			});
			resualtmovie();
		}
		
		function movieRenewPlayTime(id){
			var idmovieRenewPlay = id;
			var sendmoviRenewPlay = true;
			$.post("./set-ajax.php",{idmovieRenewPlay:idmovieRenewPlay,sendmoviRenewPlay:sendmoviRenewPlay},function(data){
				
			});
			resualtmovie();
		}
</script>
	
<script type="text/javascript">
function insert_adv(){
      document.getElementById('upload-iprocess').style.visibility = 'visible';
      return true;
}

function Insert_movieEnd(check_movieEnd){
      var server_movieresponse = '';
      if (check_movieEnd == 1){
         server_movieresponse = '<div class="alert alert-success alert-dismissable" style="color:white">فیلم با موفقیت ثبت شد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  $("#moviename").val("");
		  $("#moviedirector").val("");
		  $("#movieactor").val("");
		  $("#movieplaytime").val("");
		  $("#cinemaname").val(0);
		  $("#cinemasans").val("");
		  $("#moviepay").val("");
		  $("#cinemachairno").val("");
		  $("#cinemaaddress").val("");
		  $("#cinematel").val("");
		  $("#movieexplain").val("");
		  resualtmovie();
      }
      else {
         server_movieresponse = '<div class="alert alert-danger alert-dismissable" style="color:white">متاسفانه فیلم ثبت نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		 
      }
     
      document.getElementById('movie-insert').innerHTML = server_movieresponse;
      return true;
	  }
</script>
<script>
$("#movie-file").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#moviepic");
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

function movieedit_end(check_editmov){
      var server_responseeditmov = '';
      if (check_editmov == 1){
         server_responseeditmov = '<div class="alert alert-success alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر با موفقیت انجام شد <a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtmovie();

      }
      else {
         server_responseeditmov = '<div class="alert alert-danger alert-dismissable" style="color:white">ویرایش اطلاعات و آپلود تصویر متاسفانه انجام نشد<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a><\/div>';
		  resualtmovie();
      }
     
      document.getElementById('movie-update').innerHTML = server_responseeditmov;
      return true;
	resualtmovie();
}
</script>  

  </body>
</html>

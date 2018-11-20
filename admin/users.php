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
				<li class="active"><a data-toggle="tab" href="#addjob"><i class="fa fa-users"></i>&nbsp; مدیریت کارجویان</a></li>
				<li><a data-toggle="tab" href="#editjob"><i class="fa fa-user"></i>&nbsp; مدیریت کارفرما</a></li>
		  </ul>
       
       		<div class="tab-content">
				<div id="addjob" class="tab-pane fade in active">
				  <div class="search col-md-4 pull-right">
					<div class="input-group" style="direction: ltr">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary">جستجو کن</button>
						</div><input type="text" class="form-control" placeholder="جستجو..." style="direction: rtl">
					</div>
				  </div>
					<div id="usrbox"></div>
         				
				</div>
				
				<div id="editjob" class="tab-pane fade">
				  <div class="search col-md-4 pull-right">
					<div class="input-group" style="direction: ltr">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary">جستجو کن</button>
						</div><input type="text" class="form-control" placeholder="جستجو..." style="direction: rtl">
					</div>
				  </div>
         			<div id="karfarmabox"></div>
   
				</div>
			</div>
        </div>
	  </div>
	</div>
<?php require_once('./inc_theme/jquery.php') ?>

<script type="text/javascript">
	resualtusr()
	function resualtusr(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statususr=dispusr&pageusr="+page,false);
		xmlhttp.send(null);
		document.getElementById("usrbox").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkusr', function(){
			var page = $(this).attr("id");
			resualtusr(page);
		});
</script>
<script type="text/javascript">
	function usrTaeed(id){
		var usridt = id;
		var usrsendt = true;
		$.post("set-ajax.php",{usridt:usridt,usrsendt:usrsendt},function(data){
			$("#resedel").html(data);
		});
		resualtusr();
	}
	function usrTaliq(id){
		var usrtid = id;
		var usrtsend = true;
		$.post("set-ajax.php",{usrtid:usrtid,usrtsend:usrtsend},function(data){
			$("#resedel").html(data);
		});
		resualtusr();
	}
	function usrdelete(id){
		var usrdid = id;
		var usrdsend = true;
		$.post("set-ajax.php",{usrdid:usrdid,usrdsend:usrdsend},function(data){
			$("#msgModal").modal("show");
		});
		resualtusr();
	}
</script>

<script type="text/javascript">
	resualtkarfarma()
	function resualtkarfarma(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statuskarfarma=dispkarfarma&pagekarfrma="+page,false);
		xmlhttp.send(null);
		document.getElementById("karfarmabox").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkkarfrma', function(){
			var page = $(this).attr("id");
			resualtkarfarma(page);
		});
</script>
<script type="text/javascript">
	function karfarmaTaeed(id){
		var karfarmaidt = id;
		var karfarmasendt = true;
		$.post("set-ajax.php",{karfarmaidt:karfarmaidt,karfarmasendt:karfarmasendt},function(data){
			$("#resedel").html(data);
		});
		resualtkarfarma();
	}
	function karfarmaTaliq(id){
		var karfarmatid = id;
		var karfarmatsend = true;
		$.post("set-ajax.php",{karfarmatid:karfarmatid,karfarmatsend:karfarmatsend},function(data){
			$("#resedel").html(data);
		});
		resualtkarfarma();
	}
	function karfarmadelete(id){
		var karfarmadid = id;
		var karfarmadsend = true;
		$.post("set-ajax.php",{karfarmadid:karfarmadid,karfarmadsend:karfarmadsend},function(data){
			$("#msgModal").modal("show");
		});
		resualtkarfarma();
	}
</script>
  </body>
</html>
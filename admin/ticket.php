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
    <!-- Answer Pm Modal -->
 	<div id="PMModal" class="modal fade"  role="dialog"></div>
    <div id="PMModals" class="modal fade"  role="dialog"></div>
	<div id="PMModall" class="modal fade"  role="dialog"><div class="mesg"></div></div>
             
        <div class="col-sm-9 col-md-10 main">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#addjob"><p id="bdgs1"></p></a></li>
				<li><a data-toggle="tab" href="#editjob"><p id="bdgs2"></p></a></li>
				<li><a data-toggle="tab" href="#editjob2"><p id="bdgs3"></p></a></li>
		  </ul>
       
       		<div class="tab-content">
				<div id="addjob" class="tab-pane fade in active" style="margin-top: 20px;">
					<div id="resticketM"></div>
          		</div>
				
				<div id="editjob" class="tab-pane fade" style="margin-top: 20px;">
					<div id="resticketS"></div>
				</div>
				
				
				<div id="editjob2" class="tab-pane fade" style="margin-top: 20px;">
					<div id="resticketA"></div>
				</div>
			</div>
        </div>
   
<?php require_once('./inc_theme/jquery.php') ?>   
<script type="text/javascript">
	resualtticket()
	function resualtticket(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusticket=dispticket&paget1="+page,false);
		xmlhttp.send(null);
		document.getElementById("resticketM").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkt1', function(){
			var page = $(this).attr("id");
			resualtticket(page);
		});
</script>	
<script type="text/javascript">
	function deletet(id){
		var tcid = id;
		var tcsend = true;
		$.post("set-ajax.php",{tcid:tcid,tcsend:tcsend},function(data){
			$("#msgModal").modal("show");
		});
		resualtticket();
		resualtticketnotread();
	}
	function answer(id){
		var idanswer = id;
		$('#PMModall').modal('show');
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusmodall=dispmodall&idmodall="+idanswer,false);
		xmlhttp.send(null);
		document.getElementById("PMModall").innerHTML = xmlhttp.responseText;
		resualtticket();
		resualtticketnotread();
	}
	function updA(id){
		var idup1 = id;
		var sendup1 = true;
		var txtans1 = $("#adminpm1").val();
		$.post("set-ajax.php",{idup1:idup1,txtans1:txtans1,sendup1:sendup1},function(data){
			$(".mesg").html(data);
		});
		resualtticket();
		resualtticketnotread();
	}
</script>

<script type="text/javascript">
	resualttickets()
	function resualttickets(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statustickets=disptickets&paget2="+page,false);
		xmlhttp.send(null);
		document.getElementById("resticketS").innerHTML = xmlhttp.responseText;
	}
			$(document).on('click', '.pagination_linkt2', function(){
			var page = $(this).attr("id");
			resualttickets(page);
		});
</script>	
<script type="text/javascript">
	function deletets(id){
		var tcsid = id;
		var tcssend = true;
		$.post("set-ajax.php",{tcsid:tcsid,tcssend:tcssend},function(data){
			$("#msgModal").modal("show");
		});
		resualttickets();
		resualtticketnotread1();
	}
	function answers(id){
		var idanswers = id;
		$('#PMModals').modal('show');
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusmodals=dispmodals&idmodals="+idanswers,false);
		xmlhttp.send(null);
		document.getElementById("PMModals").innerHTML = xmlhttp.responseText;
		resualttickets();
		resualtticketnotread1();
	}
	function updS(id){
		var idup2 = id;
		var sendup2 = true;
		var txtans2 = $("#adminpm2").val();
		$.post("set-ajax.php",{idup2:idup2,txtans2:txtans2,sendup2:sendup2},function(data){
			$(".mesg").html(data);
		});
		resualttickets();
		resualtticketnotread1();
	}
</script>

<script type="text/javascript">
	resualtticketa()
	function resualtticketa(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusticketa=dispticketa&paget2="+page,false);
		xmlhttp.send(null);
		document.getElementById("resticketA").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkt3', function(){
			var page = $(this).attr("id");
			resualtticketa(page);
		});
</script>	
<script type="text/javascript">
	function deleteta(id){
		var tcaid = id;
		var tcasend = true;
		$.post("set-ajax.php",{tcaid:tcaid,tcasend:tcasend},function(data){
			$("#msgModal").modal("show");
		});
		resualtticketa();
		resualtticketnotread2();
	}
	function answera(id){
		var idanswera = id;
		$('#PMModal').modal('show');
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusmodal=dispmodal&idmodal="+idanswera,false);
		xmlhttp.send(null);
		document.getElementById("PMModal").innerHTML = xmlhttp.responseText;
		resualtticketa();
		resualtticketnotread2();
	}
	function updAd(id){
		var idup3 = id;
		var sendup3 = true;
		var txtans3 = $("#adminpm").val();
		$.post("set-ajax.php",{idup3:idup3,txtans3:txtans3,sendup3:sendup3},function(data){
			$(".mesg").html(data);
		});
		resualtticketa();
		resualtticketnotread2();
	}
</script>
<script type="text/javascript">
	resualtticketnotread()
	function resualtticketnotread(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusticketread=dispticketread",false);
		xmlhttp.send(null);
		document.getElementById("bdgs1").innerHTML = xmlhttp.responseText;
	}
</script>
<script type="text/javascript">
	resualtticketnotread1()
	function resualtticketnotread1(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusticketread1=dispticketread1",false);
		xmlhttp.send(null);
		document.getElementById("bdgs2").innerHTML = xmlhttp.responseText;
	}
</script>
<script type="text/javascript">
	resualtticketnotread2()
	function resualtticketnotread2(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusticketread2=dispticketread2",false);
		xmlhttp.send(null);
		document.getElementById("bdgs3").innerHTML = xmlhttp.responseText;
	}
</script> 
  </body>
</html>
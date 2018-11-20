<?php require_once('./inc_theme/header.php') ?>
<?php require_once('../inc_theme/modal.php') ?>
<?php
if (!isset($_SESSION['usrLogin']) || $_SESSION['usrLogin'] == ""){
	header("location:../index.php");
	exit();
}
?>
<style>
	.pagination_link:hover{
		background-color: #8657DB;
		color: #fff;
	}
</style>
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
  <div id="MessageModal" class="modal fade"  role="dialog"></div>
  
<?php
if(isset($_SESSION['usrType']) && $_SESSION['usrType'] == 1)
{
?>  
<!-- User Login -->
	<section id="userprofile">
		<div class="container text-center">
			<div class="row">
			<div class="col-xs-12 bhoechie-tab-container">
            <div class="col-md-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="glyphicon glyphicon-blackboard"></h4><br/>پیشخوان
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-user"></h4><br/>ویرایش اطلاعات کاربری
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-lock"></h4><br/>ویرایش کلمه عبور
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-envelope"></h4><br/>صندوق پیام
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-off"></h4><br/>خروج
                </a>
              </div>
            </div>
            <div class="col-md-9 col-xs-9 bhoechie-tab" style="height: auto">
<?php 
if (isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$User = new User();
		$session = $_SESSION['usrLogin'];
		$res = $User->SelectLoginUser($session);
		foreach($res as $rows){
			$unmae = $rows['_username'];
			$ids = $rows['_id'];
			
			if($unmae == $session){
			
?>                
                <div class="bhoechie-tab-content active">
                    <div style="direction: rtl;text-align: right;padding: 10px">
                    	<div class="page-header" style="margin: 0px">
                    		<h4><span class="fa fa-calendar"></span> امروز : <?php echo jdate('y/m/d',time()); ?></h4>
                    	</div>
                    	<div>
                    		<h5 style="direction: rtl"><?php echo $rows['_fname']; ?> به پنل کاربری خود خوش آمدید</h5>
                    		<h6 style="direction: rtl">
                    		<?php if(!empty($rows['_Ltime']) && !empty($rows['_Ldate'])){ ?>
                    		آخرین بازدید از سایت: <?php echo jdate('y/m/d',$rows['_Ldate']); ?> ساعت <?php echo $rows['_Ltime']; ?> 
                    		<?php } ?>
                    		</h6>
                    		<h5>این بخش به زودی تکمیل می شود</h5>
                    	</div>
                    </div>
                </div>
                                
                <div class="bhoechie-tab-content">
                     <div>
						<ul class="col-xs-12 page-header" style="margin: 0">
							<li class="col-md-8 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<label>انتخاب تصویر پروفایل</label>
							<form action="set-ajax.php" method="post" enctype="multipart/form-data" name="imgeform2" id="imgeform2">
							<input type="hidden" class="form-control" value="<?php echo $rows['_id']; ?>" id="idu" name="idu">
								<div class="input-group" style="direction: ltr">
									<label class="input-group-btn">
										<span class="btn btn-primary">
											انتخاب تصویر<input type="file" id="fileu" name="fileu[]" style="display: none" multiple>
										</span>
									</label>
										<input type="text" class="form-control" readonly id="upimageu" name="upimageu">
								</div>
								<div style="padding: 10px 0">
									<button type="submit" class="btn btn-success" id="imgupdateu" name="imgupdateu">بارگذاری تصویر</button>
								</div>
							</form>
							</li>
                   			<li class="col-md-4">
                   				<div id="preview2" style="float: left;padding: 10px;width: 200px;height: 230px">
                   					<?php
									
									if(!empty($rows['_avatar']) && file_exists("img/".$rows['_avatar'])){
										echo "<img style='float:left;padding:10px;width:200px;height:200px' src='img/".$rows['_avatar']."'  class='preview'> <br/></br>";
									}
									?>
                   				</div>
                   			</li>
                    	</ul>
                   </div>
                   <div id="editresu" style="margin: 5px 10px -10px 0;text-align: right" class="col-md-6 pull-right">
                   	
                   </div>
                   <input type="hidden" class="form-control" value="<?php echo $rows['_id']; ?>" id="ideu" name="ideu">
                   <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<label>نام و نام خانوادگی &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="fnameu" id="fnameu" class="form-control" value="<?php echo $rows['_fname']; ?>" placeholder="نام و نام خانوادگی">
						</li>
                   </ul>

                    <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<label>نام کاربری</label>
							<input type="text" name="unameu" id="unameu" disabled class="form-control" value="<?php echo $rows['_username']; ?>" placeholder="نام کاربری">
						</li>
                    </ul>
                    
                    <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<label>ایمیل</label>
							<input type="email" name="emaileu" id="emaileu" disabled class="form-control" value="<?php echo $rows['_email']; ?>" placeholder="ایمیل">
						</li>
                    </ul>
                    	
					<ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<label>موبایل &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="mobileu" id="mobileu" class="form-control" value="<?php echo $rows['_mobile']; ?>" placeholder="موبایل">
						</li>
                    </ul>
                    
                    <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<label>استان</label>
							<input type="text" name="ostanu" id="ostanu" class="form-control" value="<?php echo $rows['_ostan']; ?>" placeholder="استان">
						</li>
                    </ul>
                    
                    <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<label>شهر</label>
							<input type="text" name="cityu" id="cityu" class="form-control" value="<?php echo $rows['_city']; ?>" placeholder="شهر">
						</li>
                    </ul>
                    
                    <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<button type="button" class="btn btn-primary" id="usrsedit"><i class="fa fa-refresh"></i>&nbsp; ویرایش</button>
						</li>
                    </ul>
                </div>

                <div class="bhoechie-tab-content">
                    <div>
                    <div id="editpassresu" style="margin: 5px 10px -10px 0;text-align: right" class="col-md-6 pull-right">
                   	
                  	</div>
                   		<input type="hidden" id="idu" name="idu" value="<?php echo $ids; ?>">
                    	<ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<input type="text" name="oldpassu" id="oldpassu" class="form-control" placeholder="کلمه عبور قبلی">
						</li>
                   		</ul>
						<ul class="col-xs-12">
							<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<input type="password" name="newpassu" id="newpassu" class="form-control" placeholder="کلمه عبور جدید">
							</li>
						</ul>
                   		<ul class="col-xs-12">
							<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<input type="password" name="newpasssu" id="newpasssu" class="form-control" placeholder="تکرار کلمه عبور جدید">
							</li>
						</ul>
					   <ul class="col-xs-12">
							<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<button type="submit" class="btn btn-success" id="eidtpassu" name="editpassu"><i class="fa fa-refresh"></i>&nbsp; ویرایش کلمه عبور</button>
							</li>
						</ul>
                    </div>
                </div>
                
                <div class="bhoechie-tab-content">
                	<div class="page-header" style="text-align: right;margin: 0 0 10px 0">
                		<h5>صندوق پیام های شما <span class="fa fa-envelope-open"></span></h5>
                	</div>
                	<div id="usrmessage"></div>
                	
                </div>
 
                <div class="bhoechie-tab-content">
                   <div>
                    <ul class="col-xs-12">
                    	<li class="col-md-6 pull-right" style="text-align: right">
                    		<h5 style="text-align: right;direction: rtl">کاربر گرامی <?php echo $rows['_fname']; ?> لطفا برای خروج از پنل کاربری کلیک کنید</h5>
                    	</li>
                    	<li class="col-md-6 pull-left" style="text-align: left">
                    		<button type="button" class="btn btn-danger" onclick="window.location='../logout.php?id=<?php echo $rows['_id']; ?>' "><i class="fa fa-sign-out" ></i>&nbsp; خروج از پنل</button>
                    	</li>
                    </ul> 
                    </div>
                    <div class="page-header" style="padding-right: 30px">
                    	<h6 style="text-align: right">از همراهی و پشتیبانی شما بسیار سپاس گذاریم</h6>
                    </div>
                </div>
<?php

			}
		}
	}
}					
?>       
            </div>
        </div>
			</div>
		</div>
	</section>
<?php
}

else if(isset($_SESSION['usrType']) && $_SESSION['usrType'] == 2)
	{
?>

<!-- Karfarma Login -->
	<section id="userprofile">
		<div class="container text-center">
			<div class="row">
			<div class="col-xs-12 bhoechie-tab-container">
            <div class="col-md-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="glyphicon glyphicon-blackboard"></h4><br/>پیشخوان
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-user"></h4><br/>ویرایش اطلاعات کاربری
                </a>
                <a href="#" onClick="resualt()" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-bullhorn"></h4><br/>مدیریت آگهی ها
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-plus-sign"></h4><br/>درج آگهی
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-certificate"></h4><br/>مدیریت مشاغل
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-tasks"></h4><br/>درج مشاغل
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-usd"></h4><br/>مدیریت رسید پرداخت
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-lock"></h4><br/>ویرایش کلمه عبور
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-envelope"></h4><br/>صندوق پیام
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-off"></h4><br/>خروج
                </a>
              </div>
            </div>
            <div class="col-md-9 col-xs-9 bhoechie-tab" style="height: auto">
            
<?php 
if (isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$User = new User();
		$session = $_SESSION['usrLogin'];
		$res = $User->SelectLoginUser($session);
		foreach($res as $rows){
			$unmae = $rows['_username'];
			$ids = $rows['_id'];
			
			if($unmae == $session){
			
?>               
                <div class="bhoechie-tab-content active">
                    <div style="direction: rtl;text-align: right;padding: 10px">
                    	<div class="page-header" style="margin: 0px">
                    		<h4><span class="fa fa-calendar"></span> امروز : <?php echo jdate('y/m/d',time()); ?></h4>
                    	</div>
                    	<div>
                    		<h5 style="direction: rtl"><?php echo $rows['_fname']; ?> به پنل کاربری خود خوش آمدید</h5>
                    		<?php if(!empty($rows['_Ltime']) && !empty($rows['_Ldate'])){ ?>
                    		<h6 style="direction: rtl">آخرین بازدید از سایت: <?php echo jdate('y/m/d',$rows['_Ldate']); ?> ساعت <?php echo $rows['_Ltime']; ?></h6>
                    		<?php } ?>
                    		<h5>این بخش به زودی تکمیل می شود</h5>
                    	</div>
                    </div>
                </div>
                                
                <div class="bhoechie-tab-content">

					
                   <div id="upimages" style="margin: 5px 10px -10px 0;text-align: right" class="col-md-6 pull-right"></div>
                   <div>
						<ul class="col-xs-12 page-header">
							<li class="col-md-8 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<label>انتخاب تصویر پروفایل</label>
							<form action="set-ajax.php" method="post" enctype="multipart/form-data" name="imgeform" id="imgeform">
							<input type="hidden" class="form-control" value="<?php echo $rows['_id']; ?>" id="id" name="id">
								<div class="input-group" style="direction: ltr">
									<label class="input-group-btn">
										<span class="btn btn-primary">
											انتخاب تصویر<input type="file" id="file" name="file[]" style="display: none" multiple>
										</span>
									</label>
										<input type="text" class="form-control" readonly id="upimage" name="upimage">
								</div>
								<div style="padding: 10px 0">
									<button type="submit" class="btn btn-success" id="imgupdate" name="imgupdate">بارگذاری تصویر</button>
								</div>
							</form>
							</li>
                   			<li class="col-md-4">
                   				<div id="preview" style="float: left;padding: 10px;width: 200px;height: 230px">
                   					<?php
									
									if(!empty($rows['_avatar']) && file_exists("img/".$rows['_avatar'])){
										echo "<img style='float:left;padding:10px;width:200px;height:200px' src='img/".$rows['_avatar']."'  class='preview'> <br/></br>";
									}
									?>
                   				</div>
                   			</li>
                    	</ul>
                   </div>
                   <div id="editres" style="margin: 5px 10px -10px 0;text-align: right" class="col-md-6 pull-right">
                   	
                   </div>
                   <input type="hidden" class="form-control" value="<?php echo $rows['_id']; ?>" id="ide" name="ide">
                   <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>نام و نام خانوادگی &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="fname" id="fname" class="form-control" value="<?php echo $rows['_fname']; ?>" placeholder="نام و نام خانوادگی">
						</li>
                   </ul>

                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>نام کاربری</label>
							<input type="text" name="uname" id="uname" disabled class="form-control" value="<?php echo $rows['_username']; ?>" placeholder="نام کاربری">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>ایمیل کارفرما</label>
							<input type="email" name="emaile" id="emaile" disabled class="form-control" value="<?php echo $rows['_email']; ?>" placeholder="ایمیل">
						</li>
                    </ul>
                    	
					<ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>موبایل کارفرما &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $rows['_mobile']; ?>" placeholder="موبایل">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>استان</label>
							<input type="text" name="ostan" id="ostan" class="form-control" value="<?php echo $rows['_ostan']; ?>" placeholder="استان">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>شهر</label>
							<input type="text" name="city" id="city" class="form-control" value="<?php echo $rows['_city']; ?>" placeholder="شهر">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>نام شرکت &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="coname" id="coname" class="form-control" value="<?php echo $rows['_coName']; ?>" placeholder="نام شرکت">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>تلفن شرکت &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="cotel" id="cotel" class="form-control" value="<?php echo $rows['_coTel']; ?>" placeholder="تلفن شرکت">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>ایمیل شرکت</label>
							<input type="text" name="coemail" id="coemail" class="form-control" value="<?php echo $rows['_coEmail']; ?>" placeholder="ایمیل شرکت">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>سایت شرکت</label>
							<input type="text" name="coweb" id="coweb" class="form-control" value="<?php echo $rows['_coWeb']; ?>" placeholder="سایت شرکت">
						</li>
                    </ul>
                    
                    <ul class="col-md-6 col-xs-12 pull-right">
						<li style="direction: rtl;text-align: right;padding: 10px">
							<label>آدرس شرکت &nbsp;<strong style="color: red">*</strong></label>
							<input type="text" name="coaddress" id="coaddress" class="form-control" value="<?php echo $rows['_coAddress']; ?>" placeholder="آدرس شرکت">
						</li>
                    </ul>
                    
                    <ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<button type="button" class="btn btn-primary" id="usredit"><i class="fa fa-refresh"></i>&nbsp; ویرایش</button>
						</li>
                    </ul>
                </div>
                
                <div class="bhoechie-tab-content">
                	<div class="page-header" style="margin: 0px;text-align: right;direction: rtl">
                    	<h4><span class="fa fa-bullhorn"></span> مدیریت آگهی های ثبت شده شما</h4>

                    </div>
                  
					<div id="resualt">
						
					</div>

					<div id="resedit">
						
					</div>
                </div>
                
                <div class="bhoechie-tab-content">
                	<div class="page-header" style="margin: 0px;text-align: right;direction: rtl">
                    	<h4><span class="fa fa-bullhorn"></span> فرم ثبت آگهی</h4>
                    </div>
                    <div>
                    <table class="table table-hover" style="direction: rtl">
                    <thead style="background: #444;color: #FFF;direction: rtl">
							<tr>
								<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
								<th style="text-align: right">توضیحات</th>
							</tr>
					</thead>
					<tbody style="direction: rtl">
              		<tr>
							<td>عنوان آگهی <strong style="color: red">*</strong></td>
							<td><input type="text" name="title" id="ititle" class="form-control"></td>
						</tr>
						<tr>
							<td>نام شرکت <strong style="color: red">*</strong></td>
							<td><input type="text" name="coname" id="iconame" class="form-control"></td>
						</tr>
						<tr>
							<td>نام درخواست دهنده <strong style="color: red">*</strong></td>
							<td><input type="text" name="bossname" id="ibossname" class="form-control"></td>
						</tr>
						<tr>
							<td>آدرس شرکت <strong style="color: red">*</strong></td>
							<td><input type="text" name="coAddress" id="icoAddress" class="form-control"></td>
						</tr>
						<tr>
							<td>تلفن <strong style="color: red">*</strong></td>
							<td><input type="text" name="tel" id="itel" class="form-control"></td>
						</tr>
						<tr>
							<td>موبایل</td>
							<td><input type="text" name="mobile" id="imobile" class="form-control"></td>
						</tr>
						<tr>
							<td>ایمیل</td>
							<td><input type="text" name="email" id="iemail" class="form-control"></td>
						</tr>
						<tr>
							<td>وب سایت</td>
							<td><input type="text" name="web" id="iweb" class="form-control"></td>
						</tr>
						<tr>
							<td>شغل درخواستی <strong style="color: red">*</strong></td>
							<td><input type="text" name="jobreq" id="ijobreq" class="form-control"></td>
						</tr>
						<tr>
							<td>تحصیلات <strong style="color: red">*</strong></td>
							<td><input type="text" name="edu" id="iedu" class="form-control"></td>
						</tr>
						<tr>
							<td>رشته تحصیلی</td>
							<td><input type="text" name="degree" id="idegree" class="form-control"></td>
						</tr>
						<tr>
							<td>گرایش</td>
							<td><input type="text" name="sience" id="isience" class="form-control"></td>
						</tr>
						<tr>
							<td>تعداد نیرو <strong style="color: red">*</strong></td>
							<td><input type="text" name="reqno" id="ireqno" class="form-control"></td>
						</tr>
						<tr>
							<td>تخصص</td>
							<td><input type="text" name="export" id="iexport" class="form-control"></td>
						</tr>
						<tr>
							<td>جنسیت</td>
							<td>
							<select class="btn btn-block dropdown form-control" name="gender" id="igender" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
								<option value="1">مرد</option>
								<option value="2">زن</option>
								<option value="3">مرد یا زن</option>
							</select>
							</td>
						</tr>
						<tr>
							<td>سن مورد نیاز</td>
							<td><input type="text" name="iage" id="iage" class="form-control"></td>
						</tr>
						<tr>
							<td>تاهل</td>
							<td>
							<select class="btn btn-block dropdown form-control" name="married" id="imarried" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
								<option value="1">مجرد</option>
								<option value="2">متاهل</option>
								<option value="3">فرقی نمی کند</option>
							</select>
							</td>
						</tr>
						<tr>
							<td>وضعیت بیمه</td>
							<td>
							<select class="btn btn-block dropdown form-control" name="bime" id="ibime" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
								<option value="1">دارد</option>
								<option value="2">ندارد</option>
							</select>
							</td>
						</tr>
						<tr>
							<td>وضعیت نظام وظیفه</td>
							<td>
							<select class="btn btn-block dropdown form-control" name="khedmat" id="ikhedmat" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
								<option value="1">پایان خدمت</option>
								<option value="2">معاف</option>
								<option value="3">در حال خدمت</option>
								<option value="4">معاف تحصیلی</option>
								<option value="5">نیاز نیست</option>
							</select>
							</td>
						</tr>
						<tr>
							<td>ایاب و ذهاب</td>
							<td><input type="text" name="ayabzahab" id="iayabzahab" class="form-control"></td>
						</tr>
						<tr>
							<td>زمان کار <strong style="color: red">*</strong></td>
							<td><input type="text" name="worktime" id="iworktime" class="form-control"></td>
						</tr>
						<tr>
							<td>حقوق پرداختی <strong style="color: red">*</strong></td>
							<td><input type="text" name="workpay" id="iworkpay" class="form-control"></td>
						</tr>
						<tr>
							<td>شهر محل کار <strong style="color: red">*</strong></td>
							<td><input type="text" name="workcity" id="iworkcity" class="form-control"></td>
						</tr>
						<tr>
							<td>توضیحات</td>
							<td><input type="text" name="expalin" id="iexpalin" class="form-control"></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align: left">
								<button type="submit" name="insertadv" id="insertadv" class="btn btn-success" onClick="InsertAdv()"><i class="fa fa-check"></i>&nbsp; ثبت آگهی</button>
							</td>
						</tr>
					</tbody>
					
				</table>
                   <div id="resins"></div>
                    </div>
               
               		
                </div>
                
                <div class="bhoechie-tab-content">
                    <div class="page-header" style="margin: 0px;text-align: right;direction: rtl">
                    	<h4><span class="fa fa-bullhorn"></span> مدیریت مشاغل ثبت شده شما</h4>
                    </div>
                	<div id="resmashaqel"></div>
                	<div id="editresmashqel"></div>
                </div>
                
                <div class="bhoechie-tab-content">
                <div class="page-header" style="margin: 0px;text-align: right;direction: rtl">
                    	<h4><span class="fa fa-bullhorn"></span> ثبت مشاغل شما</h4>
                </div>
                <div class="col-md-9 col-xs-12 pull-right" style="direction: rtl;margin-top: 5px">
         			<form method="post" action="set-ajax.php" enctype="multipart/form-data" target="mashaqel-targett" onsubmit="insert_mashaqelt();">
          			<table class="table table-hover">
							<thead style="background: #444;color: #FFF">
							<tr>
								<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
								<th style="text-align: center">توضیحات</th>
							</tr>
							</thead>
							<tbody>
								<input type="hidden" class="form-control" id="idmashaqellt" name="idmashaqellt" value="<?php if(isset($_SESSION['usrLogin'])){echo $ids; }else{echo "0";} ?>">
								<tr>
									<td>نام شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mconamet" name="Mconamet" class="form-control"></td>
								</tr>
								<tr>
									<td>مدیر شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mcoadmint" name="Mcoadmint" class="form-control"></td>
								</tr>
								<tr>
									<td>تلفن شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mcotelt" name="Mcotelt" class="form-control"></td>
								</tr>
								<tr>
									<td>آدرس شرکت &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="McoAddresst" name="McoAddresst" class="form-control"></td>
								</tr>
								<tr>
									<td>متن اول &nbsp;<strong style="color: red">*</strong></td>
									<td><input type="text" id="Mtxt1t" name="Mtxt1t" class="form-control"></td>
								</tr>
								<tr>
									<td>متن دوم</td>
									<td><input type="text" id="Mtxt2t" name="Mtxt2t" class="form-control"></td>
								</tr>
								<tr>
									<td>متن سوم</td>
									<td><input type="text" id="Mtxt3t" name="Mtxt3t" class="form-control"></td>
								</tr>
								<tr>
									<td>تصویر اصلی &nbsp;<strong style="color: red">*</strong></td>
									<td>
										<input name="Mcoimg-filet" id="Mcoimg-filet" type="file" class="btn btn-primary form-control">
										<span class="help-block">
											<p style="color: red">لطفا تصویر با سایز کمتر از 300kb  انتخاب کنید</p>
											<p style="color: red">ابعاد تصویر 250*300 باشد.</p>
										</span>
									</td>
								</tr>
								<tr>
									<td>تصویر بنر</td>
									<td>
										<input name="Mcoimgs-filet" id="Mcoimgs-filet" type="file" class="btn btn-primary form-control">
										<span class="help-block">
											<p style="color: red">لطفا تصویر با سایز کمتر از 300kb  انتخاب کنید</p>
											<p style="color: red">ابعاد تصویر در سایز بنر باشد.</p>
										</span>
									</td>
								</tr>
								<tr>
									<td>توضیحات</td>
									<td><input type="text" id="Mcoexplaint" name="Mcoexplaint" class="form-control"></td>
								</tr>
								<tr>
									<td></td>
									<td style="text-align: left">
										<button type="submit" class="btn btn-success" id="ins-mashaqelt" name="ins-mashaqelt"><i class="fa fa-check"></i>&nbsp; ثبت آگهی</button>
									</td>
								</tr>
							</tbody>
						</table>
					  </form>
         			<div style="text-align:right" class="alert" id="mashaqel-insertt"></div>
					<iframe id="mashaqel-targett" name="mashaqel-targett" class="alert" style="border: none;direction: rtl;text-align: right;min-width: 400px"></iframe>
                </div>
                	<div class="edit-pic col-md-3 col-xs-12 text-center">
          				<div class="row">
          					<label style="float: right;padding: 30px">تصویر اول</label>
							<div class="img-responsive" id="Mimg1t" style="float: left;padding: 30px"></div>
          				</div>
          				<div class="row">
          					<label style="float: right;padding: 30px">تصویر دوم</label>
          					<div class="img-responsive" id="Mimg2t" style="float: left;padding: 30px"></div>
          				</div>
          			</div>
				</div>
               
                <div class="bhoechie-tab-content">
                	
                </div>

                <div class="bhoechie-tab-content">
                    <div>
                    <div id="editpassres" style="margin: 5px 10px -10px 0;text-align: right" class="col-md-6 pull-right">
                   	
                  	</div>
                   		<input type="hidden" id="idk" name="idk" value="<?php echo $ids; ?>">
                    	<ul class="col-xs-12">
						<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
							<input type="text" name="oldpass" id="oldpass" class="form-control" placeholder="کلمه عبور قبلی">
						</li>
                   		</ul>
						<ul class="col-xs-12">
							<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<input type="password" name="newpass" id="newpass" class="form-control" placeholder="کلمه عبور جدید">
							</li>
						</ul>
                   		<ul class="col-xs-12">
							<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<input type="password" name="newpasss" id="newpasss" class="form-control" placeholder="تکرار کلمه عبور جدید">
							</li>
						</ul>
					   <ul class="col-xs-12">
							<li class="col-md-4 pull-right" style="direction: rtl;text-align: right;padding: 10px">
								<button type="submit" class="btn btn-success" id="eidtpass" name="editpass"><i class="fa fa-refresh"></i>&nbsp; ویرایش کلمه عبور</button>
							</li>
						</ul>
                    </div>
                </div>
                
                <div class="bhoechie-tab-content">
                	<div class="page-header" style="text-align: right;margin: 0 0 10px 0">
                		<h5>صندوق پیام های شما <span class="fa fa-envelope-open"></span></h5>
                	</div>
                	<div id="karfarmaMessage"></div>
                </div>
 
                <div class="bhoechie-tab-content">
                   <div>
                    <ul class="col-xs-12">
                    	<li class="col-md-6 pull-right" style="text-align: right">
                    		<h5 style="text-align: right;direction: rtl">کاربر گرامی <?php echo $rows['_fname']; ?> لطفا برای خروج از پنل کاربری کلیک کنید</h5>
                    	</li>
                    	<li class="col-md-6 pull-left" style="text-align: left">
                    		<button type="button" class="btn btn-danger" onclick="window.location='../logout.php?id=<?php echo $rows['_id']; ?>' "><i class="fa fa-sign-out" ></i>&nbsp; خروج از پنل</button>
                    	</li>
                    </ul> 
                    </div>
                    <div class="page-header" style="padding-right: 30px">
                    	<h6 style="text-align: right">از همراهی و پشتیبانی شما بسیار سپاس گذاریم</h6>
                    </div>
                </div>
<?php

			}
		}
	}
}					
?>
            </div>
        </div>
			</div>
		</div>
	</section>	
			
<?php	
	}
?>

<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('../inc_theme/jquerylink.php') ?>
<script type="text/javascript" src="jform.js"></script>
<!-- File input Select-->
    <script>
		$(function() {
  // We can attach the `fileselect` event to all file inputs on the page
	  $(document).on('change', ':file', function() {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	  });

	  // We can watch for our custom `fileselect` event like this
	  $(document).ready( function() {
		  $(':file').on('fileselect', function(event, numFiles, label) {
			  var input = $(this).parents('.input-group').find(':text'),
				  log = numFiles > 1 ? numFiles + ' files selected' : label;

			  if( input.length ) {
				  input.val(log);
			  } else {
				  if( log ) alert(log);
			  }
		  });
	  });

	});
</script>
	<script type="text/javascript">

			resualt()
			function resualt(page){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET","./jquery.php?status=disp&page="+page,false);
				xmlhttp.send(null);
				document.getElementById("resualt").innerHTML = xmlhttp.responseText;
			}

			$(document).on('click', '.pagination_linka', function(){
				var page = $(this).attr("id");
				resualt(page);
			});

	</script>
	<script type="text/javascript">
			function update1s(id){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET","./jquery.php?id="+id+"&action=update",false);
				xmlhttp.send(null);
				document.getElementById("resedit").innerHTML = xmlhttp.responseText;
			}

			function delete1(id){
				var id = id;
				var dsend = true;
				$.post("set-ajax.php",{id:id,dsend:dsend},function(data){
					$("#msgModal").modal("show");
				});
				resualt();
			}
	</script>
			
	<script type="text/javascript">
	function update(id){
		var id = id;
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
		var esend = true;
		$.post("set-ajax.php",{id:id,title:title,coname:coname,bossname:bossname,coAddress:coAddress,tel:tel,mobile:mobile,email:email,web:web,jobreq:jobreq,edu:edu,degree:degree,sience:sience,reqno:reqno,exports:exports,gender:gender,age:age,married:married,bime:bime,khedmat:khedmat,ayabzahab:ayabzahab,worktime:worktime,workpay:workpay,workcity:workcity,expalin:expalin,esend:esend},function(data){
			$("#resedu").show();
			$("#resedu").html(data);
		});
		resualt()
	}
	</script>
	
	<script type="text/javascript">
		function InsertAdv(){
		var ititle = $("#ititle").val();
		var iconame = $("#iconame").val();
		var ibossname = $("#ibossname").val();
		var icoAddress = $("#icoAddress").val();
		var itel = $("#itel").val();
		var imobile = $("#imobile").val();
		var iemail = $("#iemail").val();
		var iweb = $("#iweb").val();
		var ijobreq = $("#ijobreq").val();
		var iedu = $("#iedu").val();
		var idegree = $("#idegree").val();
		var isience = $("#isience").val();
		var ireqno = $("#ireqno").val();
		var iexports = $("#iexport").val();
		var igender = $("#igender").val();
		var iage = $("#iage").val();
		var imarried = $("#imarried").val();
		var ibime = $("#ibime").val();
		var ikhedmat = $("#ikhedmat").val();
		var iayabzahab = $("#iayabzahab").val();
		var iworktime = $("#iworktime").val();
		var iworkpay = $("#iworkpay").val();
		var iworkcity = $("#iworkcity").val();
		var iexpalin = $("#iexpalin").val();
		var isend = true;
			$.post("./set-ajax.php",{ititle:ititle,iconame:iconame,ibossname:ibossname,icoAddress:icoAddress,itel:itel,imobile:imobile,iemail:iemail,iweb:iweb,ijobreq:ijobreq,iedu:iedu,idegree:idegree,isience:isience,ireqno:ireqno,iexports:iexports,igender:igender,iage:iage,imarried:imarried,ibime:ibime,ikhedmat:ikhedmat,iayabzahab:iayabzahab,iworktime:iworktime,iworkpay:iworkpay,iworkcity:iworkcity,iexpalin:iexpalin,isend:isend},function(data){
				$("#resins").show();
				$("#resins").html(data);
				if($("#resins [data-success]").attr("data-success") === "true") {
					$("#ititle").val("");
					$("#iconame").val("");
					$("#ibossname").val("");
					$("#icoAddress").val("");
					$("#itel").val("");
					$("#iweb").val("");
					$("#imobile").val("");
					$("#iemail").val("");
					$("#ijobreq").val("");
					$("#iedu").val("");
					$("#idegree").val("");
					$("#isience").val("");
					$("#ireqno").val("");
					$("#iexport").val("");
					$("#igender").val(1);
					$("#iage").val("");
					$("#imarried").val(1);
					$("#ibime").val(1);
					$("#ikhedmat").val(1);
					$("#iayabzahab").val("");
					$("#iworktime").val("");
					$("#iworkpay").val("");
					$("#iworkcity").val("");
					$("#iexpalin").val("");
					
				}
			});
		}
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#imgupdate').click(function(){
				$("#preview").html('');
				$("#preview").html('<img src="img/loadding.gif" style="width150px;height:150px" alt="Uploading...."/>');
				$("#imgeform").ajaxForm({
					target: '#preview'
					}).submit();
				});
        	}); 
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#imgupdateu').click(function(){
				$("#preview2").html('');
				$("#preview2").html('<img src="img/loadding.gif" style="width150px;height:150px" alt="Uploading...."/>');
				$("#imgeform2").ajaxForm({
					target: '#preview2'
				}).submit();
			});
		}); 
	</script>
	
	<script type="text/javascript">
		
		resualtusrmessage()
		function resualtusrmessage(page){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","./jquery.php?statususrmessage=dispusrmessage&pageusr="+page,false);
			xmlhttp.send(null);
			document.getElementById("usrmessage").innerHTML = xmlhttp.responseText;
		}
		
			$(document).on('click', '.pagination_linku', function(){
				var page = $(this).attr("id");
				resualtusrmessage(page);
			});
	</script>

	<script type="text/javascript">
	resualtkarfarmaMessage()
	function resualtkarfarmaMessage(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","./jquery.php?statuskarmessage=dispkarmessage&pagekar="+page,false);
		xmlhttp.send(null);
		document.getElementById("karfarmaMessage").innerHTML = xmlhttp.responseText;
	}
			$(document).on('click', '.pagination_linkkar', function(){
				var page = $(this).attr("id");
				resualtkarfarmaMessage(page);
			});
	</script>

	<script type="text/javascript">
	function deleteusr(id){
		var tusrid = id;
		var tusrsend = true;
		$.post("set-ajax.php",{tusrid:tusrid,tusrsend:tusrsend},function(data){
			$("#msgModal").modal('show');
		});
		resualtusrmessage();
	}
	
	function deletekarfarma(id){
		var tusrid = id;
		var tusrsend = true;
		$.post("set-ajax.php",{tusrid:tusrid,tusrsend:tusrsend},function(data){
			$("#msgModal").modal('show');
		});
		resualtkarfarmaMessage();
	}
	</script>
			
	<script type="text/javascript">	
	function ShowMessage(id){
		var idMessage = id;
		$('#MessageModal').modal('show');
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","jquery.php?statusmodalmsg=dispmodalmsg&idmodalmsg="+idMessage,false);
		xmlhttp.send(null);
		document.getElementById("MessageModal").innerHTML = xmlhttp.responseText;
		resualtusrmessage();
	}
	</script>
			
	<script type="text/javascript">
	resualtMashaqell()
	function resualtMashaqell(page){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","./jquery.php?statusmashaqell=dispmashaqell&pagework="+page,false);
		xmlhttp.send(null);
		document.getElementById("resmashaqel").innerHTML = xmlhttp.responseText;
	}
		$(document).on('click', '.pagination_linkm', function(){
				var page = $(this).attr("id");
				resualtMashaqell(page);
			});
	</script>
	<script type="text/javascript">
	function deleteMashaqell(id){
			var idMashaqell = id;
			var Mdelsend = true;
			$.post("set-ajax.php",{idMashaqell:idMashaqell,Mdelsend:Mdelsend},function(data){
				$("#msgModal").modal("show");
			});
			resualtMashaqell();
	}		
	function updateMashaqell(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET","jquery.php?id="+id+"&actionMashaqell=updateMashaqell",false);
			xmlhttp.send(null);
			document.getElementById("editresmashqel").innerHTML = xmlhttp.responseText;
	}
	</script>
<script type="text/javascript">
function Insert_Resmashaqelt(check_MashaqelEndt){
      var server_Mresponset = '';
      if (check_MashaqelEndt == 1){
         server_Mresponset = '<div class="alert alert-success" style="color:white">بنر شغلی با موفقیت ثبت شد<\/div>';
		  $("#Mconamet").val("");
		  $("#Mcoadmint").val("");
		  $("#Mcotelt").val("");
		  $("#McoAddresst").val("");
		  $("#Mtxt1t").val("");
		  $("#Mtxt2t").val("");
		  $("#Mtxt3t").val("");
		  $("#Mcoexplaint").val("");
		  resualtMashaqell();
      }
      else {
         server_Mresponset = '<div class="alert alert-danger" style="color:white">متاسفانه بنر شغلی ثبت نشد<\/div>';
		 
      }
     
      document.getElementById('mashaqel-insertt').innerHTML = server_Mresponset;
      return true;
	  
	  }
</script>
 
 <script>
$("#Mcoimg-filet").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#Mimg1t");
            image_holder.empty();
 
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
					"style": "width:150px;height:150px"
                }).appendTo(image_holder);
 
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });
</script>
<script>
$("#Mcoimgs-filet").on('change', function () {
 
        if (typeof (FileReader) != "undefined") {
 
            var image_holder = $("#Mimg2t");
            image_holder.empty();
 
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
					"style": "width:150px;height:150px"
                }).appendTo(image_holder);
 
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });
</script>
<script>
function Medit_endt(check_editMt){
      var server_responseMeditt = '';
      if (check_editMt == 1){
         server_responseMeditt = '<div class="alert alert-success" style="color:white">ویرایش اطلاعات و آپلود تصویر با موفقیت انجام شد<\/div>';
		  resualtMashaqell();
      }
      else {
         server_responseMeditt = '<div class="alert alert-danger" style="color:white">ویرایش اطلاعات و آپلود تصویر متاسفانه انجام نشد<\/div>';
		  resualtMashaqell();
      }
     
      document.getElementById('Mashaqelus-updatet').innerHTML = server_responseMeditt;
      return true;
	  resualtMashaqell();
}
</script>
<script>
	function payadvjob(id){
		var job_id = id;
		window.location.href='./pardakht.php?job_id='+job_id;
	}
	function payMashaqel(id){
		var mashaqel_id = id;
		window.location.href='./pardakht.php?mashaqel_id='+mashaqel_id;
	}
</script>
        
  </body>
</html>
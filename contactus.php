<?php require_once('./inc_theme/headerP.php') ?>
<?php require_once('./inc_theme/modal.php') ?>
  
   <!-- Contact us -->
   <section id="contact-uss">
   		<div class="container text-center">
   			<div class="row">
   				<div class="contact-form col-md-6 col-xs-12">
   					<div class="contc-txt">
   					<div class="panel" style="border: none;height: auto;min-height: 140px">
   						<div class="panel-heading" style="border: none">
   							<h4 style="text-align: right;color: #E01931">جهت برقراری ارتباط با ما</h4>
   						</div>
   						<div class="panel-body">
   							<h5 style="text-align: justify;direction: rtl"> میتواند از این فرم استفاده کنید و ظرف مدت 24 ساعت جواب خود را دریافت کنید / درصورتی که نیاز به تماس فوری دارید با شماره های شرکت تماس بگیرید .</h5>
   							<div class="col-xs-12" style="padding: 0;text-align: right"><strong><i class="fa fa-phone-square fa-1x" style="font-size: 16px"></i>&nbsp;  0911-149-5463</strong></div>
							<div class="col-xs-12" style="padding: 0;text-align: right"><strong><i class="fa fa-envelope fa-1x"></i>&nbsp;  Info@niazerasht.ir</strong></div>
  							<div class="col-xs-12" style="padding: 0;text-align: right"><strong><i class="fa fa-map-marker fa-1x"></i>&nbsp;  گیلان - رشت</strong></div>
   						</div>
   					</div>
   					</div>
   				</div>
<?php
if(isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$usrname = $_SESSION['usrLogin'];
		$DB = new DB();
		$User = new User();
		$resusrs = $User->SelectLoginUser($usrname);
		foreach($resusrs as $rows){
			$usrid = $rows['_id'];
			$usrnames = $rows['_fname'];
			$usremial = $rows['_email'];
			$usrmobile = $rows['_mobile'];
		}
?> 
   				<div class="contact-form col-md-6 col-xs-12">
   					<div class="col-xs-12">
   					<div class="panel">
   						<div class="panel-heading">
   							<h4 style="text-align: right">فرم تماس</h4>
   						</div>
   						<div class="panel-body">
   						<div id="contactres" style="margin: 0 15px;text-align: right">
                           	
                        </div>
					<div class="col-xs-12">
					 <input type="hidden" class="form-control" id="Cid" value="<?php echo $usrid; ?>">
						<div class="form-group">
							نام و نام خانوادگی : <input type="text" id="Cname" class="form-control" value="<?php echo $usrnames; ?>" style="color: #F0340F">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							شماره موبایل : <input type="tel" id="Cmobile" class="form-control" value="<?php echo $usrmobile; ?>" style="color: #F0340F">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							پست الکترونیکی : <input type="email" id="Cemail" class="form-control" value="<?php echo $usremial; ?>" style="color:#F0340F">
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<select class="btn btn-block dropdown" id="Ctype" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
							<option value="0">ارتباط با مدیر</option>
							<option value="1">بخش پشتیبانی فنی</option>
							<option value="2">بخش تبلیغات</option>
						</select>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="form-group">
							<input type="text" id="Ctitle" class="form-control" placeholder="عنوان">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<textarea class="form-control" id="Ctxt" placeholder="متن خود را وارد کنید" style="height:240px;resize: none"></textarea>
						</div>
					</div>
					<div class="col-xs-12">
						<button type="submit" id="Csendcontact" class="btn btn-default bt2" style="float: left">ارسال</button>
					</div>
   						</div>
   					</div>
   					
					
   				</div>
   			</div>
<?php
	}
}else
{
?>
				<div class="contact-form col-md-6 col-xs-12">
   					<div class="col-xs-12">
   					<div class="panel">
   						<div class="panel-heading">
   							<h4 style="text-align: right">فرم تماس</h4>
   						</div>
   						<div class="panel-body">
   						<div id="contactres" style="margin: 0 15px;text-align: right">
                           	
                        </div>
					<div class="col-xs-12">
					<input type="hidden" class="form-control" id="Cid" value="0">
						<div class="form-group">
							<input type="text" id="Cname" class="form-control" placeholder="نام و نام خانوادگی">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<input type="tel" id="Cmobile" class="form-control" placeholder="شماره موبایل">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<input type="email" id="Cemail" class="form-control" placeholder="پست الکترونیکی">
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<select class="btn btn-block dropdown" id="Ctype" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
							<option value="0">ارتباط با مدیر</option>
							<option value="1">بخش پشتیبانی فنی</option>
							<option value="2">بخش تبلیغات</option>
						</select>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="form-group">
							<input type="text" id="Ctitle" class="form-control" placeholder="عنوان">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<textarea class="form-control" id="Ctxt" placeholder="متن خود را وارد کنید" style="height:240px;resize: none"></textarea>
						</div>
					</div>
					<div class="col-xs-12">
						<button type="submit" id="Csendcontact" class="btn btn-default bt2" style="float: left">ارسال</button>
					</div>
   						</div>
   					</div>
   					
					
   				</div>
   			</div>
<?php
}
?> 
   		</div>
   	
   </section>
   
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>
 
  </body>
</html> 
<?php require_once('./inc_theme/header.php') ?>
<?php
if (!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] == ""){
	header("location:../index.php");
	exit();
}
?>
<?php
$ViewAD = new ViewAD();
$resadv = $ViewAD->ViewCount();
$User = new User();
$resusr = $User->UserCount();
$Karfarma = new Karfarma();
$reskarfrma = $Karfarma->KarfarmaCount();
$Mashaqel = new Mashaqel();
$resmashaqel = $Mashaqel->MashaqelCount();

$counter = 0;
$DB = new DB();
$Contactus = new Contactus();
$tiket = $Contactus->ReadTicketManager();
foreach($tiket as $rows)
{
	if($rows['_stutus']==0){
		$counter++;
	}
}
$counter1 = 0;
$DB = new DB();
$Contactus = new Contactus();
$tiket1 = $Contactus->ReadTicketSupport();
foreach($tiket1 as $rows)
{
	if($rows['_stutus']==0){
		$counter1++;
	}
}
$counter2 = 0;
$DB = new DB();
$Contactus = new Contactus();
$tiket1 = $Contactus->ReadTicketAds();
foreach($tiket1 as $rows)
{
	if($rows['_stutus']==0){
		$counter2++;
	}
}
$allCounter = $counter+$counter1+$counter2;
?>
      <div class="col-sm-9 col-md-10 main">
        <h2 class="page-header">پیشخوان</h2>
          <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>0</h3>
                  <p>سفارش تبلیغ جدید</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
             </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $reskarfrma; ?></h3>
                  <p>کارفرما ثبت نام کرده</p>
                </div>
                <div class="icon">
                  <i class="fa fa-line-chart"></i>
                </div>
                <a href="./users.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $resusr; ?></h3>
                  <p>کارجو ثبت نام کرده</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-plus"></i>
                </div>
                <a href="./users.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>۶۵</h3>
                  <p>بازدید کننده</p>
                </div>
                <div class="icon">
                  <i class="fa fa-area-chart"></i>
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3>0</h3>
                  <p>نظر تایید نشده</p>
                </div>
                <div class="icon">
                  <i class="fa fa-commenting"></i>
                </div>
                <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3><?php echo $allCounter; ?></h3>
                  <p>تیکت جدید</p>
                </div>
                <div class="icon">
                  <i class="fa fa-ticket"></i>
                </div>
                <a href="./ticket.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->

             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-lime">
                <div class="inner">
                  <h3><?php echo $resmashaqel; ?></h3>
                  <p>مشاغل ثبت شده</p>
                </div>
                <div class="icon">
                  <i class="fa fa-object-ungroup"></i>
                </div>
                <a href="./edit-co.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $resadv; ?></h3>
                  <p>آگهی ثبت شده</p>
                </div>
                <div class="icon">
                  <i class="fa fa-credit-card"></i>
                </div>
                <a href="./edit-job.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
              </div>
            </div><!-- ./col -->
          
          </div><!-- /.row -->
		</section>
     	<h4 class="page-header">آمار سایت</h4>
     	<section>
     		<div class="row">
     			<div class="site-state col-md-6 col-xs-6 pull-left">
				<span><label class="alert-success"><h4><i class="fa fa-globe"></i> تعداد بازدید امروز: 1050 نفر</h4></label></span>
				<span><label class="alert-danger"><h4><i class="fa fa-globe"></i> تعداد بازدید دیروز: 5520 نفر</h4></label></span>
				<span><label class="alert-warning"><h4><i class="fa fa-globe"></i> تعداد بازدید ماه: 25520 نفر</h4></label></span>
				<span><label class="alert-info"><h4><i class="fa fa-globe"></i> تعداد بازدید کل سایت: 10052550 نفر</h4></label></span>
     			</div>
     			<div class="site-state col-md-6 col-xs-6 pull-right">
     				<h5>چارت در حال حاضر غیر فعال است</h5>
     			</div>
     		</div>
     	</section>
     	<h4 class="page-header">وضعیت مدیران سایت</h4>
     	<section>
     		<div class="row">
<?php
$DB = new DB();
$Admin = new Admin();
$resAdmin = $Admin->ReadAdmin();
foreach($resAdmin as $rows)
{
?>     		
     			<div class="site-admin col-md-4 col-xs-6">
     				<span>
     					<label class="alert-info">
     						<div class="col-md-3 col-xs-6 pull-right">
     							<i class="fa fa-user-circle fa-4x" style="padding-top: 5px"></i>
     						</div>
							
     						<div class="col-md-9 col-xs-12 pull-left">
     							<h4>مدیر : <?php echo $rows['_name']; ?></h4>
     							<h5>وضعیت : آفلاین</h5>
     						</div>

     					</label>
     				</span>
     			</div>
<?php
}
?>
     			<div class="site-state col-md-4 col-xs-6">
     				
     			</div>
     			<div class="site-state col-md-4 col-xs-6">
     				
     			</div>
     		</div>
     	</section>
     	<h4 class="page-header">نتیجه نظرسنجی</h4>
     	<section>
     		<div class="row">
     			<div class="col-xs-12 pull-right">
     				<h5>در حال حاضر نظر سنجی فعال وجود ندارد</h5>
     			</div>
     		</div>
     	</section>
     	<h4 class="page-header">پاسخ به ایمیل ها و نظرات</h4>
     	<section>
     		<h5>به زودی این بخش فعال می شود</h5>
     	</section>
      </div>
          
        </div>
	  </div>
	</div>
<?php require_once('./inc_theme/jquery.php') ?>
    
  </body>
</html>

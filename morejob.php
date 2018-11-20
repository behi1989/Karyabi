<?php require_once('./inc_theme/headerP.php') ?>
<?php require_once('./inc_theme/modal.php') ?>

<?php

	if (!isset($_GET['id'])){
		header("location:index.php?msg=1001");
		exit();
	}else{
		$id = check_safe_get($_GET['id']);
	}
?>

<!-- More Job -->
	<section id="more-job">
		<div class="container text-center">
			<div class="right-slide col-md-3">
				<div class="pnlljob">
<?php
$DB = new DB();
$Adv = new Adv();
$rec = $Adv->ShowAdvInJobs();
foreach($rec as $rows)
{
?>
					<img src="./_upload/adv/ads/<?php echo $rows['_advPic']; ?>" class="img-responsive" style="width: 300px;height: 250px">
<?php
}
?>
				</div>
			</div>
			<div class="more-job col-md-9 col-xs-12">
				<div class="panel pnljob">
<?php
	$advtaeed = NULL;
	$advpay = NULL;
	$DB = new DB();
	$viewAD = new ViewAD();
	$res = $viewAD->ReadAdds($id);
	foreach($res as $rows)
		$advview = $rows['_advView'];
	{	
?>
					<div class="panel-heading" style="border-bottom: 3px solid #8657DB">
						<h4><i class="fa fa-thumb-tack" style="color: #8657DB"></i> <?php echo $rows['_jobTitle'] ?> </h4>
						<h5><i class="fa fa-calendar" style="color: #F24D16"></i> <?php echo jdate('Y/m/d',$rows['_addDate']) ?> &nbsp; &nbsp; <i class="fa fa-clock-o" style="color: #F24D16"></i> <?php echo $rows['_advTime'] ?> &nbsp; &nbsp; <i class="fa fa-eye" style="color: #F24D16"></i> <?php echo $rows['_advView']+1 ?></h5>
					</div>
					<div class="panel-body">
						<table class="table-bordered table-hover">
							<thead style="background: #444;color: #FFF;">
							<tr>
								<th style="text-align: center;width: 150px;padding: 10px">عنوان</th>
								<th style="text-align: center">توضیحات</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td>نام شرکت</td>
									<td><?php echo $rows['_coName'] ?></td>
								</tr>
								<tr>
									<td>نام درخواست دهنده</td>
									<td><?php echo $rows['_bossName'] ?></td>
								</tr>
								<tr>
									<td>آدرس شرکت</td>
									<td><?php echo $rows['_coAddress'] ?></td>
								</tr>
								<tr>
									<td>تلفن</td>
									<td><?php echo $rows['_coTel'] ?></td>
								</tr>
								<tr>
									<td>موبایل</td>
									<td><?php echo $rows['_mobile'] ?></td>
								</tr>
								<tr>
									<td>ایمیل</td>
									<td><?php echo $rows['_coEmail'] ?></td>
								</tr>
								<tr>
									<td>وب سایت</td>
									<td><?php echo $rows['_coWeb'] ?></td>
								</tr>
								<tr>
									<td>شغل درخواستی</td>
									<td><?php echo $rows['_jobReq'] ?></td>
								</tr>
								<tr>
									<td>تحصیلات</td>
									<td><?php echo $rows['_edu'] ?></td>
								</tr>
								<tr>
									<td>رشته تحصیلی</td>
									<td><?php echo $rows['_degree'] ?></td>
								</tr>
								<tr>
									<td>گرایش</td>
									<td><?php echo $rows['_sience'] ?></td>
								</tr>
								<tr>
									<td>تعداد نیرو</td>
									<td><?php echo $rows['_reqNo'] ?> نفر</td>
								</tr>
								<tr>
									<td>تخصص</td>
									<td><?php echo $rows['_export'] ?></td>
								</tr>
								<tr>
									<td>جنسیت</td>
									<td><?php echo $viewAD->gender($rows['_gender'])  ?></td>
								</tr>
								<tr>
									<td>سن مورد نیاز</td>
									<td><?php echo $rows['_age'] ?></td>
								</tr>
								<tr>
									<td>تاهل</td>
									<td><?php echo $viewAD->married($rows['_married']) ?></td>
								</tr>
								<tr>
									<td>وضعیت بیمه</td>
									<td><?php echo $viewAD->bime($rows['_bime']) ?></td>
								</tr>
								<tr>
									<td>وضعیت نظام وظیفه</td>
									<td><?php echo  $viewAD->khedmat($rows['_khedmat']) ?></td>
								</tr>
								<tr>
									<td>ایاب و ذهاب</td>
									<td><?php echo $rows['_ayabzahab'] ?></td>
								</tr>
								<tr>
									<td>زمان کار</td>
									<td><?php echo $rows['_workTime'] ?></td>
								</tr>
								<tr>
									<td>حقوق پرداختی</td>
									<td><?php echo number_format($rows['_workPay']) ?> تومان</td>
								</tr>
								<tr>
									<td>شهر محل کار</td>
									<td><?php echo $rows['_workCity'] ?></td>
								</tr>
								<tr>
									<td>توضیحات</td>
									<td><?php echo $rows['_explain'] ?></td>
								</tr>
							</tbody>
						</table>
					</div>
<?php
$advview = $advview+1;
$resU = $viewAD->UpdateViewAds($advview,$id);
	}
?>
					<div class="panel-footer" style="text-align: left">
						<button type="button" class="btn btn-info"><i class="fa fa-print"></i> پرینت</button>
						<button type="button" class="btn btn-success"><i class="fa fa-share-alt"></i> اشتراک گذاری</button>
					</div>
				</div>
			</div>

		</div>
	</section>
 	
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>
    
  </body>
</html>
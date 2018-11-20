<?php
session_start();
ob_start();
require_once str_replace('\\','/',dirname(dirname(__FILE__))).'/config.php';

function AutoLoad($className){
	if (file_exists(ROOT . 'inc_func/class.' . $className . '.php')){
		require_once ROOT . 'inc_func/class.' . $className . '.php';
	}
}
spl_autoload_register('AutoLoad');
require_once ROOT . 'inc_func/jdf.php';
require_once ROOT . 'inc_func/set-config.php';

if(!isset($_SERVER['HTTP_REFERER'])){
	exit('<h3 style=color:blue;text-align:center>چنین صفحه ای وجود ندارد یا دسترسی به آن برای شما مجاز نمی باشد</h3><h4 style=color:blue;text-align:center><a href=./dashboard.php>برگشت به پنل</a></h4>');
}

if(isset($_POST["dsend"])){
	$idD = check_safe_post($_POST['id']);
	$DB = new DB();
	$News = new News();
	$whereD = "`_id`=".$idD;
	$Dres = $News->ReadEventNews($whereD);
	foreach($Dres as $rows){
		$imgDname = $rows['_newsPic'];
	}
	$resD = $News->DeleteNews($idD);
	if(!empty($imgDname)){
	if(file_exists("../_upload/".$imgDname)){
		unlink("../_upload/".$imgDname);
		}
	}
	if($resD){
		echo '<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		آگهی با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>


<?php
if (isset($_POST['editNU'])){
	//بررسی سایر خطاهای سرور
	if ($_FILES["user-file"]["error"] > 0){
		echo "<div class=\"server\">خطا: " . $_FILES["user-file"]["error"] . "</div><br />";
		$check_result = 0;
		}
	else{
			$idU = $_POST['idU'];
			$filename = $_FILES['user-file']['name'];
			$filetmp = $_FILES['user-file']['tmp_name'];
			$filetype = $_FILES['user-file']['type'];
			$filesize = $_FILES['user-file']['size'];
			$ext = array("image/jpeg","image/jpg","image/png");
		
        if($filesize > 5000000){
			echo "<div class=\"server\">سایز عکس کمتر از 500 کیلوبایت باشد<br /><br /></div><br />";
			$check_result = 0;
		}
		else if(!(in_array($filetype,$ext))){
			echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
			$check_result = 0;
		}
		else if(empty($filename)){
			echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
			$check_result = 0;
		}
		else{		
		//انتقال و ذخیره فایل در سرور
			$filenames = md5(uniqid($filename)).substr($filename,-5,5);
			$newstitle = $_POST['newstitle'];
			$newstext = check_safe_post($_POST['newsText']);
			$newssource = check_safe_post($_POST['newssource']);
			$newsdate = time();
			date_default_timezone_set("Asia/Tehran");
			$newstime = date("H:i");
			$newswritter = check_safe_post($_POST['newswritter']);
			$newstype = check_safe_post($_POST['newstype']);
			$newskey = check_safe_post($_POST['newskey']);
			$idU = check_safe_post($_POST['idU']);
				$DB = new DB();
				$News = new News();
				$where = "`_id`=".$idU;
				$Ures = $News->ReaIDNews($where);
				foreach($Ures as $rows){
					$imgname = $rows['_newsPic'];
				}
				if(!empty($imgname)){
					if(file_exists("../_upload/".$imgname)){
						unlink("../_upload/".$imgname);
					}
				}
			$DB = new DB();
			$News = new News();
			$resU = $News->UpdateNews($newstitle,$newstext,$filenames,$newssource,$newsdate,$newstime,$newswritter,$newskey,$newstype,$idU);
			move_uploaded_file($_FILES["user-file"]["tmp_name"],"../_upload/".$filenames);
			$check_result = 1;		
		}
	}
}
?>
<script type="text/javascript">
window.top.window.upload_end(<?php echo $check_result; ?>);
</script>


<?php
if(isset($_POST['editNI'])){
if(isset($_POST['newsititle']) && isset($_POST['newsiText']) && isset($_POST['newsisource']) && isset($_POST['newsiwritter']) && isset($_POST['newsikey']) && isset($_POST['newsitype']) && isset($_FILES["user-ifile"])){
	
	if(!empty($_POST['newsititle']) && !empty($_POST['newsiText'])  && !empty($_POST['newsisource'])  && !empty($_POST['newsitype']) && !empty($_POST['newsikey'])){
		$newsititle = $_POST['newsititle'];
		$newsitext = check_safe_post($_POST['newsiText']);
		$newsisource = check_safe_post($_POST['newsisource']);
		$newsidate = time();
		date_default_timezone_set("Asia/Tehran");
		$newsitime = date("H:i");
		$newsiwritter = check_safe_post($_POST['newsiwritter']);
		$newsitype = check_safe_post($_POST['newsitype']);
		$newsikey = check_safe_post($_POST['newsikey']);
		if(isset($_FILES['user-ifile'])){
			$fileiname = $_FILES['user-ifile']['name'];
			$fileitmp = $_FILES['user-ifile']['tmp_name'];
			$fileitype = $_FILES['user-ifile']['type'];
			$fileisize = $_FILES['user-ifile']['size'];
			$iext = array("image/jpeg","image/jpg","image/png");
		if($fileisize > 5000000){
			echo "<div class=\"server\">سایز عکس کمتر از 500 کیلوبایت باشد<br /><br /></div><br />";
			$check_iresult = 0;
		}
		else if(!(in_array($fileitype,$iext))){
			echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
			$check_iresult = 0;
		}
		else if(empty($fileiname)){
			echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
			$check_iresult = 0;
		}
		else{
			$fileinames = md5(uniqid($fileiname)).substr($fileiname,-5,5);
			$DB = new DB();
			$News = new News();
			$resU = $News->InsertNews($newsititle,$newsitext,$fileinames,$newsisource,$newsidate,$newsitime,$newsiwritter,$newsikey,$newsitype);
			move_uploaded_file($_FILES["user-ifile"]["tmp_name"],"../_upload/" . $fileinames);
			$check_iresult = 1;	
			
		}
	}
}else{
		echo "<div class=\"server\">لطفا فیلد های ستاره دار را پر کنید<br /><br /></div><br />";
		$check_iresult = 0;
	}
}else{
	echo "<div class=\"server\">اخطار عدم دریافت فیلد های ورودی<br /><br /></div><br />";
		$check_iresult = 0;
}
}
?>
<script type="text/javascript">
	window.top.window.upload_iend(<?php echo $check_iresult; ?>);
</script>

<?php
if(isset($_POST["advdsend"])){
	$idadv = check_safe_post($_POST['idadv']);
	$DB = new DB();
	$Adv = new Adv();
	$whereadv = "`_id`=".$idadv;
	$advres = $Adv->ReadAdvByID($whereadv);
	foreach($advres as $rowsad){
		$imgadvname = $rowsad['_advPic'];
		$advtyp = $rowsad['_advType'];
	}
	$resDadv = $Adv->DeleteAdv($idadv);
	if(!empty($imgadvname)){
		if($advtyp == 0){
			if(file_exists("../_upload/adv/main/".$imgadvname)){
				unlink("../_upload/adv/main/".$imgadvname);
			}
		}else if($advtyp == 1){
			if(file_exists("../_upload/adv/ads/".$imgadvname)){
				unlink("../_upload/adv/ads/".$imgadvname);
			}
		}else if($advtyp == 2){
			if(file_exists("../_upload/adv/news/".$imgadvname)){
				unlink("../_upload/adv/news/".$imgadvname);
			}
		}else if($advtyp == 3){
			if(file_exists("../_upload/adv/other/".$imgadvname)){
				unlink("../_upload/adv/other/".$imgadvname);
			}
		}
	}
	if($resDadv){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		تبلیغ با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['advInsert'])){
	if(empty($_POST['advcustomerid']) && empty($_POST['advcustomername']) && empty($_POST['advcustomertel']) && empty($_POST['advcustomeraddress']) && empty($_POST['advpaystate']) && empty($_POST['advtype'])){
		echo "<div class=\"server\">لطفا فیلد های ستاره دار را پر کنید<br /><br /></div><br />";
		$check_advres = 0;
	}else{
		$advcustomerid = check_safe_post($_POST['advcustomerid']);
		$advcustomername = check_safe_post($_POST['advcustomername']);
		$advcustomertel = check_safe_post($_POST['advcustomertel']);
		$advcustomeraddress = check_safe_post($_POST['advcustomeraddress']);
		$advpaystate = check_safe_post($_POST['advpaystate']);
		$advrecivepay = check_safe_post($_POST['advrecivepay']);
		$advrecivebank = check_safe_post($_POST['advrecivebank']);
		$advtype = check_safe_post($_POST['advtype']);
		$advdate = time();
		date_default_timezone_set("Asia/Tehran");
		$advtime = date("H:i");
		if(isset($_FILES['adv-file'])){
				$advfileiname = $_FILES['adv-file']['name'];
				$advfileitmp = $_FILES['adv-file']['tmp_name'];
				$advfileitype = $_FILES['adv-file']['type'];
				$advfileisize = $_FILES['adv-file']['size'];
				$adviext = array("image/jpeg","image/jpg","image/png","image/gif");
			if($advfileisize > 5000000){
				echo "<div class=\"server\">سایز عکس کمتر از 500 کیلوبایت باشد<br /><br /></div><br />";
				$check_advres = 0;
			}
			else if(!(in_array($advfileitype,$adviext))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_advres = 0;
			}
			else if(empty($advfileiname)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_advres = 0;
			}
		
		else{
			$advfilename = md5(uniqid($advfileiname)).substr($advfileiname,-5,5);
			$DB = new DB();
			$Adv = new Adv();
			$resAdv = $Adv->InsertAdv($advfilename,$advdate,$advtime,$advcustomerid,$advcustomername,$advcustomertel,$advcustomeraddress,$advpaystate,$advrecivepay,$advrecivebank,$advtype);
			if($advtype == 0){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/main/" . $advfilename);
			}else if($advtype == 1){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/ads/" . $advfilename);
			}else if($advtype == 2){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/news/" . $advfilename);
			}else if($advtype == 3){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/other/" . $advfilename);
			}
			$check_advres = 1;
			}
		}
	}	
}
?>
<script type="text/javascript">
	window.top.window.Insert_advEnd(<?php echo $check_advres; ?>);
</script>


<?php
if (isset($_POST['editadv'])){
	//بررسی سایر خطاهای سرور
	if ($_FILES["adv-file"]["error"] > 0){
		echo "<div class=\"server\">خطا: " . $_FILES["adv-file"]["error"] . "</div><br />";
		$check_advress = 0;
		}
	else{
			$filenameadv = $_FILES['adv-file']['name'];
			$filetmpadv = $_FILES['adv-file']['tmp_name'];
			$filetypeadv = $_FILES['adv-file']['type'];
			$filesizeadv = $_FILES['adv-file']['size'];
			$extadv = array("image/jpeg","image/jpg","image/png","image/gif");
		
        if($filesizeadv > 5000000){
			echo "<div class=\"server\">سایز عکس کمتر از 500 کیلوبایت باشد<br /><br /></div><br />";
			$check_advress = 0;
		}
		else if(!(in_array($filetypeadv,$extadv))){
			echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
			$check_advress = 0;
		}
		else if(empty($filenameadv)){
			echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
			$check_advress = 0;
		}
		else{		
		//انتقال و ذخیره فایل در سرور
			$filenamesadv = md5(uniqid($filenameadv)).substr($filenameadv,-5,5);
			$advcustomername = check_safe_post($_POST['customname']);
			$advcustomertel = check_safe_post($_POST['customtel']);
			$advcustomeraddress = check_safe_post($_POST['customaddress']);
			$advpaystate = check_safe_post($_POST['customtype']);
			$advrecivepay = check_safe_post($_POST['advrecivepays']);
			$advrecivebank = check_safe_post($_POST['advpaybanks']);
			$advtypea = check_safe_post($_POST['advplaces']);
			$advdate = time();
			date_default_timezone_set("Asia/Tehran");
			$advtime = date("H:i");
			$idUadv = check_safe_post($_POST['idNAdv']);
				$DB = new DB();
				$Adv = new Adv();
				$whereadv = "`_id`=".$idUadv;
				$Uresadv = $Adv->ReadAdvByID($whereadv);
				foreach($Uresadv as $rowsadv){
					$imgnameadv = $rowsadv['_advPic'];
					$advtypp = $rowsadv['_advType'];
				}
				if(!empty($imgnameadv)){
					if($advtypp == 0){
						if(file_exists("../_upload/adv/main/".$imgnameadv)){
						unlink("../_upload/adv/main/".$imgnameadv);
						}
					}else if($advtypp == 1){
						if(file_exists("../_upload/adv/ads/".$imgnameadv)){
						unlink("../_upload/adv/ads/".$imgnameadv);
						}
					}else if($advtypp == 2){
						if(file_exists("../_upload/adv/news/".$imgnameadv)){
						unlink("../_upload/adv/news/".$imgnameadv);
						}
					}else if($advtypp == 3){
						if(file_exists("../_upload/adv/other/".$imgnameadv)){
						unlink("../_upload/adv/other/".$imgnameadv);
						}
					}
				}
			$DB = new DB();
			$Adv = new Adv();
			$resUadv = $Adv->UpdateAdv($filenamesadv,$advdate,$advtime,$advcustomername,$advcustomertel,$advcustomeraddress,$advpaystate,$advrecivepay,$advrecivebank,$advtypea,$idUadv);
			if($advtypea == 0){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/main/".$filenamesadv);
			}else if($advtypea == 1){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/ads/".$filenamesadv);
			}else if($advtypea == 2){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/news/".$filenamesadv);
			}else if($advtypea == 3){
				move_uploaded_file($_FILES["adv-file"]["tmp_name"],"../_upload/adv/other/".$filenamesadv);
			}
			$check_advress = 1;		
		}
	}
}
?>
<script type="text/javascript">
window.top.window.advedit_end(<?php echo $check_advress; ?>);
</script>


<?php
if(isset($_POST['sendav'])){
	$title = check_safe_post($_POST['title']);
	$coname = check_safe_post($_POST['coname']);
	$bossname = check_safe_post($_POST['bossname']);
	$address = check_safe_post($_POST['coAddress']);
	$tel = check_safe_post($_POST['tel']);
	$mobile = check_safe_post($_POST['mobile']);
	$email = check_safe_post($_POST['email']);
	$web = check_safe_post($_POST['web']);
	$jobreq = check_safe_post($_POST['jobreq']);
	$edu = check_safe_post($_POST['edu']);
	$degree = check_safe_post($_POST['degree']);
	$sience = check_safe_post($_POST['sience']);
	$reqno = check_safe_post($_POST['reqno']);
	$export = check_safe_post($_POST['exports']);
	$gender = check_safe_post($_POST['gender']);
	$age = check_safe_post($_POST['age']);
	$married = check_safe_post($_POST['married']);
	$bime = check_safe_post($_POST['bime']);
	$khedmat = check_safe_post($_POST['khedmat']);
	$ayabzahab = check_safe_post($_POST['ayabzahab']);
	$worktime = check_safe_post($_POST['worktime']);
	$workpay = check_safe_post($_POST['workpay']);
	$workcity = check_safe_post($_POST['workcity']);
	$idd = check_safe_post($_POST['idd']);
	$taeed = 1;
	$pay = 1;
	$advType = 0;
	$date = time();
	date_default_timezone_set("Asia/Tehran");
	$time = date("H:i");
	$expalin = check_safe_post($_POST['expalin']);
	$advUser = 1;
	$advUserid = $idd;
	if (!empty($title) && !empty($coname) && !empty($bossname) && !empty($coname) && !empty($address) && !empty($tel) && !empty($jobreq) && !empty($edu) && !empty($gender) && !empty($reqno) && !empty($export) && !empty($age) && !empty($ayabzahab) && !empty($worktime) && !empty($workpay) && !empty($workcity)){
		$ViewAD = new ViewAD();
		$resad = $ViewAD->InsertAD($title,$coname,$bossname,$address,$tel,$mobile,$email,$web,$jobreq,$edu,$degree,$sience,$reqno,$export,$gender,$age,$married,$bime,$khedmat,$ayabzahab,$worktime,$workpay,$workcity,$taeed,$pay,$advType,$date,$time,$expalin,$advUser,$advUserid);
	if($resad){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		آگهی با موفقیت درج شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		درج آگهی انجام نشد لطفا به پشتیبانی سایت گزارش دهید
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		لطفا فیلد های ستاره دار را پر کنید
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST["dadvsend"])){
	$iduu = check_safe_post($_POST['iduu']);
	$DB = new DB();
	$ViewAD = new ViewAD();
	$ress = $ViewAD->DeleteAD($iduu);
	if($ress){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		آگهی با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['uesend'])){
	$uid = check_safe_post($_POST['uuid']);
	$title = check_safe_post($_POST['utitle']);
	$coname = check_safe_post($_POST['uconame']);
	$bossname = check_safe_post($_POST['ubossname']);
	$address = check_safe_post($_POST['ucoAddress']);
	$tel = check_safe_post($_POST['utel']);
	$mobile = check_safe_post($_POST['umobile']);
	$email = check_safe_post($_POST['uemail']);
	$web = check_safe_post($_POST['uweb']);
	$jobreq = check_safe_post($_POST['ujobreq']);
	$edu = check_safe_post($_POST['uedu']);
	$degree = check_safe_post($_POST['udegree']);
	$sience = check_safe_post($_POST['usience']);
	$reqno = check_safe_post($_POST['ureqno']);
	$export = check_safe_post($_POST['uexports']);
	$gender = check_safe_post($_POST['ugender']);
	$age = check_safe_post($_POST['uage']);
	$married = check_safe_post($_POST['umarried']);
	$bime = check_safe_post($_POST['ubime']);
	$khedmat = check_safe_post($_POST['ukhedmat']);
	$ayabzahab = check_safe_post($_POST['uayabzahab']);
	$worktime = check_safe_post($_POST['uworktime']);
	$workpay = check_safe_post($_POST['uworkpay']);
	$workcity = check_safe_post($_POST['uworkcity']);
	$date = time();
	date_default_timezone_set("Asia/Tehran");
	$time = date("H:i");
	$uexpalin = check_safe_post($_POST['uexpalin']);
	$DB = new DB();
	$ViewAD = new ViewAD();
	$resuu = $ViewAD->EditAD($title,$coname,$bossname,$address,$tel,$mobile,$email,$web,$jobreq,$edu,$degree,$sience,$reqno,$export,$gender,$age,$married,$bime,$khedmat,$ayabzahab,$worktime,$workpay,$workcity,$date,$time,$uexpalin,$uid);
	if($resuu){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		اطلاعات شما با موفقیت ویرایش شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		اطلاعات شما متاسفانه ویرایش نشد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if (isset($_POST['sendjobid'])){
	$jobid = check_safe_get($_POST['jobid']);
	$taeedjob = 1;
	$DB = new DB();
	$ViewAD = new ViewAD();
	$resupdjobid = $ViewAD->UpdateViewAdsTaeed($taeedjob,$jobid);
		if($resupdjobid){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		اطلاعات شما با موفقیت ویرایش شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		اطلاعات شما متاسفانه ویرایش نشد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if (isset($_POST['sendjobidt'])){
	$jobid = check_safe_get($_POST['jobidt']);
	$taeedjob = 0;
	$DB = new DB();
	$ViewAD = new ViewAD();
	$resupdjobid = $ViewAD->UpdateViewAdsTaeed($taeedjob,$jobid);
		if($resupdjobid){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		اطلاعات شما با موفقیت ویرایش شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		اطلاعات شما متاسفانه ویرایش نشد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if (isset($_POST['sendjobids'])){
	$jobid = check_safe_get($_POST['jobids']);
	$vijehjob = 1;
	$DB = new DB();
	$ViewAD = new ViewAD();
	$resupdjobid = $ViewAD->UpdateViewAdsVijeh($vijehjob,$jobid);
		if($resupdjobid){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		اطلاعات شما با موفقیت ویرایش شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		اطلاعات شما متاسفانه ویرایش نشد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php 
if(isset($_POST['ins-mashaqel'])){
	if(empty($_POST['Mconame']) && empty($_POST['Mcoadmin']) && empty($_POST['Mcotel']) && empty($_POST['McoAddress']) && empty($_POST['Mtxt1']) && empty($_POST['Mcopaystate']) && empty($_POST['Mcorecivepay']) && empty($_POST['Mcorecivebank'])){
		echo "<div class=\"server\">لطفا فیلد های ستاره دار را پر کنید<br /><br /></div><br />";
		$check_mashaqel = 0;
	}else{
		$Mconame = check_safe_post($_POST['Mconame']);
		$Mcoadmin = check_safe_post($_POST['Mcoadmin']);
		$Mcotel = check_safe_post($_POST['Mcotel']);
		$Mcoaddress = check_safe_post($_POST['McoAddress']);
		$Mcotxt1 = check_safe_post($_POST['Mtxt1']);
		$Mcotxt2 = check_safe_post($_POST['Mtxt2']);
		$Mcotxt3 = check_safe_post($_POST['Mtxt3']);
		$Mcoexplain = check_safe_post($_POST['Mcoexplain']);
		$Mcopaystate = check_safe_post($_POST['Mcopaystate']);
		$Mcorecivepay = check_safe_post($_POST['Mcorecivepay']);
		$Mcorecivebank = check_safe_post($_POST['Mcorecivebank']);
		$Mcodate = time();
		date_default_timezone_set("Asia/Tehran");
		$Mcotime = date("H:i");
		
		if(isset($_FILES['Mcoimg-file'])){
				$Mcofileiname = $_FILES['Mcoimg-file']['name'];
				$Mcofileitmp = $_FILES['Mcoimg-file']['tmp_name'];
				$Mcofileitype = $_FILES['Mcoimg-file']['type'];
				$Mcofileisize = $_FILES['Mcoimg-file']['size'];
				$Mcoiext = array("image/jpeg","image/jpg","image/png","image/gif");
			if($Mcofileisize > 3000000){
				echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
				$check_mashaqel = 0;
			}
			else if(!(in_array($Mcofileitype,$Mcoiext))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_mashaqel = 0;
			}
			else if(empty($Mcofileiname)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_mashaqel = 0;
			}
			
		else{
			$Mcofilename = md5(uniqid($Mcofileiname)).substr($Mcofileiname,-5,5);
			if(isset($_FILES['Mcoimg-file'])){
				$Mcofileinames = $_FILES['Mcoimgs-file']['name'];
				$Mcofileitmps = $_FILES['Mcoimgs-file']['tmp_name'];
				$Mcofileitypes = $_FILES['Mcoimgs-file']['type'];
				$Mcofileisizes = $_FILES['Mcoimgs-file']['size'];
				$Mcoiexts = array("image/jpeg","image/jpg","image/png","image/gif");
			if($Mcofileisizes > 3000000){
				echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
				$check_mashaqel = 0;
			}
			else if(!(in_array($Mcofileitypes,$Mcoiexts))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_mashaqel = 0;
			}
			else if(empty($Mcofileinames)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_mashaqel = 0;
			}
				if(!empty($Mcofileinames)){
					$Mcofilenames = md5(uniqid($Mcofileinames)).substr($Mcofileinames,-5,5);
				}else{
					$Mcofilenames = "";
				}
				
			}
			
			$DB = new DB();
			$Mashaqel = new Mashaqel();
			$resMashaqel = $Mashaqel->InsertMashaqel($Mconame,$Mcoadmin,$Mcodate,$Mcotime,$Mcotel,$Mcoaddress,$Mcotxt1,$Mcotxt2,$Mcotxt3,$Mcofilename,$Mcofilenames,$Mcoexplain,$Mcopaystate,$Mcorecivepay,$Mcorecivebank);
				move_uploaded_file($_FILES["Mcoimg-file"]["tmp_name"],"../_upload/mashaqel/".$Mcofilename);
				move_uploaded_file($_FILES["Mcoimgs-file"]["tmp_name"],"../_upload/mashaqel/".$Mcofilenames);
			$check_mashaqel = 1;
			}
		}else{
			echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
			$check_mashaqel = 0;
		}
	}
}
?>
<script type="text/javascript">
	window.top.window.Insert_Resmashaqel(<?php echo $check_mashaqel; ?>);
</script>

<?php
if(isset($_POST['editM'])){
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$idMM = check_safe_post($_POST['idMM']);
	$whereum = "`_id`=".$idMM;
	$UMres = $Mashaqel->ReadMashaqelByID($whereum);
	foreach($UMres as $rows){
		$imgco1 = $rows['_coImage'];
		$imgco2 = $rows['_imgmore1'];
	}
		if(isset($_FILES['Mashqelu-file'])){
			$Mfilename = $_FILES['Mashqelu-file']['name'];
			$Mfiletmp = $_FILES['Mashqelu-file']['tmp_name'];
			$Mfiletype = $_FILES['Mashqelu-file']['type'];
			$Mfilesize = $_FILES['Mashqelu-file']['size'];
			$Mext = array("image/jpeg","image/jpg","image/png");

			if($Mfilesize > 5000000){
				echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
				$check_mashaqels = 0;
			}
			else if(!(in_array($Mfiletype,$Mext))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_mashaqels = 0;
			}
			else if(empty($Mfilename)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_mashaqels = 0;
			}
			if(!empty($Mfilename)){
				$Mfilenames = md5(uniqid($Mfilename)).substr($Mfilename,-5,5);
			}else{
				$Mfilenames = $imgco1;
			}
		}
			if(isset($_FILES['Mashqelu1-file'])){
				$Mfilename1 = $_FILES['Mashqelu1-file']['name'];
				$Mfiletmp1 = $_FILES['Mashqelu1-file']['tmp_name'];
				$Mfiletype1 = $_FILES['Mashqelu1-file']['type'];
				$Mfilesize1 = $_FILES['Mashqelu1-file']['size'];
				$Mext1 = array("image/jpeg","image/jpg","image/png");

				if($Mfilesize1 > 5000000){
					echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
					$check_mashaqels = 0;
				}
				else if(!(in_array($Mfiletype1,$Mext1))){
					echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
					$check_mashaqels = 0;
				}
				else if(empty($Mfilename1)){
					echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
					$check_mashaqels = 0;
				}
				if(!empty($Mfilename1)){
					$Mfilenames1 = md5(uniqid($Mfilename1)).substr($Mfilename1,-5,5);
				}else{
					$Mfilenames1 = $imgco2;
				}
			}		

			$Mconameu = check_safe_post($_POST['Mconames']);
			$Mcoadminu = check_safe_post($_POST['Mcoadmins']);
			$Mcotelu = check_safe_post($_POST['Mcotels']);
			$Mcoaddressu = check_safe_post($_POST['Mcoadres']);
			$Mcotxt1u = check_safe_post($_POST['Mtxts1']);
			$Mcotxt2u = check_safe_post($_POST['Mtxts2']);
			$Mcotxt3u = check_safe_post($_POST['Mtxts3']);
			$Mcoexplainu = check_safe_post($_POST['Mexplains']);
			$Mcopaystateu = check_safe_post($_POST['Mpaystates']);
			$Mcorecivepayu = check_safe_post($_POST['Mrecivepays']);
			$Mcorecivebanku = check_safe_post($_POST['Mrecivebanks']);
			$Mcodateu = time();
			date_default_timezone_set("Asia/Tehran");
			$Mcotimeu = date("H:i");
			
				if(!empty($Mfilename)){
					if(!empty($imgco1)){
						if(file_exists("../_upload/mashaqel/".$imgco1)){
							unlink("../_upload/mashaqel/".$imgco1);
						}
					}
				}
				if(!empty($Mfilename1)){
					if(!empty($imgco2)){
						if(file_exists("../_upload/mashaqel/".$imgco2)){
							unlink("../_upload/mashaqel/".$imgco2);
						}
					}
				}

			$DB = new DB();
			$Mashaqel = new Mashaqel();
			$resUs = $Mashaqel->UpdateMashaqel($Mconameu,$Mcoadminu,$Mcodateu,$Mcotimeu,$Mcotelu,$Mcoaddressu,$Mcotxt1u,$Mcotxt2u,$Mcotxt3u,$Mfilenames,$Mfilenames1,$Mcoexplainu,$Mcopaystateu,$Mcorecivepayu,$Mcorecivebanku,$idMM);
			move_uploaded_file($_FILES["Mashqelu-file"]["tmp_name"],"../_upload/mashaqel/".$Mfilenames);
			if(isset($_FILES['Mashqelu1-file'])){
				move_uploaded_file($_FILES["Mashqelu1-file"]["tmp_name"],"../_upload/mashaqel/".$Mfilenames1);
			}
			$check_mashaqels = 1;		
	
}
?>
<script type="text/javascript">
window.top.window.Medit_end(<?php echo $check_mashaqels; ?>);
</script>


<?php
if(isset($_POST["Mdsend"])){
	$idMu = check_safe_post($_POST['idM']);
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$whereM = "`_id`=".$idMu;
	$Mres = $Mashaqel->ReadMashaqelByID($whereM);
	foreach($Mres as $rowsM){
		$img1 = $rowsM['_coImage'];
		$img2 = $rowsM['_imgmore1'];
	}
	$resDM = $Mashaqel->DeleteMashaqel($idMu);
	if($resDM){
		if(!empty($img1)){
			if(file_exists("../_upload/mashaqel/".$img1)){
			unlink("../_upload/mashaqel/".$img1);
			}
		}
		if(!empty($img2)){
			if(file_exists("../_upload/mashaqel/".$img2)){
			unlink("../_upload/mashaqel/".$img2);
			}
		}
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		بنر شغلی با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['Mtaeed'])){
	$idt = check_safe_get($_POST['idt']);
	$taeed = 1;
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$rest = $Mashaqel->UpdateMashaqeTaeed($taeed,$idt);
}
?>

<?php
if(isset($_POST['Mttaeed'])){
	$idta = check_safe_get($_POST['idta']);
	$taeed = 0;
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$rest = $Mashaqel->UpdateMashaqeTaeed($taeed,$idta);
}
?>

<?php
if(isset($_POST["tcsend"])){
	$tcid = check_safe_post($_POST['tcid']);
	$DB = new DB();
	$Contactus = new Contactus();
	$deltiket = $Contactus->DeleteTicket($tcid);
	if($deltiket){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		پیام با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>
<?php
if(isset($_POST["tcssend"])){
	$tcsid = check_safe_post($_POST['tcsid']);
	$DB = new DB();
	$Contactus = new Contactus();
	$deltikets = $Contactus->DeleteTicket($tcsid);
	if($deltikets){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		پیام با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>
<?php
if(isset($_POST["tcasend"])){
	$tcaid = check_safe_post($_POST['tcaid']);
	$DB = new DB();
	$Contactus = new Contactus();
	$deltiketa = $Contactus->DeleteTicket($tcaid);
	if($deltiketa){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		پیام با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['sendup1'])){
	$idup1 = check_safe_post($_POST['idup1']);
	$txtup1 = check_safe_post($_POST['txtans1']);
	date_default_timezone_set("Asia/Tehran");
	$dateM = time();
	$DB = new DB();
	$Contactus = new Contactus();
	$restiketsidl = $Contactus->ReadTicketById($idup1);
	foreach($restiketsidl as $row){
		$userID = $row['_usrID'];
		$email = $row['_email'];
		$text = $row['_text'];
	}
	if ($userID != 0){
	$deltiketu1 = $Contactus->UpdateTicket1($idup1,$txtup1,$dateM);
	if($deltiketu1){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		پیام با موفقیت بروزرسانی شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، بروزرسانی انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
	}else{
		//echo 'بهتره عنوان سوال هم ارسال بشه در کنار حواب ادمین';
		//echo "سوال شما: ".$text."<br>";
		$To = $email;
		$Subject = "پاسخ ادمین سایت";
		$header = "FROM: <behnam.gholipoor@gmail.com>";
		$Text = "سوال شما: ".$text."<br>"."پاسخ ادمین: ".$txtup1;
		$send = mail($To,$Subject,$Text,$header);
		$ticketStatus = $Contactus->UpdateTicket1($idup1,$txtup1,$dateM);
	}
}
?>


<?php
if(isset($_POST['sendup2'])){
	$idup2 = check_safe_post($_POST['idup2']);
	$txtup2 = check_safe_post($_POST['txtans2']);
	date_default_timezone_set("Asia/Tehran");
	$dateM = time();
	$DB = new DB();
	$Contactus = new Contactus();
	$restiketsid2 = $Contactus->ReadTicketById($idup2);
	foreach($restiketsid2 as $row){
		$userID1 = $row['_usrID'];
		$email1 = $row['_email'];
	}
	if ($userID1 != 0){
	$deltiketu2 = $Contactus->UpdateTicket1($idup2,$txtup2,$dateM);
	if($deltiketu2){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		پیام با موفقیت بروزرسانی شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، بروزرسانی انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
	}else{
		$To = $email1;
		$Subject = "پاسخ ادمین سایت";
		$header = "FROM: <behnam.gholipoor@gmail.com>";
		$Text = $txtup2;
		$send = mail($To,$Subject,$Text,$header);
		$ticketStatus = $Contactus->UpdateTicket1($idup2,$txtup2,$dateM);
	}
}
?>


<?php
if(isset($_POST['sendup3'])){
	$idup3 = check_safe_post($_POST['idup3']);
	$txtup3 = check_safe_post($_POST['txtans3']);
	date_default_timezone_set("Asia/Tehran");
	$dateM = time();
	$DB = new DB();
	$Contactus = new Contactus();
	$restiketsid3 = $Contactus->ReadTicketById($idup3);
	foreach($restiketsid3 as $row){
		$userID2 = $row['_usrID'];
		$email2 = $row['_email'];
	}
	if ($userID2 != 0){
	$deltiketu3 = $Contactus->UpdateTicket1($idup3,$txtup3,$dateM);
	if($deltiketu3){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		پیام با موفقیت بروزرسانی شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، بروزرسانی انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
	}else{
		$To = $email2;
		$Subject = "پاسخ ادمین سایت";
		$header = "FROM: <behnam.gholipoor@gmail.com>";
		$Text = $txtup3;
		$send = mail($To,$Subject,$Text,$header);
		$ticketStatus = $Contactus->UpdateTicket1($idup3,$txtup3,$dateM);
	}
}
?>


<?php
if(isset($_POST['usrsendt'])){
	$idusrt = check_safe_post($_POST['usridt']);
	$DB = new DB();
	$User = new User();
	$taeed = 1;
	$usrtaeed = $User->TaeedUser($taeed,$idusrt);
	if($usrtaeed){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		کاربر تایید شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، کاربر تایید نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['usrtsend'])){
	$idusrta = check_safe_post($_POST['usrtid']);
	$DB = new DB();
	$User = new User();
	$taeeda = 0;
	$usrtaeed = $User->TaeedUser($taeeda,$idusrta);
	if($usrtaeed){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		کاربر تعلیق شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، کاربر تایید نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST["usrdsend"])){
	$idusrd = check_safe_post($_POST['usrdid']);
	$DB = new DB();
	$User = new User();
	$usrdel = $User->DeleteUser($idusrd);
	if($usrdel){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		کاربر با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>


<?php
if(isset($_POST['karfarmasendt'])){
	$idkarfarmat = check_safe_post($_POST['karfarmaidt']);
	$DB = new DB();
	$Karfarma = new Karfarma();
	$taeed = 1;
	$karfarmataeed = $Karfarma->TaeedKarfarma($taeed,$idkarfarmat);
	if($karfarmataeed){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		کارفرما تایید شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، کارفرما تایید نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['karfarmatsend'])){
	$idkarfarmata = check_safe_post($_POST['karfarmatid']);
	$DB = new DB();
	$Karfarma = new Karfarma();
	$taeeda = 0;
	$karfarmataeed = $Karfarma->TaeedKarfarma($taeeda,$idkarfarmata);
	if($karfarmataeed){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		کارفرما تعلیق شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، کارفرما تایید نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST["karfarmadsend"])){
	$idkarfarmad = check_safe_post($_POST['karfarmadid']);
	$DB = new DB();
	$Karfarma = new Karfarma();
	$karfarmadel = $Karfarma->DeleteKarfarma($idkarfarmad);
	if($karfarmadel){
		'<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		کارفرما با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>


<?php
if(isset($_POST['adminsend'])){
$DB = new DB();
$Admin = new Admin();
	$name = check_safe_post($_POST['adname']);
	$email = check_safe_post($_POST['ademail']);
	$pass = check_safe_post(hash_pass($_POST['adpass']));
	$tel = check_safe_post($_POST['adtel']);
	$ostan = check_safe_post($_POST['adostan']);
	$city = check_safe_post($_POST['adcity']);
	$date = time();
	$admintype = check_safe_post($_POST['admintype']);
	$level = check_safe_post($_POST['adlevel']);
	if (!empty($name) && !empty($email) && !empty($pass) && !empty($tel) && !empty($ostan) && !empty($city) && !empty($date) && !empty($admintype) && !empty($level)){
		
		if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i',$email)){
			echo '<div class="alert alert-danger alert-dismissable" style="color:#fff">
			لطفا ایمیل را به شکل صحیح وارد نمایید
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}else if(!preg_match('/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/',$_POST['adpass'])){
			echo '<div class="alert alert-danger alert-dismissable" style="color:#fff">
			کلمه عبور حداقل باید شامل 6 کاراکتر و ترکیبی از حروف بزرگ، کوچک واعداد باشد
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}else{
		$insadmin = $Admin->InsertAdmin($name,$email,$pass,$tel,$ostan,$city,$date,$admintype,$level);
		if($insadmin){
		echo '<div style="text-align:right;color:#fff" class="alert alert-success alert-dismissable" data-success="true">
		درج ادمین با موفقیت انجام شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
		}else{
			echo '<div style="text-align:right;color:#fff" class="alert alert-warning alert-dismissable" data-success="false">
			متاسفیم، درج انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
		}
		
	}else{
		echo '<div style="text-align:right;color:#fff" class="alert alert-danger alert-dismissable" data-success="true">
		لطفا فیلد ها را کامل کنید
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>


<?php
if(isset($_POST['admindsend'])){
	$idadmin = check_safe_post($_POST['adminid']);
	$DB = new DB();
	$Admin = new Admin();
	$admindel = $Admin->DeleteAdmin($idadmin);
	if($admindel){
		echo '<div style="text-align:right;color:#fff" class="alert alert-success alert-dismissable" data-success="true">
		ادمین با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:#fff" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>

<?php
if(isset($_POST['btnchangepass'])){

	if (empty($_POST['old_pass']) || empty($_POST['new_pass']) || empty($_POST['rnew_pass']) ){
		echo '<div class="alert alert-warning alert-dismissable">
		لطفا کلمه عبور قبلی و جدید خود را وارد نمایید
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		$old_pass = check_safe_post(hash_pass($_POST['old_pass']));
		$new_pass = check_safe_post($_POST['new_pass']);
		$rnew_pass = check_safe_post($_POST['rnew_pass']);
		$adminid = check_safe_post($_POST['adminid']);
		$DB = new DB();
		$Admin = new Admin();
		$reseda = $Admin->SelectAdminById($adminid);
		foreach($reseda as $rows){
			$oldpasa = $rows['_password'];
		}
		if($old_pass == $oldpasa){
			if(!preg_match('/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/',$new_pass)){
			echo '<div class="alert alert-warning alert-dismissable">
			کلمه عبور حداقل باید شامل 6 کاراکتر بصورت حروف بزرگ، کوچک واعداد باشد
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
			}else{
				if($new_pass == $rnew_pass){
				$newpass = hash_pass($new_pass);
				$resm = $Admin->UpdateAdminPass($newpass,$adminid);
				echo '<div class="alert alert-success alert-dismissable" data-success="true">
				کلمه عبور با موفقیت ویرایش شد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
				}
				else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					تکرار کلمه عبور صحیح نمی باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}

			}
			else{
				echo '<div class="alert alert-warning alert-dismissable">
				کلمه عبور قبلی صحیح نمی باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}
		}
}
?>

<?php
if(isset($_POST['sendadminaccess'])){
	$id_admin = check_safe_post($_POST['admin_id']);
	$access = 2;
	$DB = new DB();
	$Admin = new Admin();
	$resAd = $Admin->UpdateAdminAccess($access,$id_admin);
}
?>

<?php
if(isset($_POST['sendadminaccesss'])){
	$id_admins = check_safe_post($_POST['admin_ids']);
	$accesss = 1;
	$DB = new DB();
	$Admin = new Admin();
	$resAds = $Admin->UpdateAdminAccess($accesss,$id_admins);
}
?>

<?php
if(isset($_POST['movieInsert'])){
	if(empty($_POST['moviename']) || empty($_POST['moviedirector']) || empty($_POST['movieactor']) || empty($_POST['movieplaytime']) || empty($_POST['moviepay']) || empty($_POST['cinemaname']) || empty($_POST['cinemasans'])){
		echo "<div class=\"server\">لطفا فیلد های ستاره دار را پر کنید<br /><br /></div><br />";
		$check_movieres = 0;
		echo "<script>alert(ok);</script>";
	}else{
		$moviename = check_safe_post($_POST['moviename']);
		$moviedirector = check_safe_post($_POST['moviedirector']);
		$movieactor = check_safe_post($_POST['movieactor']);
		$movieplaytime = check_safe_post($_POST['movieplaytime']);
		$moviepay = check_safe_post($_POST['moviepay']);
		$cinemaname = check_safe_post($_POST['cinemaname']);
		$cinematel = check_safe_post($_POST['cinematel']);
		$cinemaaddress = check_safe_post($_POST['cinemaaddress']);
		$cinemachairno = check_safe_post($_POST['cinemachairno']);
		$cinemasans = check_safe_post($_POST['cinemasans']);	
		$movieexplain = check_safe_post($_POST['movieexplain']);
		$endPlayTime = 0;

		if(isset($_FILES['movie-file'])){
				$moviefileiname = $_FILES['movie-file']['name'];
				$moviefileitmp = $_FILES['movie-file']['tmp_name'];
				$moviefileitype = $_FILES['movie-file']['type'];
				$moviefileisize = $_FILES['movie-file']['size'];
				$movieext = array("image/jpeg","image/jpg","image/png","image/gif");
			if($moviefileisize > 5000000){
				echo "<div class=\"server\">سایز عکس کمتر از 500 کیلوبایت باشد<br /><br /></div><br />";
				$check_movieres = 0;
			}
			else if(!(in_array($moviefileitype,$movieext))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_movieres = 0;
			}
			else if(empty($moviefileiname)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_movieres = 0;
			}
		
		else{
			$moviefilename = md5(uniqid($moviefileiname)).substr($moviefileiname,-5,5);
			$DB = new DB();
			$Cinema = new Cinema();
			$resMovie = $Cinema->InsertMovie($moviename,$moviedirector,$movieactor,$movieplaytime,$moviepay,$cinemaname,$cinematel,$cinemaaddress,$cinemachairno,$cinemasans,$moviefilename,$movieexplain,$endPlayTime);
				move_uploaded_file($_FILES["movie-file"]["tmp_name"],"../_upload/cinema/".$moviefilename);
				$check_movieres = 1;
			
			}
		}
	}	
}
?>
<script type="text/javascript">
	window.top.window.Insert_movieEnd(<?php echo $check_movieres; ?>);
</script>


<?php
if (isset($_POST['editmovie'])){
	//بررسی سایر خطاهای سرور
	if ($_FILES["emovie-file"]["error"] > 0){
		echo "<div class=\"server\">خطا: " . $_FILES["emovie-file"]["error"] . "</div><br />";
		$check_moviress = 0;
		}
	else{
			$filenamemove = $_FILES['emovie-file']['name'];
			$filetmpmove = $_FILES['emovie-file']['tmp_name'];
			$filetypemove = $_FILES['emovie-file']['type'];
			$filesizemove = $_FILES['emovie-file']['size'];
			$extmove = array("image/jpeg","image/jpg","image/png","image/gif");
		
        if($filesizemove > 5000000){
			echo "<div class=\"server\">سایز عکس کمتر از 500 کیلوبایت باشد<br /><br /></div><br />";
			$check_moviress = 0;
		}
		else if(!(in_array($filetypemove,$extmove))){
			echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
			$check_moviress = 0;
		}
		else if(empty($filenamemove)){
			echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
			$check_moviress = 0;
		}
		else{		
		//انتقال و ذخیره فایل در سرور
			$filenamesmove = md5(uniqid($filenamemove)).substr($filenamemove,-5,5);
			$emoviename = check_safe_post($_POST['emoviename']);
			$emoviedirector = check_safe_post($_POST['emoviedirector']);
			$emovieactor = check_safe_post($_POST['emovieactor']);
			$emovieplaytime = check_safe_post($_POST['emovieplaytime']);
			$emoviepay = check_safe_post($_POST['emoviepay']);
			$ecinemaname = check_safe_post($_POST['ecinemaname']);
			$ecinematel = check_safe_post($_POST['ecinematel']);
			$ecinemaaddress = check_safe_post($_POST['ecinemaaddress']);
			$ecinmachair = check_safe_post($_POST['ecinmachair']);
			$ecinemasans = check_safe_post($_POST['ecinemasans']);
			$emovieexplain = check_safe_post($_POST['emovieexplain']);
			$idemov = check_safe_post($_POST['idemov']);
			
				$DB = new DB();
				$Cinema = new Cinema();
				$whereemov = "`_id`=".$idemov;
				$Uresemov = $Cinema->ReadMovieByID($whereemov);
				foreach($Uresemov as $rows){
					$imgnameemov = $rows['_moviePic'];
				}
				if(!empty($imgnameemov)){
					if(file_exists("../_upload/cinema/".$imgnameemov)){
						unlink("../_upload/cinema/".$imgnameemov);
					}
				}
			$DB = new DB();
			$Cinema = new Cinema();
			$resUemovi = $Cinema->UpdateMovie($emoviename,$emoviedirector,$emovieactor,$emovieplaytime,$emoviepay,$ecinemaname,$ecinematel,$ecinemaaddress,$ecinmachair,$ecinemasans,$filenamesmove,$emovieexplain,$idemov);
				move_uploaded_file($_FILES["emovie-file"]["tmp_name"],"../_upload/cinema/".$filenamesmove);
				$check_moviress = 1;		
		}
	}
}
?>
<script type="text/javascript">
window.top.window.movieedit_end(<?php echo $check_moviress; ?>);
</script>



<?php
if(isset($_POST["movdsend"])){
	$idmov = check_safe_post($_POST['idmov']);
	$DB = new DB();
	$Cinema = new Cinema();
	$wheremovie = "`_id`=".$idmov;
	$movvres = $Cinema->ReadMovieByID($wheremovie);
	foreach($movvres as $rows){
		$imgmovie = $rows['_moviePic'];
	}
	$resDmov = $Cinema->DeleteMovie($idmov);
	if(!empty($imgmovie)){
		if(file_exists("../_upload/cinema/".$imgmovie)){
			unlink("../_upload/cinema/".$imgmovie);
		}
	}
	if($resDmov){
		echo '<div style="text-align:right;color:white" class="alert alert-success alert-dismissable" data-success="true">
		فیلم با موفقیت حذف شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}else{
		echo '<div style="text-align:right;color:white" class="alert alert-warning alert-dismissable" data-success="false">
		متاسفیم، حذف انجام نشد. به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
}
?>


<?php
if(isset($_POST['sendmovieendplay'])){
	$movieendplay = 1;
	$idemove = check_safe_post($_POST['idmovieendplay']);
	$DB = new DB();
	$Cinema = new Cinema();
	$resUemovi = $Cinema->UpdateMovieEndPlay($movieendplay,$idemove);	
}
?>


<?php
if(isset($_POST['sendmoviRenewPlay'])){
	$movierenewplay = 0;
	$idrenewmove = check_safe_post($_POST['idmovieRenewPlay']);
	$DB = new DB();
	$Cinema = new Cinema();
	$resUemovi = $Cinema->UpdateMovieEndPlay($movierenewplay,$idrenewmove);	
}
?>


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

error_reporting(0);
if(!isset($_SERVER['HTTP_REFERER'])){
	exit('<h3 style=color:blue;text-align:center>چنین صفحه ای وجود ندارد یا دسترسی به آن برای شما مجاز نمی باشد</h3>');
}
?>
<?php
if (isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$User = new User();
		$session = $_SESSION['usrLogin'];
		$res = $User->SelectLoginUser($session);
		foreach($res as $rows){
			$idd = $rows['_id'];
		}
?>
<?php
if(isset($_POST['esend'])){
	$id = check_safe_post($_POST['id']);
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
	$date = time();
	date_default_timezone_set("Asia/Tehran");
	$time = date("H:i");
	$expalin = check_safe_post($_POST['expalin']);
	$DB = new DB();
	$ViewAD = new ViewAD();
	$res = $ViewAD->EditAD($title,$coname,$bossname,$address,$tel,$mobile,$email,$web,$jobreq,$edu,$degree,$sience,$reqno,$export,$gender,$age,$married,$bime,$khedmat,$ayabzahab,$worktime,$workpay,$workcity,$date,$time,$expalin,$id);
	if($res){
		echo '<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
		اطلاعات شما با موفقیت ویرایش شد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
		echo '<script>resualt();</script>';
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		اطلاعات شما متاسفانه ویرایش نشد
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}
	
	$advTaeed = 0;
	$DB = new DB();
	$ViewAD = new ViewAD();
	$resvad = $ViewAD->UpdateViewAdsTaeed($advTaeed,$id);
}


if(isset($_POST["dsend"])){
	$id2 = check_safe_post($_POST['id']);
	$DB = new DB();
	$ViewAD = new ViewAD();
	$ress = $ViewAD->DeleteAD($id2);
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


if(isset($_POST['isend'])){
	$title = check_safe_post($_POST['ititle']);
	$coname = check_safe_post($_POST['iconame']);
	$bossname = check_safe_post($_POST['ibossname']);
	$address = check_safe_post($_POST['icoAddress']);
	$tel = check_safe_post($_POST['itel']);
	$mobile = check_safe_post($_POST['imobile']);
	$email = check_safe_post($_POST['iemail']);
	$web = check_safe_post($_POST['iweb']);
	$jobreq = check_safe_post($_POST['ijobreq']);
	$edu = check_safe_post($_POST['iedu']);
	$degree = check_safe_post($_POST['idegree']);
	$sience = check_safe_post($_POST['isience']);
	$reqno = check_safe_post($_POST['ireqno']);
	$export = check_safe_post($_POST['iexports']);
	$gender = check_safe_post($_POST['igender']);
	$age = check_safe_post($_POST['iage']);
	$married = check_safe_post($_POST['imarried']);
	$bime = check_safe_post($_POST['ibime']);
	$khedmat = check_safe_post($_POST['ikhedmat']);
	$ayabzahab = check_safe_post($_POST['iayabzahab']);
	$worktime = check_safe_post($_POST['iworktime']);
	$workpay = check_safe_post($_POST['iworkpay']);
	$workcity = check_safe_post($_POST['iworkcity']);
	$date = time();
	date_default_timezone_set("Asia/Tehran");
	$time = date("H:i");
	$expalin = check_safe_post($_POST['iexpalin']);
	$taeed = 0;
	$pay = 0;
	$advType = 0;
	$advUser = 0;
	$advUserid = $idd;
	if (!empty($title) && !empty($coname) && !empty($bossname) && !empty($address) && !empty($tel) && !empty($jobreq) && !empty($edu) && !empty($reqno) && !empty($worktime) && !empty($workpay) && !empty($workcity)){
		$DB = new DB();
		$ViewAD = new ViewAD();
		$ires = $ViewAD->InsertAD($title,$coname,$bossname,$address,$tel,$mobile,$email,$web,$jobreq,$edu,$degree,$sience,$reqno,$export,$gender,$age,$married,$bime,$khedmat,$ayabzahab,$worktime,$workpay,$workcity,$taeed,$pay,$advType,$date,$time,$expalin,$advUser,$advUserid);
		if($ires){
			echo '<div style="text-align:right" class="alert alert-success alert-dismissable" data-success="true">
			آگهی با موفقیت درج شد
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}else{
			echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
			متاسفیم، آگهی درج نشد. لطفا به پشتیبانی سایت مشکل به وجود آمده را گزارش دهید. سپاس گذاریم
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
	}else{
		echo '<div style="text-align:right" class="alert alert-warning alert-dismissable" data-success="false">
		فیلد های ستاره دار را بصورت صحیح پر کنید
		<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
		</div>';
	}

		}

	
	
	
	if(isset($_FILES["file"])){
		$id = $_POST['id'];
		$errors = array();
		foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ){
			$file_name = $key.$_FILES['file']['name'][$key];
			$file_size =$_FILES['file']['size'][$key];
			$file_tmp =$_FILES['file']['tmp_name'][$key];
			$file_type=$_FILES['file']['type'][$key];
			$ext = array("image/jpeg","image/jpg","image/png");	
        	if($file_size > 100000){
				$errors = 'سایز عکس کمتر از 100 کیلوبایت باشد';
			}
			else if(!(in_array($file_type,$ext))){
				$errors = 'لطفا از تصاویر با این نوع پسوند انتخاب کنید '.' jpg / jpeg / png';
			}
			else if(empty($file_tmp)){
				$errors = 'لطفا ابتدا یک تصویر انتخاب کنید';
			}
						$User = new User();
						$dres = $User->SelectUserById($id);
						foreach($dres as $rows){
							$imgname = $rows['_avatar'];
						}
						if(!empty($imgname)){
							if(file_exists("img/".$imgname)){
								unlink("img/".$imgname);
							}
						}
        $desired_dir="img";
        if(empty($errors)==true){
           // if(is_dir($desired_dir)==false){
             //   mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            //}
            //if(is_dir("$desired_dir/".$file_name)==false){
			$filenamess = md5(uniqid($file_name)).substr($file_name,-5,5);
			$move = move_uploaded_file($file_tmp,"img/".$filenamess);
                if($move){
					echo "<img style='float:left;padding:10px;width:200px;height:200px' src='img/".$filenamess."'  class='preview'> <br/></br>";

						
						$DB = new DB();
						$User = new User();
						$ires = $User->UpdateUserPic($filenamess,$id);
				}else{
					echo 'متاسفانه تصویر آپلود نشد';
				}
            //}else{									//rename the file if another one exist
               // $new_dir="img/".$file_name.time();
                // rename($file_tmp,$new_dir) ;				
            //}
            //mysql_query($query);			
			}else{
					print_r($errors);
			}
		}
		if(empty($errors)){
			echo 'تصویر آپلود شد';
		}

	}			
			
	
		if(isset($_FILES["fileu"])){
		$idu = $_POST['idu'];
		$errorsu = array();
		foreach($_FILES['fileu']['tmp_name'] as $key => $tmp_name ){
			$file_nameu = $key.$_FILES['fileu']['name'][$key];
			$file_sizeu = $_FILES['fileu']['size'][$key];
			$file_tmpu = $_FILES['fileu']['tmp_name'][$key];
			$file_typeu = $_FILES['fileu']['type'][$key];
			$extu = array("image/jpeg","image/jpg","image/png");	
        	if($file_sizeu > 100000){
				$errorsu = 'سایز عکس کمتر از 100 کیلوبایت باشد';
			}
			else if(!(in_array($file_typeu,$extu))){
				$errorsu = 'لطفا از تصاویر با این نوع پسوند انتخاب کنید '.' jpg / jpeg / png';
			}
			else if(empty($file_tmpu)){
				$errorsu = 'لطفا ابتدا یک تصویر انتخاب کنید';
			}
						$User = new User();
						$dresu = $User->SelectUserById($idu);
						foreach($dresu as $rowss){
							$imgnameu = $rowss['_avatar'];
						}
						if(!empty($imgnameu)){
							if(file_exists("img/".$imgnameu)){
								unlink("img/".$imgnameu);
							}
						}
        $desired_dir="img";
        if(empty($errorsu)==true){
           // if(is_dir($desired_dir)==false){
             //   mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            //}
            //if(is_dir("$desired_dir/".$file_name)==false){
			$filenamessu = md5(uniqid($file_nameu)).substr($file_nameu,-5,5);
			$moveu = move_uploaded_file($file_tmpu,"img/".$filenamessu);
                if($moveu){
					echo "<img style='float:left;padding:10px;width:200px;height:200px' src='img/".$filenamessu."'  class='preview'> <br/></br>";

						
						$DB = new DB();
						$User = new User();
						$iresu = $User->UpdateUserPic($filenamessu,$idu);
				}else{
					echo 'متاسفانه تصویر آپلود نشد';
				}
            //}else{									//rename the file if another one exist
               // $new_dir="img/".$file_name.time();
                // rename($file_tmp,$new_dir) ;				
            //}
            //mysql_query($query);			
			}else{
					print_r($errorsu);
			}
		}
		if(empty($errorsu)){
			echo 'تصویر آپلود شد';
		}

	}
	
	
		if(isset($_POST['tusrsend'])){
			$tusrid = check_safe_post($_POST['tusrid']);
			$DB = new DB();
			$Contactus = new Contactus();
			$Messagedel = $Contactus->DeleteTicket($tusrid);
			if($Messagedel){
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
	
	}
}
?>


<?php 
if(isset($_POST['ins-mashaqelt'])){
	if(empty($_POST['Mconamet']) && empty($_POST['Mcoadmint']) && empty($_POST['Mcotelt']) && empty($_POST['McoAddresst']) && empty($_POST['Mtxt1t'])){
		echo "<div class=\"server\">لطفا فیلد های ستاره دار را پر کنید<br /><br /></div><br />";
		$check_mashaqelt = 0;
	}else{
		$idmashaqelusr = check_safe_post($_POST['idmashaqellt']);
		$Mconamet = check_safe_post($_POST['Mconamet']);
		$Mcoadmint = check_safe_post($_POST['Mcoadmint']);
		$Mcotelt = check_safe_post($_POST['Mcotelt']);
		$Mcoaddresst = check_safe_post($_POST['McoAddresst']);
		$Mcotxt1t = check_safe_post($_POST['Mtxt1t']);
		$Mcotxt2t = check_safe_post($_POST['Mtxt2t']);
		$Mcotxt3t = check_safe_post($_POST['Mtxt3t']);
		$Mcoexplaint = check_safe_post($_POST['Mcoexplaint']);
		$Mcodatet = time();
		date_default_timezone_set("Asia/Tehran");
		$Mcotimet = date("H:i");
		
		if(isset($_FILES['Mcoimg-filet'])){
				$Mcofileinamet = $_FILES['Mcoimg-filet']['name'];
				$Mcofileitmpt = $_FILES['Mcoimg-filet']['tmp_name'];
				$Mcofileitypet = $_FILES['Mcoimg-filet']['type'];
				$Mcofileisizet = $_FILES['Mcoimg-filet']['size'];
				$Mcoiextt = array("image/jpeg","image/jpg","image/png","image/gif");
			if($Mcofileisizet > 3000000){
				echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
				$check_mashaqelt = 0;
			}
			else if(!(in_array($Mcofileitypet,$Mcoiextt))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_mashaqelt = 0;
			}
			else if(empty($Mcofileinamet)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_mashaqelt = 0;
			}
			
		else{
			$Mcofilenamet = md5(uniqid($Mcofileinamet)).substr($Mcofileinamet,-5,5);
			if(isset($_FILES['Mcoimg-filet'])){
				$Mcofileinamest = $_FILES['Mcoimgs-filet']['name'];
				$Mcofileitmpst = $_FILES['Mcoimgs-filet']['tmp_name'];
				$Mcofileitypest = $_FILES['Mcoimgs-filet']['type'];
				$Mcofileisizest = $_FILES['Mcoimgs-filet']['size'];
				$Mcoiextst = array("image/jpeg","image/jpg","image/png","image/gif");
			if($Mcofileisizest > 3000000){
				echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
				$check_mashaqelt = 0;
			}
			else if(!(in_array($Mcofileitypest,$Mcoiextst))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$check_mashaqelt = 0;
			}
			else if(empty($Mcofileinamest)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$check_mashaqelt = 0;
			}
				if(!empty($Mcofileinamest)){
					$Mcofilenamest = md5(uniqid($Mcofileinamest)).substr($Mcofileinamest,-5,5);
				}else{
					$Mcofilenamest = "";
				}
				
			}
			$Mcopaystatet = 1;
			$DB = new DB();
			$Mashaqel = new Mashaqel();
			$resMashaqel = $Mashaqel->InsertMashaqelUser($Mconamet,$Mcoadmint,$Mcodatet,$Mcotimet,$Mcotelt,$Mcoaddresst,$Mcotxt1t,$Mcotxt2t,$Mcotxt3t,$Mcofilenamet,$Mcofilenamest,$Mcoexplaint,$Mcopaystatet,$idmashaqelusr);
				move_uploaded_file($_FILES["Mcoimg-filet"]["tmp_name"],"../_upload/mashaqel/".$Mcofilenamet);
				move_uploaded_file($_FILES["Mcoimgs-filet"]["tmp_name"],"../_upload/mashaqel/".$Mcofilenamest);
			$check_mashaqelt = 1;
			}
		}else{
			echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
			$check_mashaqelt = 0;
		}
	}
}
?>
<script type="text/javascript">
	window.top.window.Insert_Resmashaqelt(<?php echo $check_mashaqelt; ?>);
</script>


<?php
if(isset($_POST["Mdelsend"])){
	$idMashaqell = check_safe_post($_POST['idMashaqell']);
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$whereM = "`_id`=".$idMashaqell;
	$Mrest = $Mashaqel->ReadMashaqelByID($whereM);
	foreach($Mrest as $rowsM){
		$img1t = $rowsM['_coImage'];
		$img2t = $rowsM['_imgmore1'];
	}
	$resDMt = $Mashaqel->DeleteMashaqel($idMashaqell);
	if($resDMt){
		if(!empty($img1t)){
			if(file_exists("../_upload/mashaqel/".$img1t)){
			unlink("../_upload/mashaqel/".$img1t);
			}
		}
		if(!empty($img2t)){
			if(file_exists("../_upload/mashaqel/".$img2t)){
			unlink("../_upload/mashaqel/".$img2t);
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
if(isset($_POST['editMt'])){
	$DB = new DB();
	$Mashaqel = new Mashaqel();
	$idMMt = check_safe_post($_POST['idMMt']);
	$whereumt = "`_id`=".$idMMt;
	$UMrest = $Mashaqel->ReadMashaqelByID($whereumt);
	foreach($UMrest as $rows){
		$imgco1t = $rows['_coImage'];
		$imgco2t = $rows['_imgmore1'];
	}
		if(isset($_FILES['Mashqelu-filet'])){
			$Mfilenamet = $_FILES['Mashqelu-filet']['name'];
			$Mfiletmpt = $_FILES['Mashqelu-filet']['tmp_name'];
			$Mfiletypet = $_FILES['Mashqelu-filet']['type'];
			$Mfilesizet = $_FILES['Mashqelu-filet']['size'];
			$Mextt = array("image/jpeg","image/jpg","image/png");

			if($Mfilesizet > 5000000){
				echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
				$checkt_mashaqels = 0;
			}
			else if(!(in_array($Mfiletypet,$Mextt))){
				echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
				$checkt_mashaqels = 0;
			}
			else if(empty($Mfilenamet)){
				echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
				$checkt_mashaqels = 0;
			}
			if(!empty($Mfilenamet)){
				$Mfilenamest = md5(uniqid($Mfilenamet)).substr($Mfilenamet,-5,5);
			}else{
				$Mfilenamest = $imgco1t;
			}
		}
			if(isset($_FILES['Mashqelu1-filet'])){
				$Mfilename1t = $_FILES['Mashqelu1-filet']['name'];
				$Mfiletmp1t = $_FILES['Mashqelu1-filet']['tmp_name'];
				$Mfiletype1t = $_FILES['Mashqelu1-filet']['type'];
				$Mfilesize1t = $_FILES['Mashqelu1-filet']['size'];
				$Mext1t = array("image/jpeg","image/jpg","image/png");

				if($Mfilesize1t > 5000000){
					echo "<div class=\"server\">سایز عکس کمتر از 300 کیلوبایت باشد<br /><br /></div><br />";
					$checkt_mashaqels = 0;
				}
				else if(!(in_array($Mfiletype1t,$Mext1t))){
					echo "<div class=\"server\"> لطفا از تصاویر با این نوع پسوند انتخاب کنید "." jpg / jpeg / png <br/><br/></div><br/>";
					$checkt_mashaqels = 0;
				}
				else if(empty($Mfilename1t)){
					echo "<div class=\"server\">لطفا ابتدا یک تصویر انتخاب کنید<br /><br /></div><br />";
					$checkt_mashaqels = 0;
				}
				if(!empty($Mfilename1t)){
					$Mfilenames1t = md5(uniqid($Mfilename1t)).substr($Mfilename1t,-5,5);
				}else{
					$Mfilenames1t = $imgco2t;
				}
			}		

			$Mconameut = check_safe_post($_POST['Mconamest']);
			$Mcoadminut = check_safe_post($_POST['Mcoadminst']);
			$Mcotelut = check_safe_post($_POST['Mcotelst']);
			$Mcoaddressut = check_safe_post($_POST['Mcoadrest']);
			$Mcotxt1ut = check_safe_post($_POST['Mtxts1t']);
			$Mcotxt2ut = check_safe_post($_POST['Mtxts2t']);
			$Mcotxt3ut = check_safe_post($_POST['Mtxts3t']);
			$Mcoexplainut = check_safe_post($_POST['Mexplainst']);

			$Mcodateut = time();
			date_default_timezone_set("Asia/Tehran");
			$Mcotimeut = date("H:i");
			
				if(!empty($Mfilenamet)){
					if(!empty($imgco1t)){
						if(file_exists("../_upload/mashaqel/".$imgco1t)){
							unlink("../_upload/mashaqel/".$imgco1t);
						}
					}
				}
				if(!empty($Mfilename1t)){
					if(!empty($imgco2t)){
						if(file_exists("../_upload/mashaqel/".$imgco2t)){
							unlink("../_upload/mashaqel/".$imgco2t);
						}
					}
				}

			$DB = new DB();
			$taeed = 0;
			$Mashaqel = new Mashaqel();
			$resUs = $Mashaqel->UpdateMashaqelusr($Mconameut,$Mcoadminut,$Mcodateut,$Mcotimeut,$Mcotelut,$Mcoaddressut,$Mcotxt1ut,$Mcotxt2ut,$Mcotxt3ut,$Mfilenamest,$Mfilenames1t,$Mcoexplainut,$idMMt);
				move_uploaded_file($_FILES["Mashqelu-filet"]["tmp_name"],"../_upload/mashaqel/".$Mfilenamest);
			if(isset($_FILES['Mashqelu1-filet'])){
				move_uploaded_file($_FILES["Mashqelu1-filet"]["tmp_name"],"../_upload/mashaqel/".$Mfilenames1t);
			}
			$rest = $Mashaqel->UpdateMashaqeTaeed($taeed,$idMMt);
			$checkt_mashaqels = 1;		
	
}
?>
<script type="text/javascript">
window.top.window.Medit_endt(<?php echo $checkt_mashaqels; ?>);
</script>
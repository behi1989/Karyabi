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

	//Insert User
	$User = new User();
	if(isset($_POST['isend'])){
		if (empty($_POST['firstname']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])){
			echo '<div class="alert alert-warning alert-dismissable">
			لطفا تمام فیلد ها را پر نمایید
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
		else{
			$name = check_safe_post($_POST['firstname']);
			$username = check_safe_post($_POST['username']);
			$email = check_safe_post($_POST['email']);
			$password = check_safe_post(hash_pass($_POST['password']));
			$usertype = check_safe_post($_POST['usertype']);
			$cdate = time();
			$emailcode = md5(uniqid(rand()));
			$To = $email;
			$Subject = "لینک فعال سازی پنل کاربری سایت نیاز رشت";
			$header = "FROM: <behnam.gholipoor@gmail.com>";
			$Text = "لطفا جهت فعال سازی اکانت خود لینک زیر را کلیک نمایید:"."\r\n";
			$Text.='<a href="http://localhost/karyabi/user/active.php?action=active&code="'.$emailcode.'>فعال سازی اکانت کاربری</a>'; 
			$resuser = $User->SelectLoginUser($username);
			foreach($resuser as $rows){
				$resuser = $rows['_username'];
			}
			$resemail = $User->SelectEmailUser($email);
			foreach($resemail as $rows){
				$resemail = $rows['_email'];
			}
			if($resuser == $username){
				echo '<div class="alert alert-warning alert-dismissable">
				نام کاربری غبر مجاز می باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else if(!preg_match('#[(ابپتثجچحیخدذرزسشطظعغفقکگلمنوهیئضص)+]#',$_POST['firstname'])){
				echo '<div class="alert alert-warning alert-dismissable">
				نام را بصورت فارسی وارد نمایید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else if(!preg_match('/^[a-zA-Z\d_@.]{4,50}$/i',$_POST['username'])){
				echo '<div class="alert alert-warning alert-dismissable">
				نام کاربری حداقل باید شامل 4 کاراکتر باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i',$_POST['email'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا ایمیل را به شکل صحیح وارد نمایید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else if($resemail == $email){
				echo '<div class="alert alert-warning alert-dismissable">
				ایمیل غبر مجاز می باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else if(!preg_match('/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/',$_POST['password'])){
				echo '<div class="alert alert-warning alert-dismissable">
				کلمه عبور حداقل باید شامل 6 کاراکتر و ترکیبی از حروف بزرگ، کوچک واعداد باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else{
					if($usertype == 0){
						echo '<div class="alert alert-warning alert-dismissable">
						لطفا نوع اکانت کاربری خود را انتخاب نمایید
						<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
						</div>';
					}else if($usertype == 1){
						$res = $User->AddUser($name,$username,$password,$email,$cdate,$usertype,$emailcode);
						$send = mail($To,$Subject,$Text,$header);
						if($res && $send){
							echo '<div class="alert alert-success alert-dismissable" data-success="true">
							ثبت نام با موفقیت انجام شد.لینک فعال سازی به ایمیل شما ارسال خواهد شد
							<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
							</div>';
							echo "<script>setTimeout(\"location.href = './userlogin.php';\",4000);</script>";
						}
						else{
							echo '<div class="alert alert-danger alert-dismissable" data-success="false">
							ثبت نام شما با مشکل روبرو شده است.لطفا مجددا بررسی کنید
							<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
							</div>';
						}
					}else if($usertype = 2){
						$Karfarma = new Karfarma();
						$res = $Karfarma->AddKarfarma($name,$username,$password,$email,$cdate,$usertype,$emailcode);
						$send = mail($To,$Subject,$Text,$header);
						if($res && $send){
							echo '<div class="alert alert-success alert-dismissable" data-success="true">
							ثبت نام با موفقیت انجام شد.لینک فعال سازی به ایمیل شما ارسال خواهد شد
							<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
							</div>';
							//echo "<script>setTimeout(\"location.href = 'localhost/karyabi/index.php';\",3000);</script>";
						}
						else{
							echo '<div class="alert alert-danger alert-dismissable" data-success="false">
							ثبت نام شما با مشکل روبرو شده است.لطفا مجددا بررسی کنید
							<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
							</div>';
						}
					}
					
			}
		}
	}

	if(isset($_POST['lsend'])){
		if (empty($_POST['usrname']) || empty($_POST['psw'])){
			echo '<div class="alert alert-warning alert-dismissable">
			لطفا نام کاربری و رمز عبور را وارد نمایید
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
		else{
			$usr = NULL;
			$pas = NULL;
			if(isset($_POST['usrname']) && $_POST['psw']){
				$usrname = check_safe_post($_POST['usrname']);
				$pswd = $_POST['psw'];
				$psw = check_safe_post(hash_pass($_POST['psw']));
				$rememeber = $_POST['remember'];
				$resuser = $User->UserLogin($usrname,$psw);
				foreach($resuser as $rows){
				$usr = $rows['_username'];
				$pas = $rows['_password'];
				$usrid = $rows["_id"];
				$usrtype = $rows['_userType'];
				}
				if($usrname == $usr && $psw == $pas){
					$_SESSION['usrLogin']=$usrname;
					$_SESSION['usrType']=$usrtype;
					if($rememeber == "1"){
						$emailcode = substr(md5(microtime()), 0, 20);
						$rescokie = $User->UpdateUserCookie($emailcode,$usrid);
						setcookie("usr" , $usr , time()+60*60*24*3, "/","", 0);
						setcookie("psw" , $pswd , time()+60*60*24*3, "/","", 0);
					}
					echo '<div class="alert alert-success alert-dismissable" data-success="true">'.$usrname.' خوش آمدید تا لحظاتی دیگر به پنل کاربری هدایت می شوید
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
					echo "<script>setTimeout(\"location.href = './user/userprofile.php';\",3000);</script>";
				}
				else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					نام کاربری یا رمز عبور معتبر نمی باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
			else{
				echo '<div class="alert alert-warning alert-dismissable">
				نام کاربری یا رمز عبور معتبر نمی باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}
		}
	}

	if(isset($_POST['fsend'])){
		if (empty($_POST['femail'])){
			echo '<div class="alert alert-warning alert-dismissable">
			لطفا ایمیل را وارد نمایید
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i',$_POST['femail'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا ایمیل را به شکل صحیح وارد نمایید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
		}else{
			if(isset($_POST['femail'])){
				$email = NULL;
				$code = NULL;
				$femail = check_safe_post($_POST['femail']);
				$resf = $User->SelectEmailUser($femail);
				foreach($resf as $rows){
					$email = $rows['_email'];
					$code = $rows['_emailCode'];
				}
				if ($femail == $email){
					$Rto = $femail;
					$Rsubject = "لینک بازیابی کلمه عبور نیاز رشت";
					$Rmsg = 'برای دریافت کلمه عبور جدید به روی لینک کلیک کنید. <a href="localhost/karyabi/user/active.php?actions=update&code2="'.$code.'></a>';
					$headers = "Content-type:text/html; charset=utf-8";
					mail($Rto,$Rsubject,$Rmsg,$headers);
					echo '<div class="alert alert-success alert-dismissable" data-success="true">
					یک ایمیل با کد فعال سازی مجدد برای شما ارسال خواهد شد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					ایمیل وارد شده معتبر نمی باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
		}
	}

		if(isset($_POST['esend'])){
			if(empty($_POST['fnames']) || empty($_POST['mobile']) || empty($_POST['coname']) || empty($_POST['cotel']) || empty($_POST['coaddress'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا فیلد های ستاره دار را پر کنید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else
				{
				$fname = check_safe_post($_POST['fnames']);
				$mobile = check_safe_post($_POST['mobile']);
				$ostan = check_safe_post($_POST['ostan']);
				$city = check_safe_post($_POST['city']);
				$coname = check_safe_post($_POST['coname']);
				$cotel = check_safe_post($_POST['cotel']);
				$coemail = check_safe_post($_POST['coemail']);
				$coweb = check_safe_post($_POST['coweb']);
				$coaddress = check_safe_post($_POST['coaddress']);
				$id = check_safe_post($_POST['ide']);
				$rese = $User->UpdateUserProfile($fname,$mobile,$ostan,$city,$coname,$cotel,$coemail,$coweb,$coaddress,$id);
				if($rese){
					echo '<div class="alert alert-success alert-dismissable" data-success="true">
					اطلاعات شما با موفقیت ویرایش شد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					اطلاعات شما متاسفانه ویرایش نشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
		}

		if(isset($_POST['esendu'])){
			if(empty($_POST['fnameu']) || empty($_POST['mobileu'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا فیلد های ستاره دار را پر کنید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else
				{
				$fnameu = check_safe_post($_POST['fnameu']);
				$mobileu = check_safe_post($_POST['mobileu']);
				$ostanu = check_safe_post($_POST['ostanu']);
				$cityu = check_safe_post($_POST['cityu']);
				$idu = check_safe_post($_POST['ideu']);
				$reseu = $User->UpdateUserProfile($fnameu,$mobileu,$ostanu,$cityu,null,null,null,null,null,$idu);
				if($reseu){
					echo '<div class="alert alert-success alert-dismissable" data-success="true">
					اطلاعات شما با موفقیت ویرایش شد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					اطلاعات شما متاسفانه ویرایش نشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
		}

		if(isset($_POST['edsend'])){
			if(empty($_POST['oldpass']) || empty($_POST['newpass']) || empty($_POST['newpasss'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا تمام فیلد ها را پر کنید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else{
				$oldpass = check_safe_post(hash_pass($_POST['oldpass']));
				$newpass = check_safe_post($_POST['newpass']);
				$newpasss = check_safe_post($_POST['newpasss']);
				$idk = check_safe_post($_POST['idk']);
				$resed = $User->SelectUserById($idk);
				foreach($resed as $rows){
					$oldpas = $rows['_password'];
				}
				if($oldpass == $oldpas){
					if(!preg_match('/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/',$newpass)){
					echo '<div class="alert alert-warning alert-dismissable">
					کلمه عبور حداقل باید شامل 6 کاراکتر بصورت حروف بزرگ، کوچک واعداد باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
					}else{
						if($newpass == $newpasss){
						$newpass = hash_pass($newpass);
						$resm = $User->UpdateUserPass($newpass,$idk);
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

		if(isset($_POST['edsendu'])){
			if(empty($_POST['oldpassu']) || empty($_POST['newpassu']) || empty($_POST['newpasssu'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا تمام فیلد ها را پر کنید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else{
				$oldpassu = check_safe_post(hash_pass($_POST['oldpassu']));
				$newpassu = check_safe_post($_POST['newpassu']);
				$newpasssu = check_safe_post($_POST['newpasssu']);
				$idu = check_safe_post($_POST['ideu']);
				$resedu = $User->SelectUserById($idu);
				foreach($resedu as $rowsu){
					$oldpasu = $rowsu['_password'];
				}
				if($oldpassu == $oldpasu){
					if(!preg_match('/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/',$newpassu)){
					echo '<div class="alert alert-warning alert-dismissable">
					کلمه عبور حداقل باید شامل 6 کاراکتر بصورت حروف بزرگ، کوچک واعداد باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
					}else{
						if($newpassu == $newpasssu){
							$newpassu = hash_pass($newpassu);
							$resmu = $User->UpdateUserPass($newpassu,$idu);
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

		if(isset($_POST['cSend'])){
			if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['title']) || empty($_POST['text'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا تمام فیلد ها را پر کنید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i',$_POST['email'])){
				echo '<div class="alert alert-warning alert-dismissable">
				لطفا ایمیل را به شکل صحیح وارد نمایید
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}
			else{
				$cid = check_safe_post($_POST['ussrid']);
				$cemail = check_safe_post($_POST['email']);
				$cmobile = check_safe_post($_POST['mobile']);
				$cname = check_safe_post($_POST['name']);
				$ctype = check_safe_post($_POST['type']);
				$ctitle = check_safe_post($_POST['title']);
				$text = check_safe_post($_POST['text']);
				$stutus = 0;
				$ccdate = time();
				$Contactus = new Contactus();
				$resc = $Contactus->SendPM($cname,$cmobile,$cemail,$ctitle,$ctype,$text,$ccdate,$stutus,$cid);
				if($resc){
					
					echo '<div id="b1" class="alert alert-success alert-dismissable" data-success="true">
					پیام شما ارسال شد و در زمان کوتاه پاسخ داده خواهد شد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
				else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					در ارسال پیام مشکلی ایجاد شده است. لطفا مجددا تلاش کنید
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
		}

	if(isset($_POST['Asend'])){
		if (empty($_POST['AdminEmail']) || empty($_POST['AdminPass'])){
			echo '<div class="alert alert-warning alert-dismissable">
			لطفا ایمیل و رمز عبور را وارد نمایید
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
		else{
			$emailadmin = NULL;
			$passadmin = NULL;
			if(isset($_POST['AdminEmail']) && $_POST['AdminPass']){
				$Aemail = check_safe_post($_POST['AdminEmail']);
				//$Apassword = check_safe_post($_POST['AdminPass']);
				$Apassword = check_safe_post(hash_pass($_POST['AdminPass']));
				$AdminRemember = $_POST['AdminRemember'];
				$Admin = new Admin();
				$resadmin = $Admin->AdminLogin($Aemail,$Apassword);
				foreach($resadmin as $rows){
				$adminname = $rows['_name'];
				$emailadmin = $rows['_email'];
				$passadmin = $rows['_password'];
				$admintype = $rows['_adminID'];
				}
				if($Aemail == $emailadmin && $Apassword == $passadmin){
					$_SESSION['adminLogin'] = $emailadmin;
					$_SESSION['adminType'] = $admintype;
					if($AdminRemember == "1"){
						$Cookiecode = substr(md5(microtime()), 0, 20);
						$rescokie = $Admin->UpdateAdminCookie($Cookiecode,$adminid);
						setcookie("Cookiecode", $Cookiecode, time() + 3600 * 24 * 7, "/");
					}
					echo '<div class="alert alert-success alert-dismissable" data-success="true">'.$adminname.' خوش آمدید تا لحظاتی دیگر به پنل کاربری هدایت می شوید
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
					echo "<script>setTimeout(\"location.href = './admin/dashboard.php';\",3000);</script>";
				}
				else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					ایمیل یا کلمه عبور معتبر نمی باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
			else{
				echo '<div class="alert alert-warning alert-dismissable">
				ایمیل یا کلمه عبور معتبر نمی باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}
		}
	}

		if(isset($_POST['Usend'])){
		if (empty($_POST['usernmaeu']) || empty($_POST['userPassu'])){
			echo '<div class="alert alert-warning alert-dismissable">
			لطفا نام کاربری و رمز عبور را وارد نمایید
			<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
		else{
			$usrnameu = NULL;
			$passuseru = NULL;
			if(isset($_POST['usernmaeu']) && $_POST['userPassu']){
				$Uusrname = check_safe_post($_POST['usernmaeu']);
				$Upassword = check_safe_post(hash_pass($_POST['userPassu']));
				//$Apassword = check_safe_post(hash_pass($_POST['AdminPass']));
				$URemember = $_POST['userRememberu'];
				$User = new User();
				$resuser = $User->UserLogin($Uusrname,$Upassword);
				foreach($resuser as $urows){
				$usrnameu = $urows['_username'];
				$passuseru = $urows['_password'];
				$useridu = $urows["_id"];
				$usertypeu = $urows['_userType'];
				}
				if($Uusrname == $usrnameu && $Upassword == $passuseru){
					$_SESSION['usrLogin'] = $Uusrname;
					$_SESSION['usrType'] = $usertypeu;
					if($URemember == "1"){
						$usercode = substr(md5(microtime()), 0, 20);
						$resucokie = $User->UpdateUserCookie($usercode,$useridu);
						setcookie('usr' , $usrnameu , time()+60*60*24*3);
						setcookie('psw', $passuseru , time()+60*60*24*3);
					}
					echo '<div class="alert alert-success alert-dismissable" data-success="true">'.$usrnameu.' خوش آمدید تا لحظاتی دیگر به پنل کاربری هدایت می شوید
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
					echo "<script>setTimeout(\"location.href = './user/userprofile.php';\",3000);</script>";
				}
				else{
					echo '<div class="alert alert-warning alert-dismissable" data-success="false">
					نام کاربری یا کلمه عبور معتبر نمی باشد
					<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
					</div>';
				}
			}
			else{
				echo '<div class="alert alert-warning alert-dismissable">
				ایمیل یا کلمه عبور معتبر نمی باشد
				<a href="#" class="close pull-left" data-dismiss="alert" aria-label="close">&times;</a>
				</div>';
			}
		}
	}
?>
<?php
	if(isset($_POST['lmd'])){
		$servername = "localhost";
		$mysqluser = "root";
		$mysqlpas = "behi1989";
		$dbname = "__db_job";
		$connect = mysqli_connect($servername,$mysqluser,$mysqlpas,$dbname);
		mysqli_set_charset($connect,'utf8');
		$out = '';
		$Mid = '';
		$last_Mid = check_safe_post($_POST['last_Mid']);
		$sql = "SELECT * FROM `__tbl_mashaqel` WHERE `_paystate`=0 AND `_id` > ".$last_Mid." LIMIT 4";
		$resualt = mysqli_query($connect,$sql);
		if(mysqli_num_rows($resualt) > 0){
			while($rows = mysqli_fetch_array($resualt)){
				$Mid = $rows['_id'];
			$out .= '
			<div class="col-md-3 col-sm-6">
			
				<div class="img-thumbss">
						<img src="./_upload/mashaqel/'. $rows['_coImage'] .'" style="width: 250px;height: 250px;" class="img-responsive">
						<figcaption>
							<h3> '. $rows['_coname'] .'</h3>
							<p>تعداد بازدید : '. $rows['_visited'] .' <i class="glyphicon glyphicon-stats"></i><br><a href="./co-detile.php?id='. $rows['_id'] .'">مشاهده جزییات <i class="glyphicon glyphicon-menu-down"></i></a></p>
						</figcaption>
				</div>
				
			</div>
				';
			}
			$out .= '
				<div class="more-adv col-xs-12">
					<span><i class="glyphicon glyphicon-menu-down" name="btn-more" id="btn-mor"  data-toggle="tooltip" data-placement="top" data-mid="'.$Mid.'" title="مشاهده بیشتر"></i></span>
				</div>
			';
			echo $out;
		}
	}
?>


<?php
	if(isset($_POST['lmd_s'])){
		$servername = "localhost";
		$mysqluser = "root";
		$mysqlpas = "behi1989";
		$dbname = "__db_job";
		$connect = mysqli_connect($servername,$mysqluser,$mysqlpas,$dbname);
		mysqli_set_charset($connect,'utf8');
		$out = '';
		$Mid_s = '';
		$limit = "LIMIT 3";
		$last_Mid_s = check_safe_post($_POST['last_Mid_s']);
		$sql = "SELECT * FROM `__tbl_add_job` WHERE `_advPay`=1 AND `_advTaeed`=1 AND `_advType`=1 AND `_id` < ".$last_Mid_s." ORDER BY `_id` DESC $limit";
		$resualt = mysqli_query($connect,$sql);
		if(mysqli_num_rows($resualt) > 0){
			while($rows = mysqli_fetch_array($resualt)){
				$Mid_s = $rows['_id'];
			$out .= '
			
			<tbody>
			<tr onClick=window.open("morejob.php?id='.$rows["_id"].'") style="border-bottom: 2px solid #ECECEC;">
			  <th>'.jdate("l",$rows["_addDate"]).'</th>
			  <td>'.jdate("d",$rows["_addDate"]).'</td>
			  <td>'.jdate("F",$rows["_addDate"]).'</td>
			  <td>'.jdate("Y",$rows["_addDate"]).'</td>
			  <td>'.$rows["_jobTitle"].'</td>
			  <td>'.$rows["_explain"].'</td>
			</tr>
			</tbody>
				';
			}
			$out .= '
			<style>
			
			.daily-job .tbl-btn-more a:hover{
				color: #fff!important;
			}
			.daily-job .table-hover tr:hover a{
				color:#fff;
			}
			</style>
			
			<tfoot class="tbl-btn-more">
				<tr style="text-align: center;">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="text-align: left;">
						<a style="cursor: pointer;float:none" id="more-link" data-mid="'.$Mid_s.'"><strong style="color:#0b82c6 ">+</strong>  آگهی کاریابی بیشتر</a>
					</td>
				</tr>
			</tfoot>

			';
			echo $out;
		}
	}
?>
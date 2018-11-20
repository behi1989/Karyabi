<?php require_once('./inc_theme/headerM.php') ?>
<?php require_once('./inc_theme/modal.php') ?>

 	<!-- slider & job -->
    <section id="sliders" style="overflow-x: hidden">
    <!--slider -->
    <div id="slider" class="col-md-5 col-xs-12 text-center">
    
    	<div class="img-responsive">
        	<div id="mycarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
            	<ol class="carousel-indicators">
<?php
$si = 0;
$wheres = "`_newsType`= 3 or `_newsType`= 2";
$DB = new DB();
$News = new News();
$resNs = $News->ReadSliderNews($wheres);
foreach($resNs as $rowsNs)
{																								
?>
                	<li data-target="#mycarousel" data-slide-to="<?php echo $si++; ?>" class="numbers"><?php echo $si; ?></li>
<?php
}
?>
                </ol>
                <div class="carousel-inner" role="listbox">
<?php
$wheres = "`_newsType`= 3 or `_newsType`= 2";
$DB = new DB();
$News = new News();
$resNs = $News->ReadSliderNews($wheres);
foreach($resNs as $rowsNs)
{
	$idns = $rowsNs['_id'];
?>                
                	<div class="item">
                    	<a href="morenews.php?id=<?php echo $idns; ?>"><img src="./_upload/<?php echo $rowsNs['_newsPic']; ?>" style="width:600px;height:400px" class="img-responsive" alt="<?php echo $rowsNs['_newsPic']; ?>"></a>
                        
						<div class="carousel-caption text-center">
							<a href="morenews.php?id=<?php echo $idns; ?>"><h4><?php echo $rowsNs['_newsTitle'] ?></h4></a>
						</div>
                    </div>
<?php
}
?>                        
                               
                    
                </div>
                    <a class="carousel-control left" href="#mycarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    
                    <a class="carousel-control right" href="#mycarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
            </div>
        </div>

    </div>

    <div id="weather" class="text-center col-md-7 col-xs-12" style="height: 400px;padding: 0">
		<div class="col-xs-12 weather">
			<div class="panel panel-default">
				<ul class="nav nav-tabs" style="margin-top: 3px">
					<li class="active"><a data-toggle="tab" href="#gilaevent"><i class="fa fa-sort-amount-desc"></i>&nbsp; رویداد ها</a></li>
					<li><a data-toggle="tab" href="#news"><i class="fa fa-newspaper-o"></i>&nbsp; اخبار گیلان</a></li>
					<li><a data-toggle="tab" href="#cinema1"><i class="fa fa-film"></i>&nbsp; سینما</a></li>
		    		<li><a data-toggle="tab" href="#weather1"><i class="fa fa-cloud"></i>&nbsp; هواشناسی</a></li>
			    </ul>
			     <div class="tab-content">
			     	<div id="gilaevent" class="tab-pane fade in active">
			     	
						<div class="panel-body fix-panel">
            				<div class="last-news-link">
<?php
$where = "`_newsType`= 1 or `_newsType`= 2";
$DB = new DB();
$News = new News();
$resN = $News->ReadEventNews($where);
foreach($resN as $rowsN)
{
	$idv = $rowsN['_id'];
?>
                				<div class="row" style="margin-right:-10px;padding:0 0 5px 0">
                					<span class="img-thumble">
                						<a href="morenews.php?id=<?php echo $idv; ?>"><img src="./_upload/<?php echo $rowsN['_newsPic']; ?>" class="img-responsive img-circle"></a>
                					</span>
            						<span class="img-text">
               							<a href="morenews.php?id=<?php echo $idv; ?>"><?php echo $rowsN['_newsTitle']; ?></a>
               						</span>
                				</div>
<?php
}
?>
							</div>
						</div>
					 </div>
					<div id="news" class="tab-pane fade">
						<div class="panel-body fix-panel">
            				<div class="last-news-link">
<?php
$wheree = "`_newsType`= 4 or `_newsType`= 3";
$DB = new DB();
$News = new News();
$resNe = $News->ReadEventNews($wheree);
foreach($resNe as $rowsNe)
{
	$idne = $rowsNe['_id'];
?>
                				<div class="row" style="margin-right:-10px;padding:0 0 5px 0">
                					<span class="img-thumble">
                						<a href="morenews.php?id=<?php echo $idne; ?>"><img src="./_upload/<?php echo $rowsNe['_newsPic']; ?>" class="img-responsive img-circle"></a>
                					</span>
            						<span class="img-text">
               							<a href="morenews.php?id=<?php echo $idne; ?>"><?php echo $rowsNe['_newsTitle']; ?></a>
               						</span>
                				</div>
<?php
}
?>
            				</div>
						</div>
					</div>
					
<div id="cinema1" class="tab-pane fade">
    <!-- Indicators -->
<div class="text-center carouselcinema"> 
    <div id="myCarousel2" class="carousel slide" data-interval="5000" data-ride="carousel" style="margin: auto;margin-top: 10px">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
 <?php
$DB = new DB();
$Cinema = new Cinema();
$wheremovie = "`_endPlayTime`=0";
$resCinema = $Cinema->ReadMovieByID($wheremovie);
foreach($resCinema as $rows)
{
?>
            <div class="item">
                <img src="./_upload/cinema/<?php echo $rows['_moviePic']; ?>" alt="<?php echo $rows['_moviePic']; ?>" class="img-responsive" style="width: 700px;height: 330px">
                <div class="carousel-caption carousel-caption2">
                    <p style="text-align: right;margin-right: 25px"><strong style="color: #F0340F">فیلم : </strong><?php echo $rows['_movieName']; ?></p>
                    <p style="text-align: right;margin-right: 25px"><strong style="color: #F0340F">کارگردان : </strong><?php echo $rows['_movieDirector']; ?>&nbsp; &nbsp; &nbsp; &nbsp; <strong style="color: #F0340F">بازیگران : </strong><?php echo $rows['_movieActor']; ?></p>
                    <p style="text-align: right;margin-right: 25px"><strong style="color: #F0340F">اکران در : </strong><?php if($rows['_cinemaName']==1){echo "سینما سپید رود رشت سالن اول";} else if($rows['_cinemaName']==2){echo "سینما سپید رود رشت سالن دوم";} else if($rows['_cinemaName']==3){echo "سینما 22 بهمن رشت";} else if($rows['_cinemaName']==4){echo "سینما میرزا کوچک خان رشت";} ?>&nbsp; &nbsp; &nbsp; &nbsp; <strong style="color: #F0340F">قیمت بلیط : </strong><?php echo $rows['_moviePay']; ?></p>
                    <p style="text-align: right;margin-right: 25px"><strong style="color: #F0340F">سانس های نمایش فیلم : </strong><?php echo $rows['_movieSans']; ?></p>
                </div>
            </div>
<?php
}
?>            
        </div>
        <!-- Left and right controls -->
        <ol class="carousel-indicators">
<?php
$ci = 0;
$DB = new DB();
$wheremovie = "`_endPlayTime`=0";
$resCinema = $Cinema->ReadMovieByID($wheremovie);
foreach($resCinema as $rows)
{
?>           
            <li data-target="#myCarousel2" data-slide-to="<?php echo $ci++; ?>" class="numbers"><?php echo $ci; ?></li>
<?php
}
?>        
        </ol>
    </div>
</div>
				
</div>

				
					<div id="weather1" class="tab-pane fade">
					  <div id="weathers" style="padding: 35px;">
					  	<div id="cont_ad3849e1c8803ef4bcdd0e38f49da80c"><script type="text/javascript" async src="https://www.theweather.com/wid_loader/ad3849e1c8803ef4bcdd0e38f49da80c"></script></div>
					  </div>
					</div>
					
				</div>
			</div>
		</div>		
    </div>
    </section>
    
    <!-- adv -->
    <section id="advs" style="padding-top: 10px">
		<div class="container-fluid text-center" style="padding: 0 50px">
			<div class="row">
<?php
$DB = new DB();
$Adv = new Adv();
$resg = $Adv->ShowAdvInMain();
foreach($resg as $rowsg)
{
?>
            	<div class="col-md-4 wow flipInX center" data-wow-duration="1s" data-wow-delay=".5s">
					<div class="img-thumb">
					   <img src="./_upload/adv/main/<?php echo $rowsg['_advPic']; ?>" style="width: 468px;height: 60px" class="img-responsive" alt="image">
					</div>
				</div>
<?php				
}
?>           
            </div>
        </div>
    </section>
    
    <section id="advsDown" style="box-shadow: 0px -1px 5px 0px #111;">
    	<div class="container-fluid text-center wow bounceInDown center" data-wow-duration="1s" data-wow-delay="1.5s">
			<div id="headeradv">
<?php
if (isset($_SESSION['usrLogin'])){
	if($_SESSION['usrLogin'] != ""){
		$User = new User();
		$session = $_SESSION['usrLogin'];
		$res = $User->SelectLoginUser($session);
		foreach($res as $rows){
			$unmae = $rows['_username'];
			$ids = $rows['_id'];
		}
			if($unmae == $session){	
?>
				<span><h4>کارفرمایان و مدیران شرکت برای ثبت آگهی کاریابی ابتدا در سایت عضو شوند. <a href="./user/userprofile.php"  class="stro" style="color: #112233"> مدیریت پروفایل </a></h4></span>
<?php
		}
	}
}else
{
?>
			<span><h4>کارفرمایان و مدیران شرکت برای ثبت آگهی کاریابی ابتدا در سایت عضو شوند. <a href="#" data-toggle="modal" data-target="#RegModal" data-dismiss="modal" class="stro" style="color: #112233"> عضو می شوم </a></h4></span>
<?php	
}
?>
				<span><h3>مرور آگهی کاریابی روزانه استان گیلان</h3></span>
				<span ><a href="#" id="joblink" class="gojob"><i class="fa fa-angle-down fa-3x area"></i></a></span>
			</div>
    	</div>
    	
    </section>                       
                     
    <!-- Job -->
    <section id="job">
    	<div class="container text-center">
        	<div class="row">   
             <div class="daily-job wow fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">
					<table class="table table-responsive table-hover more-advs" style="direction: rtl">
					  <thead style="border-bottom: 3px solid #0b82c6;">
						<tr style="direction: rtl">
						  <th><i class="fa fa-calendar" style="color: #F24D16"></i></th>
						  <th>روز</th>
						  <th>ماه</th>
						  <th>سال</th>
						  <th><i class="fa fa-navicon" style="color: #F24D16"></i>&nbsp; عنوان آگهی</th>
						  <th><i class="fa fa-code" style="color: #F24D16"></i>&nbsp; توضیحات</th>
						</tr>
					  </thead>
<?php
	$DB = new DB();
	$viewAD = new ViewAD();
	$res = $viewAD->ReadDayAdsTop();
	foreach($res as $rows)
	{	
?>
					  <tbody class="">
					  	<tr onClick="window.open('./morejob.php?id=<?php echo $rows['_id'] ?>');"style="border-bottom: 2px solid #ECECEC;">
						  <th><?php echo jdate('l',$rows['_addDate']) ?></th>
						  <td><?php echo jdate('d',$rows['_addDate']) ?></td>
						  <td><?php echo jdate('F',$rows['_addDate']) ?></td>
						  <td><?php echo jdate('Y',$rows['_addDate']) ?></td>
						  <td><?php echo $rows['_jobTitle'] ?></td>
						  <td><?php echo $rows['_explain'] ?></td>
						</tr>
						
<?php
$Mid_s = $rows['_id'];
	}
?>
					  </tbody>
					</table>
            	<div class="tbl-btn-more">
            		<a style="cursor: pointer" id="more-link" data-mid="<?php echo $Mid_s; ?>" class="pull-left">آگهی کاریابی بیشتر <strong style="color:#0b82c6 ">+</strong></a>
				</div>
            
             </div>     
            </div>
        </div>
    </section>
    
    <section id="advs2">
    	<div class="container-fluid text-center" style="padding: 0 50px">
			<div class="row">
<?php
$DB = new DB();
$Adv = new Adv();
$resg = $Adv->ShowAdvInMain();
foreach($resg as $rowsg)
{
?>
            	<div class="col-md-4 wow flipInX center" data-wow-duration="1s" data-wow-delay="1s">
					<div class="img-thumb">
					   <img src="./_upload/adv/main/<?php echo $rowsg['_advPic']; ?>" style="width: 468px;height: 60px" class="img-responsive" alt="image">
					</div>
				</div>
<?php				
}
?>           
            </div>
        </div>
    </section>
	
    <!-- Company Header -->
    <section id="Co-head" style="box-shadow: 0px -1px 5px 0px #111;">
  		<div class="container-fluid text-center wow bounceInDown center" data-wow-duration="2s" data-wow-delay="1.5s">
  			<span><h4>کسب و کار خود را معرفی کنید و بهتر دیده شوید</h4></span>
			<span ><a href="#" id="co-advslink" class="gocoadvs"><i class="fa fa-angle-down fa-3x area"></i></a></span>
  		</div>
   </section>
   
    <!-- Company adv -->
	<section id="co-advs">
    	<div class="section-heading text-center">
        	<h3 class="text-uppercase">مشاغل برتر</h3>
            <hr class="icon">
        </div>
    
    	<div class="container text-center">
        	<div class="row" style="padding: 0 80px">
<?php
$DB = new DB();
$Mashaqel = new Mashaqel();	
$resM = $Mashaqel->ReadMainMashaqel();
foreach($resM as $rows)
{
?>
            	<div class="col-md-3 col-sm-6 wow bounceIn  center" data-wow-duration="2s" data-wow-delay="1.7s">
					<div class="img-thumbss" style="margin: 1px">
						<img src="./_upload/mashaqel/<?php echo $rows['_coImage']; ?>" style="width: 250px;height: 250px;" class="img-responsive">
						<figcaption>
							<h3><?php echo $rows['_coname']; ?></h3>
							<p>تعداد بازدید : <?php echo $rows['_visited']; ?> <i class="glyphicon glyphicon-stats"></i><br><a href="./co-detile.php?id=<?php echo $rows['_id']; ?>">مشاهده جزییات <i class="glyphicon glyphicon-menu-down"></i></a></p>
						</figcaption>	
					</div>
				</div>
<?php
}
?>				
            </div>
        </div>
    </section>

	<!-- state -->
	<section id="state">
    	<div class="section-heading text-center">
        	<h3 class="text-uppercase">وضعیت آماری سایت</h3>
            <hr class="icon2">
        </div>
    
    	<div class="container-fluid text-center">
        	<div class="row">
<?php
	$ViewAD = new ViewAD();
	$resadv = $ViewAD->ViewCount();
	$User = new User();
	$resusr = $User->UserCount();
	$Karfarma = new Karfarma();
	$reskarfrma = $Karfarma->KarfarmaCount();
	$Mashaqel = new Mashaqel();
	$resmashaqel = $Mashaqel->MashaqelCount();
?>
            	<div class="stat col-md-3 col-sm-6 col-xs-12 company-no text-center">
                	<i class="fa fa-bullhorn"></i>
                    <h2 style="color: #10D2E5"><strong class='numscroller' data-min='1' data-max='<?php echo $resadv; ?>' data-delay='<?php if($resadv <= 100 ){echo "2"; } else { echo "5"; } ?>' data-increment='3'></strong></h2>
                    <h4>تعداد آگهی ها</h4>
                </div>
      
                <div class="stat col-md-3 col-sm-6 col-xs-12 job-no text-center">
                	<i class="fa fa-handshake-o"></i>
                    <h2 style="color: #10D2E5"><strong class='numscroller' data-min='1' data-max='<?php echo $resmashaqel; ?>' data-delay='<?php if($resmashaqel <= 100 ){echo "2"; } else { echo "5"; } ?>' data-increment='5'></strong></h2>
                    <h4>تعداد مشاغل</h4>
                </div>
                
                <div class="stat col-md-3 col-sm-6 col-xs-12 Employer-no text-center">
                	<i class="fa fa-user"></i>
                    <h2 style="color: #10D2E5"><strong class='numscroller' data-min='1' data-max='<?php echo $reskarfrma; ?>' data-delay='<?php if($reskarfrma <= 100 ){echo "2"; } else { echo "5"; } ?>' data-increment='3'></strong></h2>
                    <h4>تعداد کارفرمایان</h4>
                </div>
                
            	<div class="stat col-md-3 col-sm-6 col-xs-12 Job-seeker-no text-center">
                	<i class="fa fa-users"></i>
                    <h2 style="color: #10D2E5"><strong class='numscroller' data-min='1' data-max='<?php echo $resusr; ?>' data-delay='<?php if($resusr <= 100 ){echo "2"; } else { echo "5"; } ?>' data-increment='4'></strong></h2>
                    <h4>تعداد کارجویان</h4>
                </div>
  
            </div>
        </div>
    </section>

	<!-- Contact us-->
	<section id="contact-us">
    	<div class="section-heading text-center">
        	<h3 class="text-uppercase">تماس با ما</h3>
            <hr class="icon3">
        </div>
        
    	<div class="container-fluid">
        	<div class="row">
                <div class="col-md-6 col-xs-12 text-center google-map wow bounceInRight" data-wow-duration="1s" data-wow-delay="1.9s">
                	<div class="about-address text-center">
                    <iframe class="google-maps" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d25397.89790909711!2d49.588937670654296!3d37.27765755864641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfa!2sir!4v1493290096732" width="600" height="335" frameborder="0" style="border:0" ></iframe>

                   	<div class="about-company text-center">
                    	<div class="row">
                            <div class="col-xs-12">
								<i class="fa fa-envelope-o" style="color: #E74C3C"></i>
                                <h5>پست الکترونیکی :</h5>
                                <h5>Info@niazerasht.ir</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <i class="fa fa-phone" style="color: #1ABC9C"></i>
                                <h5>شماره تماس :</h5>
                                <h5 style="direction: rtl">0911-149-5463</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <i class="fa fa-map-marker" style="color: #F1C40F"></i>
                                <h5>آدرس :</h5>
                                <h5>استان گیلان، رشت</h5>
                            </div>
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
                <div class="col-md-6 col-xs-12 text-center contact-form wow bounceInLeft" data-wow-duration="1s" data-wow-delay="1.9s">
                    	<div class="row">
                           <div id="contactres" style="margin: 0 15px;text-align: right">
                           	
                           </div>
                           <input type="hidden" class="form-control" id="Cid" value="<?php echo $usrid; ?>">
                           <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Cname" value="<?php echo $usrnames; ?>" style="color: #F0340F">
                                </div>
                            </div>
                           <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Cemail" value="<?php echo $usremial; ?>" style="color: #F0340F">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Cmobile" value="<?php echo $usrmobile; ?>" style="color: #F0340F">
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Ctitle" placeholder="عنوان">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<select class="btn btn-block dropdown" id="Ctype" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
										<option value="0">ارتباط با مدیر</option>
										<option value="1">بخش پشتیبانی فنی</option>
										<option value="2">بخش تبلیغات</option>
									</select>
                                </div>
                            </div>
                            <div class="col-xs-12 pull-right">
                                <div class="form-group">
                                    <textarea class="form-control" id="Ctxt" placeholder="متن خود را وارد کنید" style="height:240px;resize: none"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 btnsend">
                            	<button type="submit" id="Csendcontact" class="btn btn-default">ارسال</button>
                            </div>
                        </div>
                </div>
<?php
	}
}else
{
?>
       <div class="col-md-6 col-xs-12 text-center contact-form wow bounceInLeft" data-wow-duration="1s" data-wow-delay="1.9s">
                    	<div class="row">
                           <div id="contactres" style="margin: 0 15px;text-align: right">
                           	
                           </div>
                           <input type="hidden" class="form-control" id="Cid" value="0">
                           <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Cname" placeholder="نام و نام خانوادگی">
                                </div>
                            </div>
                           <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Cemail" placeholder="پست الکترونیکی">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Cmobile" placeholder="شماره موبایل">
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<input type="text" class="form-control" id="Ctitle" placeholder="عنوان">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 pull-right">
                            	<div class="form-group">
                                	<select class="btn btn-block dropdown" id="Ctype" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
										<option value="0">ارتباط با مدیر</option>
										<option value="1">بخش پشتیبانی فنی</option>
										<option value="2">بخش تبلیغات</option>
									</select>
                                </div>
                            </div>
                            <div class="col-xs-12 pull-right">
                                <div class="form-group">
                                    <textarea class="form-control" id="Ctxt" placeholder="متن خود را وارد کنید" style="height:240px;resize: none"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 btnsend">
                            	<button type="submit" id="Csendcontact" class="btn btn-default">ارسال</button>
                            </div>
                        </div>
                </div>    
<?php
}
?>
            </div>
        </div>
    </section>
    
<?php require_once('./inc_theme/footer.php') ?>
<?php require_once('./inc_theme/jquerylink.php') ?>
   
    <!-- Slider Show image SET active class -->
    <script type="text/javascript">
		$(document).ready(function(e){
			$('.carousel-indicators li:nth-child(1)').addClass('active');
			$('.item:nth-child(1)').addClass('active');
		});
	</script>
	<!-- Go Job -->
	<script type="text/javascript">
		function GoJob(){
			
		}
	</script>
	<!-- job btn more -->
	<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','#more-link',function(){
			var last_Mid_s = $(this).data('mid');
			var lmd_s = true;
			$.ajax({
				url:"./inc_func/set-ajax.php",
				method:"POST",
				data:{last_Mid_s:last_Mid_s,lmd_s:lmd_s},
				dataType:"Text",
				success:function(data){
					if(data != ''){
						$(".tbl-btn-more").remove();
						$(".more-advs").append(data);
					}else{
						$(".tbl-btn-more").hide();
					}
				}
			});
		});
	});
	</script>  
	
	</body>
</html>
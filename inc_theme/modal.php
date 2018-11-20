
	 <!-- Login form -->
 	 <div id="myModal" class="modal fade"  role="dialog">
     	<div class="modal-dialog" style="max-width: 450px">
        
     		<div class="modal-content ss1">
            
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color: #2CC990">ورود به پنل کاربری</h4>
                </div>
                
                <div class="modal-body">
                       <div class="msg_error2"></div>
<?php

if(isset($_COOKIE["usr"]) && isset($_COOKIE["psw"])){
	$usr = $_COOKIE["usr"];
	$psw = $_COOKIE["psw"];

?>
                        <div class="form-group">
                            <input type="text" class="form-control" id="usrname" name="usrname" value="<?php echo $usr; ?>" >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="psw" name="psw" value="<?php echo $psw; ?>">
                        </div>
<?php
}
else{	
?>
						<div class="form-group">
                            <input type="text" class="form-control" id="usrname" name="usrname" placeholder="نام کاربری" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="psw" name="psw" placeholder="کلمه عبور">
                        </div>
<?php
}
?>
                        <div class="checkbox">
                            <input type="checkbox" id="chkbox" name="chkbox"><label>به خاطر بسپار</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-block logins" name="logins">ورود</button>
                </div>
                <div class="modal-footer">
                    <p>
                    	<button type="submit" class="btn btn-warning" data-dismiss="modal" data-toggle="modal" data-target="#forgetpass" id="forget">کلمه عبور را فراموش کردم</button>
                    	<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#RegModal" data-dismiss="modal" id="create">ایجاد حساب کاربری</button>
                    </p>
                </div>
      		</div> 
		</div>
	</div>

<!-- Register form -->
  	 <div id="RegModal" class="modal fade"  role="dialog">
     	<div class="modal-dialog" style="max-width: 400px">
        
     		<div class="modal-content ss2">
            
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color: #1DABB8">ایجاد حساب کاربری</h4>
                </div>                
                <div class="modal-body">
                       <div class="msg_error">
                       	
                       </div>
                        <div class="form-group">
                            <input type="text" class="form-control fname" name="fname" placeholder="نام و نام خانوادگی" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control uname" name="uname" placeholder="نام کاربری">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control email1" name="email1" placeholder="پست الکترونیکی">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control pass1" name="pass1" placeholder="کلمه عبور">
                        </div>
                        <div class="form-group">
                        	<select class="btn btn-block dropdown form-control usertype" name="usertype" style="border: 1px solid #d1d1d1;margin-bottom: 15px;color: #999">
                        		<option value="0">نوع اکانت کاربری را انتخاب کنید</option>
                        		<option value="1">کاربر عادی</option>
                        		<option value="2">کارفرما</option>
                        	</select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="insert" name="insert" data-target="#insert">ثبت نام</button>
                    <button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#myModal" id="Loginn"> ورود به پنل کاربری</button>
                </div>           
      		</div>
            
		</div>
	</div>	

<!-- Forget Pass -->
	 <div id="forgetpass" class="modal fade"  role="dialog">
     	<div class="modal-dialog" style="max-width: 450px">
        
     		<div class="modal-content ss3">
            
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 style="color: #FF5A1E">بازیابی کلمه عبور</h4>
                </div>
                
                <div class="modal-body">
                   <div class="msg_error3">
                       	
                   </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email2" placeholder="پست الکترونیکی" autofocus>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block" id="recoverpass" name="recoverpass">بازیابی کلمه عبور</button>
                </div>
                <div class="modal-footer">
                    <p>
                    	<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#RegModal" data-dismiss="modal" id="create">ایجاد حساب کاربری</button>
                    	<button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#myModal"> ورود به پنل کاربری</button>
                    </p>
                </div> 
      		</div> 
		</div>
	</div>
<?php
error_reporting(0);

	//hash pass
	function hash_pass($value){
		return md5($value)."kr#n@6J*$^b";
	}
	//check xss & adslash & Script [GET]
	function check_safe_get($value){
		$value1=addslashes($value);
		$string1=htmlspecialchars($value1);
		$string2=strip_tags($string1);
		$string3=intval($string2);
		return $string3;
	}

	//check xss & adslash & Script [POST]
	function check_safe_post($value){
		$value1=addslashes($value);
		$string1=htmlspecialchars($value1);
		$string2=strip_tags($string1);
		return $string2;
	}

	// Redirect Page
	function Redirect($page,$parameter){
		if (isset($page) && isset($parameter)){
			$page_filter = $page.".php?".$parameter;
			header("location:$page_filter");
			exit();
		}elseif(isset($page)){
			$page_filter = $page.".php";
			header("location:$page_filter");
			exit();
		}
	}

	//Message Manage
	function Message_Warning($message){
		echo '<div class="alert alert-warning">'.$message.'</div>';
	}
	function Message_Success($message){
		echo '<div class="alert alert-success">'.$message.'</div>';
	}
	function Message_Error($message){
		echo '<div class="alert alert-danger">'.$message.'</div>';
	}

	//include Covering
	function Covering($page){
		$page_filter = $page.".php";
		include "$page_filter";
	}

	//Check Email
	function check_email($email) {  // First, we check that there's one @ symbol, and that the lengths are right 
        if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {   
                // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.   
                return false; 
        }  // Split it into sections to make life easier 
       
        $email_array = explode("@", $email); 
        $local_array = explode(".", $email_array[0]); 
        for ($i = 0; $i < sizeof($local_array); $i++) {     
                if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {     
                        return false;   
                }
        }   
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
                // Check if domain is IP. If not, it should be valid domain name   
                $domain_array = explode(".", $email_array[1]);   
                if (sizeof($domain_array) < 2) {       
                        return false; // Not enough parts to domain   
                }   
                for ($i = 0; $i < sizeof($domain_array); $i++) {     
                        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {       
                                return false;     
                        }   
                } 
        } 
        return true;
	}

	//Paging
	function paging2($total, $limit, $current_page, $link=':id:', $distance=3){

		$total_page = $total / $limit;

		if (is_float($total_page))    $total_page = ceil($total_page);

		$result = '<li><a title="'.$current_page.'" href="'.str_replace(':id:', $current_page, $link).'" class="disabled">'.$current_page.'</a></li>'.PHP_EOL;

		for ($i = $current_page+1; $i <= $current_page+$distance; $i++)
			if ($i <= $total_page)
				$result .= '<li><a title="'.$i.'" href="'.str_replace(':id:', $i, $link).'">'.$i.'</a></li>'.PHP_EOL;

		for ($i = $current_page-1; $i >= $current_page-$distance; $i--)
			if ($i >= 1)
				$result = '<li><a title="'.$i.'" href="'.str_replace(':id:', $i, $link).'">'.$i.'</a></li>'.PHP_EOL.$result;

		if ($current_page-$distance > 2)
			$result = '<li> ... </li>'.PHP_EOL.$result;

		if ($current_page+$distance < $total_page-1)
			$result = $result.'<li> ... </li>'.PHP_EOL;

		if ($current_page > 1) {
			$previous = $current_page - 1;
			$result = '<li><a title="'.$previous.'" href="'.str_replace(':id:', $previous, $link).'">قبلی</a></li>'.PHP_EOL.$result;
		}

		if ($current_page < $total_page) {
			$next = $current_page + 1;
			$result = $result.'<li><a title="'.$next.'" href="'.str_replace(':id:', $next, $link).'">بعدی</a></li>'.PHP_EOL;
		}

		if ($current_page-$distance > 1)
			$result = '<li><a title="1" href="'.str_replace(':id:', '1', $link).'">&laquo; اولین</a></li>'.PHP_EOL.$result;

		if ($current_page+$distance < $total_page)
			$result = $result.'<li><a title="'.$total_page.'" href="'.str_replace(':id:', $total_page, $link).'">آخرین &raquo;</a></li>'.PHP_EOL;

		return '<div class="page"><ul>'.PHP_EOL.$result.'</ul>'.PHP_EOL/*.'<div>تعداد کل صفحات : <strong>'.$total_page.'</strong> صفحه</div>'.PHP_EOL*/.'</div>';
	}



	function paging($total, $limit, $current_page, $link=':id:', $distance=3){

		$total_page = $total / $limit;

		if (is_float($total_page))    $total_page = ceil($total_page);

		$result = '<li><a title="'.$current_page.'" href="'.str_replace(':id:', $current_page, $link).'" class="disabled">'.$current_page.'</a></li>'.PHP_EOL;

		for ($i = $current_page+1; $i <= $current_page+$distance; $i++)
			if ($i <= $total_page)
				$result .= '<li><a title="'.$i.'" href="'.str_replace(':id:', $i, $link).'">'.$i.'</a></li>'.PHP_EOL;

		for ($i = $current_page-1; $i >= $current_page-$distance; $i--)
			if ($i >= 1)
				$result = '<li><a title="'.$i.'" href="'.str_replace(':id:', $i, $link).'">'.$i.'</a></li>'.PHP_EOL.$result;

		if ($current_page-$distance > 2)
			$result = '<li> ... </li>'.PHP_EOL.$result;

		if ($current_page+$distance < $total_page-1)
			$result = $result.'<li> ... </li>'.PHP_EOL;

		if ($current_page > 1) {
			$previous = $current_page - 1;
			$result = '<li><a title="'.$previous.'" href="'.str_replace(':id:', $previous, $link).'">قبلی</a></li>'.PHP_EOL.$result;
		}

		if ($current_page < $total_page) {
			$next = $current_page + 1;
			$result = $result.'<li><a title="'.$next.'" href="'.str_replace(':id:', $next, $link).'">بعدی</a></li>'.PHP_EOL;
		}

		if ($current_page-$distance > 1)
			$result = '<li><a title="1" href="'.str_replace(':id:', '1', $link).'">&laquo; اولین</a></li>'.PHP_EOL.$result;

		if ($current_page+$distance < $total_page)
			$result = $result.'<li><a title="'.$total_page.'" href="'.str_replace(':id:', $total_page, $link).'">آخرین &raquo;</a></li>'.PHP_EOL;

		return '<div class="page"><ul>'.PHP_EOL.$result.'</ul>'.PHP_EOL.'</div>';
	}


	//Safe Image Upload
	function SafeUpload($name, $max_size, $filesize) {

	$root = str_replace('\\', '/', dirname(__FILE__));

    $allowedTypes = array ('image/gif', 'image/jpeg', 'image/png', 'image/wbmp');

    if(!isset($_FILES [$name])) {

        return false;

    }

    $file = &$_FILES [$name];

    if($file ['error'] == 0 && in_array($file ['type'], $allowedTypes) && $file ['size'] <= $max_size) {

        $in = '';

        switch($file ['type']) {

        case 'image/gif':

            $in = 'ImageCreateFromGIF';

            break;

        case 'image/jpeg':

            $in = 'ImageCreateFromJPEG';

            break;

        case 'image/png':

            $in = 'ImageCreateFromPNG';

            break;

        case 'image/wbmp':

            $in = 'ImageCreateFromWBMP';

            break;

        }

        if($in == '') {

            return false;

        }
		
	$w=450;
	$h=338;
	$crop = false;
	list($width, $height) = getimagesize($file['tmp_name']);
	$r = $width / $height;
	if ($crop) {
		if ($width > $height) {
			$width = ceil($width-($width*abs($r-$w/$h)));
		} else {
			$height = ceil($height-($height*abs($r-$w/$h)));
		}
		$newwidth = $w;
		$newheight = $h;
	} else {
		if ($w/$h > $r) {
			$newwidth = $h*$r;
			$newheight = $h;
		} else {
			$newheight = $w/$r;
			$newwidth = $w;
		}
	}
    $src = $in($file ['tmp_name']);
	$dst = imagecreatetruecolor($newwidth, $newheight);
	$im = imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	/*$stamp = imagecreatefrompng('../img/watermark.png');
	$marge_right = 2;
	$marge_bottom = 2;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);
	imagecopy($dst,$stamp,imagesx($dst) - $sx - $marge_right,imagesy($dst)-$sy-$marge_bottom,0,0,imagesx($stamp),imagesy($stamp));*/	

	
    $time = time();
        while(file_exists($root . '/../upload/' . $time . '.jpg')) {

            $time++;

        }

        //$quality = 100;

        do {

            ImageJPEG($dst, $root . '/../upload/' . $time . '.jpg');

        	} 
		while(filesize($root . '/../upload/' . $time . '.jpg') > $filesize && $quality > 0);
		if(file_exists($root . '/../upload/' . $time . '.jpg')){
        ImageDestroy($dst);
        ImageDestroy($src);
		$ax = $time;
		return $ax;
		}

		}// end function
		
	}// end isset
		
?>
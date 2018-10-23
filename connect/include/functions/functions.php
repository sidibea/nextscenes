<?php



// http://www.linuxjournal.com/article/9585
function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
	if(!preg_match("/^(([A-Za-z0-9!#$%&'*+\=?^_`{|}~-][A-Za-z0-9!#$%&'*+\=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
	  	return false;
	}
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if(!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

function getDataFromUrl($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function removeSpaces($text) {
	$text = trim($text);
	$text = preg_replace("/ -+/","-",$text);
	$text = preg_replace("/- +/","-",$text);
	$text = preg_replace("/ +/","-",$text); // remplace les espaces par -
	return $text;
}

function cleanURLString($string) {
	$encoding = mb_detect_encoding($string, 'auto');
	if($encoding=='UTF-8') $string = utf8_decode($string);
    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';
    $string = strtr($string, $a, $b);
    $string = strtolower($string);
	//echo $string.'<br>';
    $string = eregi_replace("[^a-z0-9]",' ',$string);
    $string = removeSpaces($string);
    return $string;
}

function currentPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function sendMail($from, $to, $subject, $message, $bcc='') {
	ini_set('sendmail_from', "$from");
	$headers  = "From: $from\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	if($bcc!='') $headers .= "Bcc: $bcc";
	mail($to, $subject, $message, $headers);
}

function createFile($file, $content) {
	$fh = fopen($file, 'w') or die('Cannot create the file');
	fwrite($fh, $content);
	fclose($fh);
}

function notification() {
	if($_SERVER['SERVER_NAME']!='localhost') {
		if(is_writable('include')) {
			$file = 'include/install.txt';
			if(!file_exists($file)) {
				$url = 'http://yougapi.com/updates/?item='.$GLOBALS['system_code'].'&s='.currentPageURL();
				getDataFromUrl($url);
				createFile($file, 'Install completed: '.date('Y-m-d'));
			}
		}
		else {
			echo 'The "include" folder needs to be writtable (permission set to 777)<br>';
			exit();
		}		
	}
}

?>
<?php

//Define destination file to sava data
$subscribersFileName = "subscribers.txt";

function GetField($input) {
    $input=strip_tags($input);
    $input=str_replace("<","<",$input);
    $input=str_replace(">",">",$input);
    $input=str_replace("#","%23",$input);
    $input=str_replace("'","`",$input);
    $input=str_replace(";","%3B",$input);
    $input=str_replace("script","",$input);
    $input=str_replace("%3c","",$input);
    $input=str_replace("%3e","",$input);
    $input=trim($input);
    return $input;
}

function validEmail($email) {
   $isValid = true;
   $atIndex = strrpos($email, "@");
   
   if (is_bool($atIndex) && !$atIndex) {
      $isValid = false;
	  
   } else {
	   
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
	  
      if ($localLen < 1 || $localLen > 64) {
         // local part length exceeded
         $isValid = false;
      } else if ($domainLen < 1 || $domainLen > 255) {
         // domain part length exceeded
         $isValid = false;
      } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
         // local part starts or ends with '.'
         $isValid = false;
      } else if (preg_match('/\\.\\./', $local)) {
         // local part has two consecutive dots
         $isValid = false;
      } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
         // character not valid in domain part
         $isValid = false;
      } else if (preg_match('/\\.\\./', $domain)) {
         // domain part has two consecutive dots
         $isValid = false;
      } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
            $isValid = false; }
      }
   }
   return $isValid;
}

//Setting used message.
$emptyemail = 'We need your email address!';
$warningemail = 'Please enter a valid email address!';
$duplicateMail = "E-mail is already in the list!";
$systemError = 'An error occurred. Please try again!';
$thanks = 'THANK YOU<br />We&prime;ll notify you when we are ready!';

//Setting used variables.
$NotOk = '';
$Ok = 1;

// Sanitizing the data.
function clean_var($variable) {
  $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

	//Begin Validation.
	if ( empty($_REQUEST['email']) ) {
		$Ok = 0;
		$NotOk .= "<p>" . $emptyemail . "</p>";
	} elseif ( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $_REQUEST['email']) ) {
		$Ok = 0;
		$NotOk .= "<p>" . $warningemail . "</p>";
	}
	
	//If input data is false, print the error messages.
	if ( $Ok==0 ) {
		
		//This is the error message.
		echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 3000).fadeOut(\"slow\"); </script>";
		echo $NotOk;
	
	//If input data is true, begin capture form data.
	} elseif (isset($_REQUEST['email'])) {
		
		//Capture subscriber form input
		$email 	= GetField($_POST['email']);
		//Check validation
		$pass 	= validEmail($email);
		
		if ($pass) {
			//Get form input
			$fp = fopen($subscribersFileName, 'a+');
			$read = fread($fp,filesize($subscribersFileName));
			if (strstr($read,"@")) {
				$delimiter = ",";
			}
			
			//Check duplicated email.
			if (strstr($read,$email)) { 
				echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 3000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
				echo $duplicateMail;
			
			//If new email not in the list, open file, write on it then save data and say thanks to subscriber.
			} else {
			fwrite($fp, $delimiter . $email);
				echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
				echo $thanks;
				die();
			}
			//End process and close file.
			fclose($fp);
		}
		
	} else {
	
	//System error message
	echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
	echo $systemError;
		
	}

?>

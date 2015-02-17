<?php

require('../../../../wp-load.php'); 

/*--------------------------------------------------------------------------------------------------------
Set the AJAX Messages
--------------------------------------------------------------------------------------------------------*/
$emptymail = 'We need your email address!';
$alertmail = 'Please enter a valid email address!';
$thanks = 'THANK YOU<br />We&prime;ll notify you when we are ready!';

/*--------------------------------------------------------------------------------------------------------
Begin AJAX contact form validation
--------------------------------------------------------------------------------------------------------*/

//Setting used variables.
$alert = '';
$pass = 0;

// Sanitizing the data.
function clean_var($variable) {
    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

//Validate input data.
if ( empty($_REQUEST['email']) ) {
	$pass = 1;
	$alert .= "<p>" . $emptymail . "</p>";
	} elseif ( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $_REQUEST['email']) ) {
	$pass = 1;
	$alert .= "<p>" . $alertmail . "</p>";
}

	//If error, print the error messages.
	if ( $pass==1 ) {
		echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 3000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
		echo $alert;

	// If the input data is valid.
	} elseif (isset($_REQUEST['email'])) {
	    
		//Send email.
		$EmailTo = get_option(prefix."email_adrs"); //Your email address
		$EmailFrom = Trim(stripslashes($_POST['email']));
		$Subject = "Add me to your mailing list";
		$Name = Trim(stripslashes($_POST['email'])); 
		$Email = Trim(stripslashes($_POST['email'])); 
		$Message = Trim(stripslashes($_POST['email']));
		$headers .= "From: $Email" . "\r\n";
		$Body = "";
		$Body .= "Name: ";
		$Body .= $Name;
		$Body .= "\n";
		$Body .= "Email: ";
		$Body .= $Email;
		$Body .= "\n";
		$Body .= "Subject: ";
		$Body .= $Subject;
		$Body .= "\n";
		$Body .= "Message: ";
		$Body .= $Message;
		$Body .= "\n";
		$success = mail($EmailTo, $Subject, $Body, $headers);

		//Success message. 
		echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
		echo $thanks;
		die();
		echo "<br/><br/>" . $message;
		
	}
	
?>

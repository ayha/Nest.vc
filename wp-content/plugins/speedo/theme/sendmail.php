<?php

require('../../../../wp-load.php'); 

/*--------------------------------------------------------------------------------------------------------
Set the AJAX Messages
--------------------------------------------------------------------------------------------------------*/
$errormessage = 'Oops! There seems some problem occurs..!'; 
$hiddenfield = "You filled in the hiddenfield! Are you human? Please try again!";

$emptyname =  'We are sure that you have a name!';
$emptymail = 'We need your email address!';
$emptysubject = 'What is your subject?';
$emptymessage = 'Please do not send us a blank email!';

$alertname =  'Please enter your name using only the standard alphabet!';
$alertmail = 'Please enter your email in this format: <i>name@example.com</i>.';
$alertsubject = 'Please enter your subject using only the standard alphabet!';

$thanks = '<br />Your message has been sent<br />We&prime;ll contact you as soon as possible.<br />THANK YOU..!';

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
if ( empty($_REQUEST['last']) ) {
if ( empty($_REQUEST['name']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptyname . "</li>";
} elseif ( preg_match( "/^[][{}()*\\^$|+`~!@#%&+_+-+?+]/i", $_REQUEST['name'] ) ) {
	$pass = 1;
	$alert .= "<li>" . $alertname . "</li>";
}
if ( empty($_REQUEST['mail']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptymail . "</li>";
} elseif ( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $_REQUEST['mail']) ) {
	$pass = 1;
	$alert .= "<li>" . $alertmail . "</li>";
}
if ( empty($_REQUEST['subject']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptysubject . "</li>";
} elseif ( preg_match( "/^[][{}()*+.\\^$|]/i", $_REQUEST['subject'] ) ) {
	$pass = 1;
	$alert .= "<li>" . $alertsubject . "</li>";
}
if ( empty($_REQUEST['message']) ) {
	$pass = 1;
	$alert .= "<li>" . $emptymessage . "</li>";
}

	//If error, print the error messages.
	if ( $pass==1 ) {
		echo "<script>$(\".message\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 3000).fadeOut(\"slow\"); </script>";
		echo "" . $errormessage . "";
		echo "<ul>";
		echo $alert;
		echo "</ul>";

	// If the input data is valid.
	} elseif (isset($_REQUEST['message'])) {
	    
		//Send email.
		$EmailTo = get_option(prefix."email_adrs"); //Your email address
		$EmailFrom = Trim(stripslashes($_POST['name']));
		$Subject = Trim(stripslashes($_POST['subject']));
		$Name = Trim(stripslashes($_POST['name'])); 
		$Email = Trim(stripslashes($_POST['mail'])); 
		$Message = Trim(stripslashes($_POST['message']));
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
		echo "<script>$(\".message\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
		echo $thanks;
		die();
		echo "<br/><br/>" . $message;
		
	}
	
} else {
	
	echo "<script>$(\".message\").hide(\"slow\").fadeIn(\"slow\"); </script>";
	echo $hiddenfield;
	
}

?>

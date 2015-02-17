<?php

require('../../../../wp-load.php'); 

/*--------------------------------------------------------------------------------------------------------
Set the AJAX Messages
--------------------------------------------------------------------------------------------------------*/
include("PHPmailer/class.phpmailer.php");

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

/*
--------------------------------------------------------------------------------------------------------
Begin AJAX contact form validation
--------------------------------------------------------------------------------------------------------
*/

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

	// If the input data is invalid.
	echo "<script>$(\".message\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\"); </script>";
	echo "" . $errormessage . "";
	echo "<ul>";
	echo $alert;
	echo "</ul>";
	
	// If the user didn't err and there is in fact a message, time to email it.
	} elseif (isset($_REQUEST['message'])) {
	    
		//Send email.
		$name = Trim(stripslashes($_POST['name'])); 
		$email = Trim(stripslashes($_POST['mail']));
		$subject = Trim(stripslashes($_POST['subject'])); 
		$message = Trim(stripslashes($_POST['message']));
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true; // enable SMTP authentication
		$mail->SMTPSecure = "ssl"; // use ssl
		$mail->Host = "smtp.gmail.com"; // GMail's SMTP server
		$mail->Port  = 465; // SMTP port used by GMail server
		$mail->Username   = get_option(prefix."email_adrs"); // GMail username
		$mail->Password   = get_option(prefix."email_pass"); // You GMail password
		$mail->AddAddress(get_option(prefix."email_adrs"));  // email address of recipient
		$mail->AddReplyTo($email); // Reply email address
		$mail->FromName = $name; // Name to appear once the email is sent
		$mail->Subject = $subject; // Email's subject
		$mail->Body = 'Name: '.$_POST['name'] . PHP_EOL . 
			'E-mail: ' . $_POST['mail'] . PHP_EOL . PHP_EOL .
			'Subject: ' . $_POST['subject'] . PHP_EOL . PHP_EOL . 
			'Message:' . PHP_EOL . $_POST['message'];
		if(!$mail->Send())
		echo "Mailer Error: " . $mail->ErrorInfo;
		else ;

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

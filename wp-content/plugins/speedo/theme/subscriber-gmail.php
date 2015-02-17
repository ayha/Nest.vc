<?php

require('../../../../wp-load.php'); 
include("PHPmailer/class.phpmailer.php");

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
		$name = Trim(stripslashes($_POST['email'])); 
		$email = Trim(stripslashes($_POST['email']));
		$subject = "Add me to your mailing list"; 
		$message = Trim(stripslashes($_POST['email']));
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
		$mail->Body = 'Name: '.$_POST['email'] . PHP_EOL . 
			'E-mail: ' . $_POST['email'] . PHP_EOL . PHP_EOL .
			'Subject: ' . $_POST['subject'] . PHP_EOL . PHP_EOL . 
			'Message:' . PHP_EOL . $_POST['email'];
		if(!$mail->Send())
		echo "Mailer Error: " . $mail->ErrorInfo;
		else ;

		//Success message. 
		echo "<script>$(\"#submessage\").hide(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\"); $(':input').clearForm() </script>";
		echo $thanks;
		die();
		echo "<br/><br/>" . $message;
		
	}
	
?>

<?php

/** The name of the database for WordPress */
define( 'DB_NAME', 'nestvc_wp' );

/** MySQL database username */
define( 'DB_USER', 'nestvc_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'cim.123.' );
 
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

define("TABLE", "aia_applications");

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$db = mysql_select_db(DB_NAME, $conn);
$datetime = date("Y-m-d H:i:s");

$fields = array();
$values = array();

foreach($_POST as $k=>$v ){
	array_push($fields, $k);
	array_push($values, mysql_real_escape_string($v));
}


$q = "INSERT INTO ".TABLE." (";

foreach($fields as $f){
	$q .= $f.", ";
}

$q .= "date_submitted";
$q .= ") VALUES (";

foreach($values as $v){
	$q .= "'".$v ."', ";
}

$q .= "'".$datetime."')";


mysql_query($q) or die ($q);

mysql_close($conn);


require 'phpmailer/PHPMailerAutoload.php';

if(!empty($_POST)){
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('aia@nest.vc', 'AIA Accelerator');
//Set an alternative reply-to address
$mail->addReplyTo('aia@nest.vc', 'AIA Accelerator');
//Set who the message is to be sent to
$mail->addAddress('jess@investable.vc', 'Jessica');
$mail->addAddress('alex@investable.vc', 'Alex');
//Set the subject line
$mail->Subject = 'Application to the AIA Accelerator -'.$_POST["company_name"];
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$msg = "<h1>New Application to the AIA Accelerator program</h1>";
$msg .= "<p>Founder Name: ".$_POST["founder_name"]."</p>";
$msg .= "<p>Founder Email: ".$_POST["email"]."</p>";
$msg .= "<hr>";
$msg .= "<p><strong>Company Name:</strong> ".$_POST["company_name"]."</p>";
$msg .= "<p><strong>Short Video:</strong> <a href='".$_POST["video_link"]."' target='_blank'>".$_POST["video_link"]."</a></p>";
$msg .= "<p><strong>How did the founders meet</strong></p><p>".nl2br($_POST["founders"])."</p>";
$msg .= "<p><strong>Why this idea</strong></p><p>".nl2br($_POST["why"])."</p>";
$msg .= "<p><strong>Founder's experience</strong></p><p>".nl2br($_POST["experience"])."</p>";
$msg .= "<p><strong>Current Progress</strong></p><p>".nl2br($_POST["progress"])."</p>";
$msg .= "<p><strong>What problem does it solve</strong></p><p>".nl2br($_POST["problem"])."</p>";
$msg .= "<p><strong>How they heard about the program</strong></p><p>".$_POST["how"]."</p>";

$mail->msgHTML($msg);


//send the message, check for errors
if (!$mail->send()) {
    echo "There was an error sending email, please try again later.";
} else {
    echo "Thank you for your application. We will be in touch with your shortly.";
}

}else{
	echo "Please complete the form and try again.";
}

?>
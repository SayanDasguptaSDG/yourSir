<?php
require_once('connection.php');
$name=$_POST['name'];
$emailClient=$_POST['email'];
$messageForAdmin=$_POST['message'];

$messageForClient = "Thanks a lot <b><i>".ucwords($name)."</i></b> for contacting us. Our team will shortly respond to you.";

$subjectForClient = "Thank You";


require_once ('PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer;

//Enable SMTP debugging.
//$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "letterhead.yoursir@gmail.com";
$mail->Password = 'y@^r$ir$^bh1996';
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;

$mail->setFrom('letterhead.yoursir@gmail.com','System yourSir');
//$mail->FromName = "Subhashis Pal";

$mail->addAddress($emailClient, $name);

$mail->isHTML(true);

$mail->Subject = $subjectForClient;
$mail->Body = $messageForClient;
//$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send())
{
   // echo "Mailer Error: " . $mail->ErrorInfo;
	header('location:contact.php?status='.urlencode(base64_encode("error")));
}
else
{
   // echo "Message has been sent successfully";
	header('location:contact.php?status='.urlencode(base64_encode("success")));
}

?>

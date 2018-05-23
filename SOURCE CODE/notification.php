

<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function notify_password($email, $password) {
// $email and $message are the data that is being


if (!empty($password)){
$message = "Your password has been changed to ".$password."\r\n".
            "Please change it next time you log in.\r\n";
          }else {
  $message = "Congratulations you already sign up to our website\n";

          }

require './PHPMailer/vendor/vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();

$mail->SMTPDebug =0;
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "servicebasketballmanagement@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Danh2610";
//Set who the message is to be sent from
$mail->setFrom('servicebasketballmanagement@gmail.com', 'ADMIN');
//Set an alternative reply-to address
$mail->addReplyTo('servicebasketballmanagement@gmail.com', 'ADMIN MAILL BOX');
//Set who the message is to be sent to
$mail->addAddress($email,'To Users');
//Set the subject line
$mail->Subject = 'BASKET MANAGEMENT';
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
$mail->msgHTML($message , "$password");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('./logo/1.jpg');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";

}

}

function notify_feedback($email, $password) {
// $email and $message are the data that is being

$message = $password;
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
require './PHPMailer/vendor/vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug =0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "basketballmanagementfeedback@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "Thomas123456";
//Set who the message is to be sent from
$mail->setFrom('basketballmanagementfeedback@gmail.com', 'ADMIN');
//Set an alternative reply-to address
$mail->addReplyTo('basketballmanagementfeedback@gmail.com', 'ADMIN feedback');
//Set who the message is to be sent to
$mail->addAddress($email,'To Users');
//Set the subject line
$mail->Subject = 'FEEDBACK';
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
$mail->msgHTML($message , "$password");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";

}

}
?>

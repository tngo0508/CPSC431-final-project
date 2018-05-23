<?php

$email = $_POST['email'];
$cname= $_POST['cname'];
$subject= $_POST['subject'];
$message= $_POST['message'];

$feedback = "{ email: ".$email.",\r\n"."name: ".$cname.",\r\n"."subject: ".$subject.",\r\n"."message: ".$message."}";
require_once 'notification.php';
$email = "basketballmanagementfeedback@gmail.com";
notify_feedback($email, $feedback);




header('location: contact.php');
exit;


?>

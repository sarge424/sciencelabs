<?php
require_once 'PHPMailer\third_party\phpmailer\PHPMailerAutoload.php';
$mail = new PHPMailer(true);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the server
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "abhinav@ishahomeschool.org"; // GMAIL username
$mail->Password = "9733032655"; // GMAIL password

//Senders information
$email_from = "abhinav@ishahomeschool";
$name_from = "Abhinav Srivatsa";

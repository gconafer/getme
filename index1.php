<?php
function Send_Mail($to,$subject,$body)
{
require '/var/www/html/EdTech/vendor/PHPmailer/class.phpmailer.php';
$from = "prashant@ecoaching.guru";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host= "tls://email-smtp.us-west-2.amazonaws.com"; // Amazon SES
$mail->Port = 465;  // SMTP Port
$mail->Username = "AKIAJOYKO3E6TGPKPWCA";  // SMTP  Username
$mail->Password = "Ar53Fh15H9ts2wgtGh14/XEzv7xmSO73GvIEuU5uanLj";  // SMTP Password
$mail->SetFrom($from, 'Prashant');
$mail->AddReplyTo($from,'Technical Support');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
if(!$mail->Send())
return false;
else
return true;
}



$to = "pidge.1000@gmail.com";
$subject = "Test Mail Subject";
$body = "Hi
Email service is working
Amazon SES"; // HTML  tags
Send_Mail($to,$subject,$body);
?>
<?php
require_once(ABS_DIR."/vendor/PHPmailer/PHPMailerAutoload.php");

class Send_Email extends PHPMailer 
{
	
    public $SMTPAuth = true;
    public $Port     = 465;
    public $Mailer   = 'smtp';
    public $Username = 'AKIAJOYKO3E6TGPKPWCA';
    public $Host     = 'tls://email-smtp.us-west-2.amazonaws.com';
    public $Password = 'Ar53Fh15H9ts2wgtGh14/XEzv7xmSO73GvIEuU5uanLj';

}

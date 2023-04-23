<?php
ini_set('display_errors', 1);

// Mail class with a method to send email using PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once '../framework/Model.php';
require_once '../data/secret.php';
require_once '../plugins/PHPMailer/src/Exception.php';
require_once '../plugins/PHPMailer/src/PHPMailer.php';
require_once '../plugins/PHPMailer/src/SMTP.php';

class Mail extends Model
{

    public $senderName;
    public $senderEmail;
    public $password;

    public function __construct($senderName, $senderEmail, $password)
    {
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->password = $password;
    }

    public function sendMail($reciever, $subject, $body): void
    {
        $mail = new PHPMailer;

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                          //Enable verbose debug output
        $mail->isSMTP();                                                //Send using SMTP
        $mail->Host       = mailConfig::CONFIG['email']['host'];        //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
        $mail->Username   = $this->senderEmail;     //SMTP username
        $mail->Password   = $this->password;    //SMTP password
        $mail->SMTPSecure = mailConfig::CONFIG['email']['SMTPSecure'];  //Enable implicit TLS encryption
        $mail->Port       = mailConfig::CONFIG['email']['port'];        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


        $mail->setFrom($this->senderEmail, $this->senderName);
        $mail->addAddress($reciever);                                    // Add a recipient

        $mail->addReplyTo($this->senderEmail);

        $mail->isHTML(true);                                             // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;
        $mail->send();
    }
}

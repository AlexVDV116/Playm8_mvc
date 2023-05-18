<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;
use PHPMailer\PHPMailer\PHPMailer;
use Data\mailConfig;

// Mail class with a method to send email using PHPMailer

class Mail extends Model
{

    private string $senderName;
    private string $senderEmail;
    private string $password;

    public function __construct($senderName, $senderEmail, $password)
    {
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->password = $password;
    }

    public function sendMail($reciever, $subject, $body): void
    {
        $mail = new PHPMailer();

        //Server settings
        $mail->SMTPDebug = 0;                                           //Enable verbose debug output
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

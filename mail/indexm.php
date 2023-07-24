<?php
require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
 class Mailer
 {
    public function sendmail($title,$content,$addressMail)
    {
        $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $nFrom = "Bệnh nhân";
                    $mFrom = "phamnganis3004@gmail.com";
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP(); 
                    $mail-> CharSet = "utf-8";                                           //Send using SMTP
                    $mail->Host       = "ssl://smtp.gmail.com";                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = $mFrom;                     //SMTP username
                    $mail->Password   = 'jafhwjjgiuxlatss';                               //SMTP password
                    $mail->SMTPSecure = "SSL";  
                    $mail->Port = 465;
                                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom($mFrom,$nFrom); // B
                    $mail->addAddress($addressMail);     //Add a recipient
                   // $mail->addAddress('ellen@example.com');               //Name is optional
                   // $mail->addReplyTo('info@example.com', 'Information');
                    $mail->addCC('bichngan12a11@gmail.com');
                    //$mail->addBCC('bcc@example.com');

                    //Attachments
                   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $title;
                    $mail->Body    = $content;
                   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    $mail->send();
                    echo '<script>alert("Đã gởi email cho bệnh viện.")</script>';
                } catch (Exception $e) {
                    echo '<script>alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}")</script>';
                }
    }
 }

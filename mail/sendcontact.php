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
    function sendMail($title, $content, $nTo, $mTo,$diachicc=''){
        $nFrom = 'Bệnh nhân';
        $mFrom = 'phamnganis3004@gmail.com';  //dia chi email cua ban 
        $mPass = 'olmsnjprtyybrjcr';       //mat khau email cua ban
        $mail             = new PHPMailer();
        $body             = $content;
        $mail->IsSMTP(); 
        $mail->CharSet   = "utf-8";
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";        
        $mail->Port       = 465;
        $mail->Username   = $mFrom;  // GMAIL username
        $mail->Password   = $mPass;               // GMAIL password
        $mail->SetFrom($mFrom, $nFrom);
        //chuyen chuoi thanh mang
        $ccmail = explode(',', $diachicc);
        $ccmail = array_filter($ccmail);
        if(!empty($ccmail)){
            foreach ($ccmail as $k => $v) {
                $mail->AddCC($v);
            }
        }
        $mail->Subject    = $title;
        $mail->MsgHTML($body);
        $address = $mTo;
        $mail->AddAddress($address, $nTo);
       // $mail->AddReplyTo('info@freetuts.net', 'Freetuts.net');
        if(!$mail->Send()) {
            echo '<script>alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}")</script>';
          
        } else {
             echo '<script>alert("Đã gởi email cho bệnh viện.")</script>';
        }
    }
 }

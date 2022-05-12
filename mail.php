<?php
    $otp = rand(100000,999999);

    $receiver = "abhishah3102@gmail.com";
    $subject = "Email Test via PHP using Localhost";
    $body = "Hi, there...This is a test email send from Localhost. Your OTP is {$otp}";
    $sender = "From:techtreasuremag@gmail.com";
    if(mail($receiver, $subject, $body, $sender)){
        echo "Email sent successfully to $receiver";
    }else{
        echo "Sorry, failed while sending mail!";
    }
?>
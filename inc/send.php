<?php

class send{

    function email($to, $subject,$message,$options=[]){
        // $smtp =getinstance('smtp','lib');
        $mail =getinstance('PHPMailer','lib/mailer');

        $from       = $options['MAIL_FROM']?:MAIL_FROM;
        $from_name  = $options['MAIL_FROM_NAME']?:MAIL_FROM_NAME;
        $to_name    = $options['MAIL_TO_NAME']?:'';

        $mail->IsSMTP();    

        $mail->SMTPDebug    = 0;  // 0 = no output, 1 = errors and messages, 2 = messages only.
        $mail->SMTPAuth     = true;               
        $mail->SMTPSecure   = $options['SMTP_SECURE']?:SMTP_SECURE;              
        $mail->Host         = $options['SMTP_HOST']?: SMTP_HOST;        
        $mail->Port         = $options['SMTP_PORT']?:SMTP_PORT;                    
        $mail->Username     = $options['SMTP_USER']?:SMTP_USER;  
        $mail->Password     = $options['SMTP_USER']?:SMTP_USER;  

        $mail->CharSet      = 'utf8';
        $mail->SetFrom($from, $from_name);
        $mail->AddAddress ($to, $to_name); 
        // $mail->AddBCC ( 'sales@example.com', 'Example.com Sales Dep.');
        $mail->Subject      = $subject;
        $mail->ContentType  = 'text/html';
        $mail->IsHTML(true);

        $mail->Body = $message; 

        if(!$mail->Send()){
            $error_message = "Mailer Error: " . $mail->ErrorInfo;
            return 0;
        }
        else{ 
            $error_message = "Successfully sent!";
            return 1;
        }

    }


    
}

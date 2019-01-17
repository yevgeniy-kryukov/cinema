<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Utils 
{
    public static function sendEmail($email)
    {
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->SMTPDebug = 1;
            $mail->Host = 'ssl://smtp.mail.ru';
            $mail->SMTPAuth = true;
            $mail->Username = 'evgkrukov@mail.ru'; // логин от вашей почты
            $mail->Password = 'ABCD1234'; // пароль от почтового ящика
            $mail->SMTPSecure = 'SSL';
            $mail->Port = '465';
            $mail->CharSet = 'UTF-8';
            $mail->From = 'evgkrukov@mail.ru';  // адрес почты, с которой идет отправка
            $mail->FromName = 'Yevgeniy'; // имя отправителя

            $mail->addAddress($email, 'Dear customer');
        
            $mail->isHTML(true);
            
            $mail->Subject = "test email";
            $mail->Body = "This is the HTML message body <b>in bold!</b>";
            $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        
            $mail->SMTPDebug = 0;
        
            $mail->send();

            return 1;
        } catch(xception $e) {
            return 0;
        }
    }
}
?>
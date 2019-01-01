<?php 
namespace cinema\model;

use cinema\util\{DataBase, Main};
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Utils 
{
    //.
    public static function addShow($puserid, $pshowid, $porderid, $patickets, $pctickets, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, "SELECT shm1.utils_addshow($1, $2, $3, $4, $5) As res", array($puserid, $pshowid, $porderid, $patickets, $pctickets));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row["res"];
            if ($res > 0) Main::sessionData("orderID", $res);
        }
        return $res;
    }

    //.
    public static function changeQuantity($pitemid, $ptickettype, $pnewquantity)
    {
        $res = 0;
        $result = DataBase::dbQuery(null, "SELECT shm1.utils_changequantity($1, $2, $3) As res", array($pitemid, $ptickettype, $pnewquantity));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row["res"];
        }
        return $res;
    }

    //.
    public static function completeOrder($porderid, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, "SELECT shm1.utils_completeorder($1) As res", array($porderid));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row["res"];
        }
        return $res;
    }

    //.
    public static function sendEmail($email)
    {
/*         // Multiple recipients
        $to = 'evgkrukov@gmail.com'; // note the comma

        // Subject
        $subject = 'Birthday Reminders for August';

        // Message
        $message = '
        <html>
        <head>
        <title>Birthday Reminders for August</title>
        </head>
        <body>
        <p>Here are the birthdays upcoming in August!</p>
        <table>
            <tr>
            <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
            </tr>
            <tr>
            <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
            </tr>
            <tr>
            <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
            </tr>
        </table>
        </body>
        </html>
        ';

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        //$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
        $headers[] = 'To: Yevgeniy <evgkrukov@gmail.com>';
        $headers[] = 'From: Kryukov <evgkrukov@mail.ru>';
        //$headers[] = 'Cc: birthdayarchive@example.com';
        //$headers[] = 'Bcc: birthdaycheck@example.com';

        // Mail it
        return mail($to, $subject, $message, implode("\r\n", $headers)); */

        //return mail("evgkrukov@gmail.com", "My Subject", "Line 1\nLine 2\nLine 3");


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
            $mail->FromName = 'Евгений'; // имя отправителя

            $mail->addAddress($email, 'Dear customer');
        
            $mail->isHTML(true);
            
            $mail->Subject = "test email";
            $mail->Body = "This is the HTML message body <b>in bold!</b>";
            $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        
            $mail->SMTPDebug = 0;
        
        /*  if ($mail->send()) {
                $answer = '1';
            } else {
                $answer = '0';
                echo 'Письмо не может быть отправлено. ';
                echo 'Ошибка: ' . $mail->ErrorInfo;
            } */
            $mail->send();
            echo 'Message has been sent.';
            //return 1;
        } catch(Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo . ".";
            //return 0;
        }
    }
}
?>
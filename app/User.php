<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    public static function age($datetime, $full = false)
    {
        /* $diff = abs(strtotime(date("Y-m-d")) - strtotime($datetime));
        return $years = floor($diff / (365 * 60 * 60 * 24)); */
        $diff = date('Y') - date('Y', strtotime($datetime));
        return $diff - 1;
    }

    public static function age_ago($datetime, $full = false)
    {
        $diff = abs(strtotime(date("Y-m-d")) - strtotime($datetime));
        return $years = floor($diff / (365 * 60 * 60 * 24));
    }
public function subscription()
{
    return $this->hasOne(Subscription::class, 'user_id', 'id');
}

    public static function send_email($to, $subject, $message)
    {
        $mail = new \PHPMailer\PHPMailer\PHPMailer;
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'info@khorafiquran.org';
        $mail->Password = '$(Zy6@LFXJvM';
        $mail->setFrom('info@khorafiquran.org', 'khorafiquran');
        $mail->addReplyTo('info@khorafiquran.org', 'khorafiquran');
        $mail->addAddress($to, '');
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->Body = $message;
        //$mail->addAttachment('test.txt');
        if ($mail->send()) {
            return 1;
        }
    }
}

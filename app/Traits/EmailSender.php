<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 18.03.2017
 * Time: 15:02
 */

namespace App\Traits;


use PHPMailer;

trait EmailSender
{
    /** @var  PHPMailer */
    protected $mailer;

    /**
     * @param string $subject
     * @param string $body
     * @param array|string $to
     * @param array|string|null $cc
     * @param array|string|null $bcc
     * @return bool
     */
    protected function sendEmail(string $subject, string $body, $to, $cc = null, $bcc = null) {
        $this->mailer = $this->getPhpMailerInstance();

        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        if (gettype($to) == 'string') $this->mailer->addAddress($to);
        elseif(gettype($to) == 'array') {
            foreach ($to as $item) {
                $this->mailer->addAddress($item);
            }
        }

        if (!is_null($cc)) {
            if (gettype($cc) == 'string') $this->mailer->addCC($cc);
            elseif(gettype($cc) == 'array') {
                foreach ($cc as $item) {
                    $this->mailer->addCC($item);
                }
            }
        }

        if (!is_null($bcc)) {
            if (gettype($bcc) == 'string') $this->mailer->addBCC($bcc);
            elseif(gettype($bcc) == 'array') {
                foreach ($bcc as $item) {
                    $this->mailer->addBCC($item);
                }
            }
        }

        return $this->mailer->send();

    }

    /**
     * ВОзвращает ошибки майлера
     * @return null|string
     */
    protected function getErrors() {
        return !is($this->mailer) ? $this->mailer->ErrorInfo : null;
    }

    /**
     * Возвращает новый инстанс PHPMailer'а
     * @param bool $isHtml
     * @return PHPMailer
     */
    private function getPhpMailerInstance(bool $isHtml = true) {
        $mail = new PHPMailer;
        $login          = env('MAIL_USERNAME');
        $pass           = env('MAIL_PASSWORD');
        $host           = env('MAIL_HOST');
        $port           = env('MAIL_PORT');

        $from           = env('MAIL_FROM_NAME');
        $fromAddress    = env('MAIL_FROM_ADDRESS');
        $encrypt        = env('MAIL_ENCRYPTION');

        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $login;
        $mail->Password = $pass;
        $mail->SMTPSecure = $encrypt;
        $mail->Port = $port;
        $mail->setFrom($fromAddress, $from);
        $mail->isHTML($isHtml);
        $mail->CharSet = 'UTF-8';

        // $mail->SMTPDebug = 1;
        //$mail->Debugoutput = 'html';

        $mail->setLanguage('ru');

        return $mail;
    }
}
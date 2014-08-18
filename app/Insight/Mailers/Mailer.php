<?php namespace Insight\Mailers;
use Illuminate\Mail\Mailer as Mail;

/**
 * Insight Client Management Portal:
 * Date: 8/16/14
 * Time: 4:14 PM
 */

abstract class Mailer
{
    /**
     * @var Mail
     */
    private $mail;

    /**
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param $email
     * @param $subject
     * @param $view
     * @param array $data
     */
    public function sendTo($email, $subject, $view, $data = [])
    {
        $this->mail->queue($view, $data, function($message) use ($email, $subject)
        {
            $message->to($email)->subject($subject);
        });
    }
} 
<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Mail;

class MailHelper
{
    /**
    * Send email
    * 2021-03-12
    *
    * @param object
    *
    * @author
    * @return
    */
    public static function sendEmail($subject, $emailTo, $content, $emailCC = [], $linkAttach = '', $contentType = 'text/html') {
        Mail::send([], [], function ($message) use($subject, $emailTo, $content, $linkAttach, $emailCC, $contentType) {
            $message->from(env('MAIL_USERNAME', 'MacTree'))
                ->to($emailTo)
                ->cc($emailCC)
                ->subject($subject)
                ->setBody($content, $contentType) ;// for HTML rich messages
            if(!empty($linkAttach)) {
                $message->attach(\Swift_Attachment::fromPath($linkAttach));
            }
        });
    }
}

<?php

namespace QuataInvestimentos\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Storage;

class GeneralEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        /**
         * Validation
         */

        $template = (isset($this->data->template) && $this->data->template ? $this->data->template : null);
        $subject = (isset($this->data->subject) && $this->data->subject ? $this->data->subject : null);
        $body = (isset($this->data->body) && $this->data->body ? $this->data->body : null);
        $cc_array = (isset($this->data->cc) && $this->data->cc ? $this->data->cc : null);
        $bcc_array = (isset($this->data->bcc) && $this->data->bcc ? $this->data->bcc : null);
        $attachments = (isset($this->data->attachments) && $this->data->attachments ? $this->data->attachments : null);
        if($attachments && !is_array($attachments)){ $attachments = [$attachments]; }

        if(
            !$template || 
            !$subject || 
            !$body
        ){

            return false;

        }

        /**
         * Mail
         */

        $mail = (new MailMessage)
        ->markdown($template,[
            'subject' => $subject,
            'body' => $body
        ])
        ->subject('=?UTF-8?B?'.base64_encode($subject).'?=')
        ->from(env('MAIL_FROM_ADDRESS'), 'Tecnologia | Quatá Investimentos')
        ->replyTo(env('MAIL_FROM_ADDRESS'), 'Tecnologia | Quatá Investimentos');

        /**
         * Only send customer`s cc email
         * if in production
         */

         if(strtoupper(env('APP_ENV'))==='PRODUCTION' && $cc_array){
            foreach($cc_array as $cc):
                $cc = (object)$cc;

                if(isset($cc->email) && isset($cc->name)){
                    $mail->cc($cc->email, $cc->name);
                }
            endforeach;
        }

        /**
         * Only send customer`s bcc email
         * if in production
         */

        if(strtoupper(env('APP_ENV'))==='PRODUCTION' && $bcc_array){
            foreach($bcc_array as $bcc):
                $bcc = (object)$bcc;

                if(isset($bcc->email) && isset($bcc->name)){
                    $mail->bcc($bcc->email, $bcc->name);
                }
            endforeach;
        }

        /**
         * Send Attachments
         */

        if(isset($attachments) && $attachments) { 

            foreach($attachments as $attachment):
                if(Storage::disk('spaces')->exists($attachment)){
                    $mail->attachData(Storage::disk('spaces')->get($attachment), $attachment);
                }
            endforeach;

        }

        return $mail;

    }
}

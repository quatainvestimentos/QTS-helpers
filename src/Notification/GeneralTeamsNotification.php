<?php

namespace QuataInvestimentos\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

/**
 * Microsoft Teams Integration
 */

 use NotificationChannels\MicrosoftTeams\MicrosoftTeamsChannel;
 use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;

class GeneralTeamsNotification extends Notification
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
        return [MicrosoftTeamsChannel::class];
    }

    public function toMicrosoftTeams($notifiable)
    {
        /**
         * Validation
         */

        $subject = (isset($this->data->subject) && $this->data->subject ? $this->data->subject : null);
        $body = (isset($this->data->body) && $this->data->body ? $this->data->body : null);
        $attachments = (isset($this->data->attachments) && $this->data->attachments ? $this->data->attachments : null);
        if($attachments && !is_array($attachments)){ $attachments = [$attachments]; }

        if(!$subject || !$body ){ return false; }

        /**
         * Types
         * primary|secondary|accent|error|info|success|warning
         */

        $create_notification = MicrosoftTeamsMessage::create()
        ->to(config('services.teams.docs_url'))
        ->type('success')
        ->title($subject)
        ->addStartGroupToSection('data')
        ->activity('', 'Dado(s) disponível(is)', '', '', 'data');

        if(isset($body) && $body){

            foreach($body as $key => $value):
                $value = (is_array($value) || is_object($value) ? json_encode($value) : $value);
                $create_notification->fact($key, $value, 'data');
            endforeach;

        }

        if(isset($attachments) && $attachments){

            $create_notification->addStartGroupToSection('attachments')
            ->activity('', 'Anexo(s) disponível(is)', '', '', 'attachments');

            $count = 1;
            foreach($attachments as $attachment):
                
                if(Storage::disk('spaces')->exists($attachment)){
                    $create_notification->fact("Anexo #{$count}:", Storage::disk('spaces')->url($attachment), 'attachments');
                }

                $count++;

            endforeach;

        }

        return $create_notification;

    }

}

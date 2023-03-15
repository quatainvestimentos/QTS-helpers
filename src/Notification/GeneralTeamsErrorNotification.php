<?php

namespace QuataInvestimentos\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Microsoft Teams Integration
 */

use NotificationChannels\MicrosoftTeams\MicrosoftTeamsChannel;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;

class GeneralTeamsErrorNotification extends Notification
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
         * Types
         * primary|secondary|accent|error|info|success|warning
         */

        $create_notification = MicrosoftTeamsMessage::create()
        ->to(config('services.teams.errors_url'))
        ->type('error')
        ->title('Erro genérico em ' . $this->data['file']);

        if(isset($this->data['exception']) && $this->data['exception']){
            $create_notification->content($this->data['exception']);
        }

        if(isset($this->data['content']) && $this->data['content']){
            $create_notification->content($this->data['content']);
        }

        foreach($this->data['details'] as $key => $value):
            $create_notification->fact(ucfirst($key), (isset($value) && $value ? $value : 'Não informado'));
        endforeach;

        return $create_notification;

    }

}

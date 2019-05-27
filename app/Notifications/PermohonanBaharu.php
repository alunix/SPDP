<?php

namespace SPDP\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PermohonanBaharu extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($permohonan,$penilai)
    {
        $this->permohonan= $permohonan;
        $this->penilai= $penilai;
    
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
        return (new MailMessage)
                    ->greeting('Salam sejahtera ' . $this->penilai->name)
                    ->line('Anda telah menerima permohonan baharu')
                    ->line('Jenis permohonan: '. $this->permohonan->jenis_permohonan->jenis_permohonan_huraian)
                    ->action('Lihat permohonan baharu', route('view-permohonan-baharu',$this->permohonan->permohonan_id))
                    ->line('Terima kasih');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Salam sejahtera ' . $this->penilai->name)
                    ->line('Anda telah menerima permohonan baharu')
                    ->line('Jenis permohonan: '. $this->permohonan->jenis_permohonan->jenis_permohonan_huraian)
                    ->action('Lihat permohonan baharu', route('view-permohonan-baharu',$this->permohonan->permohonan_id))
                    ->line('Terima kasih');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

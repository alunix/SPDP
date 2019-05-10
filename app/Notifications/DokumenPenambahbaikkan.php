<?php

namespace SPDP\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DokumenPenambahbaikkan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dp)
    {
        $this->dp=$dp;
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
        ->greeting('Salam sejahtera ')
        ->line('Dokumen permohonan id: '. $this->dp->dokumen_permohonan_id)
        ->line('Versi :'. $this->dp->versi)
        ->line('Jenis permohonan: '. $this->dp->permohonan->jenis_permohonan_huraian)
        ->action('Sila tekan sini', route('view-permohonan-baharu',$this->dp->permohonan_id))
        ->line('Terima kasih');
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

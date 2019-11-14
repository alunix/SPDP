<?php

namespace SPDP\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LaporanDikeluarkan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($permohonan,$pjk,$panel)
    {
        $this->permohonan= $permohonan;
        $this->pjk=$pjk;
        $this->panel = $panel;
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
        ->greeting('Salam sejahtera ' . $this->pjk->name)
        ->line('Permohonan Id: '.$this->permohonan->permohonan_id)
        ->line('Laporan telah dikeluarkan oleh '.$this->panel->name.' (User ID '.$this->panel->id.')')        
        ->line('Jenis permohonan: '. $this->permohonan->jenis_permohonan->huraian)
        ->action('Lihat laporan', route('fakulti.kemajuanPermohonan',$this->permohonan->permohonan_id))
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

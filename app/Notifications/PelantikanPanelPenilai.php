<?php

namespace SPDP\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PelantikanPanelPenilai extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($permohonan, $penilaian, $penilai)
    {
        $this->permohonan = $permohonan;
        $this->penilaian = $penilaian;
        $this->penilai = $penilai;
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
            ->line('Anda telah dilantik untuk menilai permohonan ini')
            ->line('Jenis permohonan: ' . $this->permohonan->jenis_permohonan->huraian)
            ->line('Sila keluarkan laporan sebelum tarikh ' . $this->penilaian->tarikhAkhir)
            ->action('Lihat permohonan baharu', route('view-permohonan-baharu', $this->permohonan->id))
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

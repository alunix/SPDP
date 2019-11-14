<?php

namespace SPDP\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PerluPenambahbaikkan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($permohonan,$penghantar)
    {
        $this->permohonan=$permohonan;
        $this->penghantar=$penghantar;
    }


    public function pihakMeluluskan()
    {
        $role = auth()->user()->role;
        switch ($role) {
          
            case 'pjk':
                    return 'Pusat Jaminan Kualiti';
                break; 
            case 'senat':
                return 'Senat';
            break; 
            case 'penilai':
                    return 'Panel penilai';
                break; 
            case 'jppa':
                    return 'Jawatankuasa Perancangan dan Perkembangan Akademik (JPPA)';
                break; 
            default:
                    return (''); 
                break;
        }
        
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
        ->greeting('Salam sejahtera ' . $this->penghantar->name)
        ->line('Permohonan ID: '. $this->permohonan->permohonan_id)
        ->line('Jenis permohonan: '. $this->permohonan->jenis_permohonan->huraian)
        ->line('Permohonan anda perlu penambahbaikkan oleh '.$this->pihakMeluluskan())
        ->line('Laporan telah dikeluarkan')
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

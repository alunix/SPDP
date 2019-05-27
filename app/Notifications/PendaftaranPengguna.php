<?php

namespace SPDP\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PendaftaranPengguna extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->user= $user;
        $this->password=$password;
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
         ->greeting('Salam sejahtera ' . $this->user->name)
        ->line('Anda telah didaftarkan sebagai pengguna sistem Persona')
        ->line('Jenis pengguna: '. $this->user->role)
        ->line('Sila log masuk sistem dan tukar kata laluan baharu')
        ->action('Tekan sini', route('home'))
        ->line('Kata laluan: '. $this->password)
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

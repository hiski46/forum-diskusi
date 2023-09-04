<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordEmail extends Notification
{
    use Queueable;

    public $user;
    public $new_pass;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $new_pass)
    {
        $this->user = $user;
        $this->new_pass = $new_pass;
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
            ->from('diskusiforum0@gmail.com', 'Forum Diskusi')
            ->subject('Password Baru')
            ->greeting('Hallo ' . $this->user->name . ' !')
            ->line('Ini adalah password baru anda. Silahkan kembali login menggunakan password ini.')
            // ->action($this->new_pass, url('/'))
            ->line($this->new_pass)
            ->line('Terima Kasih :)');
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

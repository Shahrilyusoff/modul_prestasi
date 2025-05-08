<?php

// app/Notifications/PenilaianNotifikasi.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PenilaianNotifikasi extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notifikasi Sistem Penilaian Prestasi')
            ->line($this->message)
            ->action('Lihat Penilaian', url('/penilaian'))
            ->line('Terima kasih kerana menggunakan sistem kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => '/penilaian',
        ];
    }
}

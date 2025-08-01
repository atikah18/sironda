<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAssigned extends Notification
{
    protected $task;
    protected $daterange;

    public function __construct($task, $daterange)
    {
        $this->task = $task;
        $this->daterange = $daterange;
    }

    public function via($notifiable)
    {
        return ['mail']; // only email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tugas Baru Telah Diberikan')
            ->greeting('Hai ' . $notifiable->name . ',')
            ->line('Kamu telah diberi tugas baru oleh sistem.')
            ->line('Tanggal tugas: ' . $this->daterange)
            ->line('Jenis tugas: ' . $this->task->type)
            ->line('Silakan login untuk melihat detailnya.')
            ->action('Lihat Jadwal', url('/penjadwalan'))
            ->line('Terima kasih.');
    }


}

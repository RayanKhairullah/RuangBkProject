<?php

namespace App\Notifications;

use App\Models\JadwalKonseling;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JadwalKonselingDibuat extends Notification
{
    use Queueable;

    public function __construct(public JadwalKonseling $jadwal) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Jadwal Konseling Baru Diajukan')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Anda telah menerima jadwal konseling baru dari siswa.')
            ->line('Topik: ' . $this->jadwal->topik_dibahas)
            ->line('Tanggal: ' . $this->jadwal->tanggal)
            ->action('Lihat Jadwal', route('teacher.jadwal-konselings.show', $this->jadwal));
    }
}

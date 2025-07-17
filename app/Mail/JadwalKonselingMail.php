<?php

namespace App\Mail;

use App\Models\JadwalKonseling;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JadwalKonselingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jadwal;

    public function __construct(JadwalKonseling $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function build()
    {
        return $this->subject('Permintaan Jadwal Konseling dari Siswa')
            ->markdown('emails.jadwal-konseling');
    }
}
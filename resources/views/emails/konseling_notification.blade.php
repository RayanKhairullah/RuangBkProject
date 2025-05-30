{{-- filepath: d:\xampp\htdocs\RuangBk\resources\views\emails\konseling_notification.blade.php --}}
@component('mail::message')
# Jadwal Konseling

Halo **{{ $jadwal->penerima->name }}**,

Berikut adalah detail jadwal konseling Anda:

- **Nama Pengirim:** {{ $jadwal->pengirim->name }}
- **Email Pengirim:** {{ $jadwal->pengirim->email }}
- **Lokasi:** {{ $jadwal->lokasi }}
- **Tanggal:** {{ $jadwal->tanggal }}
- **Topik Dibahas:** {{ $jadwal->topik_dibahas }}

Terima kasih telah menggunakan layanan kami.

{{-- Tambah tombol Accept/Reject --}}
@component('mail::button', ['url' => route('penjadwalan.accept_and_calendar', $jadwal->id)])
Accept
@endcomponent

@component('mail::button', ['url' => route('penjadwalan.reject', $jadwal->id)])
Reject
@endcomponent

Salam,<br>
{{ config('app.name') }}
@endcomponent
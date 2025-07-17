@component('mail::message')
# Jadwal Konseling

Halo **{{ $jadwal->penerima->name }}**,  
Berikut detail jadwal konseling dari siswa:

- Pengirim: **{{ $jadwal->pengirim->name }}**
- Lokasi: **{{ $jadwal->lokasi }}**
- Tanggal: **{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y H:i') }}**
- Topik: **{{ $jadwal->topik_dibahas }}**

@component('mail::button', ['url' => route('teacher.jadwal-konselings.accept_and_calendar', $jadwal->id)])
Setujui & Tambahkan ke Google Calendar
@endcomponent

@component('mail::button', ['url' => route('teacher.jadwal-konselings.reject', $jadwal->id)])
Tolak Jadwal
@endcomponent

@endcomponent

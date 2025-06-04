<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Room;
use App\Models\Biodata;
use App\Models\PenjadwalanKonseling;
use App\Models\Catatan;
use App\Models\SuratPanggilan;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create('id_ID'); // Inisialisasi Faker dengan locale Indonesia
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Opsional: Hapus data yang ada jika ingin fresh start. Komentari jika ingin mempertahankan data
        // Schema::disableForeignKeyConstraints();
        // Jurusan::truncate();
        // Room::truncate();
        // User::truncate();
        // Biodata::truncate();
        // PenjadwalanKonseling::truncate();
        // Catatan::truncate();
        // Schema::enableForeignKeyConstraints();

        // 1. Create Jurusans with specific names
        $jurusanNames = [
            'Pengembangan Perangkat Lunak dan Gim',
            'Desain Komunikasi Visual',
            'Teknik Jaringan Komputer dan Telekomunikasi',
            'Manajemen Perkantoran dan Layanan Bisnis',
            'Pemasaran',
            'Animasi',
            'Unit Layanan Pengadaan',
        ];

        foreach ($jurusanNames as $name) {
            Jurusan::firstOrCreate(['nama_jurusan' => $name]);
        }
        $jurusans = Jurusan::all(); // Ambil semua jurusan yang sudah ada atau baru dibuat

        // 2. Create Rooms: satu jurusan memiliki tiga tingkatan kelas (X, XI, XII) dengan angkatan yang berbeda
        $tingkatans = ['X', 'XI', 'XII'];
        $baseStartYear = 2021; // Angkatan awal untuk contoh

        foreach ($jurusans as $jurusan) {
            foreach ($tingkatans as $index => $tingkatan) {
                $angkatan = $baseStartYear + $index; // X: 2021, XI: 2022, XII: 2023
                $tahunAjaranMulai = "{$angkatan}-07-01"; // Contoh: dimulai Juli di tahun angkatan
                $tahunAjaranBerakhir = ($angkatan + 2) . '-06-30'; // Berakhir 3 tahun kemudian

                // Pastikan kode_rooms unik secara global
                $kodeRooms = $this->generateUniqueKodeRoom();

                // Buat Room hanya jika kombinasi jurusan, tingkatan, angkatan belum ada
                $existingRoom = Room::where('jurusan_id', $jurusan->id)
                                    ->where('tingkatan_rooms', $tingkatan)
                                    ->where('angkatan_rooms', $angkatan)
                                    ->first();

                if (!$existingRoom) {
                    Room::factory()->create([
                        'jurusan_id' => $jurusan->id,
                        'kode_rooms' => $kodeRooms, // Kode unik untuk setiap room
                        'tingkatan_rooms' => $tingkatan,
                        'angkatan_rooms' => $angkatan,
                        'tahun_ajaran_mulai' => $tahunAjaranMulai,
                        'tahun_ajaran_berakhir' => $tahunAjaranBerakhir,
                    ]);
                }
            }
        }
        $rooms = Room::all(); // Ambil semua room yang sudah ada atau baru dibuat

        // 3. Create specific Teacher and Student users if they don't exist
        if (!User::where('email', 'guru@example.com')->exists()) {
            User::factory()->teacher()->create([
                'name' => 'Guru BK',
                'email' => 'guru@example.com',
                'password' => Hash::make('password'),
                'kode_rooms' => 'TCHR' // Fixed code for teacher
            ]);
        }

        if (!User::where('email', 'siswa@example.com')->exists()) {
            $studentRoom = $rooms->random(); // Get a random room from existing rooms
            User::factory()->create([
                'name' => 'Siswa Contoh',
                'email' => 'siswa@example.com',
                'password' => Hash::make('password'),
                'kode_rooms' => $studentRoom->kode_rooms,
            ]);
        }

        // 4. Create more general users (some teachers, some students)
        $desiredTeachers = 6; // Guru BK + 5 lainnya
        $currentTeachers = User::where('role', UserRole::Teacher)->count();
        if ($currentTeachers < $desiredTeachers) {
             User::factory()->count($desiredTeachers - $currentTeachers)->teacher()->create();
        }

        $desiredStudents = 21; // Siswa Contoh + 20 lainnya
        $currentStudents = User::where('role', UserRole::User)->count();
        if ($currentStudents < $desiredStudents) {
            // Pastikan siswa baru mendapatkan kode_rooms yang valid dari rooms yang sudah ada
            User::factory()->count($desiredStudents - $currentStudents)->sequence(fn ($sequence) => [
                'kode_rooms' => $rooms->random()->kode_rooms,
            ])->create();
        }

        // 5. Create Biodatas for all student users
        $studentUsers = User::where('role', UserRole::User)->get();
        foreach ($studentUsers as $user) {
            if (!$user->biodata) {
                $room = Room::where('kode_rooms', $user->kode_rooms)->first();
                if (!$room) { // Fallback if user's room somehow doesn't exist
                    $room = Room::factory()->create(); // Create a new room as fallback
                    $user->update(['kode_rooms' => $room->kode_rooms]);
                }

                Biodata::factory()->create([
                    'user_id' => $user->id,
                    'nama_siswa' => $user->name,
                    'jurusan_id' => $room->jurusan_id,
                    'room_id' => $room->id,
                    'nisn' => $this->generateUniqueNisn(),
                    'telepon' => $this->generatePhoneNumber(),
                    'no_hp_ayah' => $this->generatePhoneNumber(),
                    'no_hp_ibu' => $this->generatePhoneNumber(),
                ]);
            }
        }

        // 6. Create Penjadwalan Konselings (Siswa sebagai pengirim, Guru sebagai penerima)
        $desiredKonselings = 15;
        $currentKonselings = PenjadwalanKonseling::count();
        if ($currentKonselings < $desiredKonselings) {
            PenjadwalanKonseling::factory()->count($desiredKonselings - $currentKonselings)->create();
        }

        // 7. Create Catatans
        $desiredCatatans = 25;
        $currentCatatans = Catatan::count();
        if ($currentCatatans < $desiredCatatans) {
            Catatan::factory()->count($desiredCatatans - $currentCatatans)->create();
        }

        // 8. Create Surat Panggilans
        $desiredSuratPanggilans = 10; // Jumlah surat panggilan yang Anda inginkan
        $currentSuratPanggilans = SuratPanggilan::count();
        if ($currentSuratPanggilans < $desiredSuratPanggilans) {
            SuratPanggilan::factory()->count($desiredSuratPanggilans - $currentSuratPanggilans)->create();
        }
    }

    /**
     * Helper method to generate unique NISN.
     */
    private function generateUniqueNisn(): string
    {
        do {
            $nisn = $this->faker->numerify('############'); // 12 digits
        } while (Biodata::where('nisn', $nisn)->exists());
        return $nisn;
    }

    /**
     * Helper method to generate unique kode_rooms.
     */
    private function generateUniqueKodeRoom(): string
    {
        do {
            $kode = Str::upper(Str::random(4));
        } while (Room::where('kode_rooms', $kode)->exists());
        return $kode;
    }

    /**
     * Helper method to generate phone numbers matching the regex ^08[0-9]{8,12}$.
     */
    private function generatePhoneNumber(): string
    {
        $length = $this->faker->numberBetween(8, 12); // Between 8 to 12 digits after '08'
        return '08' . $this->faker->numerify(str_repeat('#', $length));
    }
}
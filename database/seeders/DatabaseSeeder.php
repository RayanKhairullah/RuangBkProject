<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Room;
use App\Models\Biodata;
use App\Models\RiwayatPendidikan;
use App\Models\JadwalKonseling;
use App\Models\Catatan;
use App\Models\SuratPanggilan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jurusan
        $jurusans = Jurusan::factory(5)->create();

        // Room
        $rooms = Room::factory(10)->create([
            'jurusan_id' => $jurusans->random()->id,
        ]);

        // Biodata
        $biodatas = Biodata::factory(10)->create([
            'jurusan_id' => $jurusans->random()->id,
            'room_id' => $rooms->random()->id,
        ]);

        foreach ($biodatas as $biodata) {
            $levels = collect(['SD', 'SMP', 'SMA'])->shuffle()->take(2); // ambil 2 tingkat unik acak
            foreach ($levels as $tingkat) {
                RiwayatPendidikan::factory()->create([
                    'biodata_id' => $biodata->id,
                    'tingkat' => $tingkat,
                ]);
            }
        }

        // Jadwal Konseling
        JadwalKonseling::factory(5)->create();

        // Catatan
        Catatan::factory(5)->create();

        // Surat Panggilan
        SuratPanggilan::factory(5)->create();

        // User::factory(10)->create();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }
}

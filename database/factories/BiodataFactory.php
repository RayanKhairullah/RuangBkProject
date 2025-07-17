<?php

namespace Database\Factories;

use App\Models\Jurusan;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biodata>
 */
class BiodataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'jurusan_id' => Jurusan::factory(),
            'room_id' => Room::factory(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-15 years'),
            'telepon' => $this->faker->numerify('08##########'),
            'agama' => $this->faker->randomElement(['Islam','Kristen','Hindu','Budha','Lainnya']),
            'alamat_ktp' => $this->faker->address(),
            'alamat_domisili' => $this->faker->optional()->address(),
            'cita_cita' => $this->faker->optional()->jobTitle(),
            'hobi' => $this->faker->optional()->word(),
            'minat_bakat' => $this->faker->optional()->sentence(),
            'nama_ayah' => $this->faker->optional()->name('male'),
            'pekerjaan_ayah' => $this->faker->optional()->jobTitle(),
            'no_hp_ayah' => $this->faker->optional()->numerify('08##########'),
            'nama_ibu' => $this->faker->optional()->name('female'),
            'pekerjaan_ibu' => $this->faker->optional()->jobTitle(),
            'no_hp_ibu' => $this->faker->optional()->numerify('08##########'),
            'gol_darah' => $this->faker->optional()->randomElement(['A','B','AB','O']),
            'status' => $this->faker->optional()->randomElement(['Aktif', 'Tidak Aktif']),
            'image' => $this->faker->optional()->imageUrl(300, 300, 'people'),
        ];
    }
}

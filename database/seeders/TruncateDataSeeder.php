<?php

/* delete this comment if you want to use this seeder
 * This seeder is used to truncate all dummy data in the database.
 * It is useful for resetting the database to a clean state.
 * 
 * To use this seeder, run the following command:
 * php artisan db:seed --class=TruncateDataSeeder

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Biodata;
use App\Models\Catatan;
use App\Models\PenjadwalanKonseling;
use App\Models\Room;
use App\Models\Jurusan;

class TruncateDataSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Biodata::truncate();
        Catatan::truncate();
        PenjadwalanKonseling::truncate();
        User::truncate();
        Room::truncate();
        Jurusan::truncate();

        Schema::enableForeignKeyConstraints();

        $this->command->info('All dummy data truncated successfully!');
    }
}

*/
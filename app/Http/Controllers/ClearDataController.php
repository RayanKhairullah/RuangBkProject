<?php
/* Delete this file if you are not using it anymore. 
 * This file is used to clear all data from the database tables.
 * It is not recommended to use this in production environments.
 * Use with caution, as it will delete all data from the specified tables.

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Catatan;
use App\Models\Room;
use App\Models\Jurusan; // Jika ada model Jurusan
use App\Models\PenjadwalanKonseling; // Jika ada model PenjadwalanKonseling
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; // Penting untuk Schema
use Illuminate\Support\Facades\DB; // Penting untuk DB

class ClearDataController extends Controller
{
    public function clearAllData()
    {
        // Menonaktifkan pemeriksaan foreign key untuk sementara
        // Ini penting jika tabel Anda memiliki foreign key yang saling terkait
        Schema::disableForeignKeyConstraints();

        // Urutan truncate penting jika ada foreign key antar tabel
        // Hapus tabel anak terlebih dahulu, lalu tabel induk
        Biodata::truncate();
        Catatan::truncate();
        PenjadwalanKonseling::truncate(); // Jika ada model ini
        User::truncate(); // User sering jadi tabel induk bagi banyak tabel lain
        Room::truncate(); // Jika room tidak punya fk yang mengacu padanya dari tabel di atas
        Jurusan::truncate(); // Jika jurusan tidak punya fk yang mengacu padanya dari tabel di atas


        // Mengaktifkan kembali pemeriksaan foreign key
        Schema::enableForeignKeyConstraints();

        return "Semua data berhasil dihapus dari tabel Users, Biodatas, Catatans, Penjadwalan Konseling, Rooms, dan Jurusans.";
    }

    public function clearSpecificTable(Request $request)
    {
        $tableName = $request->input('table_name'); // Ambil nama tabel dari request

        // Pastikan nama tabel adalah valid dan aman untuk dihapus
        $allowedTables = ['users', 'biodatas', 'catatans', 'rooms', 'jurusans', 'penjadwalan_konselings'];
        if (!in_array($tableName, $allowedTables)) {
            return response()->json(['error' => 'Nama tabel tidak valid.'], 400);
        }

        // Hapus data berdasarkan nama tabel
        Schema::disableForeignKeyConstraints();
        DB::table($tableName)->truncate(); // Menggunakan DB facade untuk truncate
        Schema::enableForeignKeyConstraints();

        return response()->json(['message' => "Semua data dari tabel '{$tableName}' berhasil dihapus."], 200);
    }
    public function clearAllDataDeleteMethod()
    {
        // Hapus tabel anak terlebih dahulu untuk menghindari masalah foreign key
        Biodata::query()->delete();
        Catatan::query()->delete();
        PenjadwalanKonseling::query()->delete();

        // Baru hapus tabel induk
        User::query()->delete();
        Room::query()->delete();
        Jurusan::query()->delete();

        return "Semua data berhasil dihapus menggunakan metode delete(). Auto-increment ID tidak direset.";
    }
}
    
*/
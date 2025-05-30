<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratPanggilan;
use App\Models\Catatan;
use App\Models\PenjadwalanKonseling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Jika role adalah teacher
        if ($user->role->value === 'teacher') {
            // Data untuk teacher
            $totalUsers = User::where('role', 'user')->count();
            $totalTeachers = User::where('role', 'teacher')->count();

            $suratPanggilanData = SuratPanggilan::select(
                DB::raw('MONTH(tanggal_waktu) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => $item->count];
            });

            $labels = [];
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = date('F', mktime(0, 0, 0, $i, 1));
                $data[] = $suratPanggilanData[$i] ?? 0;
            }

            return view('dashboard.teacher', [
                'totalUsers' => $totalUsers,
                'totalTeachers' => $totalTeachers,
                'suratPanggilanData' => [
                    'labels' => $labels,
                    'data' => $data,
                ],
            ]);
        }

        // Query dasar catatan user
        $query = Catatan::with(['room.jurusan', 'guru'])
            ->where('user_id', $user->id);

        // Jika ada parameter pencarian, filter berdasarkan kolom 'kasus'
        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('kasus', 'like', "%{$search}%")
                ->orWhere('catatan_guru', 'like', "%{$search}%");
            });
        }

        $catatans = $query
            ->orderBy('tanggal', 'desc')
            ->paginate(5)
            ->withQueryString();  // pertahankan ?search di pagination

        $konselings = PenjadwalanKonseling::with(['pengirim', 'penerima'])
            ->where('pengirim_id', $user->id)
            ->orWhere('penerima_id', $user->id)
            ->orderByDesc('tanggal')
            ->paginate(5);

        return view('dashboard.user', [
            'user'     => $user,
            'catatans' => $catatans,
            'konselings' => $konselings,
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratPanggilan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Jika role adalah teacher
        if ($user->role->value === 'teacher') {
            // Data untuk teacher
            $totalUsers = User::where('role', 'user')->count();
            $totalTeachers = User::where('role', 'teacher')->count();

            $suratPanggilanData = SuratPanggilan::select(
                DB::raw('MONTH(tanggal) as month'),
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

        // Jika role adalah user
        return view('dashboard.user', [
            'user' => $user,
        ]);
    }
}
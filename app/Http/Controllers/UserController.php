<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\BiodataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        // Daftar filter yang diperbolehkan
        $allowedFilters = [
            'name'      => fn($query, $value) => $query->where('name', 'like', "%{$value}%"),
            'verified'  => fn($query, $value) => $value === '1'
                ? $query->whereNotNull('email_verified_at')
                : $query->whereNull('email_verified_at'),
            'biodata'   => fn($query, $value) => $value === '1'
                ? $query->whereHas('biodata')
                : $query->doesntHave('biodata'),
            // Tambahkan filter baru di sini, misal 'email', 'created_at', dsb.
        ];

        // Mulai query dasar
        $query = User::where('role', UserRole::User->value);

        // Iterasi request query dan apply filter jika ada di allowedFilters
        foreach ($request->only(array_keys($allowedFilters)) as $filter => $value) {
            if ($value !== null && $value !== '') {
                $query = $allowedFilters[$filter]($query, $value);
            }
        }

        // Urut dan paginate
        $users = $query->orderBy('name')
                    ->paginate(10)
                    ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function showBiodata(User $user)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $biodata = $user->biodata;

        if (!$biodata) {
            return redirect()->route('users.index')->with('error', 'Biodata tidak ditemukan.');
        }

        return view('users.biodata', compact('biodata', 'user'));
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    public function downloadBiodata(User $user)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        if (! $user->biodata) {
            return back()->withError('Biodata tidak ditemukan.');
        }

        $fileName = 'biodata_' . str()->slug($user->name) . '.xlsx';
        return Excel::download(new BiodataExport($user), $fileName);
    }
}
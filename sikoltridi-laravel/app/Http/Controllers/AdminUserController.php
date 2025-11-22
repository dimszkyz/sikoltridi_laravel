<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PengajuanAkun; // Asumsi model pengajuan terpisah atau pakai User dengan status
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Ambil user yang belum aktif (pending) dan yang sudah aktif
        // Sesuaikan logika ini dengan database Anda. 
        // Jika pakai tabel User dengan kolom 'status':
        $pendingUsers = User::where('status', 'pending')->get();
        $activeUsers = User::where('status', 'active')->where('level', '!=', 'superadmin')->get();

        return view('admin.users.index', compact('pendingUsers', 'activeUsers'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active'; // Ubah status jadi aktif
        $user->save();

        return back()->with('success', 'Akun berhasil disetujui!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'User berhasil dihapus.');
    }
}
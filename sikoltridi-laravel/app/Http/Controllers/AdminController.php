<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DokumenFile;
use App\Models\Planning;
use App\Models\Organizing;
use App\Models\Video;
use App\Models\ActuatingFoto;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data (RAW) untuk keperluan Grafik Chart.js
        // Data ini akan dikirim ke View dan diubah jadi JSON (@json)
        $filesData = DokumenFile::all();
        $planningData = Planning::all();
        $organizingData = Organizing::all();
        $videoData = Video::all();
        $fotoData = ActuatingFoto::all();

        // 2. Ambil Data User untuk Tabel (Khusus Superadmin)
        $users = User::all();

        // 3. Hitung Total untuk Widget Statistik (Kartu-kartu di atas grafik)
        $totalFiles = $filesData->count();
        $totalPlanning = $planningData->count();
        $totalOrganizing = $organizingData->count();
        $totalVideo = $videoData->count();
        $totalFoto = $fotoData->count();
        $totalUsers = $users->count();

        // Kirim semua variabel ke View 'admin.dashboard'
        return view('admin.dashboard', compact(
            'filesData', 
            'planningData', 
            'organizingData', 
            'videoData', 
            'fotoData',
            'users',
            'totalFiles',
            'totalPlanning',
            'totalOrganizing',
            'totalVideo',
            'totalFoto',
            'totalUsers'
        ));
    }
}
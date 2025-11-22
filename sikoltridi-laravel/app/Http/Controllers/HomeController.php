<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenFile;
use App\Models\Planning;
use App\Models\Organizing;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data untuk ditampilkan di Landing Page
        // Ini menggantikan fetch API di masing-masing komponen React (PartFile, PartPlanning, dll)
        
        $files = DokumenFile::latest()->get();
        $plannings = Planning::latest()->get();
        $organizings = Organizing::latest()->get();
        $videos = Video::latest()->get();

        return view('home', compact('files', 'plannings', 'organizings', 'videos'));
    }
}
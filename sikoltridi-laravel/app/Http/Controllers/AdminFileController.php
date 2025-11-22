<?php
namespace App\Http\Controllers;

use App\Models\DokumenFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFileController extends Controller
{
    public function index()
    {
        $files = DokumenFile::latest()->get();
        return view('admin.files.index', compact('files'));
    }

    public function create()
    {
        return view('admin.files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|mimes:pdf|max:10240', // 10MB
            'image_file' => 'nullable|image|max:5120',
        ]);

        // Upload PDF
        $pdfName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->move(public_path('uploads/files'), $pdfName);

        // Upload Image (Jika ada)
        $imageName = null;
        if ($request->hasFile('image_file')) {
            $imageName = time() . '_' . $request->file('image_file')->getClientOriginalName();
            $request->file('image_file')->move(public_path('uploads/images'), $imageName);
        }

        DokumenFile::create([
            'title' => $request->title,
            'pdf_file' => $pdfName,
            'image_file' => $imageName,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('admin.files.index')->with('success', 'File berhasil diunggah.');
    }

    public function destroy($id)
    {
        $file = DokumenFile::findOrFail($id);
        
        // Hapus fisik file
        if (file_exists(public_path('uploads/files/' . $file->pdf_file))) {
            unlink(public_path('uploads/files/' . $file->pdf_file));
        }
        if ($file->image_file && file_exists(public_path('uploads/images/' . $file->image_file))) {
            unlink(public_path('uploads/images/' . $file->image_file));
        }

        $file->delete();
        return back()->with('success', 'File berhasil dihapus.');
    }
}
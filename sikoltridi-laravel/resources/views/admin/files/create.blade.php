@extends('layouts.main')

@section('content')
<div class="flex h-screen bg-gray-100">
    @include('components.sidebar-admin')

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow p-4">
            <h1 class="text-2xl font-bold text-gray-800">Upload File Baru</h1>
        </header>

        <main class="p-6">
            <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
                <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
                        <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">File PDF</label>
                        <input type="file" name="pdf_file" accept="application/pdf" required class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Format PDF, Maks 10MB.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cover Image (Opsional)</label>
                        <input type="file" name="image_file" accept="image/*" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Untuk thumbnail di halaman depan.</p>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('admin.files.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Upload</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
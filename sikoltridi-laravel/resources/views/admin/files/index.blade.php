@extends('layouts.main')

@section('content')
<div class="flex h-screen bg-gray-100">
    @include('components.sidebar-admin')

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen File</h1>
            <a href="{{ route('admin.files.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah File
            </a>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($files as $file)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                    <div class="h-40 bg-gray-200 rounded mb-4 overflow-hidden flex items-center justify-center">
                        @if($file->image_file)
                            <img src="{{ asset('uploads/images/' . $file->image_file) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400">No Preview</span>
                        @endif
                    </div>
                    <h3 class="font-bold text-lg mb-2">{{ $file->title }}</h3>
                    <div class="mt-auto flex justify-between items-center pt-4 border-t">
                        <a href="{{ asset('uploads/files/' . $file->pdf_file) }}" target="_blank" class="text-blue-600 hover:underline text-sm">Lihat PDF</a>
                        <form action="{{ route('admin.files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Hapus file ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</div>
@endsection
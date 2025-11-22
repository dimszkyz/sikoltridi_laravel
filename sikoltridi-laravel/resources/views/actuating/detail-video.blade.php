@extends('layouts.main')

@section('content')
@include('components.navbar')

<div class="bg-gray-50 min-h-screen pt-24 py-10 px-4 sm:px-6 lg:px-8 pb-28">
    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="bg-black rounded-xl shadow-lg overflow-hidden">
            <video class="w-full aspect-video" controls poster="{{ $video->thumbnail ? asset('uploads/video/thumb/' . $video->thumbnail) : '' }}">
                <source src="{{ asset('uploads/video/' . $video->media) }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2">{{ $video->judul }}</h1>
            <div class="flex items-center text-gray-500 text-sm mb-3">
                <span>Diupload pada {{ \Carbon\Carbon::parse($video->tanggal)->translatedFormat('d F Y') }}</span>
            </div>
            <p class="text-gray-700 leading-relaxed">{{ $video->keterangan }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Komentar ({{ $comments->count() }})
            </h2>

            @if($comments->count() > 0)
                <div class="space-y-4">
                    @foreach($comments as $comment)
                        <div class="bg-gray-100 p-4 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-center mb-1">
                                <p class="font-semibold text-gray-800">{{ $comment->user->username ?? 'Pengguna' }}</p>
                                <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 text-sm break-words">{{ $comment->isi_komentar }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            @endif
        </div>
    </div>

    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-300 shadow-lg py-3 px-4">
        <form method="POST" action="{{ route('actuating.video.comment') }}" class="max-w-4xl mx-auto flex items-center space-x-3">
            @csrf
            <input type="hidden" name="id_video" value="{{ $video->id }}">
            
            @auth
                <textarea name="isi_komentar" required
                    placeholder="Tulis komentar sebagai {{ Auth::user()->username }}..."
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-gray-400 focus:border-gray-400 text-gray-800 bg-gray-50 resize-none"
                    rows="1"></textarea>
                <button type="submit" class="px-5 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">Kirim</button>
            @else
                <textarea disabled placeholder="Login untuk menulis komentar..." class="w-full p-2 border border-gray-300 rounded-lg bg-gray-200" rows="1"></textarea>
                <a href="{{ route('login') }}" class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Login</a>
            @endauth
        </form>
    </div>
</div>
@endsection
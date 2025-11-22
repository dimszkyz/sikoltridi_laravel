<section class="min-h-screen bg-white py-12 px-6 md:px-12" x-data="{ activeTab: 'video' }">
    <div class="max-w-5xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-semibold text-slate-800 mb-3">Actuating</h2>
        <div class="h-1 w-16 bg-blue-500 mx-auto mb-8 rounded-full"></div>

        <div class="flex justify-center mb-10">
            <div class="bg-gray-100 rounded-full p-1 flex space-x-1">
                <button @click="activeTab = 'video'"
                    :class="activeTab === 'video' ? 'bg-blue-500 text-white shadow' : 'text-gray-600 hover:text-blue-600'"
                    class="px-6 py-2 rounded-full text-sm font-medium transition-all">
                    Video
                </button>
                <button @click="activeTab = 'foto'"
                    :class="activeTab === 'foto' ? 'bg-blue-500 text-white shadow' : 'text-gray-600 hover:text-blue-600'"
                    class="px-6 py-2 rounded-full text-sm font-medium transition-all">
                    Foto
                </button>
            </div>
        </div>

        <div x-show="activeTab === 'video'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center animate-fade-in">
            @forelse($videos as $vid)
                <div class="w-full max-w-sm bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition group"
                     onclick="window.location.href='{{ route('actuating.video.detail', $vid->id) }}'">
                    <div class="relative w-full aspect-video bg-gray-900 flex items-center justify-center">
                        @if($vid->thumbnail)
                            <img src="{{ asset('uploads/video/thumb/' . $vid->thumbnail) }}" 
                                 alt="{{ $vid->judul }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <video src="{{ asset('uploads/video/' . $vid->media) }}" 
                                   class="w-full h-full object-cover" muted playsinline></video>
                        @endif
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="bg-white/90 text-gray-900 px-4 py-2 rounded-full text-sm font-semibold shadow-sm">
                                Putar Video
                            </span>
                        </div>
                    </div>
                    <div class="p-4 text-left">
                        <h3 class="font-semibold text-slate-800 mb-1 line-clamp-1">{{ $vid->judul }}</h3>
                        <p class="text-sm text-slate-600 line-clamp-2">{{ $vid->keterangan ?? 'Tidak ada keterangan' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada video yang diunggah.</p>
                </div>
            @endforelse
        </div>

        <div x-show="activeTab === 'foto'" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center animate-fade-in">
            @forelse($photos as $foto)
                <div class="w-full max-w-sm bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition group"
                     onclick="window.location.href='{{ route('actuating.foto.detail', $foto->id) }}'">
                    <div class="relative w-full aspect-square bg-gray-200">
                        <img src="{{ asset('uploads/foto/' . $foto->image_file) }}" 
                             alt="{{ $foto->title }}" 
                             class="w-full h-full object-cover"
                             onerror="this.src='https://via.placeholder.com/400?text=No+Image'">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <span class="bg-white/90 text-gray-900 px-4 py-2 rounded-full text-sm font-semibold shadow-sm">
                                Lihat Detail
                            </span>
                        </div>
                    </div>
                    <div class="p-4 text-left">
                        <h3 class="font-semibold text-slate-800 mb-1 line-clamp-1">{{ $foto->title ?? $foto->judul }}</h3>
                        <p class="text-sm text-slate-600 line-clamp-2">{{ $foto->deskripsi_image ?? $foto->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada foto yang diunggah.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@extends('layouts.main')

@section('content')
<div class="flex h-screen bg-gray-100">
    @include('components.sidebar-admin')

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow p-4">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow mb-8">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold text-orange-600">Pengajuan Akun Baru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIP/NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pendingUsers as $user)
                            <tr>
                                <td class="px-6 py-4">{{ $user->nama_lengkap }} ({{ $user->username }})</td>
                                <td class="px-6 py-4 capitalize">{{ $user->jabatan }}</td>
                                <td class="px-6 py-4">{{ $user->nip_nik ?? '-' }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf @method('PUT')
                                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak pengajuan ini?')">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada pengajuan baru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold text-blue-600">Daftar User Aktif</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($activeUsers as $user)
                            <tr>
                                <td class="px-6 py-4">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->nama_lengkap }}</td>
                                <td class="px-6 py-4 capitalize">{{ $user->jabatan }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
@extends('layouts.main')

@section('content')
<div class="flex flex-col min-h-screen bg-gray-100">
  <main class="flex-grow flex items-center justify-center">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center text-gray-900">Daftar Akun</h2>

      @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register.store') }}" class="space-y-6" 
            x-data="{ 
                jabatan: '{{ old('jabatan') }}', 
                showPassword: false,
                needsNip() {
                    return ['kepsek', 'guru', 'dudi'].includes(this.jabatan);
                }
            }">
        @csrf

        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input
            id="username"
            name="username"
            type="text"
            class="w-full px-3 py-2 mt-1 text-gray-900 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan username"
            value="{{ old('username') }}"
            required
          />
        </div>

        <div>
          <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input
            id="nama_lengkap"
            name="nama_lengkap"
            type="text"
            class="w-full px-3 py-2 mt-1 text-gray-900 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            placeholder="Masukkan nama lengkap"
            value="{{ old('nama_lengkap') }}"
            required
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="relative mt-1">
            <input
              id="password"
              name="password"
              :type="showPassword ? 'text' : 'password'"
              class="w-full px-3 py-2 pr-10 text-gray-900 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan password"
              required
            />
            <div
              class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500"
              @click="showPassword = !showPassword"
            >
                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <svg x-show="showPassword" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>
            </div>
          </div>
        </div>

        <div>
          <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
          <select
            id="jabatan"
            name="jabatan"
            x-model="jabatan"
            class="w-full px-3 py-2 mt-1 text-gray-900 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            required
          >
            <option value="" disabled selected>Pilih Jabatan...</option>
            <option value="kepsek">Kepala Sekolah</option>
            <option value="guru">Guru</option>
            <option value="orangtua">Orang Tua</option>
            <option value="dudi">DUDI (Dunia Usaha/Industri)</option>
          </select>
        </div>

        <div x-show="needsNip()" x-transition style="display: none;">
            <label for="nip_nik" class="block text-sm font-medium text-gray-700">NIP / NIK</label>
            <input
              id="nip_nik"
              name="nip_nik"
              type="text"
              class="w-full px-3 py-2 mt-1 text-gray-900 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              placeholder="Masukkan NIP/NIK Kepegawaian"
              value="{{ old('nip_nik') }}"
            />
        </div>

        <button
          type="submit"
          class="w-full px-4 py-2 font-medium text-white bg-blue-700 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
        >
          Ajukan Akun
        </button>
      </form>

      <p className="text-sm text-center text-gray-600">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">
          Login di sini
        </a>
      </p>
    </div>
  </main>
  
  <footer class="bg-white text-black text-center py-4 border-t border-gray-200">
    <p class="text-sm tracking-wide">
      © Copyright <span class="font-bold">GAZEBO TECH 2025</span> All Rights Reserved
    </p>
  </footer>
</div>
@endsection
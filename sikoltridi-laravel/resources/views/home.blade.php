@extends('layouts.main')

@section('content')
    <section id="home" class="min-h-screen bg-white pt-20 md:pt-24 relative overflow-hidden">
        
        @include('components.navbar')

        <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-white"></div>

        <div class="relative max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-10 md:py-16 flex flex-col lg:flex-row items-center justify-between gap-10 md:gap-12">
            
            <div class="flex-1 text-center lg:text-left animate-fade-in">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 mb-3 delay-100 animate-fade-in opacity-0" style="animation-fill-mode: forwards;">
                    SIKOLTRIDI
                </h2>

                <p class="font-semibold text-blue-600 mb-6 leading-snug text-[32px] sm:text-[36px] md:text-[42px] lg:text-[56px] whitespace-pre-line delay-200 animate-fade-in opacity-0" style="animation-fill-mode: forwards;">
                    "Sistem informasi
                    kolaborasi tripusat
                    pendidikan"
                </p>

                <a href="#partfile" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-md hover:bg-blue-700 transition transform hover:-translate-y-0.5 active:scale-95 delay-300 animate-fade-in opacity-0" style="animation-fill-mode: forwards;">
                    Mulai
                </a>
            </div>

            <div class="flex-1 flex justify-center items-center mt-10 lg:mt-0 animate-fade-in delay-200 opacity-0" style="animation-fill-mode: forwards;">
                <div class="relative flex items-center justify-center w-[388px] h-[388px] md:w-[420px] md:h-[420px]">
                    <img 
                        src="{{ asset('logo.png') }}" 
                        alt="Logo Sikoltridi" 
                        class="w-full h-full object-contain md:scale-125 drop-shadow-md transition-transform duration-700 hover:scale-105"
                    />
                </div>
            </div>
        </div>
    </section>

    <section id="partfile">
        <div class="py-20 text-center text-gray-400">Component PartFile Here</div>
    </section>
    
    <section id="PartPlanning">
        <div class="py-20 text-center text-gray-400">Component PartPlanning Here</div>
    </section>
    
    <section id="PartOrganizing">
        <div class="py-20 text-center text-gray-400">Component PartOrganizing Here</div>
    </section>
    
    <section id="PartMedia">
        <div class="py-20 text-center text-gray-400">Component PartVideo Here</div>
    </section>

    <footer class="bg-white text-slate-700 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pt-12 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                
                <div class="flex flex-col items-center md:items-start">
                    <img src="{{ asset('logo.png') }}" alt="Logo Sikoltridi" class="w-60 h-60 object-contain mb-2" />
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-3 text-slate-900">Fitur</h4>
                    <ul class="space-y-2 text-slate-600">
                        <li><a href="#home" class="hover:text-blue-600 transition">Home</a></li>
                        <li><a href="#partfile" class="hover:text-blue-600 transition">File</a></li>
                        <li><a href="#PartPlanning" class="hover:text-blue-600 transition">Planning</a></li>
                        <li><a href="#PartOrganizing" class="hover:text-blue-600 transition">Organizing</a></li>
                        <li><a href="#PartMedia" class="hover:text-blue-600 transition">Actuating</a></li>
                        <li><a href="{{ url('/controlling') }}" class="hover:text-blue-600 transition">Controlling</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-3 text-slate-900">Informasi Lebih Lanjut</h4>
                    <ul class="space-y-2 text-slate-600">
                        <li class="flex items-center justify-center md:justify-start">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            <a href="mailto:Gtech@gmail.com" class="hover:text-blue-600">Gtech@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-10 pt-6 text-center text-gray-500 text-sm">
                <p class="tracking-wide">
                    © Copyright <span class="font-bold">GAZEBO TECH 2025</span> All Rights Reserved
                </p>
            </div>
        </div>
    </footer>

    <button 
        x-data="{ show: false }"
        @scroll.window="show = (window.pageYOffset > 300)"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-show="show"
        x-transition
        class="fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition z-50"
        style="display: none;"
    >
        ↑
    </button>

@endsection
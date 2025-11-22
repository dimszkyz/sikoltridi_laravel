@extends('layouts.main')

@section('content')
<main class="min-h-screen bg-gray-50 pt-8 pb-10"
      x-data="controllingForm()">

    <div class="max-w-7xl mx-auto px-6 md:px-8 mb-8">
        <nav class="bg-white rounded-full shadow-md flex items-center justify-between py-3 px-6">
            <span class="text-2xl font-bold text-teal-900">Sikoltridi</span>
            <a href="{{ url('/') }}" class="bg-red-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-red-700 active:scale-[0.98] transition">
                Kembali Ke Home
            </a>
        </nav>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 text-center mb-4">
            Penggunaan Model Pendidikan Kewirausahaan Anak Usia Dini Berbasis Kolaborasi Tripusat Pendidikan
        </h1>
        <hr class="border-t border-gray-500 my-4" />
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-8 mt-2 mb-8">
        <div class="relative h-1.5 bg-gray-200 rounded-full">
            <div class="absolute h-1.5 bg-blue-600 rounded-full transition-all"
                 :style="`width: ${((step - 1) / 5) * 100}%`"></div>
        </div>
        <div class="mt-2 flex justify-between text-xs text-gray-600">
            <template x-for="(label, idx) in ['Identitas', 'A', 'B', 'C', 'D', 'Selesai']">
                <span :class="step - 1 >= idx ? 'text-blue-600 font-semibold' : 'text-gray-500'" x-text="label"></span>
            </template>
        </div>
    </div>

    <section x-show="step === 1" class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="bg-white rounded-2xl shadow-md p-8">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">Identitas Responden</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama Lengkap:</label>
                    <input type="text" x-model="respondent.nama" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Jabatan:</label>
                    <input type="text" x-model="respondent.jabatan" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Lembaga:</label>
                    <input type="text" x-model="respondent.lembaga" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <button @click="nextStep(1)" class="mt-6 px-6 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-semibold">Lanjut</button>
        </div>
    </section>

    <template x-for="s in steps" :key="s.id">
        <section x-show="step === s.id" class="px-4 md:px-6 lg:px-8 max-w-7xl mx-auto">
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 mb-6" x-text="s.title"></h2>
            <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr class="text-left">
                            <th class="px-4 py-3 w-12">No</th>
                            <th class="px-4 py-3">Pertanyaan</th>
                            <template x-for="opt in scale">
                                <th class="px-3 py-3 text-center whitespace-nowrap" x-text="opt"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <template x-for="(q, idx) in s.questions">
                            <tr :class="idx % 2 ? 'bg-white' : 'bg-slate-50/50'">
                                <td class="px-4 py-3 align-top" x-text="idx + 1"></td>
                                <td class="px-4 py-3 align-top" x-text="q"></td>
                                <template x-for="opt in scale">
                                    <td class="px-3 py-3 text-center align-top">
                                        <label class="inline-flex items-center gap-2 cursor-pointer">
                                            <input type="radio" :name="s.prefix + (idx + 1)" :value="opt" 
                                                   x-model="answers[s.prefix + (idx + 1)]"
                                                   class="h-4 w-4 accent-blue-600">
                                        </label>
                                    </td>
                                </template>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="flex items-center justify-between px-4 py-3 border-t bg-white">
                    <button @click="step--" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-slate-700 hover:bg-slate-100">Kembali</button>
                    <button @click="s.id === 5 ? submitForm() : nextStep(s.id)" 
                            class="inline-flex items-center gap-2 rounded-lg px-5 py-2 bg-blue-600 text-white hover:bg-blue-700 transition"
                            x-text="s.id === 5 ? (sending ? 'Mengirim...' : 'Kirim') : 'Lanjut'"
                            :disabled="sending">
                    </button>
                </div>
            </div>
        </section>
    </template>

    <section x-show="step === 6" class="max-w-3xl mx-auto px-6 md:px-8 py-10">
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 shadow-sm p-8 text-center">
            <div class="mx-auto mb-4 grid place-items-center h-14 w-14 rounded-full bg-emerald-100">
                <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5" /></svg>
            </div>
            <h3 class="text-2xl font-bold text-emerald-800">Terima kasih! Kuesioner berhasil terkirim.</h3>
            <div class="mt-6 text-left bg-white rounded-xl border p-5">
                <ul class="text-sm text-slate-700 space-y-1">
                    <li><span class="w-24 inline-block text-slate-500">Nama</span>: <span x-text="respondent.nama"></span></li>
                    <li><span class="w-24 inline-block text-slate-500">Jabatan</span>: <span x-text="respondent.jabatan"></span></li>
                </ul>
            </div>
            <div class="mt-6 flex justify-center gap-3">
                <a href="{{ url('/') }}" class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Kembali ke Beranda</a>
                <button @click="resetForm()" class="px-5 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">Isi Lagi</button>
            </div>
        </div>
    </section>

</main>

<script>
function controllingForm() {
    return {
        step: 1,
        sending: false,
        respondent: { nama: '', jabatan: '', lembaga: '' },
        scale: ["Sangat Baik", "Baik", "Cukup", "Kurang", "Sangat Kurang"],
        answers: {},
        steps: [
            { id: 2, prefix: 'a', title: 'A. Aspek Manajemen Kolaborasi Tripusat Pendidikan', questions: [
                "Implementasi desain model Pendidikan Kewirausahaan...", "Keterpaduan tiga komponen Tripusat...", "Proses kolaborasi sekolah...", "Implementasi tahap perencanaan...", "Implementasi tahap pengorganisasian...", "Implementasi tahap pelaksanaan...", "Implementasi tahap pengawasan...", "Ketercapaian tujuan Pendidikan...", "Pelaksanaan pembelajaran kewirausahaan...", "Prospek dampak/outcome..."
            ]},
            { id: 3, prefix: 'b', title: 'B. Aspek Penggunaan Sistem Informasi...', questions: [
                "Kemudahan penggunaan...", "Kesesuaian konten...", "Kejelasan konten...", "Kemudahan penggunaan Sikoltridi...", "Keterpaduan tiga komponen..."
            ]},
            { id: 4, prefix: 'c', title: 'C. Aspek Kemanfaatan Sistem Informasi...', questions: [
                "Kemudahan sekolah...", "Kemudahan Kepala Sekolah...", "Kemudahan orang tua...", "Kemudahan DUDI...", "Kemudahan dalam penyimpanan..."
            ]},
            { id: 5, prefix: 'd', title: 'D. Aspek Kelengkapan Sistem Informasi...', questions: [
                "Kelengkapan konten (isi) tahap perencanaan...", "Kelengkapan konten (isi) tahap pengorganisasian...", "Kelengkapan konten (isi) tahap pelaksanaan...", "Kelengkapan konten (isi) tahap pengawasan..."
            ]}
        ],
        init() {
            // Init empty answers
            this.steps.forEach(s => {
                s.questions.forEach((_, i) => this.answers[s.prefix + (i + 1)] = "");
            });
        },
        nextStep(currentId) {
            if (currentId === 1) {
                if (!this.respondent.nama || !this.respondent.jabatan) return alert("Harap isi data diri!");
            } else {
                // Validasi pertanyaan
                const s = this.steps.find(x => x.id === currentId);
                const allAnswered = s.questions.every((_, i) => this.answers[s.prefix + (i + 1)]);
                if (!allAnswered) return alert("Mohon lengkapi semua jawaban terlebih dahulu.");
            }
            this.step++;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        async submitForm() {
            // Validasi step terakhir
            const s = this.steps.find(x => x.id === 5);
            if (!s.questions.every((_, i) => this.answers[s.prefix + (i + 1)])) return alert("Lengkapi jawaban!");

            this.sending = true;
            try {
                const payload = { ...this.respondent, ...this.answers, nama_responden: this.respondent.nama }; // Mapping nama field
                
                // Axios POST ke Laravel
                await axios.post('/api/kuesioner', payload);
                this.step = 6;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (e) {
                alert("Gagal mengirim: " + (e.response?.data?.message || e.message));
            } finally {
                this.sending = false;
            }
        },
        resetForm() {
            this.respondent = { nama: '', jabatan: '', lembaga: '' };
            this.init();
            this.step = 1;
        }
    }
}
</script>
@endsection
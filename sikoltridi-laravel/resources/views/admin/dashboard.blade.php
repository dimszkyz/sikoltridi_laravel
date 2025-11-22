<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sikoltridi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        @include('components.sidebar-admin')

        <div class="flex-1 flex flex-col overflow-hidden relative">
            <header class="flex justify-between items-center p-4 bg-white border-b">
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    @if(Auth::user()->level === 'superadmin')
                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total User</p>
                            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full text-blue-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total File</p>
                            <p class="text-2xl font-bold">{{ $totalFiles }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full text-blue-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Planning</p>
                            <p class="text-2xl font-bold">{{ $totalPlanning }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full text-green-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Organizing</p>
                            <p class="text-2xl font-bold">{{ $totalOrganizing }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full text-yellow-500">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    
                     <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Video</p>
                            <p class="text-2xl font-bold">{{ $totalVideo }}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full text-red-500">
                           <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold mb-4">Grafik Upload per Tanggal</h2>
                    <div class="relative h-80 w-full">
                        <canvas id="uploadChart"></canvas>
                    </div>
                </div>

                @if(Auth::user()->level === 'superadmin')
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Daftar User Aktif</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $index => $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">{{ $user->level }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('users.destroy', $user->id_user ?? $user->id) }}" method="POST" onsubmit="return confirm('Hapus user {{ $user->username }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari Controller (dikirim sebagai JSON)
            const filesData = @json($filesData);
            const planningData = @json($planningData);
            const organizingData = @json($organizingData);
            const videoData = @json($videoData);
            const fotoData = @json($fotoData);

            // Fungsi Helper Tanggal (Sama seperti di React)
            const getDateKey = (d) => {
                if (!d) return null;
                const dt = new Date(d);
                if (isNaN(dt)) return null;
                const year = dt.getFullYear();
                const month = String(dt.getMonth() + 1).padStart(2, '0');
                const day = String(dt.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            const formatLabel = (isoKey) => {
                const dt = new Date(isoKey);
                return dt.toLocaleDateString("id-ID", {
                    year: "numeric", month: "short", day: "numeric"
                });
            };

            const countByDate = (data, dateKeyName) => {
                const counts = {};
                data.forEach((item) => {
                    // Menyesuaikan dengan nama kolom di DB Laravel
                    const dateVal = item[dateKeyName] || item.created_at || item.uploaded_at || item.tanggal;
                    const key = getDateKey(dateVal);
                    if (key) counts[key] = (counts[key] || 0) + 1;
                });
                return counts;
            };

            // Proses Data
            const filesCount = countByDate(filesData, 'uploaded_at');
            const planningCount = countByDate(planningData, 'uploaded_at');
            const organizingCount = countByDate(organizingData, 'uploaded_at');
            const videoCount = countByDate(videoData, 'tanggal'); // Video mungkin punya field 'tanggal'
            const fotoCount = countByDate(fotoData, 'uploaded_at');

            const allKeys = Array.from(new Set([
                ...Object.keys(filesCount),
                ...Object.keys(planningCount),
                ...Object.keys(organizingCount),
                ...Object.keys(videoCount),
                ...Object.keys(fotoCount)
            ])).sort();

            const labels = allKeys.map(formatLabel);
            
            // Render Chart
            const ctx = document.getElementById('uploadChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        { label: "Upload File", data: allKeys.map(k => filesCount[k] || 0), backgroundColor: "rgba(59,130,246,0.75)", borderRadius: 6 },
                        { label: "Upload Planning", data: allKeys.map(k => planningCount[k] || 0), backgroundColor: "rgba(16,185,129,0.75)", borderRadius: 6 },
                        { label: "Upload Organizing", data: allKeys.map(k => organizingCount[k] || 0), backgroundColor: "rgba(234,179,8,0.75)", borderRadius: 6 },
                        { label: "Upload Video", data: allKeys.map(k => videoCount[k] || 0), backgroundColor: "rgba(239,68,68,0.75)", borderRadius: 6 },
                        { label: "Upload Foto", data: allKeys.map(k => fotoCount[k] || 0), backgroundColor: "rgba(249,115,22,0.85)", borderRadius: 6 },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
</body>
</html>
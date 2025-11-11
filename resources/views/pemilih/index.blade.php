<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>Statistik Pemilih - PILKAHIMIF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <header class="bg-white shadow-sm py-6 w-full">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/pilkahim.png') }}" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Statistik Pemilih</h1>
                    <p class="text-sm text-gray-500">Pemilihan Ketua & Wakil Ketua Umum HMIF</p>
                </div>
            </div>
            <a href="{{ route('quick.count') }}"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                Kembali ke Quick Count
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Statistik Utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Total Pemilih -->
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center space-x-5 border-l-4 border-blue-500">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500">Total Pemilih Terdaftar</div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ number_format($totalVoters) }}</div>
                </div>
            </div>

            <!-- Sudah Memilih -->
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center space-x-5 border-l-4 border-green-500">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500">Sudah Memilih</div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ number_format($votedCount) }}</div>
                </div>
            </div>

            <!-- Belum Memilih -->
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center space-x-5 border-l-4 border-red-500">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-500">Belum Memilih</div>
                    <div class="text-3xl font-extrabold text-gray-900">{{ number_format($notVotedCount) }}</div>
                </div>
            </div>
        </div>

        <!-- Rincian Per Angkatan -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gray-700">Partisipasi per Angkatan</h3>
                <p class="text-sm font-bold text-red-600">Data 100% valid, diambil dari Sekretariat Prodi IF</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Angkatan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sudah Memilih</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pemilih Terdaftar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tingkat Partisipasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($votersByBatch as $batch)
                        @php
                        // PERBAIKAN: Menggunakan 'total_pemilih' (dari controller) bukan 'total'
                        $participation = ($batch->total_pemilih > 0) ? ($batch->sudah_memilih / $batch->total_pemilih) * 100 : 0;
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">Angkatan {{ $batch->angkatan_lengkap }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ number_format($batch->sudah_memilih) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- PERBAIKAN: Menggunakan 'total_pemilih' (dari controller) bukan 'total' -->
                                <div class="text-sm text-gray-900">{{ number_format($batch->total_pemilih) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-32 bg-gray-200 rounded-full h-2.5 mr-3">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $participation }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">{{ number_format($participation, 1) }}%</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                Data pemilih tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>

</html>
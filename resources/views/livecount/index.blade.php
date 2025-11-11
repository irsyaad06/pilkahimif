<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Refresh otomatis setiap 60 detik -->
    <meta http-equiv="refresh" content="60">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>Quick Count - PILKAHIMIF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .7;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <header class="bg-white shadow-sm py-6 w-full fixed z-50 top-0 left-0">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/pilkahim.png') }}" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Quick Count</h1>
                    <p class="text-sm text-gray-500">Pemilihan Ketua & Wakil Ketua Umum HMIF</p>
                </div>
            </div>

            <div class="flex gap-4 items-center">



                <!-- DROPDOWN MENU AREA -->
                <div class="hidden sm:block relative" id="dropdown-container">

                    <!-- Tombol Trigger Dropdown (Burger Menu) -->
                    <button onclick="toggleDropdown(event)"
                        class="inline-flex items-center justify-center p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-all duration-300 focus:outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>

                    <!-- Isi Dropdown -->
                    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg py-2 z-50 ring-1 ring-black ring-opacity-5 transform origin-top-right transition-all">
                        <div class="px-4 py-2 border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            @auth
                            Halo, {{ explode(' ', auth()->user()->name)[0] }}
                            @else
                            Pilih Menu
                            @endauth
                        </div>

                        @guest
                        <!-- Menu untuk GUEST (Belum Login) -->
                        <a href="{{ route('auth.google.redirect') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition ease-in-out duration-150">
                            <!-- Ikon Google -->
                            <svg class="h-5 w-5 mr-3 text-gray-400" viewBox="0 0 488 512" fill="currentColor">
                                <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C323.6 89.5 288.4 76 248 76c-94.5 0-171 78.2-171 180s76.5 180 171 180c86.7 0 141.7-49.3 148-118.3H248v-94.8h240c2.2 12.7 4 25.5 4 39.9z" />
                            </svg>
                            Login Google
                        </a>
                        @endguest

                        @auth
                        <!-- Menu untuk USER (Sudah Login) -->
                        @if (auth()->user()->has_voted)
                            <div class="flex items-center px-4 py-3 text-sm text-green-600 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Anda Sudah Vote
                            </div>
                        @elseif ($isVotingOpen)
                            <a href="/voting" class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition ease-in-out duration-150 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Halaman Voting
                            </a>
                        @else
                            <div class="flex items-center px-4 py-3 text-sm text-gray-500 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pemilihan Selesai
                            </div>
                        @endif

                        <!-- Tombol Logout -->
                        <form action="{{ route('logout') }}" method="POST" class="block w-full border-t border-gray-100">
                            @csrf
                            <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                        @endauth
                    </div>

                </div>
                <!-- END DROPDOWN MENU AREA -->
                <!-- AVATAR USER (Hanya muncul jika login) -->
                @auth
                <div class="hidden sm:block">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random&color=fff' }}"
                        alt="{{ auth()->user()->name }}"
                        class="w-10 h-10 rounded-full border-2 border-blue-100 shadow-sm object-cover"
                        title="{{ auth()->user()->name }}">
                </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 pt-32">

        <!-- Info Bar Mobile (Hanya muncul di layar kecil) -->
        <div class="sm:hidden bg-white rounded-xl shadow p-4 mb-6 text-center border-2 border-blue-600">
            <div class="text-sm font-semibold text-gray-500">Total Suara Masuk</div>
            <div class="text-3xl font-extrabold text-blue-600">{{ number_format($totalVotes) }}</div>
        </div>

        <!-- LOGIKA DINAMIS UNTUK GRID & TOTAL BLOCK -->
        @php
        $candidateCount = $candidates->count();
        // Default untuk >= 3 kandidat
        $gridClass = 'lg:grid-cols-3';
        $centerClass = ''; // Lebar penuh default

        if ($candidateCount === 2) {
        // Jika 2 kandidat: Grid 2 kolom, lebar dibatasi max-5xl dan ditengah
        $gridClass = 'lg:grid-cols-2 lg:max-w-3xl lg:mx-auto';
        $centerClass = 'lg:max-w-3xl lg:mx-auto';
        } elseif ($candidateCount === 1) {
        // Jika 1 kandidat: Grid 1 kolom, lebar max-md dan ditengah
        $gridClass = 'lg:grid-cols-1 max-w-md mx-auto';
        $centerClass = 'max-w-md mx-auto';
        }
        @endphp

        <!-- Grid Kandidat -->
        <div class="grid grid-cols-1 md:grid-cols-2 {{ $gridClass }} gap-6 mb-10">
            @foreach ($candidates as $candidate)
            @php
            $percentage = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
            $percentageFormatted = number_format($percentage, 1);
            @endphp

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition-all hover:scale-[1.01]">
                <!-- Header Kartu -->
                <div class="relative h-72 bg-gray-200">
                    @if($candidate->foto)
                    <img src="{{ asset('storage/' . $candidate->foto) }}" alt="Paslon {{ $candidate->nomor_urut }}" class="w-full h-full object-cover object-top">
                    @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-0 left-0 bg-blue-600 text-white py-2 px-4 rounded-br-2xl font-bold text-xl shadow-md">
                        #{{ $candidate->nomor_urut }}
                    </div>
                </div>

                <!-- Body Kartu -->
                <div class="p-6">
                    <div class="mb-6 h-8 flex">
                        <h2 class="text-lg font-bold text-gray-900 leading-tight">{{ $candidate->calon_ketua }}</h2>
                        <div class="text-lg font-bold text-gray-900 leading-tight mx-1">&</div>
                        <h2 class="text-lg font-bold text-gray-900 leading-tight">{{ $candidate->calon_wakil_ketua }}</h2>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <span class="text-4xl font-extrabold text-gray-900 leading-none">
                                    {{ $percentageFormatted }}<span class="text-2xl">%</span>
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-500">Perolehan Suara</div>
                                <div class="text-xl font-bold text-blue-700">{{ number_format($candidate->votes_count) }}</div>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-4 rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%">
                                <div class="w-full h-full opacity-30 bg-white animate-pulse-slow"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Total Suara Masuk (Desktop & mengikuti lebar grid) -->
        <div class="{{ $centerClass }} mb-3">
            <div class="bg-white rounded-xl shadow p-4 text-center border-2 border-blue-600">
                <div class="text-sm font-semibold text-gray-500">Total Suara Masuk</div>
                <div class="text-3xl font-extrabold text-blue-600">{{ number_format($totalVotes) }}</div>
            </div>
        </div>

        <!-- Footer / Last Update -->
        <div class="text-center text-sm text-gray-500 flex items-center justify-center space-x-2">
            @php
                // Tentukan waktu update yang akan ditampilkan.
                // Jika waktu update terakhir melebihi waktu berakhir pemilihan, tampilkan waktu berakhir pemilihan.
                $displayTime = $lastUpdate;
                if ($votingPeriod && $votingPeriod->waktu_berakhir && $lastUpdate->gt($votingPeriod->waktu_berakhir)) {
                    $displayTime = $votingPeriod->waktu_berakhir;
                }
            @endphp
            <svg class="w-4 h-4 text-green-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 16.364H18.364M5.636 12H18.364M5.636 7.636H18.364"></path>
            </svg>
            <span>
                Data diperbarui otomatis setiap 60 detik. Terakhir update: <span class="font-semibold text-gray-700">{{ $displayTime->format('H:i:s d-m-Y') }}</span>
            </span>
        </div>

    </main>

    <!-- Script untuk Dropdown -->
    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdown-menu');
            const container = document.getElementById('dropdown-container');
            if (!container.contains(e.target) && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
@extends('layouts.app')

@section('title', 'Pemilih Dashboard')

@section('content')
<h1>Pemilih Dashboard</h1>
<p>Selamat datang di dashboard pemilih.</p>
@endsection



<main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 pt-32">

        <!-- Info Bar Mobile (Hanya muncul di layar kecil) -->
        <div class="sm:hidden bg-white rounded-xl shadow p-4 mb-6 text-center">
            <div class="text-sm font-semibold text-gray-500">Total Suara Masuk</div>
            <div class="text-3xl font-extrabold text-blue-600">{{ number_format($totalVotes) }}</div>
        </div>

        <!-- Grid Kandidat -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach ($candidates as $candidate)
            @php
            // Menghitung persentase
            $percentage = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
            // Format 1 desimal
            $percentageFormatted = number_format($percentage, 1);
            @endphp

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition-all hover:scale-[1.01]">
                <!-- Header Kartu: Nomor Urut & Foto -->
                <div class="relative h-80 bg-gray-200">
                    @if($candidate->foto)
                    <img src="{{ asset('storage/' . $candidate->foto) }}" alt="Paslon {{ $candidate->nomor_urut }}" class="w-full h-full object-cover object-top">
                    @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    <!-- Badge Nomor -->
                    <div class="absolute top-0 left-0 bg-blue-600 text-white py-2 px-4 rounded-br-2xl font-bold text-xl shadow-md">
                        #{{ $candidate->nomor_urut }}
                    </div>
                </div>

                <!-- Body Kartu -->
                <div class="p-6">
                    <!-- Nama Kandidat -->
                    <div class="mb-6 h-8 flex"> <!-- Set fixed height agar rata -->
                        <h2 class="text-lg font-bold text-gray-900 leading-tight">
                            {{ $candidate->calon_ketua }}
                        </h2>
                        <div class="text-lg font-bold text-gray-900 leading-tight mx-1">&</div>
                        <h2 class="text-lg font-bold text-gray-900 leading-tight">
                            {{ $candidate->calon_wakil_ketua }}
                        </h2>
                    </div>

                    <!-- Statistik Vote -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <span class="text-4xl font-extrabold text-gray-900 leading-none">
                                    {{ $percentageFormatted }}<span class="text-2xl">%</span>
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-500">Perolehan Suara</div>
                                <div class="text-xl font-bold text-blue-700">
                                    {{ number_format($candidate->votes_count) }}
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-4 rounded-full transition-all duration-1000 ease-out"
                                style="width: {{ $percentage }}%">
                                <!-- Efek mengkilap pada progress bar -->
                                <div class="w-full h-full opacity-30 bg-white animate-pulse-slow"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Footer / Last Update -->
        <div class="text-center text-sm text-gray-500 flex items-center justify-center space-x-2">
            <svg class="w-4 h-4 text-green-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 16.364H18.364M5.636 12H18.364M5.636 7.636H18.364"></path>
            </svg>
            <span>
                Data diperbarui otomatis setiap 60 detik. Terakhir update: <span class="font-semibold text-gray-700">{{ $lastUpdate->format('H:i:s d-m-Y') }}</span>
            </span>
        </div>

    </main>
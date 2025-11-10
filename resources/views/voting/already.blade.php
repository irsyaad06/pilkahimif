<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>Voting - PILKAHIMIF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">


    <div class="min-h-[80vh] flex items-center justify-center px-4">

        <!-- Kartu Informasi -->
        <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8 md:p-10 text-center border-t-4 border-blue-500">

            <!-- Ikon Informasi -->
            <div class="mx-auto w-20 h-20 flex items-center justify-center bg-blue-50 rounded-full mb-6">
                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <!-- Judul Utama -->
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">
                Anda Sudah Memilih
            </h1>

            <!-- Pesan Penjelasan -->
            <p class="text-gray-600 mb-8 leading-relaxed">
                Terima kasih atas partisipasi Anda. Data kami menunjukkan bahwa Anda telah menggunakan hak suara Anda dalam pemilihan ini.
            </p>

            <!-- Opsional: Menampilkan Pilihan Sebelumnya (Jika Diperbolehkan) -->
            {{--
        @if(isset($userVote))
        <div class="bg-blue-50 p-4 rounded-lg mb-8 text-left">
            <p class="text-sm text-blue-800 font-semibold mb-1">Pilihan Anda:</p>
            <p class="text-gray-700">
                Paslon No. {{ $userVote->paslon->nomor_urut }} - {{ $userVote->paslon->calon_ketua }} & {{ $userVote->paslon->calon_wakil_ketua }}
            </p>
            <p class="text-xs text-gray-500 mt-2">
                Waktu memilih: {{ $userVote->created_at->format('d M Y, H:i') }} WIB
            </p>
        </div>
        @endif
        --}}

        <!-- Tombol Kembali -->
        <div>
            <a href="/" class="inline-flex items-center justify-center w-full sm:w-auto bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <a href="/"
                class="mt-2 inline-flex items-center justify-center w-full sm:w-auto bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 16.364H18.364M5.636 12H18.364M5.636 7.636H18.364"></path>
                </svg>
                Lihat Perhitungan Suara
            </a>
        </div>

    </div>
    </div>

</body>
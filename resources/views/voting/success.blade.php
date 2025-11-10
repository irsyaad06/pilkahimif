<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>Voting Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center py-12 px-4">

        <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8 md:p-10 text-center">

            <div class="mx-auto w-20 h-20 flex items-center justify-center bg-green-100 rounded-full mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">
                Voting Berhasil!
            </h1>

            <p class="text-lg text-gray-700 mb-8">
                Anda berhasil mencoblos pasangan nomor urut:

                <strong class="text-green-700 font-extrabold text-xl">
                    {{ $paslon->nomor_urut }}
                </strong>
            </p>

            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 mb-8">
                <p class="text-sm text-gray-500 mb-3">Konfirmasi Pilihan Anda:</p>

                <p class="text-2xl font-bold text-gray-900">
                    {{ $paslon->calon_ketua }}
                </p>
                <p class="text-md text-gray-600 my-1">&</p>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $paslon->calon_wakil_ketua }}
                </p>
            </div>

            <div class="mt-10">
                <a href="/"
                    class="inline-block w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Kembali ke Beranda
                </a>
                <a href="/quick-count"
                    class="mt-3 inline-block w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Lihat Perhitungan Suara
                </a>
            </div>

        </div>
    </div>
</body>

</html>
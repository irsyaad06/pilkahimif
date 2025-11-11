<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - PILKAHIMIF</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center p-6">


        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-lg text-center">

            <!-- LOGO WRAPPER -->
            <div class="flex items-center justify-center gap-6 mb-6">
                <!-- <img src="{{ asset('img/unikom.png') }}" class="w-10 h-auto" alt="Unikom">
                <img src="{{ asset('img/hmif.png') }}" class="w-10 h-auto" alt="HMIF"> -->
                <img src="{{ asset('img/pilkahim.png') }}" class="w-20 h-auto" alt="Pilkahim">
            </div>

            <h1 class="text-2xl font-bold mb-3">
                Selamat Datang, {{ auth()->user()->name }} 👋
            </h1>

            <p class="text-gray-600 mb-6">
                Nim anda : <b> {{ auth()->user()->nim }}</b>
            </p>
            <p class="text-gray-600 mb-6">
                Anda berhasil login menggunakan <b>Google</b>.
            </p>

            <p class="text-gray-700 mb-8">
                Anda terdaftar sebagai pemilih dalam <b>Pilkahim IF</b>.
                Silakan klik tombol di bawah untuk mulai melakukan voting.
            </p>


            @if (auth()->user()->has_voted)
            <p class="text-green-600 font-semibold mt-4">
                Anda sudah melakukan voting ✅
            </p>

            <a href="/"
                class="mt-3 inline-flex items-center justify-center w-full sm:w-auto bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 16.364H18.364M5.636 12H18.364M5.636 7.636H18.364"></path>
                </svg>
                Lihat Perhitungan Suara
            </a>
            @elseif ($isVotingOpen)
            <a href="{{ route('voting.page') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                Voting Sekarang
            </a>
            @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg" role="alert">
                <p class="font-bold">Voting Belum Dibuka atau Sudah Berakhir</p>
                @if ($votingPeriod)
                <p>Jadwal voting: {{ $votingPeriod->waktu_mulai->format('d M Y, H:i') }} - {{ $votingPeriod->waktu_berakhir->format('d M Y, H:i') }}</p>
                @else
                <p>Jadwal voting belum ditentukan.</p>
                @endif
            </div>

            <a href="/"
                class="mt-3 inline-flex items-center justify-center w-full sm:w-auto bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 16.364H18.364M5.636 12H18.364M5.636 7.636H18.364"></path>
                </svg>
                Lihat Perhitungan Suara
            </a>
            @endif

        </div>

        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-lg text-center mt-7">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-red-600 hover:underline">
                    Logout
                </button>

            </form>
        </div>


    </div>

</body>

</html>
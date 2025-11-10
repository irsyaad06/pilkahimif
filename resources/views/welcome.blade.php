<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilih</title>
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
                Anda berhasil login menggunakan <b>Google</b>.
            </p>

            <p class="text-gray-700 mb-8">
                Anda terdaftar sebagai pemilih dalam <b>Pilkahim IF</b>.
                Silakan klik tombol di bawah untuk mulai melakukan voting.
            </p>


            @if (!auth()->user()->has_voted)
            <a href="{{ route('voting.page') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                Voting Sekarang
            </a>
            @else
            <p class="text-green-600 font-semibold mt-4">
                Anda sudah melakukan voting ✅
            </p>
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
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>Login E-Voting PILKAHIMIF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center p-4">

        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
            <div class="flex items-center justify-center gap-6 mb-6">
                <!-- <img src="{{ asset('img/unikom.png') }}" class="w-10 h-auto" alt="Unikom">
                <img src="{{ asset('img/hmif.png') }}" class="w-10 h-auto" alt="HMIF"> -->
                <img src="{{ asset('img/pilkahim.png') }}" class="w-20 h-auto" alt="Pilkahim">
            </div>
            <h1 class="text-2xl font-semibold text-center mb-6">
                Login E-Voting Pilkahim IF
            </h1>

            <p class="text-center text-gray-600 text-sm mb-6">
                Silakan login menggunakan akun mahasiswa Anda.
            </p>

            <!-- ALERT ERROR MESSAGE -->
            <!-- Bagian ini akan muncul HANYA jika ada session 'error' -->
            @if (session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-start" role="alert">
                <!-- Ikon Error Kecil -->
                <svg class="w-5 h-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <!-- Pesan Error -->
                <div class="text-sm text-red-700">
                    <p class="font-bold">Login Gagal</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
            @endif
            <!-- END ALERT ERROR MESSAGE -->

            <a href="{{ route('auth.google.redirect') }}"
                class="flex items-center justify-center gap-3 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg w-full transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">

                <!-- Google Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 488 512">
                    <path fill="currentColor"
                        d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248
                        8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C323.6 89.5 288.4 76 248 
                        76c-94.5 0-171 78.2-171 180s76.5 180 171 180c86.7 0 141.7-49.3 
                        148-118.3H248v-94.8h240c2.2 12.7 4 25.5 4 39.9z" />
                </svg>

                <span class="font-medium">Login dengan Google</span>
            </a>

            <div class="mt-3 text-center border-t">
                <a href="/" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg w-full transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                    Lihat Quick Count
                </a>
            </div>


            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-400">© {{ date('Y') }} Himpunan Mahasiswa Teknik Informatika - UNIKOM</p>
            </div>

        </div>

    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Voting Pilkahuim</title>
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

            <a href="{{ route('auth.google.redirect') }}"


                class="flex items-center justify-center gap-3 bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg w-full transition">

                <!-- Google Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 488 512">
                    <path fill="currentColor"
                        d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248
                        8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C323.6 89.5 288.4 76 248 
                        76c-94.5 0-171 78.2-171 180s76.5 180 171 180c86.7 0 141.7-49.3 
                        148-118.3H248v-94.8h240c2.2 12.7 4 25.5 4 39.9z" />
                </svg>

                <span>Login dengan Google</span>
            </a>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">© {{ date('Y') }} Himpunan Mahasiswa Teknik Informatika - UNIKOM</p>
            </div>

        </div>

    </div>

</body>

</html>
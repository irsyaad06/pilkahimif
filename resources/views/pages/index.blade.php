<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>FAQ & Teknis Pemilihan - PILKAHIMIF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Rotasi ikon chevron saat <details> dibuka */
        details[open] summary .chevron {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm py-6 w-full">
        <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/pilkahim.png') }}" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Informasi Pemilihan</h1>
                    <p class="text-sm text-gray-500">Teknis, Aturan, dan Tata Cara Voting</p>
                </div>
            </div>
            <a href="{{ route('quick.count') }}"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                Kembali ke Quick Count
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <!-- Bagian 1: Tata Cara Penggunaan -->
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-12 border border-gray-100">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">
                Tata Cara Penggunaan
            </h2>
            <ol class="space-y-6">
                <!-- Langkah 1 -->
                <li class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full font-bold text-lg">1</div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Login Akun Mahasiswa</h3>
                        <p class="text-gray-600">Buka website dan login menggunakan akun email <span class="font-medium">@mahasiswa.unikom.ac.id</span> Anda.</p>
                    </div>
                </li>
                <!-- Langkah 2 -->
                <li class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full font-bold text-lg">2</div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Halaman Sambutan</h3>
                        <p class="text-gray-600">Jika login berhasil, Anda akan diarahkan ke halaman sambutan (Welcome).</p>
                    </div>
                </li>
                <!-- Langkah 3 -->
                <li class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full font-bold text-lg">3</div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Vote Sekarang</h3>
                        <p class="text-gray-600">Klik tombol "Vote Sekarang" (Tombol ini hanya aktif selama rentang waktu pemilihan).</p>
                    </div>
                </li>
                <!-- Langkah 4 -->
                <li class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full font-bold text-lg">4</div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Lihat Visi & Misi</h3>
                        <p class="text-gray-600">Anda dapat melihat Visi, Misi, dan Video Perkenalan dari setiap pasangan calon.</p>
                    </div>
                </li>
                <!-- Langkah 5 -->
                <li class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full font-bold text-lg">5</div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Pilih Paslon</h3>
                        <p class="text-gray-600">Klik "Pilih Paslon" pada pilihan Anda, lalu klik "Ya, Saya Yakin" saat modal konfirmasi muncul.</p>
                    </div>
                </li>
                <!-- Langkah 6 -->
                <li class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 text-white rounded-full font-bold text-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Selesai!</h3>
                        <p class="text-gray-600">Selamat! Anda sudah berpartisipasi dalam pemilihan Ketua Umum HMIF UNIKOM.</p>
                    </div>
                </li>
            </ol>
        </div>


        <!-- Bagian 2: Teknis Pemungutan Suara (FAQ) -->
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-100">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">
                Teknis Pemungutan Suara (FAQ)
            </h2>

            <div class="space-y-4">
                <!-- FAQ 1: Platform -->
                <details class="group border border-gray-200 rounded-lg overflow-hidden">
                    <summary class="flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-800 text-lg">Bagaimana platform pemungutan suaranya?</span>
                        <svg class="chevron w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-5 border-t border-gray-100 bg-gray-50">
                        <p class="text-gray-700 leading-relaxed">
                            Pemungutan suara dilaksanakan melalui website resmi HMIF UNIKOM. Setiap pemilih wajib login menggunakan akun <strong>@mahasiswa.unikom.ac.id</strong>.
                        </p>
                    </div>
                </details>

                <!-- FAQ 2: Hak Pemilih -->
                <details class="group border border-gray-200 rounded-lg overflow-hidden">
                    <summary class="flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-800 text-lg">Siapa yang berhak memilih?</span>
                        <svg class="chevron w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-5 border-t border-gray-100 bg-gray-50">
                        <p class="text-gray-700 leading-relaxed">
                            Hanya mahasiswa aktif Program Studi Teknik Informatika UNIKOM yang berhak memberikan suara. Data mahasiswa aktif (DPT) diperoleh dari Sekretariat Program Studi Teknik Informatika UNIKOM.
                        </p>
                    </div>
                </details>

                <!-- FAQ 3: Waktu Pemungutan Suara -->
                <details class="group border border-gray-200 rounded-lg overflow-hidden">
                    <summary class="flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-800 text-lg">Kapan waktu pemungutan suaranya?</span>
                        <svg class="chevron w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-5 border-t border-gray-100 bg-gray-50">
                        @if($votingPeriod && $votingPeriod->waktu_mulai && $votingPeriod->waktu_berakhir)
                        <p class="text-gray-700 leading-relaxed">
                            Pemungutan suara dibuka pada: <br>
                            <strong class="text-blue-600">
                                <!-- Format: Selasa, 11 November 2025 pukul 00.00 WIB -->
                                {{ $votingPeriod->waktu_mulai->translatedFormat('l, d F Y') }} pukul {{ $votingPeriod->waktu_mulai->format('H.i') }} WIB
                            </strong>
                            <br><br>
                            Pemungutan suara ditutup pada: <br>
                            <strong class="text-red-600">
                                <!-- Format: Kamis, 13 November 2025 pukul 23.59 WIB -->
                                {{ $votingPeriod->waktu_berakhir->translatedFormat('l, d F Y') }} pukul {{ $votingPeriod->waktu_berakhir->format('H.i') }} WIB
                            </strong>
                            <br><br>
                            Suara yang masuk di luar rentang waktu tersebut tidak akan dianggap sah.
                        </p>
                        @else
                        <!-- Tampilkan ini jika data di DB tidak ada ATAU datanya belum lengkap -->
                        <p class="text-gray-700 leading-relaxed">
                            Jadwal pemungutan suara belum ditentukan oleh panitia.
                        </p>
                        @endif
                    </div>
                </details>

                <!-- FAQ 4: Quick Count -->
                <details class="group border border-gray-200 rounded-lg overflow-hidden">
                    <summary class="flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-800 text-lg">Apakah hasilnya transparan?</span>
                        <svg class="chevron w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-5 border-t border-gray-100 bg-gray-50">
                        <p class="text-gray-700 leading-relaxed">
                            Ya. Hasil quick count (perhitungan cepat) ditampilkan secara <strong>real-time</strong> di website HMIF selama masa pemilihan. Quick count hanya menampilkan jumlah suara masing-masing calon, tanpa menampilkan identitas pemilih.
                        </p>
                    </div>
                </details>

                <!-- FAQ 5: Keamanan & Validasi -->
                <details class="group border border-gray-200 rounded-lg overflow-hidden">
                    <summary class="flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-800 text-lg">Bagaimana keamanan dan kerahasiaan suara saya?</span>
                        <svg class="chevron w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-5 border-t border-gray-100 bg-gray-50">
                        <p class="text-gray-700 leading-relaxed">
                            Sistem ini menjamin dua hal:
                        </p>
                        <ul class="list-disc list-inside mt-3 space-y-2 text-gray-700">
                            <li><strong>Satu Akun, Satu Suara:</strong> Setiap akun mahasiswa hanya dapat memberikan satu suara. Sistem akan otomatis menolak login ganda atau percobaan voting ulang.</li>
                            <li><strong>Kerahasiaan:</strong> Pilihan pemilih bersifat rahasia. Data suara pada database telah melalui proses *hash*, sehingga tidak ada pihak mana pun yang dapat mengetahui pilihan pemilih.</li>
                        </ul>
                    </div>
                </details>

                <!-- FAQ 6: Penutupan -->
                <details class="group border border-gray-200 rounded-lg overflow-hidden">
                    <summary class="flex justify-between items-center p-5 cursor-pointer hover:bg-gray-50 transition">
                        <span class="font-semibold text-gray-800 text-lg">Apa yang terjadi setelah pemilihan ditutup?</span>
                        <svg class="chevron w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="p-5 border-t border-gray-100 bg-gray-50">
                        <p class="text-gray-700 leading-relaxed">
                            Setelah pemungutan suara ditutup, panitia akan melakukan verifikasi dan rekapitulasi akhir untuk memastikan seluruh data valid sebelum hasil resmi diumumkan.
                        </p>
                    </div>
                </details>

            </div>
        </div>

    </main>

    <!-- Footer Sederhana -->
    <footer class="mt-12 mb-8 text-center">
        <p class="text-sm text-gray-500">© {{ date('Y') }} Himpunan Mahasiswa Teknik Informatika - UNIKOM</p>
    </footer>

</body>

</html>
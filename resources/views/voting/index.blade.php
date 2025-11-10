<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/pilkahim.png') }}">
    <title>Voting - PILKAHIMIF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahan animasi sederhana untuk modal */
        #confirmationModal {
            transition: opacity 0.3s ease;
        }

        #confirmationModal .modal-content {
            transition: transform 0.3s ease;
        }

        #confirmationModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #confirmationModal.hidden .modal-content {
            transform: scale(0.95);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-5xl mx-auto py-12 px-4">

        <h1 class="text-4xl md:text-5xl font-extrabold text-center mb-4 text-gray-800 tracking-tight">
            Pemilihan Ketua & Wakil
        </h1>
        <p class="text-center text-gray-600 mb-12 text-lg">
            Silakan tentukan pilihan Anda dengan bijak.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">

            @foreach ($paslon as $p)
            <!-- Kartu Paslon -->
            <div class="bg-white shadow-xl rounded-3xl overflow-hidden flex flex-col transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500 hover:-translate-y-2 border border-gray-100">


                <!-- Foto Paslon -->
                <div class="relative aspect-square bg-gray-200">
                    @if($p->foto)
                    <img src="{{ asset('storage/' . $p->foto) }}" alt="Paslon {{ $p->nomor_urut }}" class="w-full h-full object-cover">
                    @else
                    <!-- Placeholder jika tidak ada foto -->
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif

                    <!-- Badge Nomor Urut -->
                    <div class="absolute top-4 right-4 bg-blue-600 text-white font-extrabold text-xl w-12 h-12 flex items-center justify-center rounded-full shadow-lg border-4 border-white">
                        {{ $p->nomor_urut }}
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow">

                    <!-- Nama Kandidat -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 leading-tight">
                            {{ $p->calon_ketua }}
                        </h2>
                        <span class="text-gray-400 font-medium text-sm">&</span>
                        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
                            {{ $p->calon_wakil_ketua }}
                        </h2>
                    </div>
                    <div class="my-8">
                        <a
                            href="{{ $p->link_perkenalan }}"
                            target="_blank"
                            class="w-full py-3 px-6 bg-gray-50 hover:bg-gray-100 border-2 border-gray-200 hover:border-gray-300 text-gray-700 font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center group">

                            <svg class="w-6 h-6 mr-2 text-red-500 opacity-80 group-hover:opacity-100 transition-opacity"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>

                            <span>Video Perkenalan</span>
                        </a>
                    </div>

                    <!-- Visi Misi -->
                    <div class="space-y-4 text-sm text-gray-700 mb-8 flex-grow bg-gray-50 p-4 rounded-xl">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Visi
                            </h3>
                            <div class="line-clamp-7 opacity-80 leading-relaxed">
                                {!! $p->visi !!}
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Misi
                            </h3>
                            <div class="line-clamp-30 opacity-80 leading-relaxed">
                                {!! $p->misi !!}
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Aksi -->
                    <div class="mt-auto">
                        @if(!auth()->user()->has_voted)
                        <!-- 
                                BUTTON TRIGGER MODAL 
                                Perhatikan atribut 'onclick' yang mengirim data paslon ke fungsi JS
                            -->
                        <button
                            type="button"
                            onclick="openModal('{{ $p->id }}', '{{ $p->nomor_urut }}', '{{ addslashes($p->calon_ketua) }}', '{{ addslashes($p->calon_wakil_ketua) }}')"
                            class="w-full py-4 px-6 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform hover:scale-[1.02] focus:ring-4 focus:ring-blue-500/50 active:scale-95 flex items-center justify-center group">
                            <span>PILIH PASLON {{ $p->nomor_urut }}</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                        @else
                        <div class="w-full py-3 px-4 bg-gray-100 text-gray-500 font-semibold rounded-xl text-center border-2 border-gray-200 cursor-not-allowed flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Anda sudah memilih
                        </div>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- ================= MODAL KONFIRMASI ================= -->
    <div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center px-4 hidden">

        <!-- Overlay Gelap (Background) -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

        <!-- Konten Modal -->
        <div class="modal-content bg-white rounded-3xl shadow-2xl max-w-md w-full relative z-10 overflow-hidden transform transition-all p-8 text-center">

            <!-- Ikon Tanya -->
            <div class="mx-auto w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">
                Konfirmasi Pilihan
            </h3>
            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin memberikan suara untuk paslon nomor urut <span id="modalNomor" class="font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded"></span>?
            </p>

            <!-- Detail Paslon yang Dipilih -->
            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 mb-8">
                <div class="text-lg font-bold text-gray-900" id="modalKetua"></div>
                <div class="text-sm text-gray-500 my-1">&</div>
                <div class="text-lg font-bold text-gray-900" id="modalWakil"></div>
            </div>

            <!-- Tombol Aksi Modal -->
            <div class="flex gap-3">
                <!-- Tombol Batal -->
                <button type="button" onclick="closeModal()" class="flex-1 py-3 px-4 bg-white border-2 border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                    Batal
                </button>

                <!-- Form Submit Sebenarnya -->
                <form action="{{ route('voting.submit') }}" method="POST" class="flex-1">
                    @csrf
                    <!-- Input hidden ini akan diisi oleh Javascript -->
                    <input type="hidden" name="candidate_id" id="modalCandidateId" value="">

                    <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg shadow-blue-500/30">
                        Ya, Saya Yakin!
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPT UNTUK MENGATUR MODAL -->
    <script>
        const modal = document.getElementById('confirmationModal');
        const modalNomor = document.getElementById('modalNomor');
        const modalKetua = document.getElementById('modalKetua');
        const modalWakil = document.getElementById('modalWakil');
        const modalCandidateId = document.getElementById('modalCandidateId');

        // Fungsi Membuka Modal & Mengisi Data
        function openModal(id, nomor, ketua, wakil) {
            // Isi data ke dalam elemen modal
            modalNomor.textContent = nomor;
            modalKetua.textContent = ketua;
            modalWakil.textContent = wakil;
            modalCandidateId.value = id; // Penting: set value input hidden

            // Tampilkan modal
            modal.classList.remove('hidden');
            // Tambahkan sedikit delay agar transisi CSS (opacity) berjalan halus
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modal.querySelector('.modal-content').classList.add('scale-100');
            }, 10);
        }

        // Fungsi Menutup Modal
        function closeModal() {
            modal.classList.remove('opacity-100');
            modal.querySelector('.modal-content').classList.remove('scale-100');

            // Tunggu transisi selesai baru sembunyikan (display: none)
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Sesuaikan dengan durasi transition CSS (0.3s = 300ms)
        }

        // Tutup modal jika tombol ESC ditekan
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape" && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>

</body>

</html>
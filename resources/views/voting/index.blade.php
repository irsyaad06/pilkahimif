<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto py-12 px-4">

        <h1 class="text-4xl font-extrabold text-center mb-10 text-gray-800 tracking-tight">
            Pilih Pasangan Calon Anda
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @foreach ($paslon as $p)
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">

                <div class="aspect-square">
                    <img src="{{ $p->foto }}" alt="Foto Paslon: {{ $p->calon_ketua }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="p-6 flex flex-col flex-grow">

                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-4">
                        {{ $p->calon_ketua }} &<br> {{ $p->calon_wakil_ketua }}
                    </h2>

                    <div class="space-y-4 text-sm text-gray-700 mb-6 flex-grow">
                        <div>
                            <h3 class="font-semibold text-base text-gray-800 mb-1">Visi:</h3>
                            <p class="line-clamp-3">
                                {{ $p->visi }}
                            </p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-base text-gray-800 mb-1">Misi:</h3>
                            <p class="line-clamp-4">
                                {{ $p->misi }}
                            </p>
                        </div>
                    </div>

                    @if(!auth()->user()->has_voted)
                    <form action="{{ route('voting.submit') }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="candidate_id" value="{{ $p->id }}">

                        <button
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            PILIH PASLON {{ $p->nomor_urut }}
                        </button>
                    </form>
                    @else
                    <p class="text-center text-red-600 font-semibold mt-4">
                        Anda sudah melakukan voting ✅
                    </p>
                    @endif

                </div> </div> @endforeach

        </div>
    </div>

</body>

</html>
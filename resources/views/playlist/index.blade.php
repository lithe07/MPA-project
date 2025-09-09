<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn Playlist</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-end gap-4">
        <a href="{{ route('songs.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Home</a>
    </nav>

    <main class="p-8 max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">🎧 Mijn Playlist</h1>

        @if ($songs->count() > 0)
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($songs as $song)
                    <li class="bg-gray-100 p-4 rounded shadow text-center">
                        <h2 class="text-xl font-semibold mb-1">{{ $song->name }}</h2>
                        <p class="text-gray-600">{{ $song->artist }} ({{ $song->duration }})</p>
                        <p class="text-gray-500 mb-2">{{ $song->genre->name }}</p>
                        <a href="{{ route('playlist.remove', $song->id) }}" class="text-red-600 hover:underline">Verwijder</a>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6">
                <p class="text-lg font-medium">⏱️ Totale duur: 
                    <span class="font-bold">
                        {{ floor($totalDuration / 60) }}:{{ str_pad($totalDuration % 60, 2, '0', STR_PAD_LEFT) }} minuten
                    </span>
                </p>
            </div>
        @else
            <p class="text-gray-500">Je playlist is nog leeg. Voeg liedjes toe via de homepagina.</p>
        @endif
    </main>

</body>
</html>
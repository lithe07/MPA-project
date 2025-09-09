<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Alle Liedjes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-end gap-4">
        <a href="{{ route('playlist.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Playlist</a>
    </nav>

    <main class="p-8 max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">🎵 Alle Liedjes</h1>

        <!-- Genre Filter -->
        <form method="GET" action="{{ route('songs.index') }}" class="mb-8">
            <label for="genre" class="block mb-2 text-sm font-medium">Filter op genre:</label>
            <select name="genre" id="genre" class="border rounded px-4 py-2 w-full max-w-xs">
                <option value="">Alle genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Toon
            </button>
        </form>

        <!-- Song Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($songs as $song)
                <div class="bg-gray-100 rounded shadow p-4 flex flex-col items-center text-center">
                    <h2 class="text-lg font-semibold mb-1">{{ $song->name }}</h2>
                    <p class="text-gray-600">{{ $song->artist }} • {{ $song->duration }}</p>
                    <p class="text-gray-500 mb-3">{{ $song->genre->name }}</p>

                    <!-- Detail Link -->
                    <a href="{{ route('songs.show', $song->id) }}" class="text-blue-600 underline mb-2">
                        Bekijk details
                    </a>

                    <!-- Voeg toe knop -->
                    <a href="{{ route('playlist.add', $song->id) }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                        Voeg toe aan playlist
                    </a>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
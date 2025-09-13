<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Playlist bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-between">
        <h1 class="font-bold">Jukebox</h1>
        <div class="flex gap-4">
            <a href="{{ route('songs.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100">Home</a>
            <a href="{{ route('playlist.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100">Playlist</a>
            <a href="{{ route('saved.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100">Mijn Playlists</a>
        </div>
    </nav>

    <main class="p-8 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">✏️ Playlist bewerken: {{ $savedList->name }}</h1>

        <!-- ✅ Formulier om naam aan te passen -->
        <form method="POST" action="{{ route('saved.update', $savedList->id) }}" class="mb-8">
            @csrf
            @method('PATCH')

            <label for="name" class="block text-sm font-medium mb-2">Nieuwe naam</label>
            <input type="text" id="name" name="name" value="{{ $savedList->name }}" required
                   class="w-full border rounded px-4 py-2 mb-4">

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Opslaan
            </button>
        </form>

        <!-- ✅ Lijst met liedjes in dit album -->
        <h2 class="text-xl font-semibold mb-4">🎵 Liedjes in dit album</h2>
        @if($savedList->songs->isEmpty())
            <p class="text-gray-600">Nog geen liedjes toegevoegd aan dit album.</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($savedList->songs as $song)
                    <li class="bg-white border rounded p-4 shadow text-center">
                        <h3 class="font-semibold">{{ $song->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $song->artist }} • {{ $song->duration }}</p>
                        <p class="text-xs text-gray-500 italic">{{ $song->genre->name }}</p>

                        <!-- ❌ Liedje verwijderen knop -->
                        <form action="{{ route('saved.removeSong', [$savedList->id, $song->id]) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 w-full">
                                ❌ Verwijder dit liedje
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>{{ $savedList->name }} - Playlist</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-between">
        <div class="font-bold text-lg">Jukebox</div>
        <div class="flex gap-4">
            <a href="{{ route('songs.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Home</a>
            <a href="{{ route('playlist.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Playlist</a>
            <a href="{{ route('saved.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Mijn Albums</a>
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Dashboard</a>
        </div>
    </nav>

    <main class="p-8 max-w-4xl mx-auto">
        <!-- Titel -->
        <h1 class="text-3xl font-bold mb-6">📀 Album: {{ $savedList->name }}</h1>

        <!-- Info -->
        <p class="text-gray-600 mb-4">
            Aangemaakt op: {{ $savedList->created_at->format('d-m-Y H:i') }} <br>
            Totaal: {{ $savedList->songs->count() }} liedjes
        </p>

        @if($savedList->songs->isEmpty())
            <p class="text-gray-500">Er zitten nog geen liedjes in dit album.</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($savedList->songs as $song)
                    <li class="border rounded bg-gray-50 p-4 shadow flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $song->name }}</h2>
                            <p class="text-gray-600">{{ $song->artist }} • {{ $song->duration }}</p>
                            <p class="text-sm text-gray-500 italic">{{ $song->genre->name }}</p>
                        </div>

                        <!-- Verwijderknop -->
                        <form action="{{ route('saved.removeSong', [$savedList->id, $song->id]) }}" 
                              method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                                ❌ Verwijder uit album
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Terug knop -->
        <div class="mt-6">
            <a href="{{ route('saved.index') }}" 
               class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">
                ⬅️ Terug naar mijn albums
            </a>
        </div>
    </main>
</body>
</html>
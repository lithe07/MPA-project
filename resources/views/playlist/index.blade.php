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
        <a href="{{ route('playlist.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Playlist</a>
        @auth
            <a href="{{ route('saved.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Mijn Playlists</a>
        @endauth
        <a href="{{ route('dashboard') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Dashboard</a>
    </nav>

    <main class="p-8 max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">🎧 Mijn Playlist</h1>

        @if ($playlist->isEmpty())
            <p class="text-gray-600">
                Je playlist is nog leeg. Voeg liedjes toe via de 
                <a href="{{ route('songs.index') }}" class="text-blue-600 underline">homepagina</a>.
            </p>
        @else
            <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($playlist as $song)
                    <li class="bg-gray-100 p-4 rounded shadow text-center">
                        <h2 class="text-xl font-semibold">{{ $song['name'] }}</h2>
                        <p class="text-gray-600">{{ $song['artist'] }} • {{ $song['duration'] }}</p>
                        <p class="text-sm mt-1 text-gray-500 italic">{{ $song['genre']['name'] }}</p>

                        <form action="{{ route('playlist.remove', $song['id']) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                                Verwijder
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <div class="mt-8 p-4 border-t">
                <p class="text-lg font-semibold">Totale duur: {{ $totalDuration }}</p>
            </div>

            <div class="mt-10 p-4 bg-white rounded shadow border max-w-md mx-auto">
                @auth
                    <h2 class="text-xl font-semibold mb-4">🎵 Playlist opslaan</h2>
                    <form action="{{ route('playlist.save') }}" method="POST">
                        @csrf
                        <label for="name" class="block mb-2 text-sm font-medium">Naam van playlist:</label>
                        <input type="text" name="name" id="name" required class="w-full px-4 py-2 border rounded mb-4" placeholder="Bijv. Mijn favoriete nummers">

                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
                            ✅ Opslaan
                        </button>
                    </form>
                @endauth

                @guest
                    <h2 class="text-xl font-semibold mb-4">🎵 Playlist opslaan</h2>
                    <p class="text-gray-600 mb-4">Om je playlist op te slaan, log eerst in of maak een account aan.</p>
                    <form method="GET" action="{{ route('login') }}">
                        <input type="hidden" name="redirect_to_save" value="1">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                            🔐 Inloggen om playlist op te slaan
                        </button>
                    </form>
                @endguest
            </div>
        @endif
    </main>
</body>
</html>
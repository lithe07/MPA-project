<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Alle Liedjes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <x-navbar />

    <main class="p-8 max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">🎶 Alle Liedjes</h1>

        <!-- Genre Dropdown -->
        <form method="GET" action="{{ route('songs.index') }}" class="mb-6">
            <label for="genre" class="block mb-2 text-sm font-medium">Filter op genre:</label>
            <div class="flex gap-2">
                <select name="genre" id="genre" class="border rounded px-4 py-2">
                    <option value="">Alle genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Toon</button>
            </div>
        </form>

        <!-- Songs Grid -->
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($songs as $song)
                <div class="bg-gray-50 border rounded shadow-sm p-4 flex flex-col items-center text-center">
                    <img src="https://via.placeholder.com/150" alt="{{ $song->name }}" class="w-32 h-32 object-cover rounded mb-4" />
                    
                    <a href="{{ route('songs.show', $song->id) }}" class="text-lg font-semibold text-blue-800 hover:underline">
                        {{ $song->name }}
                    </a>
                    <p class="text-sm text-gray-600">{{ $song->artist }} • {{ $song->duration }}</p>
                    <p class="text-sm text-gray-500 italic mt-1">{{ $song->genre->name }}</p>

                    <form action="{{ route('playlist.add', $song->id) }}" method="POST" class="mt-4 w-full">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                            Voeg toe aan playlist
                        </button>
                    </form>
                </div>
            @endforeach
        </section>
    </main>
</body>
</html>
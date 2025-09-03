<!DOCTYPE html>
<html>
<head>
    <title>Alle Liedjes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans max-w-4xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-6">Alle Liedjes 🎵</h1>

    <!-- Genre Filter Formulier -->
    <form method="GET" action="{{ route('songs.index') }}" class="mb-6">
        <label for="genre" class="block mb-2 text-sm font-medium">Filter op genre:</label>
        <select name="genre" id="genre" class="border rounded px-4 py-2">
            <option value="">Alle genres</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Toon</button>
    </form>

    <!-- Song List -->
    <ul class="space-y-4">
        @foreach($songs as $song)
            <li>
                <a href="{{ route('songs.show', $song->id) }}">
                    <strong>{{ $song->name }}</strong>
                </a> – 
                {{ $song->artist }} 
                ({{ $song->duration }}) 
                [{{ $song->genre->name }}]
            </li>
        @endforeach
    </ul>

</body>
</html>
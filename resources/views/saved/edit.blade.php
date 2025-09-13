<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Playlist bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-between">
        <a href="{{ route('saved.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
            ⬅️ Terug
        </a>
    </nav>

    <main class="p-8 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">✏️ Playlist bewerken: {{ $savedList->name }}</h1>

        <!-- Formulier om naam te wijzigen -->
        <form method="POST" action="{{ route('saved.update', $savedList->id) }}" class="mb-8 space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block font-medium mb-1">Nieuwe naam:</label>
                <input type="text" id="name" name="name" value="{{ $savedList->name }}" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                ✅ Opslaan
            </button>
        </form>

        <!-- Overzicht van liedjes in de playlist -->
        <h2 class="text-xl font-semibold mb-4">🎶 Liedjes in dit album</h2>

        @if($savedList->songs->isEmpty())
            <p class="text-gray-600">Er staan nog geen liedjes in dit album.</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($savedList->songs as $song)
                    <li class="border rounded bg-white p-4 shadow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $song->name }}</h3>
                            <p class="text-gray-600">{{ $song->artist }} • {{ $song->duration }}</p>
                            <p class="text-sm text-gray-500 italic">{{ $song->genre->name }}</p>
                        </div>

                        <!-- ❌ Verwijderknop -->
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
    </main>
</body>
</html>
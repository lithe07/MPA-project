<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn opgeslagen playlists</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-end gap-4">
        <a href="{{ route('songs.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Home</a>
        <a href="{{ route('playlist.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Playlist</a>
        <a href="{{ route('dashboard') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Dashboard</a>
        <a href="{{ route('saved.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Mijn Playlists</a>
    </nav>

    <main class="p-8 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">📁 Mijn opgeslagen playlists</h1>

        @if($savedLists->isEmpty())
            <p class="text-gray-600">Je hebt nog geen playlists opgeslagen.</p>
        @else
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($savedLists as $list)
                    <li class="border rounded bg-gray-50 p-4 shadow flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-semibold mb-2">{{ $list->name }}</h2>
                            <p class="text-sm text-gray-500 mb-1">Aangemaakt op: {{ $list->created_at->format('d-m-Y H:i') }}</p>
                            <p class="text-sm text-gray-500 mb-4">{{ $list->songs->count() }} liedjes</p>
                        </div>

                        <div class="flex gap-2">
                            <!-- ✏️ Bewerken knop -->
                            <a href="{{ route('saved.edit', $list->id) }}" 
                               class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                ✏️ Bewerken
                            </a>

                            <!-- ❌ Verwijderen knop -->
                            <form action="{{ route('saved.destroy', $list->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze playlist wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    ❌ Verwijderen
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>

</body>
</html>
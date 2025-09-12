<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Playlist opslaan</title>
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

    <main class="p-8 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">📁 Playlist opslaan</h1>

        <form method="POST" action="{{ route('playlist.save') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium mb-1">Naam van je playlist:</label>
                <input type="text" id="name" name="name" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300"
                       placeholder="Bijvoorbeeld: Mijn workout muziek" />
            </div>

            @if ($errors->any())
                <div class="text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">
                ✅ Playlist opslaan
            </button>
        </form>
    </main>
</body>
</html>
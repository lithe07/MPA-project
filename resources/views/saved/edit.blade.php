<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Playlist bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white px-6 py-3 flex justify-end gap-4">
        <a href="{{ route('saved.index') }}" class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">Terug</a>
    </nav>

    <main class="p-8 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-6">✏️ Playlist bewerken</h1>

        <form method="POST" action="{{ route('saved.update', $savedList->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium mb-1">Nieuwe naam:</label>
                <input type="text" id="name" name="name" value="{{ $savedList->name }}" required
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                ✅ Opslaan
            </button>
        </form>
    </main>
</body>
</html>
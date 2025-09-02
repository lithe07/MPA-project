<!DOCTYPE html>
<html>
<head>
  <title>{{ $song->name }} - Detail</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $song->name }}</h1>

    <p><strong>Artiest:</strong> {{ $song->artist }}</p>
    <p><strong>Duur:</strong> {{ $song->duration }}</p>
    <p><strong>Genre:</strong> {{ $song->genre->name }}</p>

    <a href="/songs" class="inline-block mt-6 text-blue-600 hover:underline">← Terug naar alle liedjes</a>
  </div>

</body>
</html>
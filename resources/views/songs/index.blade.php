<!DOCTYPE html>
<html>
<head>
    <title>Alle Liedjes</title>
</head>
<body>
    <h1>Alle Liedjes 🎵</h1>
    <ul>
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
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
                <strong>{{ $song->name }}</strong> – 
                {{ $song->artist }} 
                ({{ $song->duration }}) 
                [{{ $song->genre->name }}]
            </li>
        @endforeach
    </ul>
</body>
</html>
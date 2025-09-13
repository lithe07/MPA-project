<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-blue-900 text-white px-6 py-3 flex justify-between items-center">
    <div class="font-bold text-lg">🎵 Jukebox</div>
    <div class="flex gap-4">
        <a href="{{ route('songs.index') }}" 
           class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
           Home
        </a>

        <a href="{{ route('playlist.index') }}" 
           class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
           Playlist
        </a>

        @auth
            <a href="{{ route('saved.index') }}" 
               class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
               Mijn Albums
            </a>

            @if (!request()->routeIs('dashboard'))
                <a href="{{ route('dashboard') }}" 
                   class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
                   Dashboard
                </a>
            @endif

            <!-- Uitloggen -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 font-medium">
                    Uitloggen
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" 
               class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
               Inloggen
            </a>
            <a href="{{ route('register') }}" 
               class="bg-white text-blue-900 px-4 py-2 rounded hover:bg-gray-100 font-medium">
               Registreren
            </a>
        @endauth
    </div>
</nav>
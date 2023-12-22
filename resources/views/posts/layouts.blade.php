<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js']);
</head>
<body>
    <nav>
        @if(auth()->check())
            <a href="{{ route('posts.create') }}">Create Post</a>
        @endif

        <!-- Add more navigation links as needed -->
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>

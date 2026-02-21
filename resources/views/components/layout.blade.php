<!-- resources/views/components/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <title>Readers</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-50">

<!-- Navbar -->
<header class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <a href="/" class="flex items-center">
                <x-application-logo class="h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
            <a href="/" class="text-2xl font-bold">Readers</a>
        </div>

        <nav>
            <ul class="flex space-x-6 items-center">
                <li><a href="{{ route('home') }}" class="hover:text-indigo-400">Home</a></li>
                @auth
                    <li><a href="{{ route('books.create') }}" class="hover:text-indigo-400">Add Book</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-indigo-400">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hover:text-indigo-400">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-indigo-400">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-indigo-400">Register</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<!-- Main content -->
<main>
    {{ $slot }}
</main>

<!-- Footer (optional) -->
<footer>
    {{ $footer ?? '' }}
</footer>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

</body>
</html>

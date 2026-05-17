<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Connexion') — MonBlog</title>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center px-4 antialiased">

    @yield('content')

    @stack('scripts')
</body>

</html>

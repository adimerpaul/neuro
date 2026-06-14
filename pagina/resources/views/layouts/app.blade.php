<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', '4ta Jornada Nacional de Neurología · 2do Simposio Internacional — Oruro, Bolivia')</title>
<meta name="description" content="@yield('description', '4ta Jornada Nacional de Neurología y 2do Simposio Internacional de Emergencias Neurológicas. Oruro, Bolivia 2023.')">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Mulish:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@yield('content')
</body>
</html>

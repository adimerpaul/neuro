<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'NeuroOruro 2026 · Simposio Internacional Enfermedad Cerebrovascular + Seminario Código Ictus — Oruro, Bolivia')</title>
<meta name="description" content="@yield('description', '1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura y 1er Seminario-Taller Código Ictus y Manejo Hospitalario. Oruro, Bolivia — 23, 24 y 25 de julio de 2026. Modalidad Híbrida.')">
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Iniciar sesión — NeuroOruro 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Mulish', sans-serif;
            background: linear-gradient(135deg, #0d0003 0%, #3d0010 60%, #1a0006 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .back-link {
            position: fixed;
            top: 1.5rem;
            left: 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s;
        }
        .back-link:hover { color: #fff; }
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 500px;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            margin: 2rem;
        }
        .login-brand {
            flex: 1;
            background: linear-gradient(160deg, #c0392b 0%, #7b1a1a 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            text-align: center;
        }
        .brand-logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }
        .brand-title {
            font-family: 'Sora', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }
        .brand-subtitle {
            color: rgba(255,255,255,0.75);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .brand-badge {
            margin-top: 2rem;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 2rem;
            padding: 0.5rem 1.25rem;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .login-form-wrap {
            flex: 1;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
        }
        .form-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d0003;
            margin-bottom: 0.5rem;
        }
        .form-subtitle {
            color: #666;
            font-size: 0.875rem;
            margin-bottom: 2rem;
        }
        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            color: #b91c1c;
            font-size: 0.875rem;
        }
        .field-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.4rem;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #d1d5db;
            border-radius: 0.5rem;
            font-family: 'Mulish', sans-serif;
            font-size: 1rem;
            color: #111;
            transition: border-color 0.2s;
            outline: none;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #c0392b;
            box-shadow: 0 0 0 3px rgba(192,57,43,0.12);
        }
        input.has-error { border-color: #f87171; }
        .field-error { color: #ef4444; font-size: 0.8rem; margin-top: 0.3rem; }
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .remember-row input[type="checkbox"] { accent-color: #c0392b; }
        .remember-row label { margin: 0; font-weight: 400; color: #555; font-size: 0.875rem; }
        .btn-submit {
            width: 100%;
            background: #c0392b;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.875rem;
            font-family: 'Sora', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-submit:hover { background: #a93226; }
        .btn-submit:active { transform: scale(0.99); }
        @media (max-width: 640px) {
            .login-brand { display: none; }
            .login-form-wrap { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>
    <a href="/" class="back-link">&#8592; Volver al sitio</a>

    <div class="login-wrapper">
        <div class="login-brand">
            <div class="brand-logo">🧠</div>
            <div class="brand-title">NeuroOruro<br>2026</div>
            <div class="brand-subtitle">
                1er Simposio Internacional de<br>Enfermedad Cerebrovascular<br>en la Altura
            </div>
            <div class="brand-badge">Oruro, Bolivia · 23-25 Jul 2026</div>
        </div>

        <div class="login-form-wrap">
            <div class="form-title">Iniciar sesión</div>
            <div class="form-subtitle">Ingresa con tus credenciales de participante</div>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="field-group">
                    <label for="nickname">Usuario (nickname)</label>
                    <input
                        type="text"
                        id="nickname"
                        name="nickname"
                        value="{{ old('nickname') }}"
                        class="{{ $errors->has('nickname') ? 'has-error' : '' }}"
                        placeholder="tu_usuario"
                        autocomplete="username"
                        autofocus
                    />
                    @error('nickname')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                    />
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember"/>
                    <label for="remember">Recordarme</label>
                </div>

                <button type="submit" class="btn-submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>

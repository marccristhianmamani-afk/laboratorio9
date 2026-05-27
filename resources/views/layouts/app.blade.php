<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ProductosApp') | DAI</title>
    <style>
        /* ─────────────────────────────
   PALETA MINIMALISTA FEMBOY
───────────────────────────── */
        :root {
            --bg: #f7f1eb;
            --bg-soft: #fffaf7;

            --pink: #e8b7c8;
            --pink-soft: #f6d9e4;

            --brown: #9d7b6d;
            --brown-dark: #6f554b;

            --beige: #efe1d3;

            --text: #5f4b45;
            --text-light: #8b7168;

            --border: #eadfd6;

            --shadow:
                0 8px 24px rgba(157, 123, 109, .12);

            --radius: 18px;

            --gradient:
                linear-gradient(135deg,
                    #f6d9e4,
                    #efe1d3);
        }

        /* ─────────────────────────────
   RESET
───────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:
                linear-gradient(180deg,
                    #fffaf7 0%,
                    #f7f1eb 100%);

            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: var(--brown);
            transition: .25s;
        }

        a:hover {
            color: var(--brown-dark);
        }

        /* ─────────────────────────────
   NAVBAR
───────────────────────────── */
        .navbar {
            background:
                rgba(255, 255, 255, .75);

            backdrop-filter: blur(12px);

            border-bottom:
                1px solid var(--border);

            padding: 1rem 2rem;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow:
                0 4px 14px rgba(0, 0, 0, .04);
        }

        .navbar .brand {
            font-size: 1.5rem;
            font-weight: 700;

            color: var(--brown-dark);

            letter-spacing: .5px;
        }

        .navbar .brand span {
            color: var(--pink);
        }

        .navbar nav a {
            margin-left: 1rem;

            color: var(--text);

            font-weight: 500;

            position: relative;
        }

        .navbar nav a::after {
            content: '';

            position: absolute;
            left: 0;
            bottom: -4px;

            width: 0%;
            height: 2px;

            background: var(--pink);

            transition: .3s;
        }

        .navbar nav a:hover::after {
            width: 100%;
        }

        /* ─────────────────────────────
   BOTONES
───────────────────────────── */
        .btn {
            border: none;

            border-radius: 999px;

            padding: .65rem 1.3rem;

            font-weight: 600;

            transition: .3s ease;
        }

        .btn-primary {
            background: var(--gradient);
            color: var(--brown-dark);
        }

        .btn-primary:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(232, 183, 200, .25);
        }

        .btn-success {
            background: #d7eadf;
            color: #55715d;
        }

        .btn-success:hover {
            background: #c7dfd0;
        }

        .btn-danger {
            background: #f5d2d8;
            color: #8b4d58;
        }

        .btn-danger:hover {
            background: #ecc2ca;
        }

        .btn-outline {
            background: transparent;

            border: 1.5px solid var(--pink);

            color: var(--brown-dark);
        }

        .btn-outline:hover {
            background: var(--pink-soft);
        }

        /* ─────────────────────────────
   CONTENIDO
───────────────────────────── */
        .main-content {
            max-width: 1200px;

            margin: 2rem auto;

            padding: 0 1.5rem;
        }

        /* ─────────────────────────────
   TARJETAS
───────────────────────────── */
        .card,
        .producto-card {
            background: rgba(255, 255, 255, .82);

            border:
                1px solid var(--border);

            border-radius: var(--radius);

            overflow: hidden;

            box-shadow: var(--shadow);

            transition: .3s ease;
        }

        .producto-card:hover {
            transform:
                translateY(-6px);

            box-shadow:
                0 12px 30px rgba(157, 123, 109, .16);
        }

        .producto-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;

            transition: .4s;
        }

        .producto-card:hover img {
            transform: scale(1.04);
        }

        .producto-card .no-foto {
            width: 100%;
            height: 220px;

            background: #f4ebe4;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--text-light);
        }

        .producto-card .card-body {
            padding: 1.2rem;

            display: flex;
            flex-direction: column;

            flex-grow: 1;
        }

        .producto-card h3 {
            font-size: 1.05rem;

            margin-bottom: .3rem;

            color: var(--brown-dark);
        }

        .producto-card .marca {
            color: var(--text-light);

            font-size: .88rem;
        }

        .producto-card .precio {
            margin-top: auto;

            font-size: 1.3rem;
            font-weight: 700;

            color: var(--brown);
        }

        .producto-card .card-footer {
            padding: 1rem;

            border-top:
                1px solid var(--border);

            background: #fffaf8;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: .5rem;
        }

        /* ─────────────────────────────
   GRID
───────────────────────────── */
        .galeria-grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fill, minmax(240px, 1fr));

            gap: 1.6rem;

            margin-top: 1.5rem;
        }

        /* ─────────────────────────────
   BADGES
───────────────────────────── */
        .badge-categoria {
            background: #f6d9e4;

            color: var(--brown-dark);

            padding: .35rem .8rem;

            border-radius: 999px;

            font-size: .76rem;
            font-weight: 600;
        }

        .badge-stock-ok {
            background: #d8eadc;
            color: #55715d;
        }

        .badge-stock-warn {
            background: #f5e5cf;
            color: #a37339;
        }

        .badge-stock-low {
            background: #f5d2d8;
            color: #8b4d58;
        }

        /* ─────────────────────────────
   TABLAS
───────────────────────────── */
        table {
            width: 100%;

            border-collapse: collapse;

            margin-top: 1rem;

            overflow: hidden;

            border-radius: 18px;

            background: white;

            box-shadow: var(--shadow);
        }

        th {
            background:
                linear-gradient(135deg,
                    #e8b7c8,
                    #efe1d3);

            color: var(--brown-dark);

            padding: .9rem 1rem;

            text-align: left;
        }

        td {
            padding: .85rem 1rem;

            border-bottom:
                1px solid var(--border);

            color: var(--text);
        }

        tr:hover td {
            background: #fff8f5;
        }

        /* ─────────────────────────────
   ALERTAS
───────────────────────────── */
        .alert {
            padding: 1rem 1.2rem;

            border-radius: 16px;

            margin-bottom: 1rem;

            border: none;
        }

        .alert-success {
            background: #dceee2;
            color: #4f6b58;
        }

        .alert-danger {
            background: #f7d8dd;
            color: #8b4d58;
        }

        .alert-info {
            background: #efe1d3;
            color: #7a6257;
        }

        /* ─────────────────────────────
   FORMULARIOS
───────────────────────────── */
        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;

            margin-bottom: .45rem;

            font-weight: 600;

            color: var(--brown-dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;

            padding: .8rem 1rem;

            border:
                1.5px solid var(--border);

            border-radius: 14px;

            background: white;

            color: var(--text);

            transition: .3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;

            border-color: var(--pink);

            box-shadow:
                0 0 0 4px rgba(232, 183, 200, .15);
        }

        .form-error {
            margin-top: .35rem;

            color: #b25f72;

            font-size: .84rem;
        }

        /* ─────────────────────────────
   FOOTER
───────────────────────────── */
        .site-footer {
            text-align: center;

            padding: 2rem;

            margin-top: 3rem;

            color: var(--text-light);

            border-top:
                1px solid var(--border);

            background:
                rgba(255, 255, 255, .5);
        }

        /* ─────────────────────────────
   ANIMACIONES SUAVES
───────────────────────────── */
        .card,
        .producto-card,
        .btn {
            animation: fadeUp .5s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─────────────────────────────
   RESPONSIVE
───────────────────────────── */
        @media(max-width:768px) {

            .navbar {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar nav {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .main-content {
                padding: 0 1rem;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('home') }}" class="brand">Productos<span>App</span></a>
        <nav>
            @auth
                <a href="{{ route('productos.galeria') }}">Galeria</a>
                <a href="{{ route('productos.index') }}">Productos</a>
                <a href="{{ route('categorias.index') }}">Categorias</a>
                <a href="{{ route('carrito.index') }}" class="carrito-btn">
                    Carrito
                    @if(session('carrito') && count(session('carrito')) > 0)
                        ({{ count(session('carrito')) }})
                    @endif
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="margin-left:1rem">
                        Cerrar sesion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar sesion</a>
            @endauth
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">

        {{-- Mensajes flash de sesion --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @yield('contenido')
    </div>

    <div class="site-footer">
        Desarrollo de Aplicaciones en Internet &mdash; Ciclo III &mdash; {{ date('Y') }}
    </div>

    @stack('scripts')
</body>

</html>
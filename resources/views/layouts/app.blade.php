<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard') - MotoService
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    {{-- Google Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --primary: #6f4e37;
            --primary-dark: #4b3325;
            --secondary: #c68b59;
            --cream: #f8f5f0;
            --white: #ffffff;
            --text: #2f2925;
            --muted: #8a817a;
            --border: #ebe5df;
            --success: #3f8f6b;
            --danger: #c95b5b;
            --shadow: 0 12px 35px rgba(77, 54, 38, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        a {
            text-decoration: none;
        }

        .app-wrapper {
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(
                180deg,
                #4b3325 0%,
                #6f4e37 100%
            );
            color: white;
            padding: 28px 18px;
            z-index: 1000;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 30px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgba(255,255,255,0.14);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .brand-text {
            line-height: 1.1;
        }

        .brand-text h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
        }

        .brand-text span {
            font-size: 10px;
            opacity: .7;
            letter-spacing: 1.5px;
        }

        .menu-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            opacity: .55;
            margin: 12px 12px 10px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 13px;
            color: rgba(255,255,255,.72);
            padding: 13px 14px;
            border-radius: 13px;
            transition: all .25s ease;
            font-size: 13px;
            font-weight: 600;
        }

        .nav-link-custom i {
            font-size: 17px;
            width: 22px;
            text-align: center;
        }

        .nav-link-custom:hover {
            color: white;
            background: rgba(255,255,255,.10);
            transform: translateX(4px);
        }

        .nav-link-custom.active {
            color: white;
            background: rgba(255,255,255,.15);
            box-shadow: inset 3px 0 0 var(--secondary);
        }

        /* MAIN */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 76px;
            background: rgba(255,255,255,.90);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 34px;
            position: sticky;
            top: 0;
            z-index: 900;
            backdrop-filter: blur(12px);
        }

        .page-location {
            color: var(--muted);
            font-size: 12px;
        }

        .page-location strong {
            color: var(--text);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
        }

        .profile-info {
            line-height: 1.2;
        }

        .profile-info strong {
            display: block;
            font-size: 12px;
        }

        .profile-info span {
            display: block;
            color: var(--muted);
            font-size: 10px;
        }

        /* CONTENT */
        .content {
            padding: 34px;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-header h1 {
            margin: 0 0 7px;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.7px;
        }

        .page-header p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        /* BUTTON */
        .btn-main {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 11px 17px;
            font-size: 12px;
            font-weight: 700;
            transition: all .25s ease;
            box-shadow: 0 8px 20px rgba(111,78,55,.18);
        }

        .btn-main:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(111,78,55,.25);
        }

        /* CARDS */
        .stat-card {
            border: 1px solid var(--border);
            background: white;
            border-radius: 20px;
            padding: 22px;
            box-shadow: var(--shadow);
            transition: transform .25s ease, box-shadow .25s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(77,54,38,.13);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1e8df;
            color: var(--primary);
            font-size: 20px;
        }

        .stat-number {
            font-size: 29px;
            font-weight: 800;
            margin-top: 17px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 11px;
            font-weight: 600;
        }

        /* TABLE CARD */
        .table-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-card-header {
            padding: 22px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-card-header h5 {
            margin: 0;
            font-size: 14px;
            font-weight: 800;
        }

        .table-responsive {
            padding: 0 20px 20px;
        }

        .table {
            margin: 0;
            vertical-align: middle;
        }

        .table thead th {
            color: var(--muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .7px;
            border-bottom: 1px solid var(--border);
            padding: 15px 10px;
            white-space: nowrap;
        }

        .table tbody td {
            font-size: 11px;
            padding: 16px 10px;
            border-bottom: 1px solid #f2eee9;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr {
            transition: background .2s ease;
        }

        .table tbody tr:hover {
            background: #fcfaf8;
        }

        /* FORM */
        .form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px;
            box-shadow: var(--shadow);
        }

        .form-label {
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            border: 1px solid #e4ddd6;
            border-radius: 11px;
            min-height: 44px;
            font-size: 12px;
            padding: 10px 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(198,139,89,.12);
        }

        textarea.form-control {
            min-height: 100px;
        }

        .form-hint {
            color: var(--muted);
            font-size: 10px;
            margin-top: 5px;
        }

        /* ALERT */
        .alert {
            border: none;
            border-radius: 14px;
            font-size: 12px;
            box-shadow: var(--shadow);
        }

        /* BADGE */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 10px;
            border-radius: 30px;
            font-size: 9px;
            font-weight: 700;
        }

        .status-success {
            color: #327253;
            background: #e5f2eb;
        }

        .status-warning {
            color: #8c6b2f;
            background: #f8efda;
        }

        .status-danger {
            color: #a64b4b;
            background: #f8e3e3;
        }

        /* ACTION BUTTON */
        .action-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            background: white;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            transition: all .2s ease;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* ANIMATION */
        .fade-up {
            animation: fadeUp .55s ease both;
        }

        .delay-1 {
            animation-delay: .08s;
        }

        .delay-2 {
            animation-delay: .16s;
        }

        .delay-3 {
            animation-delay: .24s;
        }

        .delay-4 {
            animation-delay: .32s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* MOBILE */
        @media (max-width: 991px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
            }

            .content {
                padding: 24px;
            }
        }

        @media (max-width: 767px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                padding: 0 18px;
            }

            .content {
                padding: 20px 15px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .profile-info {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="app-wrapper">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-scooter"></i>
            </div>

            <div class="brand-text">
                <h4>MotoService</h4>
                <span>Motor Service System</span>
            </div>
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <nav class="nav-menu">

            <a href="{{ route('dashboard') }}"
               class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('pelanggan.index') }}"
               class="nav-link-custom {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Pelanggan</span>
            </a>

            <a href="{{ route('kendaraan.index') }}"
               class="nav-link-custom {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                <i class="bi bi-scooter"></i>
                <span>Data Kendaraan</span>
            </a>

            <a href="{{ route('daftar-service.index') }}"
               class="nav-link-custom {{ request()->routeIs('daftar-service.*') ? 'active' : '' }}">
                <i class="bi bi-tools"></i>
                <span>Daftar Service</span>
            </a>

            <a href="{{ route('data-service.index') }}"
               class="nav-link-custom {{ request()->routeIs('data-service.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-check-fill"></i>
                <span>Data Service</span>
            </a>

            <a href="{{ route('pembayaran.index') }}"
               class="nav-link-custom {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-fill"></i>
                <span>Pembayaran Service</span>
            </a>

        </nav>

        <div class="menu-title mt-4">
            Sistem
        </div>

        <nav class="nav-menu">

            <a href="#" class="nav-link-custom">
                <i class="bi bi-person-circle"></i>
                <span>Profil</span>
            </a>

        </nav>

    </aside>

    {{-- MAIN --}}
    <main class="main-content">

        <header class="topbar">

            <div class="page-location">
                MotoService
                <span class="mx-1">/</span>
                <strong>@yield('breadcrumb', 'Dashboard')</strong>
            </div>

            <div class="profile">

                <div class="profile-avatar">
                    MS
                </div>

                <div class="profile-info">
                    <strong>Administrator</strong>
                    <span>Service Management</span>
                </div>

            </div>

        </header>

        <section class="content">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            {{-- ERROR --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            {{-- VALIDATION ERROR --}}
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        Data belum dapat disimpan.
                    </div>

                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </section>

    </main>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@stack('scripts')

</body>
</html>
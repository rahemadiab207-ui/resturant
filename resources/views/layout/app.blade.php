<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Restaurant System')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --dark: #111827;
            --background: #f8fafc;
            --card: #ffffff;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: 'Cairo', sans-serif;
        }

        a {
            text-decoration: none;
        }

        .main-navbar {
            background: var(--dark);
            box-shadow: 0 4px 20px rgba(15, 23, 42, .08);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 800;
            font-size: 21px;
        }

        .nav-link-modern {
            color: #d1d5db !important;
            padding: 10px 13px !important;
            border-radius: 9px;
            transition: .2s;
        }

        .nav-link-modern:hover {
            color: #fff !important;
            background: rgba(255,255,255,.08);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .page-title {
            font-size: 30px;
            font-weight: 800;
            margin: 0;
            color: var(--dark);
        }

        .page-subtitle {
            margin: 5px 0 0;
            color: var(--muted);
        }

        .card-modern {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .05);
            overflow: hidden;
        }

        .card-modern-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
        }

        .card-modern-header h5 {
            margin: 0;
            font-weight: 800;
        }

        .card-modern-body {
            padding: 24px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 8px 25px rgba(15,23,42,.04);
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(15,23,42,.08);
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        .stat-value {
            margin-top: 8px;
            color: var(--dark);
            font-size: 25px;
            font-weight: 800;
        }

        .btn-modern {
            border: 0;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-primary-modern {
            color: #fff;
            background: var(--primary);
        }

        .btn-primary-modern:hover {
            color: #fff;
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .form-control-modern,
        .form-select-modern {
            width: 100%;
            border: 1px solid var(--border);
            background: white;
            color: var(--text);
            border-radius: 10px;
            padding: 11px 13px;
            outline: none;
            transition: .2s;
        }

        .form-control-modern:focus,
        .form-select-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }

        .form-label-modern {
            display: block;
            margin-bottom: 7px;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
        }

        .table-modern {
            margin: 0;
        }

        .table-modern thead th {
            background: #f8fafc;
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
            border-bottom: 1px solid var(--border);
            padding: 15px;
        }

        .table-modern tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }

        .table-modern tbody tr {
            transition: .15s;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
        }

        .badge-modern {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-success-modern {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning-modern {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger-modern {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-primary-modern {
            background: #dbeafe;
            color: #1e40af;
        }

        footer {
            margin-top: 60px;
        }

        @media (max-width: 768px) {

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-title {
                font-size: 25px;
            }

            .chat-form {
                flex-direction: column;
            }

        }

    </style>

    @stack('styles')

</head>

<body>

<nav class="navbar navbar-expand-lg main-navbar">

    <div class="container">

        <a
            class="navbar-brand"
            href="{{ route('home') }}"
        >
            Restaurant System
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="mainNavigation"
        >

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @auth

                    @if(auth()->user()->isAdmin())

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('dashboard') }}"
                            >
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('categories') }}"
                            >
                                Categories
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('meals') }}"
                            >
                                Meals
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('beverages') }}"
                            >
                                Beverages
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('orders') }}"
                            >
                                Orders
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('customers') }}"
                            >
                                Customers
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('chatbot') }}"
                            >
                                AI Assistant
                            </a>
                        </li>

                    @else

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('home') }}"
                            >
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('customer.chatbot') }}"
                            >
                                AI Assistant
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('customer.preferences') }}"
                            >
                                Preferences
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('customer.recommendations') }}"
                            >
                                Recommendations
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link nav-link-modern"
                                href="{{ route('cart') }}"
                            >
                                Cart
                            </a>
                        </li>

                    @endif

                @else

                    <li class="nav-item">
                        <a
                            class="nav-link nav-link-modern"
                            href="{{ route('home') }}"
                        >
                            Home
                        </a>
                    </li>

                @endauth

            </ul>

            <ul class="navbar-nav">

                @auth

                    <li class="nav-item">
                        <a
                            class="nav-link nav-link-modern"
                            href="{{ route('profile') }}"
                        >
                            {{ auth()->user()->name }}
                        </a>
                    </li>

                    <li class="nav-item">

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="nav-link nav-link-modern bg-transparent border-0"
                            >
                                Logout
                            </button>

                        </form>

                    </li>

                @else

                    <li class="nav-item">
                        <a
                            class="nav-link nav-link-modern"
                            href="{{ route('login.form') }}"
                        >
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link nav-link-modern"
                            href="{{ route('register.form') }}"
                        >
                            Register
                        </a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>


<main>

    @if(session('success'))

        <div class="container mt-3">

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="container mt-3">

            <div class="alert alert-danger alert-dismissible fade show">

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        </div>

    @endif


    @if($errors->any())

        <div class="container mt-3">

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    @yield('content')

</main>


@include('layout.footer')


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

@stack('scripts')

</body>

</html>
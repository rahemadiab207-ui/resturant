<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'El Shamy Cafeteria')
    </title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            color: #222;
        }


        a {
            text-decoration: none;
        }


        .customer-navbar {

            width: 100%;
            min-height: 75px;

            background: #ffffff;

            border-bottom: 1px solid #e5e5e5;

            padding: 0 35px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            position: sticky;
            top: 0;

            z-index: 1000;
        }


        .brand {

            font-size: 24px;
            font-weight: bold;

            color: #8b4513;

            white-space: nowrap;
        }


        .nav-links {

            display: flex;
            align-items: center;

            gap: 4px;

            list-style: none;
        }


        .nav-links a,
        .nav-button {

            color: #333;

            padding: 10px 12px;

            border-radius: 8px;

            font-size: 14px;

            background: none;

            border: none;

            cursor: pointer;

            transition: 0.2s;
        }


        .nav-links a:hover,
        .nav-button:hover {

            background: #f3eee9;

            color: #8b4513;
        }


        .dropdown {

            position: relative;
        }


        .dropdown-menu {

            display: none;

            position: absolute;

            top: 42px;
            left: 0;

            min-width: 220px;

            background: white;

            border: 1px solid #e5e5e5;

            border-radius: 10px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.08);

            padding: 8px;
        }


        .dropdown:hover .dropdown-menu {

            display: block;
        }


        .dropdown-menu a {

            display: block;

            width: 100%;
        }


        .nav-actions {

            display: flex;

            align-items: center;

            gap: 5px;
        }


        .action-link {

            color: #333;

            padding: 9px 11px;

            border-radius: 8px;

            font-size: 14px;
        }


        .action-link:hover {

            background: #f3eee9;

            color: #8b4513;
        }


        .cart-count {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 20px;
            height: 20px;

            padding: 0 5px;

            border-radius: 20px;

            background: #8b4513;

            color: white;

            font-size: 11px;

            margin-left: 4px;
        }


        .customer-main {

            min-height: calc(100vh - 75px);
        }


        .customer-footer {

            background: #222;

            color: white;

            text-align: center;

            padding: 25px;

            margin-top: 50px;
        }


        .alert-success {

            max-width: 1200px;

            margin: 20px auto;

            padding: 14px 18px;

            background: #dcfce7;

            color: #166534;

            border: 1px solid #bbf7d0;

            border-radius: 10px;
        }


        .alert-error {

            max-width: 1200px;

            margin: 20px auto;

            padding: 14px 18px;

            background: #fee2e2;

            color: #991b1b;

            border: 1px solid #fecaca;

            border-radius: 10px;
        }


        @media (max-width: 1200px) {

            .customer-navbar {

                padding: 15px 20px;

                flex-wrap: wrap;

                gap: 12px;
            }

            .nav-links {

                flex-wrap: wrap;

                justify-content: center;
            }

            .nav-actions {

                flex-wrap: wrap;
            }
        }


        @media (max-width: 700px) {

            .customer-navbar {

                justify-content: center;
            }

            .brand {

                width: 100%;

                text-align: center;
            }

            .nav-links {

                width: 100%;
            }

            .nav-actions {

                width: 100%;

                justify-content: center;
            }
        }

    </style>

    @stack('styles')

</head>


<body>


<nav class="customer-navbar">


    {{-- Brand --}}

    <a
        href="{{ route('customer.dashboard') }}"
        class="brand"
    >
        El Shamy Cafeteria
    </a>


    {{-- Main Navigation --}}

    <ul class="nav-links">


        <li>
            <a href="{{ route('customer.dashboard') }}">
                Home
            </a>
        </li>


        <li>
            <a href="{{ route('customer.dashboard') }}#meals">
                Meals
            </a>
        </li>


        <li class="dropdown">

            <button
                type="button"
                class="nav-button"
            >
                Categories ▾
            </button>


            <div class="dropdown-menu">

                @if(isset($categories) && $categories->count())

                    @foreach($categories as $category)

                        <a
                            href="{{ route('customer.dashboard') }}#category-{{ $category->id }}"
                        >
                            {{ $category->name }}
                        </a>

                    @endforeach

                @else

                    <a href="{{ route('customer.dashboard') }}#categories">
                        No categories available
                    </a>

                @endif

            </div>

        </li>


        <li>
            <a href="{{ route('customer.dashboard') }}#beverages">
                Beverages
            </a>
        </li>


        <li>
            <a href="{{ route('customer.favorites') }}">
                ❤️ Favorites
            </a>
        </li>


        <li>
            <a href="{{ route('cart') }}">
                🛒 Cart

                @php

                    $cart = session('cart', []);

                    $cartCount = 0;

                    foreach ($cart as $item) {
                        $cartCount += (int) ($item['quantity'] ?? 0);
                    }

                @endphp

                <span class="cart-count">
                    {{ $cartCount }}
                </span>

            </a>
        </li>


        <li>
            <a href="{{ route('customer.recommendations') }}">
                ⭐ Recommendations
            </a>
        </li>


        <li>
            <a href="{{ route('customer.chatbot') }}">
                🤖 Chatbot
            </a>
        </li>


        <li>
            <a href="{{ route('profile') }}">
                👤 Profile
            </a>
        </li>


    </ul>


    {{-- User Actions --}}

    <div class="nav-actions">


        <span class="action-link">
            Hello,
            <strong>
                {{ auth()->user()->name ?? 'Customer' }}
            </strong>
        </span>


        <form
            action="{{ route('logout') }}"
            method="POST"
            style="display:inline;"
        >

            @csrf

            <button
                type="submit"
                class="action-link"
                style="
                    border:none;
                    background:none;
                    cursor:pointer;
                "
            >
                Logout
            </button>

        </form>


    </div>


</nav>


{{-- Flash Messages --}}

@if(session('success'))

    <div class="alert-success">
        {{ session('success') }}
    </div>

@endif


@if(session('error'))

    <div class="alert-error">
        {{ session('error') }}
    </div>

@endif


{{-- Main Content --}}

<main class="customer-main">

    @yield('content')

</main>


{{-- Footer --}}

<footer class="customer-footer">

    <p>
        © {{ date('Y') }} El Shamy Cafeteria.
        All rights reserved.
    </p>

</footer>


@stack('scripts')


</body>

</html>

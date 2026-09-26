<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
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

    .customer-navbar {
        width: 100%;
        min-height: 75px;
        background: #ffffff;
        border-bottom: 1px solid #e5e5e5;
        padding: 0 40px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .brand {
        text-decoration: none;
        font-size: 25px;
        font-weight: bold;
        color: #8b4513;
        white-space: nowrap;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 5px;
        list-style: none;
    }

    .nav-links a,
    .nav-button {
        text-decoration: none;
        color: #333;
        padding: 11px 13px;
        border-radius: 8px;
        transition: 0.2s;
        font-size: 15px;
        background: none;
        border: none;
        cursor: pointer;
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
        top: 45px;
        left: 0;

        min-width: 220px;

        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 10px;

        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);

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
        gap: 8px;
    }

    .cart-link {
        text-decoration: none;
        color: #333;
        padding: 10px 12px;
        border-radius: 8px;
    }

    .cart-link:hover {
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

    @media (max-width: 1100px) {

        .customer-navbar {
            padding: 15px 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .nav-links {
            flex-wrap: wrap;
            justify-content: center;
        }

        .nav-actions {
            flex-wrap: wrap;
        }
    }
</style>

@stack('styles')
```

</head>

<body>

```
<nav class="customer-navbar">

    <a href="{{ route('customer.dashboard') }}" class="brand">
        El Shamy Cafeteria
    </a>

    <ul class="nav-links">

        <li>
            <a href="{{ route('customer.dashboard') }}">
                Home
            </a>
        </li>

        <li>
            <a href="#meals">
                Meals
            </a>
        </li>

        <li class="dropdown">

            <button type="button" class="nav-button">
                Categories ▾
            </button>

            <div class="dropdown-menu">

                @if(isset($categories) && $categories->count())

                    @foreach($categories as $category)

                        <a href="#category-{{ $category->id }}">
                            {{ $category->name }}
                        </a>

                    @endforeach

                @else

                    <a href="#categories">
                        No categories available
                    </a>

                @endif

            </div>

        </li>

        <li>
            <a href="#beverages">
                Beverages
            </a>
        </li>

        <li>
            <a href="{{ route('customer.preferences') }}">
                My Profile
            </a>
        </li>

        <li>
            <a href="{{ route('customer.recommendations') }}">
                Recommendations
            </a>
        </li>

        <li>
            <a href="{{ route('customer.chatbot') }}">
                Chatbot
            </a>
        </li>

    </ul>

    <div class="nav-actions">

        <a href="#" class="cart-link">
            🛒 Cart
            <span class="cart-count">0</span>
        </a>

        <a
            href="{{ route('customer.preferences') }}"
            class="cart-link"
        >
            👤 {{ auth()->user()->name ?? 'Customer' }}
        </a>

    </div>

</nav>

<main class="customer-main">

    @yield('content')

</main>

<footer class="customer-footer">

    <p>
        © {{ date('Y') }} El Shamy Cafeteria. All rights reserved.
    </p>

</footer>

@stack('scripts')
```

</body>
</html>

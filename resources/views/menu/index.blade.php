@extends('layout.app')

@section('title', 'Menu')

@section('content')

<div class="container py-5">

    <div class="menu-heading">

        <div>
            <h1>Our Menu</h1>
            <p>اختاري وجبتك المفضلة</p>
        </div>

    </div>


    <div class="row g-4">

        @forelse($meals as $meal)

            <div class="col-md-6 col-lg-4 col-xl-3">

                <div class="menu-card">

                    <div class="menu-image-wrapper">

                        @if($meal->image)

                            <img
                                src="{{ asset('storage/' . $meal->image) }}"
                                class="menu-image"
                                alt="{{ $meal->name }}"
                            >

                        @else

                            <div class="menu-placeholder">
                                🍽️
                            </div>

                        @endif

                    </div>


                    <div class="menu-body">

                        <h5>
                            {{ $meal->name }}
                        </h5>

                        <p>
                            {{ Str::limit($meal->description, 90) }}
                        </p>


                        <div class="menu-price">

                            @if(
                                !is_null($meal->discount_price) &&
                                $meal->discount_price > 0 &&
                                $meal->discount_price < $meal->price
                            )

                                <span class="old-price">
                                    {{ number_format($meal->price, 2) }} EGP
                                </span>

                            @endif

                            <strong>
                                {{ number_format($meal->active_price, 2) }} EGP
                            </strong>

                        </div>

                    </div>


                    <div class="menu-footer">

                        <form
                            method="POST"
                            action="{{ route('cart.add', $meal->id) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="cart-btn"
                            >
                                Add to Cart
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="empty-menu">
                    No meals found.
                </div>

            </div>

        @endforelse

    </div>

</div>


<style>

.menu-heading {
    margin-bottom: 30px;
}

.menu-heading h1 {
    color: #111827;
    font-weight: 800;
    margin-bottom: 6px;
}

.menu-heading p {
    color: #64748b;
}

.menu-card {
    height: 100%;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(15,23,42,.07);
    transition: .25s;
}

.menu-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(15,23,42,.12);
}

.menu-image-wrapper {
    height: 220px;
    background: #f1f5f9;
}

.menu-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.menu-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 60px;
}

.menu-body {
    padding: 20px;
}

.menu-body h5 {
    color: #111827;
    font-weight: 800;
}

.menu-body p {
    color: #64748b;
    min-height: 48px;
}

.menu-price {
    display: flex;
    align-items: center;
    gap: 10px;
}

.menu-price strong {
    color: #16a34a;
    font-size: 18px;
}

.old-price {
    color: #94a3b8;
    text-decoration: line-through;
    font-size: 13px;
}

.menu-footer {
    padding: 0 20px 20px;
}

.cart-btn {
    width: 100%;
    border: 0;
    border-radius: 12px;
    padding: 12px;
    background: #2563eb;
    color: white;
    font-weight: 700;
    transition: .2s;
}

.cart-btn:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

.empty-menu {
    background: #fff;
    border-radius: 16px;
    padding: 50px;
    text-align: center;
    color: #64748b;
}

</style>

@endsection
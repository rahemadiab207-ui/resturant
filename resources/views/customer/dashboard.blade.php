@extends('layout.app')

@section('content')

<div class="container py-5">

```
<div class="text-center mb-5">
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <p>Explore our menu and discover your favorite meals.</p>
</div>

<h2 class="mb-4">Categories</h2>

<div class="row g-4 mb-5">
    @forelse($categories as $category)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
                @if($category->image)
                    <img
                        src="{{ asset('storage/' . $category->image) }}"
                        class="card-img-top"
                        style="height:180px; object-fit:cover;"
                        alt="{{ $category->name }}"
                    >
                @endif

                <div class="card-body text-center">
                    <h5 class="card-title">
                        {{ $category->name }}
                    </h5>

                    @if($category->description)
                        <p class="card-text">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p>No categories available.</p>
        </div>
    @endforelse
</div>

<h2 class="mb-4">Meals</h2>

<div class="row g-4 mb-5">
    @forelse($meals as $meal)
        <div class="col-md-6 col-lg-4">

            <div class="card h-100 shadow-sm">

                @if($meal->image)
                    <img
                        src="{{ asset('storage/' . $meal->image) }}"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;"
                        alt="{{ $meal->name }}"
                    >
                @endif

                <div class="card-body">

                    <h5 class="card-title">
                        {{ $meal->name }}
                    </h5>

                    @if($meal->category)
                        <small class="text-muted">
                            {{ $meal->category->name }}
                        </small>
                    @endif

                    @if($meal->description)
                        <p class="card-text mt-2">
                            {{ $meal->description }}
                        </p>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <strong>
                            {{ number_format($meal->price, 2) }}
                        </strong>

                        @if($meal->discount_price)
                            <span>
                                {{ number_format($meal->discount_price, 2) }}
                            </span>
                        @endif
                    </div>

                    <form
                        action="{{ route('customer.cart.add') }}"
                        method="POST"
                        class="mt-3"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="meal_id"
                            value="{{ $meal->id }}"
                        >

                        <input
                            type="hidden"
                            name="quantity"
                            value="1"
                        >

                        <button class="btn btn-primary w-100">
                            Add to Cart
                        </button>
                    </form>

                </div>
            </div>

        </div>
    @empty
        <div class="col-12">
            <p>No meals available.</p>
        </div>
    @endforelse
</div>

<h2 class="mb-4">Beverages</h2>

<div class="row g-4">

    @forelse($beverages as $beverage)

        <div class="col-md-6 col-lg-4">

            <div class="card h-100 shadow-sm">

                @if($beverage->image)
                    <img
                        src="{{ asset('storage/' . $beverage->image) }}"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;"
                        alt="{{ $beverage->name }}"
                    >
                @endif

                <div class="card-body">

                    <h5 class="card-title">
                        {{ $beverage->name }}
                    </h5>

                    @if($beverage->description)
                        <p class="card-text">
                            {{ $beverage->description }}
                        </p>
                    @endif

                    <strong>
                        {{ number_format($beverage->price, 2) }}
                    </strong>

                </div>
            </div>

        </div>

    @empty

        <div class="col-12">
            <p>No beverages available.</p>
        </div>

    @endforelse

</div>
```

</div>

@endsection

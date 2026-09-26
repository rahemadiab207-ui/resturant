@extends('layout.app')

@section('title', 'Home')

@section('content')

<div class="container py-4">

    <div class="row g-4">

        @forelse($meals as $meal)

            <div class="col-md-4 col-lg-3">

                <div class="card h-100 shadow-sm">

                    <img
                        src="{{ asset('storage/' . $meal->image) }}"
                        class="card-img-top"
                        alt="{{ $meal->name }}"
                        style="height:220px;object-fit:cover;"
                    >

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $meal->name }}
                        </h5>

                        <p class="card-text">
                            {{ $meal->description }}
                        </p>

                        @if($meal->is_on_sale && $meal->discount_price !== null)

                            <span class="text-decoration-line-through text-muted">
                                {{ number_format($meal->price, 2) }} EGP
                            </span>

                            <strong class="text-danger">
                                {{ number_format($meal->discount_price, 2) }} EGP
                            </strong>

                        @else

                            <strong>
                                {{ number_format($meal->price, 2) }} EGP
                            </strong>

                        @endif

                    </div>

                    <div class="card-footer bg-white border-0">

                        <form
                            method="POST"
                            action="{{ route('cart.add', $meal->id) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                Add to Cart
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-info">
                    No meals available.
                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
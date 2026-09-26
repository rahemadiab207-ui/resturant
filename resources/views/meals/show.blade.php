@extends('layout.app')

@section('title', $meal->name)

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">

        <div>
            <h1 class="page-title">
                {{ $meal->name }}
            </h1>

            <p class="page-subtitle">
                تفاصيل الوجبة
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('meals.edit', $meal->id) }}"
                class="btn-modern btn-primary-modern"
            >
                Edit
            </a>

            <a
                href="{{ route('meals') }}"
                class="btn btn-outline-secondary"
            >
                Back
            </a>

        </div>

    </div>


    <div class="card-modern">

        <div class="row g-0">

            <div class="col-lg-5">

                @if($meal->image)

                    <img
                        src="{{ asset('storage/' . $meal->image) }}"
                        alt="{{ $meal->name }}"
                        style="
                            width:100%;
                            height:100%;
                            min-height:420px;
                            object-fit:cover;
                        "
                    >

                @endif

            </div>

            <div class="col-lg-7">

                <div class="card-modern-body">

                    <div class="mb-3">

                        <span class="badge-modern badge-primary-modern">
                            {{ $meal->category?->name ?? 'No Category' }}
                        </span>

                    </div>

                    <h2 class="fw-bold">
                        {{ $meal->name }}
                    </h2>

                    <p class="text-muted">
                        {{ $meal->description }}
                    </p>

                    <div class="fs-4 fw-bold mb-4">

                        {{ number_format($meal->active_price, 2) }}
                        EGP

                        @if($meal->discount_price)

                            <span
                                class="fs-6 text-muted text-decoration-line-through"
                            >
                                {{ number_format($meal->price, 2) }}
                                EGP
                            </span>

                        @endif

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="info-box">

                                <small class="text-muted">
                                    Calories
                                </small>

                                <div class="fw-bold">
                                    {{ $meal->calories ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <small class="text-muted">
                                    Spicy Level
                                </small>

                                <div class="fw-bold">
                                    {{ $meal->spicy_level ?? 0 }}/5
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <small class="text-muted">
                                    Rating
                                </small>

                                <div class="fw-bold">
                                    {{ $meal->rating ?? 0 }}/5
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-box">

                                <small class="text-muted">
                                    Status
                                </small>

                                <div class="fw-bold">

                                    @if($meal->is_available)
                                        Available
                                    @else
                                        Unavailable
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    @if($meal->ingredients)

                        <div class="mt-4">

                            <h5 class="fw-bold">
                                Ingredients
                            </h5>

                            <p class="text-muted">
                                {{ $meal->ingredients }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
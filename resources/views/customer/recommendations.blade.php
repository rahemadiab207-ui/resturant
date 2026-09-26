@extends('layout.app')

@section('content')

<div class="container py-5">

```
<div class="mb-5">
    <h1>Recommended For You</h1>
    <p>Meals selected based on your preferences.</p>
</div>

<div class="row g-4">

    @forelse($recommendations as $recommendation)

        @php
            $meal = $recommendation->meal ?? $recommendation;
        @endphp

        @if($meal)

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

                        <h5>
                            {{ $meal->name }}
                        </h5>

                        @if($meal->description)
                            <p>
                                {{ $meal->description }}
                            </p>
                        @endif

                        <strong>
                            {{ number_format($meal->price, 2) }}
                        </strong>

                    </div>

                </div>

            </div>

        @endif

    @empty

        <div class="col-12">
            <div class="alert alert-info">
                No recommendations available yet.
            </div>
        </div>

    @endforelse

</div>
```

</div>

@endsection

@extends('layout.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Drinks</h2>

    <a
        href="{{ route('beverages.create') }}"
        class="btn btn-primary"
    >
        Add Drink
    </a>

</div>

<div class="row">

    @forelse($beverages as $beverage)

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                @if($beverage->image)

                    <img
                        src="{{ $beverage->image }}"
                        class="card-img-top"
                        style="height:220px;object-fit:cover;"
                        alt="{{ $beverage->name }}"
                    >

                @endif

                <div class="card-body">

                    <h5>{{ $beverage->name }}</h5>

                    <p class="text-muted">
                        {{ $beverage->description }}
                    </p>

                    @if($beverage->category)

                        <span class="badge bg-secondary">
                            {{ $beverage->category->name }}
                        </span>

                    @endif

                    <div class="mt-3">

                        @if(
                            $beverage->is_on_sale &&
                            $beverage->discount_price !== null
                        )

                            <span class="text-decoration-line-through text-muted">
                                {{ number_format($beverage->price, 2) }} EGP
                            </span>

                            <strong class="text-danger">
                                {{ number_format($beverage->active_price, 2) }} EGP
                            </strong>

                        @else

                            <strong>
                                {{ number_format($beverage->active_price, 2) }} EGP
                            </strong>

                        @endif

                    </div>

                    <div class="mt-2">

                        @if($beverage->is_available)

                            <span class="badge bg-success">
                                Available
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Unavailable
                            </span>

                        @endif

                    </div>

                </div>

                <div class="card-footer bg-white">

                    <a
                        href="{{ route('beverages.show', $beverage->id) }}"
                        class="btn btn-sm btn-info"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('beverages.edit', $beverage->id) }}"
                        class="btn btn-sm btn-warning"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('beverages.destroy', $beverage->id) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Delete this drink?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info">
                No drinks found.
            </div>

        </div>

    @endforelse

</div>

@endsection
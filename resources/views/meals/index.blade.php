@extends('layout.app')

@section('title', 'Meals')

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">

        <div>
            <h1 class="page-title">
                Meals
            </h1>

            <p class="page-subtitle">
                إدارة الوجبات
            </p>
        </div>

        <a
            href="{{ route('meals.create') }}"
            class="btn-modern btn-primary-modern"
        >
            + Add Meal
        </a>

    </div>


    <div class="card-modern">

        <div class="table-responsive">

            <table class="table table-modern">

                <thead>

                <tr>

                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

                </thead>

                <tbody>

                @forelse($meals as $meal)

                    <tr>

                        <td>

                            @if($meal->image)

                                <img
                                    src="{{ asset('storage/' . $meal->image) }}"
                                    alt="{{ $meal->name }}"
                                    style="
                                        width:55px;
                                        height:55px;
                                        object-fit:cover;
                                        border-radius:10px;
                                    "
                                >

                            @else

                                <div
                                    style="
                                        width:55px;
                                        height:55px;
                                        border-radius:10px;
                                        background:#f1f5f9;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >
                                    —
                                </div>

                            @endif

                        </td>

                        <td>
                            <strong>
                                {{ $meal->name }}
                            </strong>
                        </td>

                        <td>
                            {{ $meal->category?->name ?? '-' }}
                        </td>

                        <td>

                            @if($meal->discount_price)

                                <span class="text-muted text-decoration-line-through">
                                    {{ number_format($meal->price, 2) }}
                                </span>

                                <strong class="text-danger">
                                    {{ number_format($meal->discount_price, 2) }}
                                </strong>

                            @else

                                {{ number_format($meal->price, 2) }}

                            @endif

                            EGP

                        </td>

                        <td>

                            @if($meal->is_available)

                                <span class="badge-modern badge-success-modern">
                                    Available
                                </span>

                            @else

                                <span class="badge-modern badge-danger-modern">
                                    Unavailable
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('meals.show', $meal->id) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('meals.edit', $meal->id) }}"
                                    class="btn btn-sm btn-outline-secondary"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('meals.destroy', $meal->id) }}"
                                    onsubmit="return confirm('هل أنت متأكد من حذف الوجبة؟')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5 text-muted"
                        >
                            لا توجد وجبات.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
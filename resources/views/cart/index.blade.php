@extends('layout.app')

@section('title', 'Cart')

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">

        <div>
            <h1 class="page-title">
                Shopping Cart
            </h1>

            <p class="page-subtitle">
                مراجعة المنتجات قبل إتمام الطلب
            </p>
        </div>

    </div>


    @if(empty($cart))

        <div class="card-modern p-5 text-center">

            <h4 class="fw-bold mb-2">
                السلة فارغة
            </h4>

            <p class="text-muted">
                أضف بعض الوجبات أولاً.
            </p>

            <a
                href="{{ route('home') }}"
                class="btn-modern btn-primary-modern"
            >
                Browse Meals
            </a>

        </div>

    @else

        <div class="card-modern">

            <div class="table-responsive">

                <table class="table table-modern align-middle">

                    <thead>

                    <tr>
                        <th>Meal</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>

                    </thead>

                    <tbody>

                    @foreach($cart as $id => $item)

                        <tr>

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if(!empty($item['image']))

                                        <img
                                            src="{{ asset('storage/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}"
                                            style="
                                                width:60px;
                                                height:60px;
                                                object-fit:cover;
                                                border-radius:10px;
                                            "
                                        >

                                    @endif

                                    <strong>
                                        {{ $item['name'] }}
                                    </strong>

                                </div>

                            </td>

                            <td>
                                {{ number_format($item['price'], 2) }}
                                EGP
                            </td>

                            <td>
                                {{ $item['quantity'] }}
                            </td>

                            <td>
                                <strong>
                                    {{ number_format(
                                        $item['price'] * $item['quantity'],
                                        2
                                    ) }}
                                    EGP
                                </strong>
                            </td>

                            <td>

                                <form
                                    method="POST"
                                    action="{{ route('cart.remove', $id) }}"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger btn-sm"
                                    >
                                        Remove
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

            <div
                class="p-4 border-top d-flex justify-content-between align-items-center"
            >

                <span class="fw-bold">
                    Total
                </span>

                <strong class="fs-4">
                    {{ number_format($total, 2) }}
                    EGP
                </strong>

            </div>

        </div>

    @endif

</div>

@endsection
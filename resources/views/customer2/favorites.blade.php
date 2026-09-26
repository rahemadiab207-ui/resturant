@extends('customer2.layout')

@section('title', 'Favorites - El Shamy Cafeteria')


@section('content')


<div style="
    max-width:1200px;
    margin:auto;
    padding:40px 25px;
">


    <div style="
        background:white;
        padding:30px;
        border-radius:15px;
        margin-bottom:30px;
    ">

        <h1 style="color:#8b4513;">
            ❤️ My Favorites
        </h1>

        <p style="
            color:#777;
            margin-top:8px;
        ">
            Your favorite meals and beverages.
        </p>

    </div>


    @if($favorites->count())


        <div style="
            display:grid;
            grid-template-columns:
                repeat(auto-fit, minmax(270px, 1fr));
            gap:25px;
        ">


            @foreach($favorites as $favorite)


                <div style="
                    background:white;
                    border:1px solid #eee;
                    border-radius:15px;
                    overflow:hidden;
                ">


                    @if($favorite->meal)


                        @if($favorite->meal->image)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $favorite->meal->image
                                ) }}"
                                alt="{{ $favorite->meal->name }}"
                                style="
                                    width:100%;
                                    height:190px;
                                    object-fit:cover;
                                "
                            >

                        @endif


                        <div style="padding:20px;">

                            <small style="
                                color:#8b4513;
                            ">
                                Meal
                            </small>


                            <h3 style="
                                margin-top:7px;
                            ">
                                {{ $favorite->meal->name }}
                            </h3>


                            <p style="
                                margin-top:10px;
                                color:#777;
                            ">
                                {{ $favorite->meal->description }}
                            </p>


                            <strong style="
                                display:block;
                                margin-top:15px;
                                color:#8b4513;
                            ">
                                {{ number_format(
                                    $favorite->meal->active_price,
                                    2
                                ) }}
                            </strong>


                            <form
                                action="{{ route(
                                    'cart.add',
                                    $favorite->meal->id
                                ) }}"
                                method="POST"
                                style="margin-top:15px;"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button
                                    type="submit"
                                    style="
                                        width:100%;
                                        padding:11px;
                                        border:none;
                                        border-radius:8px;
                                        background:#8b4513;
                                        color:white;
                                        cursor:pointer;
                                    "
                                >
                                    🛒 Add to Cart
                                </button>

                            </form>

                        </div>


                    @elseif($favorite->beverage)


                        @if($favorite->beverage->image)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $favorite->beverage->image
                                ) }}"
                                alt="{{ $favorite->beverage->name }}"
                                style="
                                    width:100%;
                                    height:190px;
                                    object-fit:cover;
                                "
                            >

                        @endif


                        <div style="padding:20px;">

                            <small style="
                                color:#8b4513;
                            ">
                                Beverage
                            </small>


                            <h3 style="
                                margin-top:7px;
                            ">
                                {{ $favorite->beverage->name }}
                            </h3>


                            <p style="
                                margin-top:10px;
                                color:#777;
                            ">
                                {{ $favorite->beverage->description }}
                            </p>


                            <strong style="
                                display:block;
                                margin-top:15px;
                                color:#8b4513;
                            ">
                                {{ number_format(
                                    $favorite->beverage->active_price,
                                    2
                                ) }}
                            </strong>


                            <form
                                action="{{ route(
                                    'cart.add',
                                    $favorite->beverage->id
                                ) }}"
                                method="POST"
                                style="margin-top:15px;"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button
                                    type="submit"
                                    style="
                                        width:100%;
                                        padding:11px;
                                        border:none;
                                        border-radius:8px;
                                        background:#8b4513;
                                        color:white;
                                        cursor:pointer;
                                    "
                                >
                                    🛒 Add to Cart
                                </button>

                            </form>

                        </div>


                    @endif


                    <div style="
                        padding:0 20px 20px;
                    ">

                        <form
                            action="{{ route(
                                'customer.favorites.destroy',
                                $favorite->id
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                style="
                                    width:100%;
                                    padding:10px;
                                    border:1px solid #dc2626;
                                    color:#dc2626;
                                    background:white;
                                    border-radius:8px;
                                    cursor:pointer;
                                "
                            >
                                Remove from Favorites
                            </button>

                        </form>

                    </div>


                </div>


            @endforeach


        </div>


    @else


        <div style="
            background:white;
            padding:50px;
            text-align:center;
            border-radius:15px;
        ">

            <div style="
                font-size:50px;
                margin-bottom:15px;
            ">
                ❤️
            </div>

            <h2>
                No Favorites Yet
            </h2>

            <p style="
                margin-top:10px;
                color:#777;
            ">
                Add your favorite meals and beverages
                from the menu.
            </p>


            <a
                href="{{ route('customer.dashboard') }}"
                style="
                    display:inline-block;
                    margin-top:20px;
                    padding:12px 20px;
                    background:#8b4513;
                    color:white;
                    border-radius:8px;
                "
            >
                Browse Menu
            </a>

        </div>


    @endif


</div>


@endsection

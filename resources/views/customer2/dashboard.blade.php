@extends('customer2.layout')

@section('title', 'Home - El Shamy Cafeteria')

@section('content')

<div style="padding: 40px;">

```
<div style="
    background: white;
    padding: 40px;
    border-radius: 15px;
    margin-bottom: 35px;
    text-align: center;
">

    <h1 style="margin-bottom: 10px;">
        Welcome to El Shamy Cafeteria
    </h1>

    <p style="color: #777;">
        Discover our meals, drinks and special recommendations.
    </p>

</div>


<section id="categories" style="margin-bottom: 45px;">

    <h2 style="margin-bottom: 20px;">
        Categories
    </h2>

    @if($categories->count())

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        ">

            @foreach($categories as $category)

                <div
                    id="category-{{ $category->id }}"
                    style="
                        background: white;
                        padding: 25px;
                        border-radius: 12px;
                        border: 1px solid #eee;
                    "
                >

                    <h3>
                        {{ $category->name }}
                    </h3>

                    @if($category->description)
                        <p style="
                            margin-top: 10px;
                            color: #777;
                        ">
                            {{ $category->description }}
                        </p>
                    @endif

                </div>

            @endforeach

        </div>

    @else

        <p>No categories available.</p>

    @endif

</section>


<section id="meals" style="margin-bottom: 45px;">

    <h2 style="margin-bottom: 20px;">
        Meals
    </h2>

    @if($meals->count())

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        ">

            @foreach($meals as $meal)

                <div style="
                    background: white;
                    border-radius: 12px;
                    overflow: hidden;
                    border: 1px solid #eee;
                ">

                    @if($meal->image)

                        <img
                            src="{{ asset('storage/' . $meal->image) }}"
                            alt="{{ $meal->name }}"
                            style="
                                width: 100%;
                                height: 200px;
                                object-fit: cover;
                            "
                        >

                    @endif

                    <div style="padding: 20px;">

                        <h3>
                            {{ $meal->name }}
                        </h3>

                        @if($meal->category)
                            <small style="color: #8b4513;">
                                {{ $meal->category->name }}
                            </small>
                        @endif

                        @if($meal->description)

                            <p style="
                                margin-top: 10px;
                                color: #777;
                            ">
                                {{ $meal->description }}
                            </p>

                        @endif

                        <p style="
                            margin-top: 15px;
                            font-weight: bold;
                            font-size: 18px;
                        ">
                            {{ $meal->price }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <p>No meals available.</p>

    @endif

</section>


<section id="beverages" style="margin-bottom: 45px;">

    <h2 style="margin-bottom: 20px;">
        Beverages
    </h2>

    @if($beverages->count())

        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        ">

            @foreach($beverages as $beverage)

                <div style="
                    background: white;
                    padding: 25px;
                    border-radius: 12px;
                    border: 1px solid #eee;
                ">

                    <h3>
                        {{ $beverage->name }}
                    </h3>

                    @if(isset($beverage->description))

                        <p style="
                            margin-top: 10px;
                            color: #777;
                        ">
                            {{ $beverage->description }}
                        </p>

                    @endif

                    @if(isset($beverage->price))

                        <p style="
                            margin-top: 15px;
                            font-weight: bold;
                        ">
                            {{ $beverage->price }}
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    @else

        <p>No beverages available.</p>

    @endif

</section>
```

</div>

@endsection

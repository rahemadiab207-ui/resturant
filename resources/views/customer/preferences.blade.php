@extends('layout.app')

@section('content')

<div class="container py-5">

```
<div class="mb-4">
    <h1>My Preferences</h1>
    <p>Choose your allergies and favorite foods.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form
    action="{{ route('customer.preferences.update') }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4>Allergies</h4>

            <textarea
                name="allergies"
                class="form-control"
                rows="4"
                placeholder="Example: cheese, mushroom, nuts"
            >{{ old('allergies', $preference->allergies) }}</textarea>

        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4>Favorite Foods</h4>

            <textarea
                name="favorite_foods"
                class="form-control"
                rows="4"
                placeholder="Example: pizza, burger, pasta"
            >{{ old('favorite_foods', $preference->favorite_foods) }}</textarea>

        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4>Favorite Categories</h4>

            <textarea
                name="favorite_categories"
                class="form-control"
                rows="4"
                placeholder="Example: Italian, Fast Food"
            >{{ old('favorite_categories', $preference->favorite_categories) }}</textarea>

        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h4>Disliked Foods</h4>

            <textarea
                name="disliked_foods"
                class="form-control"
                rows="4"
                placeholder="Example: onions, spicy food"
            >{{ old('disliked_foods', $preference->disliked_foods) }}</textarea>

        </div>
    </div>

    <button class="btn btn-primary">
        Save Preferences
    </button>

</form>
```

</div>

@endsection

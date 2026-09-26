@extends('layout.app')

@section('content')

<style>
    .category-page {
        max-width: 1050px;
        margin: 30px auto;
        padding: 0 20px 50px;
    }

    .page-header h1 {
        margin: 0 0 8px;
        font-size: 30px;
        color: #111827;
    }

    .page-header p {
        color: #6B7280;
        margin-bottom: 25px;
    }

    .card {
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 18px;
        padding: 28px;
        margin-bottom: 22px;
        box-shadow: 0 8px 30px rgba(0,0,0,.05);
    }

    .title {
        font-size: 19px;
        font-weight: 800;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #E5E7EB;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .full {
        grid-column: 1 / -1;
    }

    label {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    input,
    textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #D1D5DB;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .checks {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .check {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 13px;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        background: #F9FAFB;
        cursor: pointer;
    }

    .check input {
        width: 17px;
        height: 17px;
        accent-color: #2563EB;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn {
        padding: 12px 22px;
        border-radius: 10px;
        text-decoration: none;
        border: 0;
        cursor: pointer;
        font-weight: 700;
    }

    .primary {
        background: #2563EB;
        color: white;
    }

    .secondary {
        background: #F3F4F6;
        color: #374151;
    }

    .errors {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #991B1B;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
    }

    @media(max-width:800px) {
        .grid,
        .checks {
            grid-template-columns: 1fr;
        }

        .full {
            grid-column: auto;
        }
    }
</style>

<div class="category-page">

    <div class="page-header">
        <h1>📂 Add Category</h1>
        <p>Create a category with its food properties.</p>
    </div>

    @if($errors->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('categories.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="card">

            <div class="title">
                📝 Category Information
            </div>

            <div class="grid">

                <div>
                    <label>Category Name *</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <div>
                    <label>Price *</label>

                    <input
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        min="0"
                        step="0.01"
                        required
                    >
                </div>

                <div>
                    <label>Discount Price</label>

                    <input
                        type="number"
                        name="discount_price"
                        value="{{ old('discount_price') }}"
                        min="0"
                        step="0.01"
                    >
                </div>

                <div>
                    <label>Rating</label>

                    <input
                        type="number"
                        name="rating"
                        value="{{ old('rating', 0) }}"
                        min="0"
                        max="5"
                        step="0.1"
                    >
                </div>

                <div class="full">
                    <label>Description</label>

                    <textarea name="description">{{ old('description') }}</textarea>
                </div>

            </div>
        </div>


        <div class="card">

            <div class="title">
                🤖 Food Properties
            </div>

            <div class="checks">

                <label class="check">
                    <input type="checkbox" name="is_spicy" value="1"
                        {{ old('is_spicy') ? 'checked' : '' }}>
                    🌶️ Spicy
                </label>

                <label class="check">
                    <input type="checkbox" name="has_cheese" value="1"
                        {{ old('has_cheese') ? 'checked' : '' }}>
                    🧀 Contains Cheese
                </label>

                <label class="check">
                    <input type="checkbox" name="has_chicken" value="1"
                        {{ old('has_chicken') ? 'checked' : '' }}>
                    🍗 Contains Chicken
                </label>

                <label class="check">
                    <input type="checkbox" name="has_meat" value="1"
                        {{ old('has_meat') ? 'checked' : '' }}>
                    🥩 Contains Meat
                </label>

                <label class="check">
                    <input type="checkbox" name="has_mushroom" value="1"
                        {{ old('has_mushroom') ? 'checked' : '' }}>
                    🍄 Contains Mushroom
                </label>

                <label class="check">
                    <input type="checkbox" name="is_vegetarian" value="1"
                        {{ old('is_vegetarian') ? 'checked' : '' }}>
                    🌱 Vegetarian
                </label>

                <label class="check">
                    <input type="checkbox" name="is_healthy" value="1"
                        {{ old('is_healthy') ? 'checked' : '' }}>
                    🥗 Healthy / Diet
                </label>

                <label class="check">
                    <input type="checkbox" name="is_vegan" value="1"
                        {{ old('is_vegan') ? 'checked' : '' }}>
                    🌿 Vegan
                </label>

                <label class="check">
                    <input type="checkbox" name="is_gluten_free" value="1"
                        {{ old('is_gluten_free') ? 'checked' : '' }}>
                    🌾 Gluten Free
                </label>

                <label class="check">
                    <input type="checkbox" name="is_dairy_free" value="1"
                        {{ old('is_dairy_free') ? 'checked' : '' }}>
                    🥛 Dairy Free
                </label>

                <label class="check">
                    <input type="checkbox" name="is_high_protein" value="1"
                        {{ old('is_high_protein') ? 'checked' : '' }}>
                    💪 High Protein
                </label>

                <label class="check">
                    <input type="checkbox" name="is_low_calorie" value="1"
                        {{ old('is_low_calorie') ? 'checked' : '' }}>
                    🔥 Low Calorie
                </label>

            </div>

        </div>


        <div class="card">

            <div class="title">
                🖼️ Category Image
            </div>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
            >

        </div>


        <div class="actions">

            <a
                href="{{ route('categories') }}"
                class="btn secondary"
            >
                ← Cancel
            </a>

            <button
                type="submit"
                class="btn primary"
            >
                💾 Save Category
            </button>

        </div>

    </form>

</div>

@endsection
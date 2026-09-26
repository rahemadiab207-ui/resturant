@extends('layout.app')

@section('content')

<style>
    .meal-edit-page {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 20px 50px;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 8px;
        font-size: 30px;
        font-weight: 800;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6B7280;
    }

    .form-card {
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 18px;
        padding: 28px;
        margin-bottom: 22px;
        box-shadow: 0 8px 30px rgba(0,0,0,.05);
    }

    .section-title {
        font-size: 19px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #E5E7EB;
    }

    .section-description {
        color: #6B7280;
        font-size: 14px;
        margin-top: -10px;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select,
    .form-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #D1D5DB;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
        outline: none;
    }

    .form-control:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37,99,235,.10);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: 12px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 13px 14px;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        background: #F9FAFB;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .checkbox-item input {
        width: 17px;
        height: 17px;
        accent-color: #2563EB;
    }

    .switch-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 15px;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        background: #F9FAFB;
    }

    .switch-row input {
        width: 18px;
        height: 18px;
        accent-color: #2563EB;
    }

    .current-image {
        width: 200px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #E5E7EB;
        margin-bottom: 12px;
    }

    .error-box {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #991B1B;
        padding: 15px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .error-box ul {
        margin: 0;
        padding-right: 20px;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn {
        border: none;
        border-radius: 10px;
        padding: 12px 22px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-primary {
        background: #2563EB;
        color: white;
    }

    .btn-secondary {
        background: #F3F4F6;
        color: #374151;
    }

    @media(max-width:800px) {
        .form-grid,
        .checkbox-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="meal-edit-page">

    <div class="page-header">
        <h1>✏️ Edit Meal</h1>
        <p>Update meal information and food properties.</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <strong>Please fix the following:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('meals.update', $meal->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="form-card">

            <div class="section-title">
                📝 Basic Information
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">Meal Name *</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $meal->name) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Category *</label>

                    <select
                        name="category_id"
                        class="form-select"
                        required
                    >
                        <option value="">Select Category</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $meal->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group full">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        class="form-textarea"
                    >{{ old('description', $meal->description) }}</textarea>
                </div>

                <div class="form-group full">
                    <label class="form-label">Ingredients</label>

                    <textarea
                        name="ingredients"
                        class="form-textarea"
                    >{{ old('ingredients', $meal->ingredients) }}</textarea>
                </div>

            </div>
        </div>


        <div class="form-card">

            <div class="section-title">
                💰 Price & Sale
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">Price *</label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ old('price', $meal->price) }}"
                        min="0"
                        step="0.01"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Discount Price</label>

                    <input
                        type="number"
                        name="discount_price"
                        class="form-control"
                        value="{{ old('discount_price', $meal->discount_price) }}"
                        min="0"
                        step="0.01"
                    >
                </div>

                <div class="form-group full">

                    <div class="switch-row">

                        <input
                            type="checkbox"
                            name="is_on_sale"
                            value="1"
                            id="is_on_sale"
                            {{ old('is_on_sale', $meal->is_on_sale) ? 'checked' : '' }}
                        >

                        <label for="is_on_sale">
                            🏷️ This meal is on sale
                        </label>

                    </div>

                </div>

            </div>
        </div>


        <div class="form-card">

            <div class="section-title">
                ⭐ Rating & Spicy Level
            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label">
                        Rating
                    </label>

                    <input
                        type="number"
                        name="rating"
                        class="form-control"
                        value="{{ old('rating', $meal->rating) }}"
                        min="0"
                        max="5"
                        step="0.1"
                    >

                </div>

                <div class="form-group">

                    <label class="form-label">
                        🌶️ Spicy Level
                    </label>

                    <select
                        name="spicy_level"
                        class="form-select"
                    >
                        @for($i = 0; $i <= 5; $i++)
                            <option
                                value="{{ $i }}"
                                {{ old('spicy_level', $meal->spicy_level) == $i ? 'selected' : '' }}
                            >
                                {{ $i }} -
                                @if($i == 0)
                                    Not Spicy
                                @elseif($i == 1)
                                    Very Mild
                                @elseif($i == 2)
                                    Mild
                                @elseif($i == 3)
                                    Medium
                                @elseif($i == 4)
                                    Hot
                                @else
                                    Very Hot
                                @endif
                            </option>
                        @endfor
                    </select>

                </div>

            </div>
        </div>


        <div class="form-card">

            <div class="section-title">
                🤖 AI Food Properties
            </div>

            <div class="section-description">
                These properties are saved as structured data and can be used by the chatbot.
            </div>

            <div class="checkbox-grid">

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_spicy"
                        value="1"
                        {{ old('is_spicy', $meal->is_spicy) ? 'checked' : '' }}
                    >
                    🌶️ Spicy
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_cheese"
                        value="1"
                        {{ old('has_cheese', $meal->has_cheese) ? 'checked' : '' }}
                    >
                    🧀 Contains Cheese
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_chicken"
                        value="1"
                        {{ old('has_chicken', $meal->has_chicken) ? 'checked' : '' }}
                    >
                    🍗 Contains Chicken
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_meat"
                        value="1"
                        {{ old('has_meat', $meal->has_meat) ? 'checked' : '' }}
                    >
                    🥩 Contains Meat
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_mushroom"
                        value="1"
                        {{ old('has_mushroom', $meal->has_mushroom) ? 'checked' : '' }}
                    >
                    🍄 Contains Mushroom
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_vegetarian"
                        value="1"
                        {{ old('is_vegetarian', $meal->is_vegetarian) ? 'checked' : '' }}
                    >
                    🌱 Vegetarian
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_healthy"
                        value="1"
                        {{ old('is_healthy', $meal->is_healthy) ? 'checked' : '' }}
                    >
                    🥗 Healthy / Diet
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_vegan"
                        value="1"
                        {{ old('is_vegan', $meal->is_vegan) ? 'checked' : '' }}
                    >
                    🌿 Vegan
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_gluten_free"
                        value="1"
                        {{ old('is_gluten_free', $meal->is_gluten_free) ? 'checked' : '' }}
                    >
                    🌾 Gluten Free
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_dairy_free"
                        value="1"
                        {{ old('is_dairy_free', $meal->is_dairy_free) ? 'checked' : '' }}
                    >
                    🥛 Dairy Free
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_high_protein"
                        value="1"
                        {{ old('is_high_protein', $meal->is_high_protein) ? 'checked' : '' }}
                    >
                    💪 High Protein
                </label>

                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_low_calorie"
                        value="1"
                        {{ old('is_low_calorie', $meal->is_low_calorie) ? 'checked' : '' }}
                    >
                    🔥 Low Calorie
                </label>

            </div>
        </div>


        <div class="form-card">

            <div class="section-title">
                📊 Additional Information
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">Calories</label>

                    <input
                        type="number"
                        name="calories"
                        class="form-control"
                        value="{{ old('calories', $meal->calories) }}"
                        min="0"
                    >
                </div>

                <div class="form-group">

                    <label class="form-label">
                        Availability
                    </label>

                    <div class="switch-row">

                        <input
                            type="checkbox"
                            name="is_available"
                            value="1"
                            id="is_available"
                            {{ old('is_available', $meal->is_available) ? 'checked' : '' }}
                        >

                        <label for="is_available">
                            ✅ Available for ordering
                        </label>

                    </div>

                </div>

            </div>
        </div>


        <div class="form-card">

            <div class="section-title">
                🖼️ Meal Image
            </div>

            @if($meal->image)

                <div>
                    <img
                        src="{{ asset('storage/' . $meal->image) }}"
                        alt="{{ $meal->name }}"
                        class="current-image"
                    >
                </div>

            @endif

            <div class="form-group">

                <label class="form-label">
                    Change Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                >

            </div>

        </div>


        <div class="actions">

            <a
                href="{{ route('meals') }}"
                class="btn btn-secondary"
            >
                ← Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                💾 Update Meal
            </button>

        </div>

    </form>

</div>

@endsection
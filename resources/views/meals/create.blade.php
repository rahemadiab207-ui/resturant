@extends('layout.app')

@section('content')

<style>
    .meal-create-page {
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
        font-size: 15px;
    }

    .form-card {
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 22px;
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
        color: #111827;
        background: #fff;
        outline: none;
        transition: 0.2s;
    }

    .form-control:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-help {
        margin-top: 6px;
        font-size: 12px;
        color: #6B7280;
    }

    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
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
        color: #374151;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .checkbox-item:hover {
        border-color: #2563EB;
        background: #EFF6FF;
    }

    .checkbox-item input {
        width: 17px;
        height: 17px;
        accent-color: #2563EB;
        cursor: pointer;
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

    .switch-row label {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        cursor: pointer;
    }

    .rating-box {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .rating-stars {
        display: flex;
        gap: 3px;
        font-size: 27px;
        color: #D1D5DB;
        cursor: pointer;
        user-select: none;
    }

    .rating-stars .star.active {
        color: #F59E0B;
    }

    .rating-number {
        min-width: 45px;
        font-weight: 800;
        color: #374151;
    }

    .image-preview-wrapper {
        margin-top: 15px;
        display: none;
    }

    .image-preview {
        width: 180px;
        height: 140px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #E5E7EB;
    }

    .error-box {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        color: #991B1B;
        border-radius: 12px;
        padding: 15px 18px;
        margin-bottom: 20px;
    }

    .error-box ul {
        margin: 0;
        padding-right: 20px;
    }

    .error-box li {
        margin-bottom: 5px;
    }

    .error-box li:last-child {
        margin-bottom: 0;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 25px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        border-radius: 10px;
        padding: 12px 22px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-primary {
        background: #2563EB;
        color: #fff;
    }

    .btn-primary:hover {
        background: #1D4ED8;
    }

    .btn-secondary {
        background: #F3F4F6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #E5E7EB;
    }

    .required {
        color: #DC2626;
    }

    @media (max-width: 900px) {
        .checkbox-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .checkbox-grid {
            grid-template-columns: 1fr;
        }

        .form-card {
            padding: 20px;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="meal-create-page">

    <div class="page-header">
        <h1>🍽️ Add New Meal</h1>
        <p>Create a new meal and define all of its food properties.</p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="error-box">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('meals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- =========================
             BASIC INFORMATION
        ========================== --}}
        <div class="form-card">

            <div class="section-title">
                📝 Basic Information
            </div>

            <div class="form-grid">

                {{-- Meal Name --}}
                <div class="form-group">
                    <label class="form-label">
                        Meal Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Enter meal name"
                        required
                    >
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label class="form-label">
                        Category <span class="required">*</span>
                    </label>

                    <select
                        name="category_id"
                        class="form-select"
                        required
                    >
                        <option value="">Select Category</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div class="form-group full">
                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-textarea"
                        placeholder="Describe the meal..."
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Ingredients --}}
                <div class="form-group full">
                    <label class="form-label">
                        Ingredients
                    </label>

                    <textarea
                        name="ingredients"
                        class="form-textarea"
                        placeholder="Example: Chicken, cheese, tomato, onion..."
                    >{{ old('ingredients') }}</textarea>

                    <div class="form-help">
                        Write the ingredients separated by commas.
                    </div>
                </div>

            </div>
        </div>


        {{-- =========================
             PRICE & SALE
        ========================== --}}
        <div class="form-card">

            <div class="section-title">
                💰 Price & Sale
            </div>

            <div class="form-grid">

                {{-- Price --}}
                <div class="form-group">
                    <label class="form-label">
                        Price <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ old('price') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        required
                    >
                </div>

                {{-- Discount Price --}}
                <div class="form-group">
                    <label class="form-label">
                        Discount Price
                    </label>

                    <input
                        type="number"
                        name="discount_price"
                        class="form-control"
                        value="{{ old('discount_price') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                    >

                    <div class="form-help">
                        Enter the final discounted price, not the discount percentage.
                    </div>
                </div>

                {{-- On Sale --}}
                <div class="form-group full">

                    <div class="switch-row">

                        <input
                            type="checkbox"
                            name="is_on_sale"
                            value="1"
                            id="is_on_sale"
                            {{ old('is_on_sale') ? 'checked' : '' }}
                        >

                        <label for="is_on_sale">
                            🏷️ This meal is currently on sale
                        </label>

                    </div>

                </div>

            </div>
        </div>


        {{-- =========================
             RATING & SPICY LEVEL
        ========================== --}}
        <div class="form-card">

            <div class="section-title">
                ⭐ Rating & Spicy Level
            </div>

            <div class="form-grid">

                {{-- Rating --}}
                <div class="form-group">

                    <label class="form-label">
                        Rating
                    </label>

                    <div class="rating-box">

                        <input
                            type="hidden"
                            name="rating"
                            id="rating"
                            value="{{ old('rating', 0) }}"
                        >

                        <div class="rating-stars" id="ratingStars">

                            <span class="star" data-rating="1">★</span>
                            <span class="star" data-rating="2">★</span>
                            <span class="star" data-rating="3">★</span>
                            <span class="star" data-rating="4">★</span>
                            <span class="star" data-rating="5">★</span>

                        </div>

                        <div class="rating-number">
                            <span id="ratingValue">
                                {{ old('rating', 0) }}
                            </span>
                            / 5
                        </div>

                    </div>

                </div>

                {{-- Spicy Level --}}
                <div class="form-group">

                    <label class="form-label">
                        🌶️ Spicy Level
                    </label>

                    <select
                        name="spicy_level"
                        class="form-select"
                    >
                        <option value="0" {{ old('spicy_level', 0) == 0 ? 'selected' : '' }}>
                            0 - Not Spicy
                        </option>

                        <option value="1" {{ old('spicy_level') == 1 ? 'selected' : '' }}>
                            1 - Very Mild
                        </option>

                        <option value="2" {{ old('spicy_level') == 2 ? 'selected' : '' }}>
                            2 - Mild
                        </option>

                        <option value="3" {{ old('spicy_level') == 3 ? 'selected' : '' }}>
                            3 - Medium
                        </option>

                        <option value="4" {{ old('spicy_level') == 4 ? 'selected' : '' }}>
                            4 - Hot
                        </option>

                        <option value="5" {{ old('spicy_level') == 5 ? 'selected' : '' }}>
                            5 - Very Hot
                        </option>
                    </select>

                </div>

            </div>
        </div>


        <div class="form-card">

    <div class="section-title">
        🤖 AI Food Properties
    </div>

    <div class="section-description">
        Choose the properties that apply to this meal.
        These properties will help the chatbot understand the meal.
    </div>

    <div class="checkbox-grid">

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_spicy"
                value="1"
                {{ old('is_spicy') ? 'checked' : '' }}
            >
            🌶️ Spicy
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="has_cheese"
                value="1"
                {{ old('has_cheese') ? 'checked' : '' }}
            >
            🧀 Contains Cheese
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="has_chicken"
                value="1"
                {{ old('has_chicken') ? 'checked' : '' }}
            >
            🍗 Contains Chicken
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="has_meat"
                value="1"
                {{ old('has_meat') ? 'checked' : '' }}
            >
            🥩 Contains Meat
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="has_mushroom"
                value="1"
                {{ old('has_mushroom') ? 'checked' : '' }}
            >
            🍄 Contains Mushroom
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_vegetarian"
                value="1"
                {{ old('is_vegetarian') ? 'checked' : '' }}
            >
            🌱 Vegetarian
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_healthy"
                value="1"
                {{ old('is_healthy') ? 'checked' : '' }}
            >
            🥗 Healthy / Diet
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_vegan"
                value="1"
                {{ old('is_vegan') ? 'checked' : '' }}
            >
            🌿 Vegan
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_gluten_free"
                value="1"
                {{ old('is_gluten_free') ? 'checked' : '' }}
            >
            🌾 Gluten Free
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_dairy_free"
                value="1"
                {{ old('is_dairy_free') ? 'checked' : '' }}
            >
            🥛 Dairy Free
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_high_protein"
                value="1"
                {{ old('is_high_protein') ? 'checked' : '' }}
            >
            💪 High Protein
        </label>

        <label class="checkbox-item">
            <input
                type="checkbox"
                name="is_low_calorie"
                value="1"
                {{ old('is_low_calorie') ? 'checked' : '' }}
            >
            🔥 Low Calorie
        </label>

    </div>
</div>
        {{-- =========================
             ADDITIONAL INFORMATION
        ========================== --}}
        <div class="form-card">

            <div class="section-title">
                📊 Additional Information
            </div>

            <div class="form-grid">

                {{-- Calories --}}
                <div class="form-group">

                    <label class="form-label">
                        Calories
                    </label>

                    <input
                        type="number"
                        name="calories"
                        class="form-control"
                        value="{{ old('calories') }}"
                        min="0"
                        placeholder="Example: 450"
                    >

                    <div class="form-help">
                        Approximate calories per serving.
                    </div>

                </div>

                {{-- Availability --}}
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
                            {{ old('is_available', true) ? 'checked' : '' }}
                        >

                        <label for="is_available">
                            ✅ Meal is available for ordering
                        </label>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             IMAGE
        ========================== --}}
        <div class="form-card">

            <div class="section-title">
                🖼️ Meal Image
            </div>

            <div class="form-group">

                <label class="form-label">
                    Upload Image
                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    class="form-control"
                    accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                >

                <div class="form-help">
                    Supported: JPG, JPEG, PNG, GIF, WEBP. Maximum size: 2MB.
                </div>

                <div class="image-preview-wrapper" id="imagePreviewWrapper">
                    <img
                        src=""
                        id="imagePreview"
                        class="image-preview"
                        alt="Meal Preview"
                    >
                </div>

            </div>

        </div>


        {{-- =========================
             ACTIONS
        ========================== --}}
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
                💾 Save Meal
            </button>

        </div>

    </form>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* =========================
           RATING
        ========================== */

        const ratingInput = document.getElementById('rating');
        const ratingValue = document.getElementById('ratingValue');
        const stars = document.querySelectorAll('#ratingStars .star');

        function updateStars(value) {
            stars.forEach(function (star) {
                const starRating = parseInt(star.dataset.rating);

                if (starRating <= value) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });

            ratingValue.textContent = value;
        }

        stars.forEach(function (star) {

            star.addEventListener('click', function () {

                const value = parseInt(this.dataset.rating);

                ratingInput.value = value;

                updateStars(value);

            });

        });

        updateStars(parseInt(ratingInput.value || 0));


        /* =========================
           IMAGE PREVIEW
        ========================== */

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');

        imageInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                imagePreviewWrapper.style.display = 'none';
                imagePreview.src = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                imagePreview.src = event.target.result;

                imagePreviewWrapper.style.display = 'block';

            };

            reader.readAsDataURL(file);

        });

    });
</script>

@endsection
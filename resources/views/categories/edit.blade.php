@extends('layout.app')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Edit Category</h1>
            <p>Update category information and food properties.</p>
        </div>

        <a href="{{ route('categories') }}" class="back-btn">
            ← Back to Categories
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('categories.update', $category->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        {{-- ================= BASIC INFORMATION ================= --}}
        <div class="card">

            <div class="card-header">
                <h2>Basic Information</h2>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="name">Category Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        placeholder="Enter category name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter category description"
                    >{{ old('description', $category->description) }}</textarea>
                </div>

            </div>

        </div>


        {{-- ================= PRICE & SALE ================= --}}
        <div class="card">

            <div class="card-header">
                <h2>Price & Sale</h2>
            </div>

            <div class="form-grid three-columns">

                <div class="form-group">
                    <label for="price">Price</label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        min="0"
                        value="{{ old('price', $category->price) }}"
                        placeholder="0.00"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="discount_price">Discount Price</label>

                    <input
                        type="number"
                        id="discount_price"
                        name="discount_price"
                        step="0.01"
                        min="0"
                        value="{{ old('discount_price', $category->discount_price) }}"
                        placeholder="0.00"
                    >
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>

                    <input
                        type="number"
                        id="rating"
                        name="rating"
                        step="0.01"
                        min="0"
                        max="5"
                        value="{{ old('rating', $category->rating ?? 0) }}"
                        placeholder="0 - 5"
                    >
                </div>

            </div>

            <label class="switch-row">

                <input
                    type="checkbox"
                    name="is_on_sale"
                    value="1"
                    {{ old('is_on_sale', $category->is_on_sale ?? false) ? 'checked' : '' }}
                >

                <span>
                    <strong>Category is on sale</strong>
                    <small>Enable discount price for this category.</small>
                </span>

            </label>

        </div>


        {{-- ================= FOOD PROPERTIES ================= --}}
        <div class="card">

            <div class="card-header">
                <div>
                    <h2>Food Properties</h2>
                    <p>Select the properties that describe this category.</p>
                </div>
            </div>

            <div class="checkbox-grid">

                {{-- Spicy --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_spicy"
                        value="1"
                        {{ old('is_spicy', $category->is_spicy ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🌶️ Spicy</strong>
                        <small>Contains spicy food.</small>
                    </span>
                </label>


                {{-- Cheese --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_cheese"
                        value="1"
                        {{ old('has_cheese', $category->has_cheese ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🧀 Contains Cheese</strong>
                        <small>Contains cheese.</small>
                    </span>
                </label>


                {{-- Chicken --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_chicken"
                        value="1"
                        {{ old('has_chicken', $category->has_chicken ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🍗 Chicken</strong>
                        <small>Contains chicken.</small>
                    </span>
                </label>


                {{-- Meat --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_meat"
                        value="1"
                        {{ old('has_meat', $category->has_meat ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🥩 Meat</strong>
                        <small>Contains meat.</small>
                    </span>
                </label>


                {{-- Mushroom --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="has_mushroom"
                        value="1"
                        {{ old('has_mushroom', $category->has_mushroom ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🍄 Mushroom</strong>
                        <small>Contains mushroom.</small>
                    </span>
                </label>


                {{-- Vegetarian --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_vegetarian"
                        value="1"
                        {{ old('is_vegetarian', $category->is_vegetarian ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🥗 Vegetarian</strong>
                        <small>Suitable for vegetarians.</small>
                    </span>
                </label>


                {{-- Healthy --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_healthy"
                        value="1"
                        {{ old('is_healthy', $category->is_healthy ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>💚 Healthy / Diet</strong>
                        <small>Healthy or diet-friendly food.</small>
                    </span>
                </label>


                {{-- Vegan --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_vegan"
                        value="1"
                        {{ old('is_vegan', $category->is_vegan ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🌱 Vegan</strong>
                        <small>Suitable for vegans.</small>
                    </span>
                </label>


                {{-- Gluten Free --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_gluten_free"
                        value="1"
                        {{ old('is_gluten_free', $category->is_gluten_free ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🌾 Gluten Free</strong>
                        <small>Does not contain gluten.</small>
                    </span>
                </label>


                {{-- Dairy Free --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_dairy_free"
                        value="1"
                        {{ old('is_dairy_free', $category->is_dairy_free ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🥛 Dairy Free</strong>
                        <small>Does not contain dairy products.</small>
                    </span>
                </label>


                {{-- High Protein --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_high_protein"
                        value="1"
                        {{ old('is_high_protein', $category->is_high_protein ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>💪 High Protein</strong>
                        <small>High protein food.</small>
                    </span>
                </label>


                {{-- Low Calorie --}}
                <label class="checkbox-item">
                    <input
                        type="checkbox"
                        name="is_low_calorie"
                        value="1"
                        {{ old('is_low_calorie', $category->is_low_calorie ?? false) ? 'checked' : '' }}
                    >

                    <span>
                        <strong>🔥 Low Calorie</strong>
                        <small>Low calorie food.</small>
                    </span>
                </label>

            </div>

        </div>


        {{-- ================= IMAGE ================= --}}
        <div class="card">

            <div class="card-header">
                <h2>Category Image</h2>
            </div>

            @if ($category->image)

                <div class="current-image">
                    <p>Current Image</p>

                    <img
                        src="{{ asset('storage/' . $category->image) }}"
                        alt="{{ $category->name }}"
                    >
                </div>

            @endif

            <div class="form-group">

                <label for="image">Change Image</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                >

                <small>
                    Leave empty if you don't want to change the current image.
                </small>

            </div>

            <div id="image-preview-container" style="display:none;">
                <p>New Image Preview</p>

                <img
                    id="image-preview"
                    src=""
                    alt="Preview"
                >
            </div>

        </div>


        {{-- ================= ACTIONS ================= --}}
        <div class="actions">

            <a
                href="{{ route('categories') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Category
            </button>

        </div>

    </form>

</div>


<style>

    .page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 30px;
        background: #f8fafc;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 6px;
        font-size: 30px;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
    }

    .back-btn {
        text-decoration: none;
        padding: 11px 18px;
        border: 1px solid #e5e7eb;
        border-radius: 9px;
        color: #374151;
        background: #ffffff;
        font-weight: 600;
    }

    .card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 25px;
        margin-bottom: 22px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.04);
    }

    .card-header {
        margin-bottom: 22px;
    }

    .card-header h2 {
        margin: 0 0 5px;
        font-size: 20px;
        color: #111827;
    }

    .card-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .three-columns {
        grid-template-columns: repeat(3, 1fr);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        outline: none;
        font-size: 14px;
        background: #ffffff;
        transition: 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }

    .form-group small {
        color: #6b7280;
        font-size: 12px;
    }

    .switch-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 10px;
        cursor: pointer;
    }

    .switch-row input {
        width: 18px;
        height: 18px;
    }

    .switch-row span {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .switch-row strong {
        color: #111827;
    }

    .switch-row small {
        color: #6b7280;
    }

    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
        background: #f8fafc;
        cursor: pointer;
        transition: 0.2s;
    }

    .checkbox-item:hover {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .checkbox-item input {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        cursor: pointer;
    }

    .checkbox-item span {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .checkbox-item strong {
        color: #1f2937;
        font-size: 14px;
    }

    .checkbox-item small {
        color: #6b7280;
        font-size: 12px;
    }

    .current-image {
        margin-bottom: 20px;
    }

    .current-image p {
        font-weight: 600;
        color: #374151;
        margin-bottom: 10px;
    }

    .current-image img,
    #image-preview {
        width: 180px;
        height: 130px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    #image-preview-container {
        margin-top: 20px;
    }

    #image-preview-container p {
        font-weight: 600;
        color: #374151;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 25px;
    }

    .btn {
        display: inline-block;
        padding: 12px 22px;
        border-radius: 9px;
        border: none;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary {
        background: #2563eb;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #ffffff;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-secondary:hover {
        background: #f3f4f6;
    }

    .alert {
        padding: 15px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert ul {
        margin: 8px 0 0 20px;
    }

    @media (max-width: 900px) {

        .checkbox-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .three-columns {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {

        .page-container {
            padding: 18px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .checkbox-grid {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column;
        }

        .actions .btn {
            text-align: center;
        }
    }

</style>


<script>

    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');

    if (imageInput) {

        imageInput.addEventListener('change', function(event) {

            const file = event.target.files[0];

            if (!file) {
                previewContainer.style.display = 'none';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {

                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';

            };

            reader.readAsDataURL(file);

        });

    }

</script>

@endsection
@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-custom-yellow m-0">إضافة وجبة جديدة 🍔</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                العودة للوحة التحكم
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.meals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- اسم الوجبة -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">اسم الوجبة</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="أدخل اسم الوجبة">
                    </div>

                    <!-- تصنيف الوجبة -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-bold">تصنيف الوجبة</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="" disabled selected>اختر قسم الوجبة...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- الوصف -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">وصف الوجبة</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="وصف مكونات الوجبة">{{ old('description') }}</textarea>
                    </div>

                    <!-- السعر -->
                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">السعر (ج.م)</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required placeholder="0.00">
                    </div>

                 <!-- خصم الوجبة (جديد) -->
             <div class="mb-3">
                 <label for="discount" class="form-label fw-bold">  قيمة أو نسبة الخصم (اختياري) % </label>
                 <div class="input-group">
                     <input type="number" step="0.01" min="0" max="100" name="discount" id="discount" class="form-control" value="{{ old('discount',$meal->discount ??'') }}" placeholder="0.00">
                     <span class="input-group=text">%</span>
                     </div>     
                     </div>
                    <!-- صورة الوجبة -->
                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">صورة الوجبة</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    <!-- زر الحفظ -->
                    <button type="submit" class="btn btn-warning w-100 fw-bold py-2 fs-5">
                        حفظ الوجبة ✨
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
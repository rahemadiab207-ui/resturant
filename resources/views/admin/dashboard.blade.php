@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-custom-yellow m-0">لوحة تحكم الأدمن 🛠️</h2>
        <a href="{{ route('admin.meals.create') }}" class="btn btn-warning fw-bold">
            ➕ إضافة وجبة جديدة
        </a>
    </div>

    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-custom-black text-white p-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold text-custom-yellow">قائمة الوجبات المضافة 🍽️</h5>
                <span class="badge bg-warning text-dark fs-6">{{ isset($meals) ? $meals->count() : 0 }} وجبة</span>
            </div>
            <div class="card-body p-0">
                @if(isset($meals) && $meals->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>الصورة</th>
                                    <th>اسم الوجبة</th>
                                    <th>القسم</th>
                                    <th>السعر</th>
                                    <th>الوصف</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($meals as $meal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($meal->image)
                                                <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" width="55" height="55" class="img-thumbnail rounded-circle object-fit-cover">
                                            @else
                                                <span class="badge bg-secondary">بدون صورة</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $meal->name }}</strong></td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                {{ $meal->category->name ?? 'غير محدد' }}
                                            </span>
                                        </td>
                                        <td class="fw-bold text-success">{{ number_format($meal->price, 2) }} ج.م</td>
                                        <td class="text-muted" style="max-width: 200px;">{{ $meal->description ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.meals.create', $meal->id) }}" class="btn btn-sm btn-outline-warning me-1">تعديل ✏️</a>
                                            
                                            <form action="{{ route('admin.meals.destroy', $meal->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذه الوجبة؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">حذف 🗑️</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center m-4">
                        لا توجد وجبات مضافة حتى الآن.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
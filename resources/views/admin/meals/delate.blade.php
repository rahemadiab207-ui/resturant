@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-danger text-white text-center py-3">
                    <h4 class="fw-bold mb-0">⚠️ تأكيد حذف الوجبة</h4>
                </div>
                <div class="card-body p-4 text-center">
                    @if($meal->image)
                        <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" class="rounded mb-3" style="max-height: 150px; object-fit: cover;">
                    @endif
                    <h3 class="fw-bold text-dark mb-2">{{ $meal->name }}</h3>
                    <p class="text-muted mb-3">{{ $meal->description }}</p>
                    <div class="badge bg-warning text-dark fs-6 mb-4">{{ $meal->price }} ج.م</div>

                    <div class="alert alert-warning text-start small">
                        <strong>تنبيه:</strong> عند الضغط على "تأكيد الحذف"، سيتم مسح بيانات الوجبة بشكل نهائي.
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 fw-bold">
                            إلغاء وتراجع
                        </a>
                        <form action="{{ route('admin.meals.destroy', $meal->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4 fw-bold">
                                تأكيد الحذف 🗑️
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

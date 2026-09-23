@extends('layout.app')

@section('content')
<div class="container py-4">
    <!-- كارت تعريفي بالأدمن -->
    <div class="card shadow-sm border-0 mb-4 bg-dark text-white p-3 rounded">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center fw-bold fs-3" style="width: 60px; height: 60px;">
                👑
            </div>
            <div>
                <h3 class="mb-0 fw-bold text-custom-yellow">{{ $user->name }}</h3>
                <span class="badge bg-danger mt-1 fs-6">مدير النظام (Admin)</span>
                <p class="text-muted small mb-0 mt-1">{{ $user->email }} | {{ $user->phone1 }}</p>
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-3 border-bottom border-warning border-2 d-inline-block pb-1 text-custom-yellow">ملخص إحصائيات اليوم 📊</h4>

    <!-- أزرار وكروت الإحصائيات التفاعلية -->
    <div class="row g-3 mb-4">
        <!-- كارت عدد طلبات اليوم -->
        <div class="col-md-4">
            <a href="{{ route('admin.orders') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 bg-primary text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1 opacity-75">طلبات اليوم</h6>
                            <h2 class="fw-bold mb-0">{{ $todayOrdersCount }}</h2>
                        </div>
                        <div class="fs-1">🛍️</div>
                    </div>
                </div>
            </a>
        </div>

        <!-- كارت الطلبات معلقة / قيد الانتظار -->
        <div class="col-md-4">
            <a href="{{ route('admin.orders') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 bg-warning text-dark h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1 opacity-75">طلبات قيد الانتظار</h6>
                            <h2 class="fw-bold mb-0">{{ $pendingOrdersCount }}</h2>
                        </div>
                        <div class="fs-1">⏳</div>
                    </div>
                </div>
            </a>
        </div>

        <!-- كارت مبيعات اليوم -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1 opacity-75">مبيعات اليوم المحصلة</h6>
                        <h2 class="fw-bold mb-0">{{ $todaySales }} ج.م</h2>
                    </div>
                    <div class="fs-1">💰</div>
                </div>
            </div>
        </div>
    </div>

    <!-- أزرار الوصول السريع لأقسام الأدمن -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold mb-3">إجراءات سريعة ⚡</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary fw-bold">
                    📦 إدارة كل الطلبات
                </a>
                <a href="{{ route('admin.meals.create') }}" class="btn btn-outline-success fw-bold">
                    ➕ إضافة وجبة جديدة
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark fw-bold">
                    🖥️ لوحة التحكم الرئيسية
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
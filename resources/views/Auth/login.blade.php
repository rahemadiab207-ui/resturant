
@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-warning text-dark text-center fw-bold fs-5">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> تسجيل الدخول
                </div>
                <div class="card-body p-4">
                    <!-- عرض الأخطاء إن وجدت -->
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- تذكرني -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label class="form-check-label small" for="remember">تذكر بياناتي</label>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-bold">دخول</button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">إنشاء حساب جديد</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
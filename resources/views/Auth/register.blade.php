@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-warning text-dark text-center fw-bold fs-5">
                    <i class="fa-solid fa-user-plus me-1"></i> إنشاء حساب جديد
                </div>
                <div class="card-body p-4">
                    <!-- عرض أخطاء الـ Validation -->
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- الاسم بالكامل -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">الاسم بالكامل</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <!-- رقم الهاتف الأساسي -->
                        <div class="mb-3">
                            <label for="phone1" class="form-label fw-bold">رقم الهاتف 1 </label>
                            <input type="text" name="phone1" id="phone1" class="form-control" value="{{ old('phone1') }}" required>
                            <label for="phone2" class="form-label fw-bold">رقم الهاتف 2</label>
                            <input type="text" name="phone2" id="phone2" class="form-control" value="{{ old('phone2') }}" required>
                        
                        </div>
                        <!-- العنوان -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">العنوان التفصيلي</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>


                        <div class="mb-3">
                              <label class="form-label fw-bold">نوع الحساب</label>
                           <select name="role" class="form-select" required>
                            <option value="user" selected>مستخدم عادي</option>
                             <option value="admin">مدير (أدمن)</option>
                               </select>
                                  </div>
                        <button type="submit" class="btn btn-warning w-100 fw-bold">تسجيل الحساب</button>
                    </form>
 

                    <div class="text-center mt-3">
                        <small class="text-muted">لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">تسجيل الدخول</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
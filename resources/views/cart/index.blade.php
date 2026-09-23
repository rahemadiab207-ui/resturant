@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-warning"><i class="fa-solid fa-cart-shopping me-2"></i>سلة الشراء</h2>
        <p class="text-muted">مراجعة الوجبات المختارة قبل تأكيد الطلب</p>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row g-4">
            <!-- جدول الوجبات -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>الوجبة</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th>الإجمالي</th>
                                        <th>إجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
       @php $total = 0; @endphp
        @foreach(session('cart') as $id => $details)
       @php $total += $details['price'] * $details['quantity']; @endphp
         <tr>
                 <td class="fw-bold "style="color:black!important ; font size: 1.2rem">{{ $details['name'] }}</td>
                    <td>{{ $details['price'] }} ج.م</td>
                             <td>{{ $details['quantity'] }}</td>
                             <td class="fw-bold text-black">{{ $details['price'] * $details['quantity'] }} ج.م</td>
                            <td>
                                    <form action="{{ route('cart.remove', $id) ?? '#' }}" method="POST">
                                     @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ملخص الفاتورة -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-warning text-dark fw-bold">ملخص الطلب</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>إجمالي الوجبات:</span>
                            <span class="fw-bold text-white fs-5">{{ $total }} ج.م</span>
                        </div>
                        <hr>
                        <a href="{{ route('checkout') ?? '#' }}" class="btn btn-warning w-100 fw-bold py-2">
                            تأكيد الطلب والدفع <i class="fa-solid fa-arrow-left ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- في حال كانت السلة فارغة -->
        <div class="text-center py-5">
            <div class="alert alert-warning d-inline-block px-5 py-3 rounded-3 shadow-sm">
                <i class="fa-solid fa-basket-shopping fs-2 mb-2 d-block"></i>
                سلة الشراء فارغة حالياً!
            </div>
            <div class="mt-3">
                <a href="{{ url('/') }}" class="btn btn-dark"><i class="fa-solid fa-utensils me-1"></i> تصفح المنيو</a>
            </div>
        </div>
    @endif
</div>
@endsection
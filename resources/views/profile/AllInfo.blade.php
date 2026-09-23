@extends('layout.app')

@section('content')
<div class="row">
  <div class="col-md-4 mb-4">
    <div class="card p-3 shadow-sm border-0 bg-light">
      <h4 class="fw-bold text-custom-yellow bg-dark p-2 rounded text-center">بيانات الحساب</h4>
      <p><strong>الاسم:</strong> {{ $user->name }}</p>
      <p><strong>البريد:</strong> {{ $user->email }}</p>
      <p><strong>الهاتف الأول:</strong> {{ $user->phone1 }}</p>
      <p><strong>الهاتف الثاني:</strong> {{ $user->phone2 ?? 'غير مدخل' }}</p>
      <p><strong>العنوان:</strong> {{ $user->address }}</p>
    </div>
  </div>

  <div class="col-md-8">
    <h3 class="fw-bold mb-3">حالة الطلبات</h3>

    <h5 class="fw-bold text-warning bg-dark p-2 rounded">الطلب الحالي:</h5>
    @if($currentOrder)
      <div class="card p-3 mb-4 border-warning">
        <p><strong>رقم الطلب:</strong> #{{ $currentOrder->id }}</p>
        <p><strong>الحالة:</strong> <span class="badge bg-warning text-dark">{{ $currentOrder->status }}</span></p>
        <p><strong>المبلغ الإجمالي:</strong> {{ $currentOrder->total_price }} ج.م</p>
      </div>
    @else
      <p class="text-muted">لا يوجد طلب قيد التحضير حالياً.</p>
    @endif

    <h5 class="fw-bold">سجل الطلبات السابقة:</h5>
    @foreach($pastOrders as $order)
      <div class="card p-3 mb-2 shadow-sm border-0">
        <div class="d-flex justify-content-between">
          <span><strong>طلب #{{ $order->id }}</strong> - {{ $order->created_at->format('Y-m-d') }}</span>
          <span class="badge bg-success">{{ $order->status }}</span>
        </div>
        <small class="text-muted">المبلغ: {{ $order->total_price }} ج.م</small>
      </div>
    @endforeach
  </div>
</div>
@endsection
@extends('layout.app')

@section('content')
<h2 class="fw-bold mb-4">إدارة طلبات العملاء (Admin Panel) 🌯</h2>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-dark text-custom-yellow">
      <tr>
        <th># الطلب</th>
        <th>اسم العميل</th>
        <th>هاتف 1</th>
        <th>هاتف 2</th>
        <th>العنوان</th>
        <th>الوجبات المطلوبة</th>
        <th>الإجمالي</th>
        <th>تاريخ الطلب</th>
        <th>الحالة والتحكم</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td class="fw-bold">#{{ $order->id }}</td>
        <td>{{ $order->user->name }}</td>
        <td><a href="tel:{{ $order->user->phone1 }}">{{ $order->user->phone1 }}</a></td>
        <td>{{ $order->user->phone2 ?? '---' }}</td>
        <td>{{ $order->user->address }}</td>
        <td>
          <ul class="mb-0 ps-3">
            @foreach($order->items as $item)
              <li><strong>{{ $item->meal->name }}</strong> (العدد: {{ $item->quantity }})</li>
            @endforeach
          </ul>
        </td>
        <td class="fw-bold text-success">{{ $order->total_price }} ج.م</td>
        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
        <td>
          <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
            @csrf
            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
              <option value="pending" {{ ($order->status ?? '') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
             <option value="processing" {{ ($order->status ?? '') == 'processing' ? 'selected' : '' }}>جاري التحضير</option>
             <option value="completed" {{ ($order->status ?? '') == 'completed' ? 'selected' : '' }}>مكتمل</option>
              <option value="cancelled" {{ ($order->status ?? '') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
            </select>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
@extends('layout.app')

@section('title', 'My Profile')

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">

        <div>
            <h1 class="page-title">
                My Profile
            </h1>

            <p class="page-subtitle">
                بيانات الحساب والطلبات السابقة
            </p>
        </div>

    </div>


    <div class="card-modern mb-4">

        <div class="card-modern-header">
            <h5>Account Information</h5>
        </div>

        <div class="card-modern-body">

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label-modern">
                        Name
                    </label>

                    <div class="info-box">
                        {{ $user->name }}
                    </div>

                </div>

                <div class="col-md-6">

                    <label class="form-label-modern">
                        Email
                    </label>

                    <div class="info-box">
                        {{ $user->email }}
                    </div>

                </div>

                <div class="col-md-6">

                    <label class="form-label-modern">
                        Phone
                    </label>

                    <div class="info-box">
                        {{ $user->phone1 ?? '-' }}
                    </div>

                </div>

                <div class="col-md-6">

                    <label class="form-label-modern">
                        Address
                    </label>

                    <div class="info-box">
                        {{ $user->address ?? '-' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    @if($currentOrder)

        <div class="card-modern mb-4">

            <div class="card-modern-header">
                <h5>Current Order</h5>
            </div>

            <div class="card-modern-body">

                <div class="d-flex justify-content-between">

                    <strong>
                        Order #{{ $currentOrder->id }}
                    </strong>

                    <span class="badge-modern badge-warning-modern">
                        {{ $currentOrder->status }}
                    </span>

                </div>

                <div class="mt-3">

                    Total:
                    <strong>
                        {{ number_format($currentOrder->total_price, 2) }}
                        EGP
                    </strong>

                </div>

            </div>

        </div>

    @endif


    <div class="card-modern">

        <div class="card-modern-header">
            <h5>Past Orders</h5>
        </div>

        <div class="card-modern-body">

            @forelse($pastOrders as $order)

                <div
                    class="border rounded-3 p-3 mb-3"
                >

                    <div class="d-flex justify-content-between">

                        <strong>
                            Order #{{ $order->id }}
                        </strong>

                        <span class="badge-modern badge-success-modern">
                            {{ $order->status }}
                        </span>

                    </div>

                    <div class="mt-2 text-muted">

                        Total:
                        {{ number_format($order->total_price, 2) }}
                        EGP

                    </div>

                </div>

            @empty

                <p class="text-muted mb-0">
                    لا توجد طلبات سابقة.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection
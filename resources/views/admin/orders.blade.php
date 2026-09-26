@extends('layout.app')

@section('title', 'Orders')

@section('content')

<style>
    .orders-page {
        padding: 30px;
        background: #f8fafc;
        min-height: calc(100vh - 70px);
    }

    .orders-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .orders-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #111827;
    }

    .orders-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .orders-count {
        background: #2563eb;
        color: white;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
    }

    .success-message {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .error-message {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .orders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(390px, 1fr));
        gap: 22px;
    }

    .order-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: 0.2s ease;
    }

    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .order-top {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .order-number {
        font-size: 19px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 5px;
    }

    .order-date {
        color: #6b7280;
        font-size: 13px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-confirmed {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-preparing {
        background: #ede9fe;
        color: #6d28d9;
    }

    .status-ready {
        background: #dcfce7;
        color: #15803d;
    }

    .status-out_for_delivery {
        background: #cffafe;
        color: #0e7490;
    }

    .status-delivered {
        background: #dcfce7;
        color: #166534;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #b91c1c;
    }

    .order-body {
        padding: 20px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 12px;
    }

    .customer-info {
        background: #f8fafc;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 18px;
    }

    .customer-row {
        display: flex;
        gap: 10px;
        margin-bottom: 8px;
        color: #4b5563;
        font-size: 14px;
    }

    .customer-row:last-child {
        margin-bottom: 0;
    }

    .customer-label {
        font-weight: 700;
        color: #111827;
        min-width: 75px;
    }

    .items-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 18px;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 11px 12px;
        background: #f9fafb;
        border-radius: 10px;
        border: 1px solid #f1f5f9;
    }

    .item-name {
        font-size: 14px;
        font-weight: 700;
        color: #1f2937;
    }

    .item-quantity {
        font-size: 12px;
        color: #6b7280;
        margin-top: 3px;
    }

    .item-price {
        font-size: 14px;
        font-weight: 800;
        color: #111827;
        white-space: nowrap;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 18px;
    }

    .total-label {
        font-size: 15px;
        font-weight: 800;
        color: #111827;
    }

    .total-value {
        font-size: 21px;
        font-weight: 900;
        color: #2563eb;
    }

    .status-section {
        background: #f8fafc;
        padding: 16px;
        border-radius: 13px;
        border: 1px solid #e5e7eb;
    }

    .status-section-title {
        font-size: 14px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 10px;
    }

    .status-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .status-select {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        background: white;
        color: #111827;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        outline: none;
    }

    .status-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .update-status-btn {
        width: 100%;
        border: none;
        background: #2563eb;
        color: white;
        padding: 11px 15px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .update-status-btn:hover {
        background: #1d4ed8;
    }

    .quick-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }

    .quick-action-btn {
        flex: 1;
        min-width: 120px;
        border: none;
        padding: 9px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-confirm {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .btn-confirm:hover {
        background: #bfdbfe;
    }

    .btn-preparing {
        background: #ede9fe;
        color: #6d28d9;
    }

    .btn-preparing:hover {
        background: #ddd6fe;
    }

    .btn-ready {
        background: #dcfce7;
        color: #15803d;
    }

    .btn-ready:hover {
        background: #bbf7d0;
    }

    .btn-delivery {
        background: #cffafe;
        color: #0e7490;
    }

    .btn-delivery:hover {
        background: #a5f3fc;
    }

    .btn-delivered {
        background: #dcfce7;
        color: #166534;
    }

    .btn-delivered:hover {
        background: #bbf7d0;
    }

    .btn-cancel {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-cancel:hover {
        background: #fecaca;
    }

    .empty-orders {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 60px 20px;
        text-align: center;
    }

    .empty-orders-icon {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .empty-orders h3 {
        margin: 0 0 8px;
        color: #111827;
        font-size: 21px;
    }

    .empty-orders p {
        margin: 0;
        color: #6b7280;
    }

    @media (max-width: 700px) {

        .orders-page {
            padding: 18px;
        }

        .orders-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .orders-grid {
            grid-template-columns: 1fr;
        }

        .order-top {
            flex-direction: column;
        }

        .status-badge {
            align-self: flex-start;
        }
    }
</style>


<div class="orders-page">

    {{-- Header --}}
    <div class="orders-header">

        <div>
            <h1>Orders</h1>

            <p>
                Manage customer orders and update their delivery status.
            </p>
        </div>

        <div class="orders-count">
            {{ $orders->count() }} Orders
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="error-message">
            {{ session('error') }}
        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="error-message">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif


    {{-- Orders --}}
    @if($orders->count() > 0)

        <div class="orders-grid">

            @foreach($orders as $order)

                @php

                    $status = $order->status ?? 'pending';

                    $statusLabels = [

                        'pending' => 'Pending',

                        'confirmed' => 'Confirmed',

                        'preparing' => 'Preparing - Kitchen',

                        'ready' => 'Ready',

                        'out_for_delivery' => 'Out for Delivery',

                        'delivered' => 'Delivered',

                        'cancelled' => 'Cancelled',

                    ];

                    $statusLabel = $statusLabels[$status]
                        ?? ucfirst(str_replace('_', ' ', $status));

                @endphp


                <div class="order-card">

                    {{-- Order Header --}}
                    <div class="order-top">

                        <div>

                            <div class="order-number">
                                Order #{{ $order->id }}
                            </div>

                            <div class="order-date">

                                {{ $order->created_at?->format('d M Y - h:i A') }}

                            </div>

                        </div>


                        <div class="status-badge status-{{ $status }}">

                            {{ $statusLabel }}

                        </div>

                    </div>


                    {{-- Order Body --}}
                    <div class="order-body">


                        {{-- Customer --}}
                        <div class="section-title">
                            Customer Information
                        </div>

                        <div class="customer-info">

                            <div class="customer-row">

                                <span class="customer-label">
                                    Name:
                                </span>

                                <span>
                                    {{ $order->user->name ?? 'Guest' }}
                                </span>

                            </div>


                            @if(!empty($order->user?->email))

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Email:
                                    </span>

                                    <span>
                                        {{ $order->user->email }}
                                    </span>

                                </div>

                            @endif


                            @if(!empty($order->phone))

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Phone:
                                    </span>

                                    <span>
                                        {{ $order->phone }}
                                    </span>

                                </div>

                            @elseif(!empty($order->user?->phone1))

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Phone:
                                    </span>

                                    <span>
                                        {{ $order->user->phone1 }}
                                    </span>

                                </div>

                            @endif


                            @if(!empty($order->address))

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Address:
                                    </span>

                                    <span>
                                        {{ $order->address }}
                                    </span>

                                </div>

                            @elseif(!empty($order->user?->address))

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Address:
                                    </span>

                                    <span>
                                        {{ $order->user->address }}
                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- Items --}}
                        <div class="section-title">
                            Order Items
                        </div>


                        <div class="items-list">

                            @if($order->items && $order->items->count() > 0)

                                @foreach($order->items as $item)

                                    <div class="item-row">

                                        <div>

                                            <div class="item-name">

                                                {{ $item->meal->name
                                                    ?? $item->name
                                                    ?? 'Meal' }}

                                            </div>

                                            <div class="item-quantity">

                                                Quantity:
                                                {{ $item->quantity ?? 1 }}

                                            </div>

                                        </div>


                                        <div class="item-price">

                                            {{ number_format(
                                                ($item->price ?? 0) *
                                                ($item->quantity ?? 1),
                                                2
                                            ) }}

                                        </div>

                                    </div>

                                @endforeach

                            @else

                                <div class="item-row">

                                    <div class="item-name">
                                        No items found
                                    </div>

                                </div>

                            @endif

                        </div>


                        {{-- Total --}}
                        <div class="order-total">

                            <span class="total-label">
                                Total
                            </span>

                            <span class="total-value">

                                {{ number_format($order->total ?? 0, 2) }}

                            </span>

                        </div>


                        {{-- Payment --}}
                        @if(!empty($order->payment_method))

                            <div class="customer-info">

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Payment:
                                    </span>

                                    <span>
                                        {{ ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $order->payment_method
                                            )
                                        ) }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        {{-- Notes --}}
                        @if(!empty($order->notes))

                            <div class="customer-info">

                                <div class="customer-row">

                                    <span class="customer-label">
                                        Notes:
                                    </span>

                                    <span>
                                        {{ $order->notes }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        {{-- Status Actions --}}
                        <div class="status-section">

                            <div class="status-section-title">
                                Update Order Status
                            </div>


                            <form
                                action="{{ route('orders.status', $order->id) }}"
                                method="POST"
                                class="status-form"
                            >

                                @csrf

                                @method('PUT')


                                <select
                                    name="status"
                                    class="status-select"
                                >

                                    <option
                                        value="pending"
                                        {{ $status === 'pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>


                                    <option
                                        value="confirmed"
                                        {{ $status === 'confirmed' ? 'selected' : '' }}
                                    >
                                        Confirmed
                                    </option>


                                    <option
                                        value="preparing"
                                        {{ $status === 'preparing' ? 'selected' : '' }}
                                    >
                                        Preparing - Kitchen
                                    </option>


                                    <option
                                        value="ready"
                                        {{ $status === 'ready' ? 'selected' : '' }}
                                    >
                                        Ready
                                    </option>


                                    <option
                                        value="out_for_delivery"
                                        {{ $status === 'out_for_delivery' ? 'selected' : '' }}
                                    >
                                        Out for Delivery
                                    </option>


                                    <option
                                        value="delivered"
                                        {{ $status === 'delivered' ? 'selected' : '' }}
                                    >
                                        Delivered
                                    </option>


                                    <option
                                        value="cancelled"
                                        {{ $status === 'cancelled' ? 'selected' : '' }}
                                    >
                                        Cancelled
                                    </option>

                                </select>


                                <button
                                    type="submit"
                                    class="update-status-btn"
                                >
                                    Update Status
                                </button>

                            </form>


                            {{-- Quick Actions --}}
                            <div class="quick-actions">


                                @if($status === 'pending')

                                    <form
                                        action="{{ route('orders.status', $order->id) }}"
                                        method="POST"
                                        style="flex:1;"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="confirmed"
                                        >

                                        <button
                                            type="submit"
                                            class="quick-action-btn btn-confirm"
                                            style="width:100%;"
                                        >
                                            Confirm Order
                                        </button>

                                    </form>

                                @endif


                                @if($status === 'confirmed')

                                    <form
                                        action="{{ route('orders.status', $order->id) }}"
                                        method="POST"
                                        style="flex:1;"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="preparing"
                                        >

                                        <button
                                            type="submit"
                                            class="quick-action-btn btn-preparing"
                                            style="width:100%;"
                                        >
                                            Start Preparing
                                        </button>

                                    </form>

                                @endif


                                @if($status === 'preparing')

                                    <form
                                        action="{{ route('orders.status', $order->id) }}"
                                        method="POST"
                                        style="flex:1;"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="ready"
                                        >

                                        <button
                                            type="submit"
                                            class="quick-action-btn btn-ready"
                                            style="width:100%;"
                                        >
                                            Mark as Ready
                                        </button>

                                    </form>

                                @endif


                                @if($status === 'ready')

                                    <form
                                        action="{{ route('orders.status', $order->id) }}"
                                        method="POST"
                                        style="flex:1;"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="out_for_delivery"
                                        >

                                        <button
                                            type="submit"
                                            class="quick-action-btn btn-delivery"
                                            style="width:100%;"
                                        >
                                            Send to Delivery
                                        </button>

                                    </form>

                                @endif


                                @if($status === 'out_for_delivery')

                                    <form
                                        action="{{ route('orders.status', $order->id) }}"
                                        method="POST"
                                        style="flex:1;"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="delivered"
                                        >

                                        <button
                                            type="submit"
                                            class="quick-action-btn btn-delivered"
                                            style="width:100%;"
                                        >
                                            Mark as Delivered
                                        </button>

                                    </form>

                                @endif


                                @if(
                                    $status !== 'cancelled' &&
                                    $status !== 'delivered'
                                )

                                    <form
                                        action="{{ route('orders.status', $order->id) }}"
                                        method="POST"
                                        style="flex:1;"
                                        onsubmit="return confirm('Are you sure you want to cancel this order?');"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="cancelled"
                                        >

                                        <button
                                            type="submit"
                                            class="quick-action-btn btn-cancel"
                                            style="width:100%;"
                                        >
                                            Cancel Order
                                        </button>

                                    </form>

                                @endif


                            </div>

                        </div>


                    </div>

                </div>

            @endforeach

        </div>


    @else

        <div class="empty-orders">

            <div class="empty-orders-icon">
                📦
            </div>

            <h3>
                No Orders Found
            </h3>

            <p>
                There are no customer orders yet.
            </p>

        </div>

    @endif


</div>

@endsection
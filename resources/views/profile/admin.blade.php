@extends('layout.app')

@section('title', 'Admin Profile')

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Admin Profile</h1>
            <p class="page-subtitle">معلومات وإحصائيات الحساب</p>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-label">Today's Orders</div>
                <div class="stat-value">
                    {{ $todayOrdersCount ?? 0 }}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-label">Pending Orders</div>
                <div class="stat-value">
                    {{ $pendingOrdersCount ?? 0 }}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-label">Today's Sales</div>
                <div class="stat-value">
                    {{ number_format($todaySales ?? 0, 2) }}
                    EGP
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-label">Role</div>
                <div class="stat-value">
                    Admin
                </div>
            </div>
        </div>

    </div>

    <div class="card-modern mt-4">

        <div class="card-modern-header">
            <h5>Account Information</h5>
        </div>

        <div class="card-modern-body">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label-modern">Name</label>
                    <div class="info-box">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label-modern">Email</label>
                    <div class="info-box">
                        {{ $user->email }}
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
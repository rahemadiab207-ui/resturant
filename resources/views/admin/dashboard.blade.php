@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="container py-4">

    <div class="page-header mb-4">

        <div>

            <h1 class="page-title">
                Dashboard
            </h1>

            <p class="page-subtitle">
                نظرة عامة على نظام المطعم
            </p>

        </div>

    </div>


    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-label">
                    Total Orders
                </div>

                <div class="stat-value">
                    {{ $totalOrders }}
                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-label">
                    Pending Orders
                </div>

                <div class="stat-value">
                    {{ $pendingOrders }}
                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-label">
                    Customers
                </div>

                <div class="stat-value">
                    {{ $totalUsers }}
                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-label">
                    Monthly Sales
                </div>

                <div class="stat-value">
                    {{ number_format($monthlySales, 2) }}
                    EGP
                </div>

            </div>

        </div>

    </div>


    <div class="row g-4">

        <div class="col-lg-7">

            <div class="card-modern">

                <div class="card-modern-header">

                    <h5>
                        Latest Meals
                    </h5>

                </div>

                <div class="table-responsive">

                    <table class="table table-modern">

                        <thead>

                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>

                        </thead>

                        <tbody>

                        @forelse($meals->take(8) as $meal)

                            <tr>

                                <td>
                                    {{ $meal->name }}
                                </td>

                                <td>
                                    {{ $meal->category?->name ?? '-' }}
                                </td>

                                <td>
                                    {{ number_format($meal->active_price, 2) }}
                                    EGP
                                </td>

                                <td>

                                    @if($meal->is_available)

                                        <span class="badge-modern badge-success-modern">
                                            Available
                                        </span>

                                    @else

                                        <span class="badge-modern badge-danger-modern">
                                            Unavailable
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center text-muted py-4"
                                >
                                    No meals found.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <div class="col-lg-5">

            <div class="card-modern">

                <div class="card-modern-header">

                    <h5>
                        Top Meals
                    </h5>

                </div>

                <div class="card-modern-body">

                    @forelse($topMeals as $item)

                        <div
                            class="d-flex justify-content-between align-items-center border-bottom py-3"
                        >

                            <strong>
                                {{ $item->meal?->name ?? 'Unknown' }}
                            </strong>

                            <span class="badge-modern badge-primary-modern">
                                {{ $item->total_qty }}
                            </span>

                        </div>

                    @empty

                        <p class="text-muted mb-0">
                            No order data available.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
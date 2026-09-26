

@extends('layout.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Customers</h2>
            <p class="text-muted mb-0">Manage all registered customers</p>
        </div>

        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addCustomerModal"
        >
            Add Customer
        </button>
    </div>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">Customers List</h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-striped mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone 1</th>
                            <th>Phone 2</th>
                            <th>Address</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($customers as $customer)

                            <tr>

                                <td>
                                    {{ $customer->id }}
                                </td>

                                <td>
                                    {{ $customer->name }}
                                </td>

                                <td>
                                    {{ $customer->email }}
                                </td>

                                <td>
                                    {{ $customer->phone1 ?? '-' }}
                                </td>

                                <td>
                                    {{ $customer->phone2 ?? '-' }}
                                </td>

                                <td>
                                    {{ $customer->address ?? '-' }}
                                </td>

                                <td>
                                    {{ $customer->created_at?->format('Y-m-d') ?? '-' }}
                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('customers.show', $customer->id) }}"
                                            class="btn btn-sm btn-info text-white"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('customers.edit', $customer->id) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('customers.destroy', $customer->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this customer?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    No customers found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- ADD CUSTOMER MODAL --}}

<div
    class="modal fade"
    id="addCustomerModal"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                action="{{ route('customers.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Customer
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required
                            >

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                required
                            >

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Phone 1
                            </label>

                            <input
                                type="text"
                                name="phone1"
                                class="form-control"
                                value="{{ old('phone1') }}"
                                required
                            >

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Phone 2
                            </label>

                            <input
                                type="text"
                                name="phone2"
                                class="form-control"
                                value="{{ old('phone2') }}"
                            >

                        </div>


                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                                required
                            >{{ old('address') }}</textarea>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required
                            >

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Customer
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
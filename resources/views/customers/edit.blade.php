@extends('layout.app')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Edit Customer</h2>
            <p class="text-muted mb-0">
                Update customer information
            </p>
        </div>

        <a
            href="{{ route('customers') }}"
            class="btn btn-secondary"
        >
            Back to Customers
        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                Edit: {{ $customer->name }}
            </h5>
        </div>


        <div class="card-body">

            <form
                action="{{ route('customers.update', $customer->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="row">


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $customer->name) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $customer->email) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Phone 1
                        </label>

                        <input
                            type="text"
                            name="phone1"
                            class="form-control"
                            value="{{ old('phone1', $customer->phone1) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Phone 2
                        </label>

                        <input
                            type="text"
                            name="phone2"
                            class="form-control"
                            value="{{ old('phone2', $customer->phone2) }}"
                        >

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label fw-bold">
                            Address
                        </label>

                        <textarea
                            name="address"
                            class="form-control"
                            rows="3"
                            required
                        >{{ old('address', $customer->address) }}</textarea>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            minlength="8"
                            placeholder="Leave empty to keep current password"
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            minlength="8"
                            placeholder="Confirm new password"
                        >

                    </div>


                </div>


                <div class="d-flex justify-content-between mt-4">

                    <a
                        href="{{ route('customers.show', $customer->id) }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update Customer
                    </button>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection
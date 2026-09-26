@extends('layout.app')

@section('title', 'Register')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card-modern">

                <div class="card-modern-header">

                    <h3 class="fw-bold mb-1">
                        Create Account
                    </h3>

                    <p class="text-muted mb-0">
                        أنشئ حسابك الجديد
                    </p>

                </div>

                <div class="card-modern-body">

                    <form
                        method="POST"
                        action="{{ route('register') }}"
                    >

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label-modern">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control-modern"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label-modern">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control-modern"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label-modern">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone1"
                                    value="{{ old('phone1') }}"
                                    class="form-control-modern"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label-modern">
                                    Phone 2
                                </label>

                                <input
                                    type="text"
                                    name="phone2"
                                    value="{{ old('phone2') }}"
                                    class="form-control-modern"
                                >

                            </div>

                            <div class="col-12">

                                <label class="form-label-modern">
                                    Address
                                </label>

                                <textarea
                                    name="address"
                                    class="form-control-modern"
                                    rows="3"
                                    required
                                >{{ old('address') }}</textarea>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label-modern">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control-modern"
                                    required
                                >

                            </div>

                            <div class="col-md-6">

                                <label class="form-label-modern">
                                    Confirm Password
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control-modern"
                                    required
                                >

                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn-modern btn-primary-modern w-100 mt-4"
                        >
                            Create Account
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
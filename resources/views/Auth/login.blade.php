@extends('layout.app')

@section('title', 'Login')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card-modern">

                <div class="card-modern-header text-center">

                    <h3 class="fw-bold">
                        Login
                    </h3>

                    <p class="text-muted mb-0">
                        Welcome back
                    </p>

                </div>

                <div class="card-modern-body">

                    <form
                        method="POST"
                        action="{{ route('login') }}"
                    >

                        @csrf

                        <div class="mb-3">

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

                        <div class="mb-4">

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

                        <button
                            type="submit"
                            class="btn-modern btn-primary-modern w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
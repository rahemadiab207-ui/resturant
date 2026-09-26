<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Customer</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #1f2937;
        }

        .container {
            max-width: 850px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow:
                0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .header p {
            margin: 0;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input,
        textarea {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            font-family: inherit;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, 0.1);
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #1f2937;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .required {
            color: #dc2626;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <div class="header">

            <h1>
                Add Customer
            </h1>

            <p>
                Create a new customer account.
            </p>

        </div>


        {{-- Validation Errors --}}

        @if ($errors->any())

            <div class="alert">

                <strong>
                    Please fix the following errors:
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('customers.store') }}"
            method="POST"
        >

            @csrf


            {{-- Name --}}

            <div class="form-group">

                <label for="name">

                    Customer Name

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter customer name"
                    required
                >

                @error('name')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Email --}}

            <div class="form-group">

                <label for="email">

                    Email

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="customer@example.com"
                    required
                >

                @error('email')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Phone 1 --}}

            <div class="form-group">

                <label for="phone1">

                    Phone 1

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="text"
                    id="phone1"
                    name="phone1"
                    value="{{ old('phone1') }}"
                    placeholder="Enter primary phone number"
                    required
                >

                @error('phone1')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Phone 2 --}}

            <div class="form-group">

                <label for="phone2">

                    Phone 2

                </label>

                <input
                    type="text"
                    id="phone2"
                    name="phone2"
                    value="{{ old('phone2') }}"
                    placeholder="Enter secondary phone number (optional)"
                >

                @error('phone2')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Address --}}

            <div class="form-group">

                <label for="address">

                    Address

                    <span class="required">
                        *
                    </span>

                </label>

                <textarea
                    id="address"
                    name="address"
                    placeholder="Enter customer address"
                    required
                >{{ old('address') }}</textarea>

                @error('address')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Password --}}

            <div class="form-group">

                <label for="password">

                    Password

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
                >

                @error('password')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Confirm Password --}}

            <div class="form-group">

                <label for="password_confirmation">

                    Confirm Password

                    <span class="required">
                        *
                    </span>

                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    required
                >

            </div>


            {{-- Buttons --}}

            <div class="actions">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Add Customer
                </button>

                <a
                    href="{{ route('customers') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>
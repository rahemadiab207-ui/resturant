@extends('layout.app')

@section('title', 'Customer Details')

@section('content')

<div class="container py-5">

    <div class="customer-details-card">

        <div class="details-header">

            <div>
                <h1>Customer Details</h1>
                <p>View customer information</p>
            </div>

            <div class="header-actions">

                <a
                    href="{{ route('customers.edit', $customer->id) }}"
                    class="modern-btn warning-btn"
                >
                    Edit Customer
                </a>

                <a
                    href="{{ route('customers') }}"
                    class="modern-btn secondary-btn"
                >
                    Back
                </a>

            </div>

        </div>


        <div class="customer-name">
            {{ $customer->name }}
        </div>


        <div class="details-grid">

            <div class="detail-item">
                <label>Customer ID</label>
                <div>{{ $customer->id }}</div>
            </div>

            <div class="detail-item">
                <label>Name</label>
                <div>{{ $customer->name }}</div>
            </div>

            <div class="detail-item">
                <label>Email</label>
                <div>{{ $customer->email }}</div>
            </div>

            <div class="detail-item">
                <label>Phone 1</label>
                <div>{{ $customer->phone1 ?? '-' }}</div>
            </div>

            <div class="detail-item">
                <label>Phone 2</label>
                <div>{{ $customer->phone2 ?? '-' }}</div>
            </div>

            <div class="detail-item">
                <label>Role</label>
                <div>{{ $customer->role }}</div>
            </div>

            <div class="detail-item full">
                <label>Address</label>
                <div>{{ $customer->address ?? '-' }}</div>
            </div>

            <div class="detail-item">
                <label>Account Created</label>
                <div>
                    {{ $customer->created_at?->format('Y-m-d H:i') ?? '-' }}
                </div>
            </div>

            <div class="detail-item">
                <label>Last Updated</label>
                <div>
                    {{ $customer->updated_at?->format('Y-m-d H:i') ?? '-' }}
                </div>
            </div>

        </div>


        <div class="bottom-actions">

            <a
                href="{{ route('customers') }}"
                class="modern-btn secondary-btn"
            >
                Back
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
                    class="modern-btn danger-btn"
                >
                    Delete Customer
                </button>

            </form>

        </div>

    </div>

</div>


<style>

.customer-details-card {
    background: #fff;
    border-radius: 22px;
    padding: 30px;
    box-shadow: 0 12px 40px rgba(15,23,42,.08);
}

.details-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.details-header h1 {
    margin: 0 0 5px;
    color: #111827;
    font-weight: 800;
}

.details-header p {
    margin: 0;
    color: #64748b;
}

.header-actions,
.bottom-actions {
    display: flex;
    gap: 10px;
}

.customer-name {
    background: #111827;
    color: #fff;
    border-radius: 14px;
    padding: 18px 20px;
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 25px;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.detail-item {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 13px;
    padding: 17px;
}

.detail-item.full {
    grid-column: 1 / -1;
}

.detail-item label {
    display: block;
    color: #64748b;
    font-size: 13px;
    margin-bottom: 7px;
}

.detail-item div {
    color: #111827;
    font-weight: 700;
}

.bottom-actions {
    justify-content: space-between;
    margin-top: 30px;
}

.modern-btn {
    border: 0;
    border-radius: 12px;
    padding: 11px 18px;
    text-decoration: none;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
}

.modern-btn:hover {
    transform: translateY(-2px);
}

.warning-btn {
    background: #fef3c7;
    color: #92400e;
}

.secondary-btn {
    background: #f1f5f9;
    color: #374151;
}

.danger-btn {
    background: #dc2626;
    color: #fff;
}

.danger-btn:hover {
    background: #b91c1c;
    color: #fff;
}

@media(max-width: 768px) {

    .details-header {
        flex-direction: column;
        align-items: stretch;
    }

    .header-actions {
        flex-direction: column;
    }

    .details-grid {
        grid-template-columns: 1fr;
    }

    .detail-item.full {
        grid-column: auto;
    }

    .bottom-actions {
        flex-direction: column;
    }
}

</style>

@endsection
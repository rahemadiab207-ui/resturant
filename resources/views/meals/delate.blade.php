@extends('layout.app')

@section('title', 'حذف الوجبة')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="delete-card">

                <div class="delete-header">
                    ⚠️ تأكيد حذف الوجبة
                </div>

                <div class="delete-body">

                    @if($meal->image)

                        <img
                            src="{{ asset('storage/' . $meal->image) }}"
                            alt="{{ $meal->name }}"
                        >

                    @endif

                    <h2>
                        {{ $meal->name }}
                    </h2>

                    <p>
                        {{ $meal->description }}
                    </p>

                    <div class="price">
                        {{ number_format($meal->price, 2) }} ج.م
                    </div>

                    <div class="warning">
                        <strong>تنبيه:</strong>
                        عند الضغط على "تأكيد الحذف"، سيتم حذف الوجبة نهائيًا.
                    </div>

                    <div class="delete-actions">

                        <a
                            href="{{ route('meals') }}"
                            class="cancel-btn"
                        >
                            إلغاء وتراجع
                        </a>

                        <form
                            action="{{ route('meals.destroy', $meal->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-confirm-btn"
                            >
                                تأكيد الحذف 🗑️
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

.delete-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(15,23,42,.10);
}

.delete-header {
    background: #dc2626;
    color: #fff;
    text-align: center;
    padding: 20px;
    font-size: 20px;
    font-weight: 800;
}

.delete-body {
    padding: 30px;
    text-align: center;
}

.delete-body img {
    max-width: 180px;
    max-height: 160px;
    object-fit: cover;
    border-radius: 15px;
    margin-bottom: 20px;
}

.delete-body h2 {
    color: #111827;
    font-weight: 800;
}

.delete-body p {
    color: #64748b;
}

.price {
    display: inline-block;
    background: #fef3c7;
    color: #92400e;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 800;
    margin: 10px 0 20px;
}

.warning {
    background: #fff7ed;
    color: #9a3412;
    border-radius: 12px;
    padding: 15px;
    text-align: right;
}

.delete-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 25px;
}

.cancel-btn,
.delete-confirm-btn {
    border: 0;
    border-radius: 12px;
    padding: 12px 20px;
    text-decoration: none;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
}

.cancel-btn {
    background: #f1f5f9;
    color: #374151;
}

.delete-confirm-btn {
    background: #dc2626;
    color: white;
}

.cancel-btn:hover {
    background: #e2e8f0;
    color: #111827;
}

.delete-confirm-btn:hover {
    background: #b91c1c;
    transform: translateY(-2px);
}

</style>

@endsection
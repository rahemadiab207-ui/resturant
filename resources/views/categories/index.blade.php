@extends('layout.app')

@section('content')

<div class="container-fluid py-4">

```
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Categories</h2>
        <p class="text-muted mb-0">
            Manage your restaurant categories
        </p>
    </div>

    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#addCategoryModal"
    >
        Add Category
    </button>

</div>


@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

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


<div class="card shadow-sm border-0">

    <div class="card-header bg-white py-3">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Categories List
            </h5>

            <span class="text-muted small">
                Total: {{ $categories->count() }}
            </span>

        </div>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th style="width: 70px;">
                            #
                        </th>

                        <th style="min-width: 180px;">
                            Name
                        </th>

                        <th style="min-width: 180px;">
                            Slug
                        </th>

                        <th style="min-width: 300px;">
                            Description
                        </th>

                        <th
                            class="text-center"
                            style="width: 180px;"
                        >
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td class="fw-semibold">
                                {{ $category->id }}
                            </td>


                            <td>

                                <div class="fw-semibold">
                                    {{ $category->name }}
                                </div>

                            </td>


                            <td>

                                <span class="badge bg-light text-dark border">
                                    {{ $category->slug }}
                                </span>

                            </td>


                            <td>

                                @if($category->description)

                                    <span>
                                        {{ $category->description }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        No description
                                    </span>

                                @endif

                            </td>


                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <a
                                        href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this category?')"
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

                            <td
                                colspan="5"
                                class="text-center py-5"
                            >

                                <div class="text-muted mb-2">
                                    No categories found.
                                </div>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal"
                                >
                                    Add First Category
                                </button>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
```

</div>

{{-- Add Category Modal --}}

<div
    class="modal fade"
    id="addCategoryModal"
    tabindex="-1"
    aria-labelledby="addCategoryModalLabel"
    aria-hidden="true"
>

```
<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content shadow">

        <div class="modal-header">

            <h5
                class="modal-title"
                id="addCategoryModalLabel"
            >
                Add Category
            </h5>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>

        </div>


        <form
            action="{{ route('categories.store') }}"
            method="POST"
        >

            @csrf

            <div class="modal-body">

                <div class="mb-3">

                    <label
                        for="categoryName"
                        class="form-label fw-semibold"
                    >
                        Name
                    </label>

                    <input
                        type="text"
                        id="categoryName"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Enter category name"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label
                        for="categorySlug"
                        class="form-label fw-semibold"
                    >
                        Slug
                    </label>

                    <input
                        type="text"
                        id="categorySlug"
                        name="slug"
                        class="form-control"
                        value="{{ old('slug') }}"
                        placeholder="Enter category slug"
                    >

                    <small class="text-muted">
                        Leave empty to generate it automatically.
                    </small>

                </div>


                <div class="mb-3">

                    <label
                        for="categoryDescription"
                        class="form-label fw-semibold"
                    >
                        Description
                    </label>

                    <textarea
                        id="categoryDescription"
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter category description"
                    >{{ old('description') }}</textarea>

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
                    Save Category
                </button>

            </div>

        </form>

    </div>

</div>
```

</div>

@endsection

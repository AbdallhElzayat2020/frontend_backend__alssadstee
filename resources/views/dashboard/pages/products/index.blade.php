@extends('dashboard.layouts.master')
@section('title', 'Products')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Products</h5>
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>
                        Add Product
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}"
                                                     alt="{{ $product->getTranslation('name', 'en') }}" width="60" class="rounded">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->getTranslation('name', 'en') }}</td>
                                        <td><code>{{ $product->slug }}</code></td>
                                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('dashboard.products.edit', $product) }}"
                                                   class="btn btn-sm btn-warning">
                                                    <i class="ti ti-edit me-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('dashboard.products.destroy', $product) }}" method="POST"
                                                      onsubmit="return confirm('Delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ti ti-trash me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-muted">No products found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

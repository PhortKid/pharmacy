@extends('dash_layout.app')

@section('page-title', 'Products Management')
@section('module', 'Product Module')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Title and Add Product Button -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-0">Products</h5>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus"></i> Add Product
                        </a>
                    </div>
                    @include('dashboard.products.create')

                    <!-- Responsive Table -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Manufacturer</th>
                                    <th>Purchase Price</th>
                                    <th>Stock Quantity</th>
                                    <th>Expiry Date</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->manufacturer }}</td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->stock_quantity }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->expiry_date)->format('d/m/Y') }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProduct{{ $product->id }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProduct{{ $product->id }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                    @include('dashboard.products.edit')
                                    @include('dashboard.products.delete')
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Responsive Table -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product_management.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" required>
                    </div>

                  

                    <div class="mb-3">
                        <label for="purchase_price" class="form-label">Purchase Price</label>
                        <input type="number" class="form-control" name="purchase_price" required>
                    </div>

                    <div class="mb-3">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price" required>
                    </div>

                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" name="stock_quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="min_stock_level" class="form-label">Min Stock Level</label>
                        <input type="number" class="form-control" name="min_stock_level" required>
                    </div>

                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" name="expiry_date" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


          
            $table->string('manufacturer');
            $table->string('barcode')->nullable();
            //$table->enum('unit', ['pill', 'bottle', 'box', 'vial', 'other']);
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->integer('stock_quantity')->default(0);
            $table->integer('min_stock_level')->default(10); 
            $table->date('expiry_date')->nullable();
@extends('dash_layout.app')

@section('page-title', 'Low Stock Report')
@section('module', 'Stock Management')

@section('content')
<section class="section">
    <div class="row">
        <!-- Low Stock Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card warning-card">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Products</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $lowStockCount }}</h6>
                            <span class="text-warning small pt-1 fw-bold">Products below minimum stock level</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Low Stock Card -->

        <!-- Low Stock Table -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Products</h5>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Manufacturer</th>
                                    <th>Stock Quantity</th>
                                    <th>Min Stock Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockProducts as $product)
                                <tr class="text-danger fw-bold">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->manufacturer }}</td>
                                    <td>{{ $product->stock_quantity }}</td>
                                    <td>{{ $product->min_stock_level }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="bi bi-cart-plus"></i> Restock
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Low Stock Table -->
    </div>
</section>
@endsection

@extends('dash_layout.app')

@section('page-title', 'Product Report')
@section('module', 'Report Module')

@section('content')
<section class="section mb-5">
    <div class="row">
        <!-- Cards for Category Counts -->
        @foreach($categories as $category)
            <div class="col-md-4">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-box"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $category->products->count() }}</h6> <!-- Count total products -->
                                <span class="text-muted small pt-2">Total Products</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Filter Form -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Filter by Category</h5>
            <form method="GET" action="{{ route('product.report') }}">
                <div class="row">
                    <div class="col-md-6">
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Report Table -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Report</h5>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>

                    <tbody>
    @foreach($purchases as $key => $purchase)
    <tr class="{{ \Carbon\Carbon::parse($purchase->expire_date)->lessThan(\Carbon\Carbon::now()) ? 'table-danger' : '' }}">
        <td>{{ $key + 1 }}</td>
        <td>{{ $purchase->product->name ?? 'N/A' }}</td>
        <td>{{ $purchase->product->category->name ?? 'N/A' }}</td>
        <td>{{ $purchase->quantity_bought }}</td>
        <td>{{ $purchase->expire_date }}</td>
    </tr>
    @endforeach
</tbody>


                    {{-- 
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr class="{{ \Carbon\Carbon::parse($product->expiry_date)->lessThan(\Carbon\Carbon::now()) ? 'table-danger' : '' }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->purchase->expire_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>--}}
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

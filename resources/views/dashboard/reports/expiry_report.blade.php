@extends('dash_layout.app')

@section('page-title', 'Expiry Date Report')
@section('module', 'Reports')

@section('content')
<section class="section mb-5">
    <div class="row">
        <!-- Cards for Summary -->
        <div class="col-md-4">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $totalProducts }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card info-card danger-card">
                <div class="card-body">
                    <h5 class="card-title">Expired Products</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-white">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-danger">{{ $expiredCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card info-card warning-card">
                <div class="card-body">
                    <h5 class="card-title">Expiring Soon (7 Days)</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-dark">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="ps-3">
                            <h6 class="text-warning">{{ $expiringSoonCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expired Products Table -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Expired Products</h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expiredProducts as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-danger">{{ \Carbon\Carbon::parse($product->expiry_date)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expiring Soon Products Table -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Expiring Soon (30 Days)</h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Expiry Date</th>
                                    <th>Days Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expiringProducts as $index => $product)
                                    <tr class="{{ $product->days_remaining <= 7 ? 'bg-danger text-white' : '' }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-danger">{{ \Carbon\Carbon::parse($product->expire_date)->format('d/m/Y') }}</td>
                                        <td>{{ $product->days_remaining }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('dash_layout.app')

@section('content')

<div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('stock.report') }}">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
    
    <div class="row">
        <!-- Purchased Stock Card -->
       <!-- Purchased Stock Card -->
       <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Purchased Stock</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ number_format($purchasedStock->sum('total_purchased')) }}</h6>
                            <span class="text-muted small">Total Purchased</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ number_format($sales->sum('total_sold')) }}</h6>
                            <span class="text-muted small">Total Sold</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit/Loss Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Profit / Loss</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ number_format($profitLoss->sum('profit_loss')) }}</h6>
                            @if($profitLoss->sum('profit_loss') >= 0)
                                <span class="text-success small">Profit</span>
                            @else
                                <span class="text-danger small">Loss</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

 

    <!-- Purchased Stock Table -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">Purchased Stock Details</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Purchased</th>
                        <th>Total Cost (TZS)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchasedStock as $stock)
                        <tr>
                            <td>{{ $stock->product_name }}</td>
                            <td>{{ $stock->total_purchased }}</td>
                            <td>Tsh {{ number_format($stock->total_cost, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="card mt-4">
        <div class="card-header bg-success text-white">Sales Details</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Sold</th>
                        <th>Total Sales (TZS)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->product_name }}</td>
                            <td>{{ $sale->total_sold }}</td>
                            <td>TZS {{ number_format($sale->total_sales, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Profit/Loss Table -->
    <div class="card mt-4">
        <div class="card-header bg-danger text-white">Profit/Loss Details</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Purchased</th>
                        <th>Total Sold</th>
                        <th>Profit/Loss (TZS)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profitLoss as $pl)
                        <tr>
                            <td>{{ $pl->product_name }}</td>
                            <td>{{ $pl->total_purchased }}</td>
                            <td>{{ $pl->total_sold }}</td>
                            <td>TZS {{ number_format($pl->profit_loss, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection

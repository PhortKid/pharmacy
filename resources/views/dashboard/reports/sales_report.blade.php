@extends('dash_layout.app')

@section('page-title', 'Sales & Revenue Report')
@section('module', 'Reports')

@section('content')
<section class="section mb-5">

<div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('sales.report') }}">
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
        <!-- Sales & Revenue Cards -->
        <div class="col-lg-6">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $salesData->total_sold ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ number_format($salesData->total_revenue ?? 0, 2) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top Selling Products</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->total_sold }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sales & Revenue Chart -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales & Revenue Trends</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($salesChart->pluck('month')),
            datasets: [{
                label: 'Revenue (TZS)',
                data: @json($salesChart->pluck('revenue')),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue (TZS)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
</script>--}}

{{-- 
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($salesChart->pluck('date')),
            datasets: [
                {
                    label: 'Total Sales',
                    data: @json($salesChart->pluck('total_sold')),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    yAxisID: 'ySales'
                },
                {
                    label: 'Total Revenue',
                    data: @json($salesChart->pluck('total_revenue')),
                    type: 'line',
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    yAxisID: 'yRevenue'
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false
            },
            stacked: false,
            scales: {
                ySales: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Quantity Sold'
                    },
                    beginAtZero: true
                },
                yRevenue: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false
                    },
                    title: {
                        display: true,
                        text: 'Revenue (TZS)'
                    }
                }
            }
        }
    });
</script>
--}}

@endsection

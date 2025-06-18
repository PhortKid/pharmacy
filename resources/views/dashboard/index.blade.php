@extends('dash_layout.app')

@section('page-title', 'Dashboard')
@section('module', 'Overview')

@section('content')

<section class="section">
    <div class="row">

        <!-- Total Products -->
        <div class="col-md-3">
            <div class="card info-card primary-card">
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

        <!-- Expired Products -->
        <div class="col-md-3">
            <div class="card info-card danger-card">
                <div class="card-body">
                    <h5 class="card-title">Expired Products</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $expiredCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expiring Soon -->
        <div class="col-md-3">
            <div class="card info-card warning-card">
                <div class="card-body">
                    <h5 class="card-title">Expiring Soon</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $expiringSoonCount }}</h6>
                            <span class="text-warning small pt-1 fw-bold">Within 7 Days</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  

        <!-- Total Sales -->
        <div class="col-md-3">
            <div class="card info-card success-card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales (30 Days)</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6> 0.00 </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                    @include('dashboard.sales')
      {{--  <!-- Total Suppliers -->
          <div class="col-md-3">
            <div class="card info-card primary-card">
                <div class="card-body">
                    <h5 class="card-title">Total Suppliers</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>total sup</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Debt -->
        <div class="col-md-3">
            <div class="card info-card danger-card">
                <div class="card-body">
                    <h5 class="card-title">Total Debt</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="ps-3">
                            <h6> 0.00 </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Payments -->
        <div class="col-md-3">
            <div class="card info-card success-card">
                <div class="card-body">
                    <h5 class="card-title">Total Payments</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="ps-3">
                            <h6>0.00</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}  
     
 

    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Sales Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales Report (Last 30 Days)</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Stock Per Category Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stock Per Category</h5>
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales Chart
    var ctxSales = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctxSales, {
        type: 'line',
        data: {
           {{--  labels: {!! json_encode($salesData->pluck('date')) !!},--}}
            datasets: [{
                label: 'Total Sales',
                {{--    //   data: {!! json_encode($salesData->pluck('total_sales')) !!},--}}
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderWidth: 2
            }]
        }
    });


    
    // Stock Per Category Chart
    var ctxStock = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(ctxStock, {
        type: 'bar',
        data: {
            {{--   labels: {!! json_encode($stockByCategory->pluck('category')) !!},--}}
            datasets: [{
                label: 'Total Stock',
                {{--    data: {!! json_encode($stockByCategory->pluck('total_stock')) !!},--}} 
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        }
    });
</script>


@endsection

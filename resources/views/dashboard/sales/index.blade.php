@extends('dash_layout.app')

@section('page-title', 'Sales')
@section('module', 'Stock Management')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-0">Sales</h5>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStockMovement">
                            <i class="bi bi-plus"></i> Add Sales
                        </a>
                        @include('dashboard.sales.create')
                    </div>

                    <!-- Sales Table -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Notes</th>
                                    <th>Date</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockMovements as $movement)
                                <tr>
                                    <td>{{ $movement->id }}</td>
                                    <td>{{ $movement->product->name }}</td>
                                    <td>{{ ucfirst($movement->movement_type) }}</td>
                                    <td>{{ $movement->quantity }}</td>
                                    <td>{{ number_format($movement->price_at_time, 2) }}</td>
                                    <td>{{ $movement->notes }}</td>
                                    <td>{{ $movement->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editStockMovement{{ $movement->id }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteStockMovement{{ $movement->id }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                    @include('dashboard.sales.edit')
                                    @include('dashboard.sales.delete')
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

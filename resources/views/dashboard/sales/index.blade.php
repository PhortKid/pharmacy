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
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSaleModal">
                            <i class="bi bi-plus"></i> Add Sale
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
                                    <th>Quantity Sold</th>
                                    <th>Total Price</th>
                                    <th>Receipt No</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->purchase->product->name ?? 'N/A' }}</td>
                                    <td>{{ $sale->quantity_sold }}</td>
                                    <td>{{ number_format($sale->total_price, 2) }}</td>
                                    <td>{{ $sale->receipt_no ?? '-' }}</td>
                                    <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSaleModal{{ $sale->id }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSaleModal{{ $sale->id }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
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

<!-- Edit Sale Modals -->
@foreach($sales as $sale)
<div class="modal fade" id="editSaleModal{{ $sale->id }}" tabindex="-1" aria-labelledby="editSaleModalLabel{{ $sale->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sales.update', $sale->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editSaleModalLabel{{ $sale->id }}">Edit Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="purchase_id_{{ $sale->id }}" class="form-label">Product</label>
                    <select name="purchase_id" id="purchase_id_{{ $sale->id }}" class="form-control" required>
                        @foreach($purchases as $purchase)
                            <option value="{{ $purchase->id }}" {{ $sale->purchase_id == $purchase->id ? 'selected' : '' }}>
                                {{ ucfirst($purchase->product->name) }}  - Qty: {{ $purchase->quantity_bought }} - Price: {{ number_format($purchase->unit_price,2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity_sold_{{ $sale->id }}" class="form-label">Quantity Sold</label>
                    <input type="number" name="quantity_sold" id="quantity_sold_{{ $sale->id }}" class="form-control" value="{{ $sale->quantity_sold }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="total_price_{{ $sale->id }}" class="form-label">Total Price</label>
                    <input type="number" step="0.01" name="total_price" id="total_price_{{ $sale->id }}" class="form-control" value="{{ $sale->total_price }}" required>
                </div>

                <div class="mb-3">
                    <label for="receipt_no_{{ $sale->id }}" class="form-label">Receipt No (optional)</label>
                    <input type="text" name="receipt_no" id="receipt_no_{{ $sale->id }}" class="form-control" value="{{ $sale->receipt_no }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Sale</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Delete Sale Modals -->
@foreach($sales as $sale)
<div class="modal fade" id="deleteSaleModal{{ $sale->id }}" tabindex="-1" aria-labelledby="deleteSaleModalLabel{{ $sale->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSaleModalLabel{{ $sale->id }}">Delete Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this sale of <strong>{{ $sale->purchase->product->name }}</strong>?</p>
                <p><strong>Quantity Sold:</strong> {{ $sale->quantity_sold }}</p>
                <p><strong>Total Price:</strong> {{ number_format($sale->total_price, 2) }}</p>
                @if($sale->receipt_no)
                <p><strong>Receipt No:</strong> {{ $sale->receipt_no }}</p>
                @endif
                <p><strong>Date:</strong> {{ $sale->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Sale</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
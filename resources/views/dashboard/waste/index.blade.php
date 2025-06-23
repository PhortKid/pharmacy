@extends('dash_layout.app')

@section('page-title', 'Waste Management')
@section('module', 'Waste Management')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Disposal Products</h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($DisposalProducts as $index => $waste)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $waste->purchase->product->name }}</td>
                                        <td>{{ $waste->quantity_disposed }}</td>
                                        <td>{{ $waste->reason }}</td>
                                        <td>{{ \Carbon\Carbon::parse($waste->wasted_at)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Button to Mark Product as Waste -->
                    <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#markWasteModal">
                        <i class="bi bi-exclamation-triangle"></i> Mark Product as Waste
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Waste Modal -->
<div class="modal fade" id="markWasteModal" tabindex="-1" aria-labelledby="markWasteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markWasteModalLabel">Mark Product as Waste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('waste.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product</label>
                        <select name="purchase_id" class="form-control" required>
                            <option value="">-- Select Product --</option>
                            @foreach($purchases as $purchase)
                                <option value="{{ $purchase->id }}">{{ $purchase->product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <input type="text" class="form-control" name="reason" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Mark as Waste</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

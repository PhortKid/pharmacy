@extends('dash_layout.app')

@section('page-title', 'Purchases')
@section('module', 'Management')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-0">Purchases</h5>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPurchaseModal">
                            <i class="bi bi-plus"></i> Add Purchase
                        </a>
                        @include('dashboard.purchases.create')
                    </div>

                    <!-- Purchases Table -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Supplier</th>
                                    <th>Unit Price</th>
                                    <th>Selling Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Purchase Date</th>
                                    <th>Expiry</th>
                                    <th>Manufacturer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->product->name ?? '-' }}</td>
                                    <td>{{ $purchase->supplier->name ?? '-' }}</td>
                                    <td>{{ number_format($purchase->unit_price, 2) }}</td>
                                    <td>{{ number_format($purchase->selling_price, 2) }}</td>
                                    <td>{{ $purchase->quantity_bought }}</td>
                                    <td>{{ number_format($purchase->total_purchase, 2) }}</td>
                                    <td>{{ ucfirst($purchase->payment_method) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->date_of_purchase)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->expire_date)->format('d/m/Y') }}</td>
                                    <td>{{ $purchase->manufacturer }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPurchase{{ $purchase->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePurchase{{ $purchase->id }}">
                                            <i class="bi bi-trash"></i>
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

<!-- Edit and Delete Modals -->
@foreach($purchases as $purchase)
<!-- Edit Purchase Modal -->
<div class="modal fade" id="editPurchase{{ $purchase->id }}" tabindex="-1" aria-labelledby="editPurchaseLabel{{ $purchase->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('purchases.update', $purchase->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editPurchaseLabel{{ $purchase->id }}">Edit Purchase #{{ $purchase->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Product -->
                <div class="mb-3">
                    <label for="product_id_{{ $purchase->id }}" class="form-label">Product</label>
                    <select id="product_id_{{ $purchase->id }}" name="product_id" class="form-control" required>
                        <option value="">-- Select Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $purchase->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div class="mb-3">
                    <label for="supplier_id_{{ $purchase->id }}" class="form-label">Supplier</label>
                    <select id="supplier_id_{{ $purchase->id }}" name="supplier_id" class="form-control" required>
                        <option value="">-- Select Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Unit Price -->
                <div class="mb-3">
                    <label for="unit_price_{{ $purchase->id }}" class="form-label">Unit Price</label>
                    <input type="number" step="0.01" id="unit_price_{{ $purchase->id }}" name="unit_price" class="form-control" value="{{ $purchase->unit_price }}" required>
                </div>

                <!-- Selling Price -->
                <div class="mb-3">
                    <label for="selling_price_{{ $purchase->id }}" class="form-label">Selling Price</label>
                    <input type="number" step="0.01" id="selling_price_{{ $purchase->id }}" name="selling_price" class="form-control" value="{{ $purchase->selling_price }}" required>
                </div>

                <!-- Quantity Bought -->
                <div class="mb-3">
                    <label for="quantity_bought_{{ $purchase->id }}" class="form-label">Quantity Bought</label>
                    <input type="number" id="quantity_bought_{{ $purchase->id }}" name="quantity_bought" class="form-control" value="{{ $purchase->quantity_bought }}" min="1" required>
                </div>

                <!-- Total Purchase -->
                <div class="mb-3">
                    <label for="total_purchase_{{ $purchase->id }}" class="form-label">Total Purchase</label>
                    <input type="number" step="0.01" id="total_purchase_{{ $purchase->id }}" name="total_purchase" class="form-control" value="{{ $purchase->total_purchase }}" required readonly>
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                    <label for="payment_method_{{ $purchase->id }}" class="form-label">Payment Method</label>
                    <select id="payment_method_{{ $purchase->id }}" name="payment_method" class="form-control" required>
                        <option value="">-- Select Payment Method --</option>
                        @foreach(['cash', 'bank', 'mobile_payment', 'insurance'] as $method)
                            <option value="{{ $method }}" {{ strtolower($purchase->payment_method) == $method ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $method)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date of Purchase -->
                <div class="mb-3">
                    <label for="date_of_purchase_{{ $purchase->id }}" class="form-label">Date Of Purchase</label>
                    <input type="date" id="date_of_purchase_{{ $purchase->id }}" name="date_of_purchase" class="form-control" value="{{ $purchase->date_of_purchase }}" required>
                </div>

                <!-- Expire Date -->
                <div class="mb-3">
                    <label for="expire_date_{{ $purchase->id }}" class="form-label">Expire Date</label>
                    <input type="date" id="expire_date_{{ $purchase->id }}" name="expire_date" class="form-control" value="{{ $purchase->expire_date }}" required>
                </div>

                <!-- Manufacturer -->
                <div class="mb-3">
                    <label for="manufacturer_{{ $purchase->id }}" class="form-label">Manufacturer</label>
                    <input type="text" id="manufacturer_{{ $purchase->id }}" name="manufacturer" class="form-control" value="{{ $purchase->manufacturer }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Purchase</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Purchase Modal -->
<div class="modal fade" id="deletePurchase{{ $purchase->id }}" tabindex="-1" aria-labelledby="deletePurchaseLabel{{ $purchase->id }}" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="deletePurchaseLabel{{ $purchase->id }}">Delete Purchase #{{ $purchase->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this purchase of <strong>{{ $purchase->product->name ?? 'Unknown Product' }}</strong>?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- JavaScript for Auto-calculation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate total purchase for each edit modal
    @foreach($purchases as $purchase)
    const unitPriceInput{{ $purchase->id }} = document.getElementById('unit_price_{{ $purchase->id }}');
    const quantityInput{{ $purchase->id }} = document.getElementById('quantity_bought_{{ $purchase->id }}');
    const totalInput{{ $purchase->id }} = document.getElementById('total_purchase_{{ $purchase->id }}');

    function calculateTotal{{ $purchase->id }}() {
        const unitPrice = parseFloat(unitPriceInput{{ $purchase->id }}.value) || 0;
        const quantity = parseInt(quantityInput{{ $purchase->id }}.value) || 0;
        totalInput{{ $purchase->id }}.value = (unitPrice * quantity).toFixed(2);
    }

    unitPriceInput{{ $purchase->id }}.addEventListener('input', calculateTotal{{ $purchase->id }});
    quantityInput{{ $purchase->id }}.addEventListener('input', calculateTotal{{ $purchase->id }});
    @endforeach
});
</script>

@endsection
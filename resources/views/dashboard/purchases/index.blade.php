@extends('dash_layout.app')

@section('page-title', 'Purchases')
@section('module', 'Management')

@section('content')
<div class="container mb-5">
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
                            <option value="{{ $product->id }}" {{ $purchase->product_id == $product->id ? 'selected' : '' }}>{{ ucfirst($product->name) }}</option>
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
                        {{-- , 'bank', 'mobile_payment', 'insurance' --}}
                        @foreach(['cash'] as $method)
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


</div><!-- End of container -->



<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#addPurchaseModal form');

    const quantityInput = form.querySelector('input[name="quantity_bought"]');
    const unitPriceInput = form.querySelector('input[name="unit_price"]');
    const sellingPriceInput = form.querySelector('input[name="selling_price"]');
    const totalPurchaseInput = form.querySelector('input[name="total_purchase"]');
    const datePurchaseInput = form.querySelector('input[name="date_of_purchase"]');
    const expireDateInput = form.querySelector('input[name="expire_date"]');
    const manufacturerInput = form.querySelector('input[name="manufacturer"]');

    // Calculate total purchase = quantity * unit price
    function updateTotal() {
        const qty = parseInt(quantityInput.value);
        const unit = parseFloat(unitPriceInput.value);
        if (!isNaN(qty) && !isNaN(unit)) {
            totalPurchaseInput.value = (qty * unit).toFixed(2);
        }
    }

    quantityInput.addEventListener('input', updateTotal);
    unitPriceInput.addEventListener('input', updateTotal);

    // Allow letters only for manufacturer
    function isLettersOnly(value) {
        return /^[A-Za-z\s]+$/.test(value.trim());
    }

    manufacturerInput.addEventListener('input', function () {
        if (isLettersOnly(manufacturerInput.value)) {
            manufacturerInput.classList.remove('is-invalid');
            manufacturerInput.classList.add('is-valid');
        } else {
            manufacturerInput.classList.remove('is-valid');
            manufacturerInput.classList.add('is-invalid');
        }
    });

    // Final form validation before submit
    form.addEventListener('submit', function (e) {
        const qty = parseInt(quantityInput.value);
        const unit = parseFloat(unitPriceInput.value);
        const sell = parseFloat(sellingPriceInput.value);
        const total = parseFloat(totalPurchaseInput.value);
        const date1 = new Date(datePurchaseInput.value);
        const date2 = new Date(expireDateInput.value);
        const manuValid = isLettersOnly(manufacturerInput.value);

        let valid = true;

        if (isNaN(qty) || qty <= 0) {
            quantityInput.classList.add('is-invalid');
            valid = false;
        }

        if (isNaN(unit) || unit <= 0) {
            unitPriceInput.classList.add('is-invalid');
            valid = false;
        }

        if (isNaN(sell) || sell <= 0) {
            sellingPriceInput.classList.add('is-invalid');
            valid = false;
        }

        if (!manuValid) {
            manufacturerInput.classList.add('is-invalid');
            valid = false;
        }

        if (datePurchaseInput.value && expireDateInput.value && date2 < date1) {
            expireDateInput.classList.add('is-invalid');
            alert("Expire date must be after or same as Date of Purchase.");
            valid = false;
        }

        if (!valid) {
            e.preventDefault(); // stop form from submitting
        }
    });
});
</script>

{{--
<script>
document.addEventListener('DOMContentLoaded', function () {
    const purchaseId = @json($purchase->id); // ensure dynamic ID
    const form = document.querySelector(`form[action*='purchases/update/${purchaseId}']`);

    const unitPrice = document.getElementById(`unit_price_${purchaseId}`);
    const quantityBought = document.getElementById(`quantity_bought_${purchaseId}`);
    const totalPurchase = document.getElementById(`total_purchase_${purchaseId}`);
    const sellingPrice = document.getElementById(`selling_price_${purchaseId}`);
    const datePurchase = document.getElementById(`date_of_purchase_${purchaseId}`);
    const expireDate = document.getElementById(`expire_date_${purchaseId}`);
    const manufacturer = document.getElementById(`manufacturer_${purchaseId}`);

    // Live calculation of total purchase
    function updateTotal() {
        const unit = parseFloat(unitPrice.value);
        const qty = parseInt(quantityBought.value);
        if (!isNaN(unit) && !isNaN(qty)) {
            totalPurchase.value = (unit * qty).toFixed(2);
        }
    }

    unitPrice.addEventListener('input', updateTotal);
    quantityBought.addEventListener('input', updateTotal);

    // Manufacturer: allow letters only
    function isLettersOnly(value) {
        return /^[A-Za-z\s]+$/.test(value.trim());
    }

    manufacturer.addEventListener('input', function () {
        if (isLettersOnly(manufacturer.value)) {
            manufacturer.classList.remove('is-invalid');
            manufacturer.classList.add('is-valid');
        } else {
            manufacturer.classList.add('is-invalid');
        }
    });

    // Prevent submission if invalid
    form.addEventListener('submit', function (e) {
        const unit = parseFloat(unitPrice.value);
        const sell = parseFloat(sellingPrice.value);
        const qty = parseInt(quantityBought.value);
        const date1 = new Date(datePurchase.value);
        const date2 = new Date(expireDate.value);

        let valid = true;

        if (isNaN(unit) || unit <= 0) {
            unitPrice.classList.add('is-invalid');
            valid = false;
        }

        if (isNaN(sell) || sell <= 0) {
            sellingPrice.classList.add('is-invalid');
            valid = false;
        }

        if (isNaN(qty) || qty <= 0) {
            quantityBought.classList.add('is-invalid');
            valid = false;
        }

        if (!isLettersOnly(manufacturer.value)) {
            manufacturer.classList.add('is-invalid');
            valid = false;
        }

        if (expireDate.value && date2 < date1) {
            alert("Expire date must be later than or equal to purchase date.");
            expireDate.classList.add('is-invalid');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>--}}



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.getElementById('quantity_bought');
        const unitPriceInput = document.getElementById('unit_price');
        const totalPurchaseInput = document.getElementById('total_purchase');

        function updateTotalPurchase() {
            const qty = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(unitPriceInput.value) || 0;
            totalPurchaseInput.value = (qty * price).toFixed(2);
        }

        quantityInput.addEventListener('input', updateTotalPurchase);
        unitPriceInput.addEventListener('input', updateTotalPurchase);
    });
</script>
@endsection
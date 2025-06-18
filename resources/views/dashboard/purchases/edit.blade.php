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
                    <input type="number" step="0.01" id="total_purchase_{{ $purchase->id }}" name="total_purchase" class="form-control" value="{{ $purchase->total_purchase }}" required>
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                    <label for="payment_method_{{ $purchase->id }}" class="form-label">Payment Method</label>
                    <select id="payment_method_{{ $purchase->id }}" name="payment_method" class="form-control" required>
                        @foreach(['Cash', 'Bank', 'Mobile Payment', 'Insurance'] as $method)
                            <option value="{{ $method }}" {{ $purchase->payment_method == $method ? 'selected' : '' }}>{{ $method }}</option>
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

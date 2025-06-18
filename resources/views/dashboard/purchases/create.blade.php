<!-- Add Purchase Modal -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('purchases.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity Bought</label>
                        <input type="number" class="form-control" name="quantity_bought" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unit Price</label>
                        <input type="number" step="0.01" class="form-control" name="unit_price" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Purchase</label>
                        <input type="number" step="0.01" class="form-control" name="total_purchase" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Purchase</label>
                        <input type="date" class="form-control" name="date_of_purchase" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Expire Date</label>
                        <input type="date" class="form-control" name="expire_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="">-- Select Method --</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>
                            <option value="Mobile Payment">Mobile Payment</option>
                            <option value="Insurance">Insurance</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-control" required>
                            <option value="">-- Select Supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Purchase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

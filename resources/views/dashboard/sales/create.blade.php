<!-- Modal for creating Sale -->
<div class="modal fade" id="createSaleModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="createSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sales.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="createSaleModalLabel">Add New Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="purchase_id" class="form-label">Select Purchase</label>
                    <select name="purchase_id" id="purchase_id" class="form-control" required>
                        <option value="">-- Select Purchase --</option>
                        @foreach($purchases as $purchase)
                            <option value="{{ $purchase->id }}" data-price="{{ $purchase->selling_price }}">
                                {{ ucfirst($purchase->product->name) }} (Qty: {{ $purchase->quantity_bought }}, Price: {{ number_format($purchase->selling_price, 2) }})
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity_sold" class="form-label">Quantity Sold</label>
                    <input type="number" name="quantity_sold" id="quantity_sold" class="form-control" min="1" required>
                    

                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="receipt_no" class="form-label">Receipt No (optional)</label>
                    <input type="text" name="receipt_no" id="receipt_no" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Sale</button>
            </div>
        </form>
    </div>
</div>

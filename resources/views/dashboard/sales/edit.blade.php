<!-- Edit Sale Modal -->
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
                    <label for="purchase_id" class="form-label">Purchase</label>
                    <select name="purchase_id" class="form-control" required>
                        @foreach($purchases as $purchase)
                            <option value="{{ $purchase->id }}" {{ $sale->purchase_id == $purchase->id ? 'selected' : '' }}>
                                {{ $purchase->product->name }} - Qty: {{ $purchase->quantity }} - Price: {{ $purchase->unit_price }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity_sold" class="form-label">Quantity Sold</label>
                    <input type="number" name="quantity_sold" class="form-control" value="{{ $sale->quantity_sold }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="number" step="0.01" name="total_price" class="form-control" value="{{ $sale->total_price }}" required>
                </div>

                <div class="mb-3">
                    <label for="receipt_no" class="form-label">Receipt No (optional)</label>
                    <input type="text" name="receipt_no" class="form-control" value="{{ $sale->receipt_no }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Sale</button>
            </div>
        </form>
    </div>
</div>

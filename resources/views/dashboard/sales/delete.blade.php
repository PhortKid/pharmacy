<div class="modal fade" id="deleteSale{{ $sale->id }}" tabindex="-1" aria-labelledby="deleteSaleLabel{{ $sale->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSaleLabel{{ $sale->id }}">Delete Sale</h5>
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

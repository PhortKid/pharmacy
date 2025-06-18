
<div class="modal fade" id="deleteStockMovement{{ $movement->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Stock Movement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this stock movement for <strong>{{ $movement->product->name }}</strong>?</p>
                <p><strong>Movement Type:</strong> {{ ucfirst($movement->movement_type) }}</p>
                <p><strong>Quantity:</strong> {{ $movement->quantity }}</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('sales.destroy', $movement->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


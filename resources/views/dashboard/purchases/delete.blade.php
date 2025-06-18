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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>

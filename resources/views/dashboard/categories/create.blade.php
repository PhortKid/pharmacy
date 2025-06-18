


<!-- Modal for creating category -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" data-bs-backdrop="false" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Unit</label>
                        <select name="unit" id="" class="form-control" >
                            <option>-- Select Unit --</option>
                            <option value="Pills">Pills</option>
                            <option value="Tablets">Tablets</option>
                            <option value="Ya maji">Ya maji</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



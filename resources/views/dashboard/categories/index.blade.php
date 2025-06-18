@extends('dash_layout.app')

@section('page-title', 'Categories Management')
@section('module', 'Category Module')

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Title and Add Category Button -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-0">Categories</h5>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                            <i class="bi bi-plus"></i> Add Category
                        </a>
                        @include('dashboard.categories.create')
                    </div>

                    <!-- Responsive Table -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->unit}}</td>
                                    <td>
                                      
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
    <i class="bi bi-pencil"></i> Edit
</button>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $category->id }}">Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                    <label for="name{{ $category->id }}" class="form-label">Category Name</label>
                                                    <input type="text" class="form-control" id="name{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                    <label for="unit{{ $category->id }}" class="form-label">Unit</label>
                                                    <select name="unit" id="unit{{ $category->id }}" class="form-control">
                                                        <option value="Pills" {{ $category->unit == 'Pills' ? 'selected' : '' }}>Pills</option>
                                                        <option value="Tablets" {{ $category->unit == 'Tablets' ? 'selected' : '' }}>Tablets</option>
                                                        <option value="Ya maji" {{ $category->unit == 'Ya maji' ? 'selected' : '' }}>Ya maji</option>
                                                        <option value="Others" {{ $category->unit == 'Others' ? 'selected' : '' }}>Others</option>
                                                    </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        </div>


                                  
                                        <!-- Delete Button -->
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Responsive Table -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

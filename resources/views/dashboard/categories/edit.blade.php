@extends('dash_layout.app')

@section('page-title', 'Edit Category')
@section('module', 'Category Module')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Category</h5>

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                        </div>

                        <div class="mb-3">
                        <label for="name" class="form-label">Unit</label>
                        <select name="unit" id="" class="form-control" >
                            <option value="{{$category->unit}}">{{ $category->unit }}</option>
                            <option value="Pills">Pills</option>
                            <option value="Tablets">Tablets</option>
                            <option value="Ya maji">Ya maji</option>
                            <option value="Others">Others</option>
                        </select>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

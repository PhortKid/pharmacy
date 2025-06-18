@extends('dash_layout.app')

@section('content')
<div class="container">
    <h2>Suppliers</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Supplier Form --}}
    <form action="{{ route('suppliers.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" name="name" placeholder="Supplier Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="phone_number" placeholder="Contact" required>
            </div>
            <div class="col-md-2">
                <input type="email" class="form-control" name="email" placeholder="Email">

            </div>
            <input type="hidden" class="form-control" name="pharmacy_id" value="{{Auth::user()->pharmacy_id}}">
            <div class="col-md-3">
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Add Supplier</button>
            </div>
        </div>
    </form>

    {{-- Suppliers Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone_number }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete supplier?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{-- Pagination --}}
    {{ $suppliers->links() }}
</div>
@endsection

@extends('dash_layout.app')

@section('page-title', 'Users Management')
@section('module', 'User Module')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    <!-- Title and Add User Button -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="card-title mb-0">Users</h5>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                            <i class="bi bi-plus"></i> Add User
                        </a>
                    </div>
                    @include('dashboard.users_management.create')

                    <!-- Responsive Table -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->firstname}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                  
                                        <!-- Delete Button -->
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser{{$user->id}}">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                    @include('dashboard.users_management.edit')
                                    @include('dashboard.users_management.delete')

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

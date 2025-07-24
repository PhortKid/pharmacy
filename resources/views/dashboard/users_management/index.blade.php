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
                                    <th>Role</th>
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
                                    <td>{{ucfirst($user->role->name)}}</td>
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


<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#disablebackdrop form');

    const firstname = document.getElementById('firstname');
    const lastname = document.getElementById('lastname');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone_number');
    const role = document.getElementById('role');

    // Helper to validate letters only
    function isLettersOnly(value) {
        return /^[A-Za-z]+$/.test(value);
    }

    // Helper to mark valid/invalid
    function markInvalid(input, isValid) {
        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }
    }

    firstname.addEventListener('input', function () {
        markInvalid(firstname, isLettersOnly(firstname.value) && firstname.value.length >= 2);
    });

    lastname.addEventListener('input', function () {
        markInvalid(lastname, isLettersOnly(lastname.value) && lastname.value.length >= 2);
    });

    email.addEventListener('input', function () {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        markInvalid(email, regex.test(email.value));
    });

    phone.addEventListener('input', function () {
        const regex = /^0[67][0-9]{8}$/;
        markInvalid(phone, regex.test(phone.value));
    });

    role.addEventListener('change', function () {
        markInvalid(role, role.value !== '');
    });

    // Prevent form submission if invalid
    form.addEventListener('submit', function (e) {
        const validFirst = isLettersOnly(firstname.value) && firstname.value.length >= 2;
        const validLast = isLettersOnly(lastname.value) && lastname.value.length >= 2;
        const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value);
        const validPhone = /^0[67][0-9]{8}$/.test(phone.value);
        const validRole = role.value !== '';

        if (!validFirst || !validLast || !validEmail || !validPhone || !validRole) {
            e.preventDefault();
            alert('Please correct the errors before submitting the form.');
        }
    });
});
</script>


@endsection

@extends('admin.layouts.admin_dashboard')

@section('title', 'AMS - Attendance Management System')

@section('admin')
    @include('includes.flash')
    <div class="page-content">

        <div class="col-lg-3 col-xl-2 mb-3">
            <a href="{{ route('users.add') }}" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add User</a>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body p-4">
                <table class="table my-5 table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tag Number</th>
                            <th scope="col">Group</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id}}</th>
                                    <td>{{ $user->surname}} {{ $user->othernames }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->tagNumber}}</td>
                                    <td>{{ $user->group}}</td>
                                    <td>{{ $user->unit}}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ url('/admin/user/view/'.$user->id) }}" class=""><i class='bx bxs-edit'></i></a>
                                            <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="row" class="text-center fw-4" colspan="8"><h4>No users added yet</h4></th>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @include('includes.add_user')
@endsection
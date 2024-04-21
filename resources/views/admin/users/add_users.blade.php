@extends('admin.layouts.admin_dashboard')

@section('title', 'AMS - Attendance Management System')

@section('admin')
    @include('includes.flash')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/user')}}">Users</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                </nav>
            </div>
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
                <h5 class="card-title">Add New User</h5>
                <hr/>
                 <form class="form-body mt-4" method="POST" action="{{ route('users.store')}}" >
                    @csrf
                  <div class="row">
                     <div class="col-lg-8">
                     <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                          <label for="surname" class="form-label">Surname</label>
                          <input type="text" name="surname" class="form-control" id="surname" placeholder="Enter Surname">
                        </div>
                        <div class="mb-3">
                            <label for="othernames" class="form-label">Other Names</label>
                            <input type="text" name="othernames" class="form-control" id="othernames" placeholder="Enter Other Names">
                        </div>
                        <div class="mb-3">
                            <label for="tagNumber" class="form-label">Tag Number</label>
                            <input type="text" name="tagNumber" class="form-control" id="tagNumber" placeholder="Enter Tag Number">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input class="form-control" id="email" name="email" id="email" placeholder="Enter Email"></input>
                        </div>
                        {{-- <div class="mb-3">
                          <label for="inputProductDescription" class="form-label">Product Images</label>
                          <input id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf">
                        </div> --}}

                      </div>
                     </div>
                     <div class="col-lg-4">
                      <div class="border border-3 p-4 rounded">
                        <div class="row g-3">
                            <div class="col-12">
                              <label for="group" class="form-label">User Group</label>
                              <select class="form-select" id="group" name="group">
                                  <option>Select User Group</option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="C">C</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control" placeholder="Enter User Unit">
                              </div>
                            <div class="col-12">
                              <label for="phone" class="form-label">Phone Number</label>
                              <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter User Phone Number">
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                   <button type="submit" class="btn btn-primary">Save User</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                    </div>
                </form><!--end row-->
              </div>
            </div>
        </div>
    </div>
@endsection
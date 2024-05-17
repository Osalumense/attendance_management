@extends('admin.layouts.admin_dashboard')

@section('title', 'AMS - Attendance Management System')

@section('admin')
    @include('includes.flash')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Attendance Register</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Attendance Register</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-body p-4">
                <table class="table my-5 table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Attendance</th>
                            <th scope="col">Group</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Time In</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp 
                        @foreach ($attendance as $user)
                            <tr>
                                <td>{{ $count }} </td>
                                <td scope="row">{{ $user->user->surname}} {{ $user->user->othernames }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->attendance_date)->format('Y-m-d')}}
                                    @if ($user->isPresent == 1)
                                        <span class="badge badge-success badge-pill float-right">On Time</span>
                                    @else
                                        <span class="badge badge-danger badge-pill float-right">Absent</span>
                                    @endif
                                </td>
                                <td> @if ($user->isPresent == 1)
                                    <span class="badge badge-success badge-pill">Present</span>
                                @else
                                    <span class="badge badge-danger badge-pill">Absent</span>
                                @endif</td>
                                <td>{{ $user->user->group}}</td>
                                <td>{{ $user->user->unit}}</td>                                
                                <td>{{ \Carbon\Carbon::parse($user->attendance_date)->format('h:i A')}}</td>
                                
                            </tr>
                            @php
                                $count++;
                            @endphp 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}


    <div class="card">
        <div class="card-body">
            <h3>Attendance Report</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        @foreach($sundays as $sunday)
                            <th>{{ \Carbon\Carbon::parse($sunday)->format('d M Y') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceData as $data)
                        <tr>
                            <td>{{ $data['user']->surname }} {{ $data['user']->othernames }}</td>
                            @foreach($data['attendance'] as $date => $status)
                                <td class="">
                                    
                                    <span class="{{ $status == 'Present' ? 'badge rounded-pill text-success bg-light-success p-2' : 'badge rounded-pill text-danger bg-light-danger p-2' }}">{{ $status }}</span>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>


    </div>
@endsection
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <h4 class="logo-text">Attendance Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        {{-- <li class="menu-label">Users</li> --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li> <a href="{{ url('/admin/user/add') }}"><i class='bx bx-radio-circle'></i>Add User</a>
                </li>
                <li> <a href="{{ url('/admin/user') }}"><i class='bx bx-radio-circle'></i>View Users</a>
                </li>
                
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                
                <div class="menu-title">Attendance</div>
            </a>
            <ul>
                <li> <a href="{{ route('attendance.list') }}"><i class='bx bx-radio-circle'></i>View Attendance</a>
                </li>
                {{-- <li> <a href="component-accordions.html"><i class='bx bx-radio-circle'></i>Accordions</a>
                </li> --}}
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
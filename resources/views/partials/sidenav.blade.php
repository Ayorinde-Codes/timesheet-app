

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> 
                    <span>Main</span>
                </li>
                <li>
                    <a href={{URL('/dashboard')}}><i class="la la-dashboard"></i> <span> Dashboard</span> </a>
                    {{-- <ul style="display: none;">
                        <li><a href="index.html">Admin Dashboard</a></li>
                        <li><a href="employee-dashboard.html">Employee Dashboard</a></li> authorize_employee  user/leave
                    </ul> --}}
                </li>
                <li> 
                    <a href="{{ URL('employees') }}"><i class="la la-user"></i> <span>Employees</span></a>
                </li>  
                <li> 
                    <a href="{{ URL('projects') }}"><i class="la la-rocket"></i> <span>Projects</span></a>
                </li>  
                <li> 
                    <a href="{{ URL('timesheet') }}"><i class="la la-calendar"></i> <span>Timesheet</span></a>
                </li>   
                <li> 
                    <a href="{{ URL('user/timesheet') }}"><i class="la la-calendar"></i> <span>My Timesheet</span></a>
                </li>  
                <li> 
                    <a href="{{ URL('absence') }}"><i class="la la-user-times"></i> <span>Absence (Leave)</span></a>
                </li>               
                <li> 
                    <a href="{{ URL('profile') }}"><i class="la la-user-times"></i> <span>Profile</span></a>
                </li>
                <li> 
                    <a href="{{ URL('authorize_employee') }}"><i class="la la-user-times"></i> <span> Authorize Employee</span></a>
                </li>
                <li> 
                    <a href="{{ URL('user/leave') }}"><i class="la la-user-times"></i> <span> Employee Leave</span></a>
                </li>
                <li> 
                    <a href="{{ URL('view/leave') }}"><i class="la la-user-times"></i> <span> View Employee Leave</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
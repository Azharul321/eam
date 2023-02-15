<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="#">
            @if (session()->get('pp'))
            <img src="{{asset('img/profile').'/'.session()->get('email').'/'.session()->get('pp')}}" class="logo-icon" alt="logo icon">
                        @else
                        <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
                        @endif
            
            <h5 class="logo-text">Employee</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header"></li>
        <li>
            <a href="{{route('EmployeeDashboard')}}">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
     
        <li>
            <a href="{{route('EmployeeProfile')}}">
                <i class="zmdi zmdi-face"></i> <span>Profile</span>
            </a>
        </li>

        <li>
            <a href="{{route('logout')}}">
                <i class="zmdi zmdi-power"></i> <span>Logout</span>
            </a>
        </li>

    </ul>

</div>
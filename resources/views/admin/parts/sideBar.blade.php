<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="#">
            <img src="{{asset('img/hi.png')}}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">EAM Admin</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header"></li>
        <li>
            <a href="{{route('AdminDashboard')}}">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{route('EmployeeList')}}">
                <i class="zmdi zmdi-invert-colors"></i> <span>Employees</span>
            </a>
        </li>

        <li>
            <a href="{{route('seeMessage')}}">
                <i class="zmdi zmdi-whatsapp"></i> <span>Messages</span>
            </a>
        </li>
        <li>
            <a href="{{route('logout')}}">
                <i class="zmdi zmdi-power"></i> <span>Logout</span>
            </a>
        </li>

    </ul>

</div>
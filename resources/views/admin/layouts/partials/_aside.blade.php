<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('admin_dashboard')}}">
                <img style="width: 170px; height: 50px;" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="" srcset="">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="{{route('admin_dashboard')}}" aria-expanded="false" class=" nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only"></span>
                </a>

            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-1">
            <span>User Controls</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <a href="{{route('admin_edit')}}" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Edit Profile</span>
            </a>
            {{-- <a href="adduser.php" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Add User</span>
            </a> --}}
            <a href="{{route('users_details')}}" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Users Detail</span>
            </a>
            <a href="{{route('providers_details')}}" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Providers Detail</span>
            </a>
            <a href="{{route('clinics_details')}}" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Clinic Detail</span>
            </a>
            <a href="{{route('queries')}}" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Messages</span>
            </a>
            <a href="{{route('logout')}}" aria-expanded="false" class=" nav-link">
                <i class="fe fe-box fe-16"></i>
                <span class="ml-3 item-text">Logout</span>
            </a>
        </ul>
    </nav>
</aside>
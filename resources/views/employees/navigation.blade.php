 <!-- Navbar pills -->
 <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills flex-column flex-sm-row mb-4">
        <li class="nav-item"><a class="nav-link {{ Request::routeIs('employee.profile') ? 'active' : '' }}" href="{{ route('employee.profile',$id) }}"><i class="ti-xs ti ti-user-check me-1"></i> Profile</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::routeIs('employee.reports') ? 'active' : '' }}" href="{{ route('employee.reports',$id) }}"><i class="ti-xs ti ti-calendar me-1"></i> Reports</a></li>
        <li class="nav-item"><a class="nav-link" href="pages-profile-connections.html"><i class="ti-xs ti ti-link me-1"></i> Connections</a></li>
      </ul>
    </div>
  </div>
  <!--/ Navbar pills -->

<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset('assets/logo/logo.png') }}" class="mt-1" alt="Nziza Logo" width="170">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <!-- Dashboard -->
        <li class="menu-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        @if (auth()->user()->role == 'employee')
            <li class="menu-item {{ Request::routeIs('dairly_report.index') ? 'active' : '' }}">
                <a href="{{ route('dairly_report.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar"></i>
                    <div data-i18n="Reporting">Reporting</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar"></i>
                    <div data-i18n="Request Leave">Request Leave</div>
                </a>
            </li>
        @else
            <li class="menu-item {{ Request::routeIs(['request.quotation', 'request.demostration', 'request.careers', 'request.quotation.create', 'request.quotation.edit', 'request.quotation.show']) ? 'open' : '' }}"
                style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-checkbox"></i>
                    <div data-i18n="Requests">Requests</div>
                </a>
                <ul class="menu-sub">
                    <li
                        class="menu-item {{ Request::routeIs(['request.quotation', 'request.quotation.create', 'request.quotation.edit', 'request.quotation.show']) ? 'active' : '' }}">
                        <a href="{{ route('request.quotation') }}" class="menu-link">
                            <div data-i18n="Quotations">Quotations</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('request.demostration') ? 'active' : '' }}">
                        <a href="{{ route('request.demostration') }}" class="menu-link">
                            <div data-i18n="Demostration">Demostration</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::routeIs('request.careers') ? 'active' : '' }}">
                        <a href="{{ route('request.careers') }}" class="menu-link">
                            <div data-i18n="Careers">Careers</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ Request::routeIs(['invoice.index', 'invoice.create', 'invoice.quotation_invoice', 'invoice.edit', 'invoice.show']) ? 'open' : '' }}"
                style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                    <div data-i18n="Invoice ">Invoice</div>
                </a>
                <ul class="menu-sub">
                    <li
                        class="menu-item {{ Request::routeIs(['invoice.index', 'invoice.show', 'invoice.edit']) ? 'active' : '' }}">
                        <a href="{{ route('invoice.index') }}" class="menu-link">
                            <div data-i18n="List">List</div>
                        </a>
                    </li>
                    <li
                        class="menu-item {{ Request::routeIs(['invoice.create', 'invoice.quotation_invoice']) ? 'active' : '' }}">
                        <a href="{{ route('invoice.create') }}" class="menu-link">
                            <div data-i18n="Add">Add</div>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="menu-item {{ Request::routeIs('client.index') ? 'active' : '' }}">
                <a href="{{ route('client.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="Clients">Clients</div>
                </a>
            </li>

            <li class="menu-item {{ Request::routeIs('course.index') ? 'active' : '' }}">
                <a href="{{ route('course.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                    <div data-i18n="Courses">Courses</div>
                </a>
            </li>
            <li class="menu-item {{ Request::routeIs('licence.index') ? 'active' : '' }}">
                <a href="{{ route('licence.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-id"></i>
                    <div data-i18n="Licenses">Licenses</div>
                </a>
            </li>

            <li class="menu-item {{ Request::routeIs('employees.index') ? 'active' : '' }}">
                <a href="{{ route('employees.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Employees">Employees</div>
                </a>
            </li>

            <li class="menu-item {{ Request::routeIs('setting.index') ? 'active' : '' }}">
                <a href="{{ route('setting.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="Settings">Settings</div>
                </a>
            </li>
        @endif


    </ul>



</aside>
<!-- / Menu -->

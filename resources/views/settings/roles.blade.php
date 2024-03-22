@section('title', 'Roles List')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-semibold mb-4">Roles List</h4>

        <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role
            an administrator can have access to what user needs.</p>
        <!-- Role cards -->
        <div class="row g-4">
            @foreach ($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-normal mb-2">Total {{ $role->users->count() }}
                                    {{ Str::plural('user', $role->users->count()) }}</h6>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($role->users as $ru)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="{{ $ru->name }}" class="avatar avatar-sm pull-up">
                                            @php
                                                $words = explode(' ', $ru->name);
                                                $initials = '';
                                                foreach ($words as $word) {
                                                    $initials .= substr($word, 0, 1) . ' ';
                                                }
                                                $initials = trim($initials);
                                                // Define an array of color classes
                                                $colors = [
                                                    'bg-label-danger',
                                                    'bg-label-success',
                                                    'bg-label-primary',
                                                    'bg-label-warning',
                                                ];

                                                // Select a random color from the array
                                                $randomColor = $colors[array_rand($colors)];
                                            @endphp
                                            @if ($ru->profile)
                                                <img src="{{ asset('images/profile') }}/{{ $ru->photo }}"
                                                    alt="Avatar" class="rounded-circle">
                                            @else
                                                <span
                                                    class="avatar-initial rounded-circle {{ $randomColor }}">{{ $initials }}</span>
                                            @endif

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $role->name }}</h4>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                        class="role-edit-modal">
                                        <span
                                            data="@foreach ($role->permissions as $permission)permission[{{ $permission->name }}], @endforeach"
                                            ariaLabel="{{ $role->name }}" ariaHidden="{{ $role->id }}">Edit
                                            Role</span>
                                    </a>
                                </div>
                                <a href="javascript:void(0);" class="text-muted"><i data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom" data-bs-placement="top" title="Delete"
                                        class="ti ti-trash ti-md"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('assets/img/add-new-roles.png') }}"
                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Role</button>
                                <p class="mb-0 mt-1">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role cards -->
        <!-- Add Role Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2">Add New Role</h3>
                            <p class="text-muted">Set role permissions</p>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    @if ($errors->any())
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <span class="alert-icon text-danger me-2">
                                                <i class="ti ti-ban ti-xs"></i>
                                            </span>
                                            @foreach ($errors->all() as $error)
                                                <span class="d-block"> {{ $error }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- Add role form -->
                        <form id="addRoleForm" class="row g-3" method="post">
                            @csrf
                            <input type="hidden" id="is" name="express" />
                            <div class="col-12 mb-4">
                                <label class="form-label" for="modalRoleName">Role Name</label>
                                <input type="text" id="modalRoleName" name="name" class="form-control"
                                    placeholder="Enter a role name" tabindex="-1" value="{{ old('name') }}" />
                            </div>
                            <div class="col-12">
                                <h5>Role Permissions</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Administrator Access <i
                                                        class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        aria-label="Allows a full access to the system"
                                                        data-bs-original-title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                        <label class="form-check-label" for="selectAll">
                                                            Select All
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Employee Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-users" name="permission[read-users]">
                                                            <label class="form-check-label" for="read-users">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-users" name="permission[update-users]">
                                                            <label class="form-check-label" for="update-users">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-users" name="permission[create-users]">
                                                            <label class="form-check-label" for="create-users">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-users" name="permission[delete-users]">
                                                            <label class="form-check-label" for="delete-users">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Course Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-courses" name="permission[read-courses]">
                                                            <label class="form-check-label" for="read-courses">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-courses" name="permission[update-courses]">
                                                            <label class="form-check-label" for="update-courses">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-courses" name="permission[create-courses]">
                                                            <label class="form-check-label" for="create-courses">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-courses" name="permission[delete-courses]">
                                                            <label class="form-check-label" for="delete-courses">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">License Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-licenses" name="permission[read-licenses]">
                                                            <label class="form-check-label" for="read-licenses">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-licenses"
                                                                name="permission[update-licenses]">
                                                            <label class="form-check-label" for="update-licenses">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-licenses"
                                                                name="permission[create-licenses]">
                                                            <label class="form-check-label" for="create-licenses">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-licenses"
                                                                name="permission[delete-licenses]">
                                                            <label class="form-check-label" for="delete-licenses">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Trainees Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-trainees" name="permission[read-trainees]">
                                                            <label class="form-check-label" for="read-trainees">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-trainees"
                                                                name="permission[update-trainees]">
                                                            <label class="form-check-label" for="update-trainees">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-trainees"
                                                                name="permission[create-trainees]">
                                                            <label class="form-check-label" for="create-trainees">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-trainees"
                                                                name="permission[delete-trainees]">
                                                            <label class="form-check-label" for="delete-trainees">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Clients Management</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-clients" name="permission[read-clients]">
                                                            <label class="form-check-label" for="read-clients">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-clients" name="permission[update-clients]">
                                                            <label class="form-check-label" for="update-clients">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-clients" name="permission[create-clients]">
                                                            <label class="form-check-label" for="create-clients">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-clients" name="permission[delete-clients]">
                                                            <label class="form-check-label" for="delete-clients">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Reporting</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-reports" name="permission[read-reports]">
                                                            <label class="form-check-label" for="read-reports">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-reports" name="permission[update-reports]">
                                                            <label class="form-check-label" for="update-reports">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-reports" name="permission[create-reports]">
                                                            <label class="form-check-label" for="create-reports">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-reports" name="permission[delete-reports]">
                                                            <label class="form-check-label" for="delete-reports">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">License Subscription</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-license-subscription"
                                                                name="permission[read-license-subscription]">
                                                            <label class="form-check-label"
                                                                for="read-license-subscription">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-license-subscription"
                                                                name="permission[update-license-subscription]">
                                                            <label class="form-check-label"
                                                                for="update-license-subscription">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-license-subscription"
                                                                name="permission[create-license-subscription]">
                                                            <label class="form-check-label"
                                                                for="create-license-subscription">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-license-subscription"
                                                                name="permission[delete-license-subscription]">
                                                            <label class="form-check-label"
                                                                for="delete-license-subscription">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Courses Subscription</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-courses-subscription"
                                                                name="permission[read-courses-subscription]">
                                                            <label class="form-check-label"
                                                                for="read-courses-subscription">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-courses-subscription"
                                                                name="permission[update-courses-subscription]">
                                                            <label class="form-check-label"
                                                                for="update-courses-subscription">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-courses-subscription"
                                                                name="permission[create-courses-subscription]">
                                                            <label class="form-check-label"
                                                                for="create-courses-subscription">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-courses-subscription"
                                                                name="permission[delete-courses-subscription]">
                                                            <label class="form-check-label"
                                                                for="delete-courses-subscription">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Invoice Management</td>
                                                <td>
                                                    <div class="d-flex mb-2">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-invoices" name="permission[read-invoices]">
                                                            <label class="form-check-label" for="read-invoices">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-invoices"
                                                                name="permission[update-invoices]">
                                                            <label class="form-check-label" for="update-invoices">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-invoices"
                                                                name="permission[create-invoices]">
                                                            <label class="form-check-label" for="create-invoices">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-invoices"
                                                                name="permission[delete-invoices]">
                                                            <label class="form-check-label" for="delete-invoices">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="email-invoices" name="permission[email-invoices]">
                                                            <label class="form-check-label" for="email-invoices">
                                                                Send Mail
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="download-invoices"
                                                                name="permission[download-invoices]">
                                                            <label class="form-check-label" for="download-invoices">
                                                                Download
                                                            </label>
                                                        </div>
                                                        <div class="form-check  me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="print-invoices" name="permission[print-invoices]">
                                                            <label class="form-check-label" for="print-invoices">
                                                                Print
                                                            </label>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap fw-medium">Quotation Management</td>
                                                <td>
                                                    <div class="d-flex mb-2">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="read-quotations"
                                                                name="permission[read-quotations]">
                                                            <label class="form-check-label" for="read-quotations">
                                                                Read
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="update-quotations"
                                                                name="permission[update-quotations]">
                                                            <label class="form-check-label" for="update-quotations">
                                                                Update
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-quotations"
                                                                name="permission[create-quotations]">
                                                            <label class="form-check-label" for="create-quotations">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="delete-quotations"
                                                                name="permission[delete-quotations]">
                                                            <label class="form-check-label" for="delete-quotations">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="email-quotations"
                                                                name="permission[email-quotations]">
                                                            <label class="form-check-label" for="email-quotations">
                                                                Send Mail
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="download-quotations"
                                                                name="permission[download-quotations]">
                                                            <label class="form-check-label" for="download-quotations">
                                                                Download
                                                            </label>
                                                        </div>
                                                        <div class="form-check  me-2 me-lg-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="print-quotations"
                                                                name="permission[print-quotations]">
                                                            <label class="form-check-label" for="print-quotations">
                                                                Print
                                                            </label>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Role Modal -->

    </div>

    @section('css')

    @endsection

    @section('js')
    <script>
        "use strict";
        $(function() {
                var e,
                    a = $(".datatables-users"),
                    l = {
                        1: {
                            title: "Pending",
                            class: "bg-label-warning"
                        },
                        2: {
                            title: "Active",
                            class: "bg-label-success"
                        },
                        3: {
                            title: "Inactive",
                            class: "bg-label-secondary"
                        }
                    },
                    i = "app-user-view-account.html";
                a.length && (e = a.DataTable({
                        ajax: assetsPath + "json/user-list.json",
                        columns: [{
                                data: ""
                            },
                            {
                                data: "full_name"
                            },
                            {
                                data: "role"
                            },
                            {
                                data: "current_plan"
                            },
                            {
                                data: "billing"
                            },
                            {
                                data: "status"
                            },
                            {
                                data: ""
                            }
                        ],
                        columnDefs: [{
                                className: "control",
                                orderable: !1,
                                searchable: !1,
                                responsivePriority: 2,
                                targets: 0,
                                render: function(e, a, t, s) {
                                    return ""
                                }
                            },
                            {
                                targets: 1,
                                responsivePriority: 4,
                                render: function(e, a, t, s) {
                                    var l = t.full_name,
                                        n = t.email,
                                        r = t.avatar;
                                    return '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3">' +
                                        (r ? '<img src="' + assetsPath + "img/avatars/" + r +
                                            '" alt="Avatar" class="rounded-circle">' :
                                            '<span class="avatar-initial rounded-circle bg-label-' + [
                                                "success", "danger", "warning", "info", "primary",
                                                "secondary"
                                            ][Math.floor(6 * Math.random())] + '">' + (r = (((r = (l = t
                                                    .full_name).match(/\b\w/g) || []).shift() ||
                                                "") + (r.pop() || "")).toUpperCase()) + "</span>") +
                                        '</div></div><div class="d-flex flex-column"><a href="' + i +
                                        '" class="text-body text-truncate"><span class="fw-semibold">' +
                                        l + '</span></a><small class="text-muted">@' + n +
                                        "</small></div></div>"
                                }
                            },
                            {
                                targets: 2,
                                render: function(e, a, t, s) {
                                    t = t.role;
                                    return "<span class='text-truncate d-flex align-items-center'>" + {
                                        Subscriber: '<span class="badge badge-center rounded-pill bg-label-warning me-3 w-px-30 h-px-30"><i class="ti ti-user ti-sm"></i></span>',
                                        Author: '<span class="badge badge-center rounded-pill bg-label-success me-3 w-px-30 h-px-30"><i class="ti ti-settings ti-sm"></i></span>',
                                        Maintainer: '<span class="badge badge-center rounded-pill bg-label-primary me-3 w-px-30 h-px-30"><i class="ti ti-chart-pie-2 ti-sm"></i></span>',
                                        Editor: '<span class="badge badge-center rounded-pill bg-label-info me-3 w-px-30 h-px-30"><i class="ti ti-edit ti-sm"></i></span>',
                                        Admin: '<span class="badge badge-center rounded-pill bg-label-secondary me-3 w-px-30 h-px-30"><i class="ti ti-device-laptop ti-sm"></i></span>'
                                    } [t] + t + "</span>"
                                }
                            },
                            {
                                targets: 3,
                                render: function(e, a, t, s) {
                                    return '<span class="fw-semibold">' + t.current_plan + "</span>"
                                }
                            },
                            {
                                targets: 5,
                                render: function(e, a, t, s) {
                                    t = t.status;
                                    return '<span class="badge ' + l[t].class + '" text-capitalized>' +
                                        l[t].title + "</span>"
                                }
                            },
                            {
                                targets: -1,
                                title: "Actions",
                                searchable: !1,
                                orderable: !1,
                                render: function(e, a, t, s) {
                                    return '<div class="d-flex align-items-center"><a href="' + i +
                                        '" class="btn btn-sm btn-icon"><i class="ti ti-eye"></i></a><a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a><a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div>'
                                }
                            }
                        ],
                        order: [
                            [1, "desc"]
                        ],
                        dom: '<"row mx-2"<"col-sm-12 col-md-4 col-lg-6" l><"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        language: {
                            sLengthMenu: "Show _MENU_",
                            search: "Search",
                            searchPlaceholder: "Search.."
                        },
                        responsive: {
                            details: {
                                display: $.fn.dataTable.Responsive.display.modal({
                                    header: function(e) {
                                        return "Details of " + e.data().full_name
                                    }
                                }),
                                type: "column",
                                renderer: function(e, a, t) {
                                    t = $.map(t, function(e, a) {
                                        return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex +
                                            '" data-dt-column="' + e.columnIndex + '"><td>' + e
                                            .title + ":</td> <td>" + e.data + "</td></tr>" : ""
                                    }).join("");
                                    return !!t && $('<table class="table"/><tbody />').append(t)
                                }
                            }
                        },
                        initComplete: function() {
                            this.api().columns(2).every(function() {
                                var a = this,
                                    t = $(
                                        '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
                                        ).appendTo(".user_role").on("change", function() {
                                        var e = $.fn.dataTable.util.escapeRegex($(this).val());
                                        a.search(e ? "^" + e + "$" : "", !0, !1).draw()
                                    });
                                a.data().unique().sort().each(function(e, a) {
                                    t.append('<option value="' + e +
                                        '" class="text-capitalize">' + e + "</option>")
                                })
                            })
                        }
                    })),
                    $(".datatables-users tbody").on("click", ".delete-record", function() {
                        e.row($(this).parents("tr")).remove().draw()
                    }),
                    setTimeout(() => {
                        $(".dataTables_filter .form-control").removeClass("form-control-sm"),
                            $(".dataTables_length .form-select").removeClass("form-select-sm")
                    }, 300)
            }),
            function() {
                var e = document.querySelectorAll(".role-edit-modal"),
                    a = document.querySelector(".add-new-role"),
                    b = document.querySelector("#modalRoleName"),
                    h = document.querySelector("#is"),
                    o = document.querySelectorAll('[type="checkbox"]'),
                    t = document.querySelector(".role-title");
                a.onclick = function() {
                        t.innerHTML = "Add New Role";
                        h.value = '0';
                    },
                    e && e.forEach(function(e) {
                        e.onclick = function(event) {
                            b.value = event.target.attributes[1].value;
                            h.value = event.target.attributes[2].value;
                            let permissions = event.target.attributes[0].value.split(',');
                            o.forEach(e => {
                                e.checked = e.name && permissions.includes(e.name) ? true : false;
                            })
                            t.innerHTML = "Edit Role";
                        }
                    })
            }();
    </script>
    <script>
        // Get the "Select All" checkbox
        var selectAll = document.getElementById("selectAll");
        // Get all the checkboxes
        var checkboxes = document.querySelectorAll(".form-check-input");

        // Add event listener to the "Select All" checkbox
        selectAll.addEventListener("change", function() {
            // Loop through all checkboxes
            checkboxes.forEach(function(checkbox) {
                // Set the checked state of each checkbox to the state of the "Select All" checkbox
                checkbox.checked = selectAll.checked;
            });
        });

        // Add event listener to each checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                // If any checkbox is unchecked, uncheck the "Select All" checkbox
                if (!this.checked) {
                    selectAll.checked = false;
                }
                // If all checkboxes are checked, check the "Select All" checkbox
                else if ([...checkboxes].every(c => c.checked)) {
                    selectAll.checked = true;
                }
            });
        });
    </script>
        <script>
            @if ($errors->any())
                var myModal = new bootstrap.Modal(document.getElementById('addRoleModal'), {
                    keyboard: false
                })
                myModal.show()
            @endif
        </script>
    @endsection
</x-app-layout>

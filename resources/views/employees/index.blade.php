@section('title', 'Employees')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Employees


                    <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                        data-bs-target="#newUser"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                            class="d-none d-sm-inline-block">New Employee</span></a>
                </h5>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables table border-top">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $item)
                            <tr class="odd">
                                <td class="sorting_1">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-3">
                                                @php
                                                    $words = explode(' ', $item->name);
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

                                                @if ($item->profile)
                                                    <img src="{{ asset('images/profile') }}/{{ $item->profile }}"
                                                        alt="Avatar" class="rounded-circle">
                                                @else
                                                    <span
                                                        class="avatar-initial rounded-circle {{ $randomColor }}">{{ $initials }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column"><a href="javascript:"
                                                class="text-body text-truncate"><span
                                                    class="fw-medium">{{ $item->name }}</span></a><small
                                                class="text-muted">{{ $item->email }}</small></div>
                                    </div>
                                </td>
                                <td><span class="text-truncate d-flex align-items-center">{{ $item->phone }}</span>
                                </td>

                                <td>{{ $item->position }}</td>
                                <td>{{ $item->branch->name }}</td>
                                <td>
                                    @if ($item->status == 'active')
                                        <span class="badge bg-label-success" text-capitalized="">Active</span>
                                    @else
                                        <span class="badge bg-label-danger" text-capitalized="">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('employee.profile',$item->id) }}" class="text-body"><i
                                                class="ti ti-eye ti-sm me-2"></i></a>
                                        <a href="javascript:;" class="text-body" data-bs-toggle="modal"
                                            data-bs-target="#editUser{{ $item->id }}"><i
                                                class="ti ti-edit ti-sm me-2"></i></a>
                                        <a href="javascript:;" data-bs-toggle="modal"
                                            data-bs-target="#deleteUser{{ $item->id }}"
                                            class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a>

                                    </div>
                                    <!-- Update User Modal -->
                                    <div class="modal fade" id="editUser{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                            <div class="modal-content p-3 p-md-5">
                                                <div class="modal-body">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    <div class="text-center mb-4">
                                                        <h3 class="mb-2">Add Employee</h3>
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <p><strong>Opps Something went wrong</strong></p>
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>* {{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <form id="newUserForm"
                                                        action="{{ route('employees.update', $item->id) }}"
                                                        class="row g-3" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="name">Full Name</label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Full name"
                                                                value="{{ old('name', $item->name) }}" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="email">Email</label>
                                                            <input type="text" id="email" name="email"
                                                                class="form-control" placeholder="example@domain.com"
                                                                value="{{ old('email', $item->email) }}" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="phone">Phone
                                                                Number</label>
                                                            <div class="input-group">
                                                                <input type="text" id="phone" name="phone"
                                                                    class="form-control phone-number-mask"
                                                                    maxLength="10" placeholder="xxx xxx xxxx"
                                                                    value="{{ old('phone', $item->phone) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="position">Position</label>
                                                            <input type="text" id="position" name="position"
                                                                class="form-control" placeholder="Position"
                                                                value="{{ old('position', $item->position) }}" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="branch_id">Branch</label>
                                                            <select id="branch_id" name="branch_id"
                                                                class="form-select">
                                                                <option value="" selected> - Select - </option>
                                                                @foreach ($branches as $branch)
                                                                    </option>
                                                                    <option
                                                                        @if (old('branch_id', $item->branch_id) == $branch->id) selected @endif
                                                                        value="{{ $branch->id }}">
                                                                        {{ $branch->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="role">Role</label>
                                                            <select id="role" name="role"
                                                                class="form-select">
                                                                <option value="" selected> - Select - </option>
                                                                <option
                                                                    @if (old('role', $item->role) == 'admin') selected @endif
                                                                    value="admin">Manager
                                                                </option>
                                                                <option
                                                                    @if (old('role', $item->role) == 'employee') selected @endif
                                                                    value="employee">Employee
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="image">Profile
                                                                Image</label>
                                                            <input type="file" id="image" name="image"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="form-label" for="status">Status</label>
                                                            <select id="status" name="status"
                                                                class="form-select">
                                                                <option value="" selected> - Select - </option>
                                                                <option
                                                                    @if (old('status', $item->status) == 'active') selected @endif
                                                                    value="active">Active
                                                                </option>
                                                                <option
                                                                    @if (old('status') == 'inactive') selected @endif
                                                                    value="inactive">Inactive
                                                                </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-12 text-center">
                                                            <button type="submit"
                                                                class="btn btn-primary me-sm-3 me-1">Save</button>
                                                            <button type="reset" class="btn btn-label-secondary"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Update User Modal -->
                                    <!-- Delete User Modal -->
                                    <div class="modal fade" id="deleteUser{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-simple">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    <div class="text-center mb-4">
                                                        <h5 class="mb-2">Are you sure you want to delete
                                                            this?</h5>
                                                    </div>
                                                    <form action="{{ route('employees.destroy', $item->id) }}"
                                                        class="row g-3" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="col-12 text-center">
                                                            <button type="submit"
                                                                class="btn btn-danger me-sm-3 me-1">Yes
                                                                Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Delete User Modal -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- New User Modal -->
        <div class="modal fade" id="newUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Add Employee</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Opps Something went wrong</strong></p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>* {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form id="newUserForm" action="{{ route('employees.store') }}" class="row g-3"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="name">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Full name" value="{{ old('name') }}" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="example@domain.com" value="{{ old('email') }}" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <div class="input-group">
                                    <input type="text" id="phone" name="phone"
                                        class="form-control phone-number-mask" maxLength="10"
                                        placeholder="xxx xxx xxxx" value="{{ old('phone') }}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="position">Position</label>
                                <input type="text" id="position" name="position" class="form-control"
                                    placeholder="Position" value="{{ old('position') }}" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="branch_id">Branch</label>
                                <select id="branch_id" name="branch_id" class="form-select">
                                    <option value="" selected> - Select - </option>
                                    @foreach ($branches as $item)
                                        </option>
                                        <option @if (old('branch_id') == $item->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="role">Role</label>
                                <select id="role" name="role" class="form-select">
                                    <option value="" selected> - Select - </option>
                                    <option @if (old('role') == 'admin') selected @endif value="admin">Manager
                                    </option>
                                    <option @if (old('role') == 'employee') selected @endif value="employee">
                                        Employee
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="image">Profile Image</label>
                                <input type="file" id="image" name="image" class="form-control" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="status">Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="" selected> - Select - </option>
                                    <option @if (old('status') == 'active') selected @endif value="active">Active
                                    </option>
                                    <option @if (old('status') == 'inactive') selected @endif value="inactive">
                                        Inactive
                                    </option>

                                </select>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ New User Modal -->

    </div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>

        <script>
            "use strict";

            document.addEventListener("DOMContentLoaded", function(e) {
                {
                    const o = document.querySelector("#newUserForm"),
                        p = document.querySelector("#editUserForm"),
                        t = document.querySelector("#phone");
                    t && new Cleave(t, {
                        phone: !0,
                        phoneRegionCode: "RW"
                    });
                    const s = (o && FormValidation.formValidation(o, {
                        fields: {
                            position: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter posistion"
                                    }
                                }
                            },
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter full name"
                                    }
                                }
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter your email"
                                    },
                                    emailAddress: {
                                        message: "The value is not a valid email address"
                                    }
                                }
                            },
                            phone: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter phone number"
                                    },
                                }
                            },
                            status: {
                                validators: {
                                    notEmpty: {
                                        message: "Select status"
                                    }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                eleValidClass: "",
                                rowSelector: ".col-md-6"
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton,
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit,
                            autoFocus: new FormValidation.plugins.AutoFocus
                        },
                        init: e => {
                            e.on("plugins.message.placed", function(e) {
                                e.element.parentElement.classList.contains("input-group") && e
                                    .element.parentElement.insertAdjacentElement("afterend", e
                                        .messageElement)
                            })
                        }
                    }));
                    const u = (p && FormValidation.formValidation(p, {
                        fields: {

                            name: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter full name"
                                    }
                                }
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter your email"
                                    },
                                    emailAddress: {
                                        message: "The value is not a valid email address"
                                    }
                                }
                            },
                            phone: {
                                validators: {
                                    notEmpty: {
                                        message: "Please enter phone number"
                                    },
                                }
                            },
                            gender: {
                                validators: {
                                    notEmpty: {
                                        message: "Select gender"
                                    }
                                }
                            },
                            marital: {
                                validators: {
                                    notEmpty: {
                                        message: "Select martial status"
                                    }
                                }
                            },
                            district: {
                                validators: {
                                    notEmpty: {
                                        message: "Select district"
                                    }
                                }
                            },
                            category: {
                                validators: {
                                    notEmpty: {
                                        message: "Select user category"
                                    }
                                }
                            },
                            status: {
                                validators: {
                                    notEmpty: {
                                        message: "Select status status"
                                    }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                eleValidClass: "",
                                rowSelector: ".col-md-6"
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton,
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit,
                            autoFocus: new FormValidation.plugins.AutoFocus
                        },
                        init: e => {
                            e.on("plugins.message.placed", function(e) {
                                e.element.parentElement.classList.contains("input-group") && e
                                    .element.parentElement.insertAdjacentElement("afterend", e
                                        .messageElement)
                            })
                        }
                    }));
                }
                @if (old('express'))
                    @if ($errors->any())
                        var myModal = new bootstrap.Modal(document.getElementById('editUser'), {
                            keyboard: false
                        })
                        myModal.show()
                    @endif
                @else
                    @if ($errors->any())
                        var myModal = new bootstrap.Modal(document.getElementById('newUser'), {
                            keyboard: false
                        })
                        myModal.show()
                    @endif
                @endif

            })
        </script>

        <script>
            $(document).ready(function() {
                $('.datatables').DataTable({
                    order: []
                });
            });
        </script>
    @endsection
</x-app-layout>

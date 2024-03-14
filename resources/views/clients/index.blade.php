@section('title', 'Clients')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">Clients
                            <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                                data-bs-target="#newClient"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                    class="d-none d-sm-inline-block">Add New</span></a>

                        </h5>
                        <!-- New User Modal -->
                        <div class="modal fade" id="newClient" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Add Client</h3>
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
                                        <form action="{{ route('client.store') }}" class="row g-3" method="post">
                                            @csrf

                                            <div class="col-md-12">
                                                <label class="form-label" for="name">Client Name</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Client Name" value="{{ old('name') }}" />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    placeholder="Email Address" value="{{ old('email') }}" />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                    placeholder="Phone Number" value="{{ old('phone') }}" />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="text" id="address" name="address" class="form-control"
                                                    placeholder="Address " value="{{ old('address') }}" />
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1">Submit</button>
                                                <button type="reset" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ New User Modal -->
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables table border-top">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $item)
                                    <tr class="odd">
                                        <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            <div class="d-flex align-items-center"><a href="javascript:;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateClient{{ $item->id }}"
                                                    class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>
                                                <a href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#deleteClient{{ $item->id }}"
                                                    class="text-body delete-record{{ $item->id }}">
                                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                                </a>


                                            </div>
                                            <!-- New User Modal -->
                                            <div class="modal fade" id="updateClient{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                                    <div class="modal-content p-3 p-md-5">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h3 class="mb-2">Edit Branch</h3>
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <p><strong>Opps Something went wrong</strong>
                                                                        </p>
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>* {{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <form action="{{ route('client.update', $item->id) }}"
                                                                class="row g-3" method="post">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="name">Client
                                                                        Name</label>
                                                                    <input type="text" id="name" name="name"
                                                                        class="form-control"
                                                                        value="{{ $item->name }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="email">Email Address</label>
                                                                    <input type="email" id="email" name="email" class="form-control" value="{{ $item->email }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="phone">Phone Number</label>
                                                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $item->phone }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="name">Address
                                                                    </label>
                                                                    <input type="text" id="name" name="address"
                                                                        class="form-control"
                                                                        value="{{ $item->address }}" />
                                                                </div>
                                                                <div class="col-12 text-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary me-sm-3 me-1">Save
                                                                        Change</button>
                                                                    <button type="reset"
                                                                        class="btn btn-label-secondary"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/ New User Modal -->
                                            <!-- New User Modal -->
                                            <div class="modal fade" id="deleteClient{{ $item->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-simple">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h5 class="mb-2">Are you sure you want to delete
                                                                    this?</h5>
                                                            </div>
                                                            <form action="{{ route('client.destroy', $item->id) }}"
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
                                            <!--/ New User Modal -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.datatables').DataTable({
                    scrollX: true,
                });
            });
        </script>

    @endsection
</x-app-layout>

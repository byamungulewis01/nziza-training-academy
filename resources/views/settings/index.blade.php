@section('title', 'Settings')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">Branches
                            <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                                data-bs-target="#newBranch"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                    class="d-none d-sm-inline-block">Add New</span></a>

                        </h5>

                        <!-- New User Modal -->
                        <div class="modal fade" id="newBranch" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Add Branch</h3>
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
                                        <form action="{{ route('branch.store') }}" class="row g-3" method="post">
                                            @csrf

                                            <div class="col-md-12">
                                                <label class="form-label" for="name">Branch Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="form-control" placeholder="Branch Name"
                                                    value="{{ old('name') }}" />
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
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $item)
                                    <tr class="odd">
                                        <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center"><a href="javascript:;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateBranch{{ $item->id }}"
                                                    class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>
                                                <a href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#deleteBranch{{ $item->id }}"
                                                    class="text-body delete-record{{ $item->id }}">
                                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                                </a>


                                            </div>
                                            <!-- New User Modal -->
                                            <div class="modal fade" id="updateBranch{{ $item->id }}"
                                                tabindex="-1" aria-hidden="true">
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
                                                            <form action="{{ route('branch.update', $item->id) }}"
                                                                class="row g-3" method="post">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="name">Branch
                                                                        Name</label>
                                                                    <input type="text" id="name"
                                                                        name="name" class="form-control"
                                                                        value="{{ $item->name }}" />
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
                                            <div class="modal fade" id="deleteBranch{{ $item->id }}"
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
                                                            <form action="{{ route('branch.destroy', $item->id) }}"
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
                    lengthMenu: [5, 10, 25, 50], // Define available page lengths
                    pageLength: 5, // Set default page length to 5

                });
            });
        </script>

    @endsection
</x-app-layout>

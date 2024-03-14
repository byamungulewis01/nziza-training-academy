@section('title', 'Quotations')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Quotations
                    <a class="btn btn-dark text-white pull-left float-end"
                        href="{{ route('request.quotation.create') }}"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                            class="d-none d-sm-inline-block">Create
                            Quotation</span></a>
                </h5>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables table border-top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->position }}</td>
                                <td>
                                    <div class="d-flex align-items-center"><a href="javascript:;" class="text-body"
                                            data-bs-placement="top" aria-label="Send Mail"
                                            data-bs-original-title="Send Mail" data-bs-toggle="offcanvas"
                                            data-bs-target="#sendInvoiceOffcanvas{{ $item->id }}"><i
                                                class="ti ti-mail mx-2 ti-sm"></i></a>
                                        <a href="{{ route('request.quotation.show', $item->id) }}"
                                            data-bs-toggle="tooltip" class="text-body" data-bs-placement="top"
                                            aria-label="Preview Invoice" data-bs-original-title="Preview Invoice"><i
                                                class="ti ti-eye mx-2 ti-sm"></i></a>
                                        <div class="dropdown"><a href="javascript:;"
                                                class="btn dropdown-toggle hide-arrow text-body p-0"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('request.quotation.download', $item->id) }}"
                                                    class="dropdown-item">Download</a>
                                                <a href="{{ route('invoice.quotation_invoice', $item->id) }}"
                                                    class="dropdown-item">Invoice</a>
                                                <a href="{{ route('request.quotation.edit', $item->id) }}"
                                                    class="dropdown-item">Edit</a>
                                                <div class="dropdown-divider"></div>

                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#deleteInvoice{{ $item->id }}"
                                                    data-bs-toggle="tooltip"
                                                    class="dropdown-item delete-record text-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- New User Modal -->
                                    <div class="modal fade" id="deleteInvoice{{ $item->id }}" tabindex="-1"
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
                                                    <form action="{{ route('request.quotation.destroy', $item->id) }}"
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
            $(document).ready(function() {
                $('.datatables').DataTable({});
            });
        </script>
    @endsection
</x-app-layout>

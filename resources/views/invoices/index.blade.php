@section('title', 'Invoices List')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Invoice List


                    <a class="btn btn-dark text-white pull-left float-end" href="{{ route('invoice.create') }}"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                            class="d-none d-sm-inline-block">Create Invoice</span></a>
                    <a class="d-none" id="edit" data-bs-toggle="modal" data-bs-target="#editUser"></a>
                    {{-- <a class="btn btn-info text-white pull-left float-end"><span class="d-none d-sm-inline-block">Excel Expo</span></a> &nbsp; &nbsp; --}}
                </h5>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables table border-top">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Client</th>
                            <th>Address</th>
                            <th>Total</th>
                            <th>Issued Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $item)
                            <tr class="odd">
                                <td class="sorting_1"><a
                                        href="{{ route('invoice.show', $item->id) }}">#{{ $item->invoice_no }}</a></td>
                                <td><span
                                        class="text-truncate d-flex align-items-center">{{ $item->salesperson }}</span>
                                <td><span class="text-truncate d-flex align-items-center">{{ $item->address }}</span>
                                </td>

                                <td><span class="d-none">{{ $item->total }}</span>${{ $item->total }}</td>
                                <td> {{ $item->created_at->format('d M Y') }}</td>
                                <td class="d-flex align-items-center">
                                    <div><a href="javascript:;" data-bs-toggle="tooltip" class="text-body"
                                            data-bs-placement="top" aria-label="Send Mail"
                                            data-bs-original-title="Send Mail"><i class="ti ti-mail mx-2 ti-sm"></i></a>

                                        <a href="{{ route('invoice.show', $item->id) }}" data-bs-toggle="tooltip"
                                            class="text-body" data-bs-placement="top" aria-label="Preview Invoice"
                                            data-bs-original-title="Preview Invoice"><i
                                                class="ti ti-eye mx-2 ti-sm"></i></a>
                                        <a href="app-invoice-preview.html" data-bs-toggle="tooltip" class="text-body"
                                            data-bs-placement="top" aria-label="Preview Invoice"
                                            data-bs-original-title="Download"><i
                                                class="ti ti-download mx-2 ti-sm"></i></a>
                                        <a href="{{ route('invoice.edit', $item->id) }}" data-bs-toggle="tooltip"
                                            class="text-body" data-bs-placement="top" aria-label="Preview Invoice"
                                            data-bs-original-title="Edit"><i class="ti ti-edit mx-2 ti-sm"></i></a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteInvoice{{ $item->id }}" data-bs-toggle="tooltip"
                                            class="text-body"><i class="ti ti-trash mx-2 ti-sm"></i></a>

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
                                                    <form action="{{ route('invoice.destroy', $item->id) }}"
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
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('.datatables').DataTable({});
            });
        </script>
    @endsection
</x-app-layout>

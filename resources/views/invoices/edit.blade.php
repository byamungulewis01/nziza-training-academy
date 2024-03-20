@section('title', 'Edit Invoice')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row invoice-add">
            <!-- Invoice Add-->
            <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <form action="{{ route('invoice.update', $invoice->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            @if (session()->has('warning1'))
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-warning me-2">
                                        <i class="ti ti-ban ti-xs"></i>
                                    </span>
                                    {{ session()->get('warning1') }}
                                </div>
                            @endif
                            <div class="row m-sm-4 m-0">
                                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                        <img src="{{ asset('assets/logo/logo.png') }}" class="mt-1" alt="Nziza Logo"
                                            width="170">
                                    </div>
                                    <p class="mb-2">Kigali, Rwanda KICUKIRO, KK 15 RD</p>
                                    <p class="mb-2">Hotline: +25078556718</p>
                                    <p class="mb-2">Website: <a
                                            href="https://nzizatraining.ac.rw">https://nzizatraining.ac.rw</a></p>
                                    <p class="mb-2">Email: sales@nzizatraining.ac.rw</p>
                                </div>
                                <div class="col-md-5">
                                    <dl class="row mb-2">
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                                            <div class="input-group input-group-merge disabled w-px-150">
                                                <span class="input-group-text">#</span>
                                                <input type="text" class="form-control"name="invoice_no"
                                                    disabled="" placeholder="{{ $invoice->invoice_no }}"
                                                    value="{{ $invoice->invoice_no }}" id="invoiceId">
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                                            <span class="fw-normal">Valid Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                                            <input type="text" id="valid_date" name="valid_date" required
                                                class="form-control w-px-150 date-picker flatpickr-input"
                                                value="{{ $invoice->valid_date }}" readonly="readonly">
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                                            <span class="fw-normal">Expiry Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                                            <input type="text" id="expired_date" name="expired_date" required
                                                class="form-control w-px-150 date-picker flatpickr-input"
                                                value="{{ $invoice->expired_date }}" readonly="readonly">
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <hr class="my-3 mx-n4">
                            <div class="row m-sm-4 m-0">
                                <div class="mb-3">
                                    <label for="trainings" class="form-label fs-6">Select Training:</label>
                                    <select id="trainings" class="form-select">
                                        <option value="" selected disabled>Select Training</option>
                                    </select>
                                </div>
                                <table id="trainingTable" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%">Training Name</th>
                                            <th>Qty</th>
                                            <th>Discout (%)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @empty($invoice->training)
                                        @else
                                            @php
                                                $training = explode('_', $invoice->training);
                                                $trainingsQty = explode('_', $invoice->training_qty);
                                                $trainingsDiscount = explode('_', $invoice->training_discount);
                                                $count = count($training);
                                            @endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                <tr data-id="{{ $training[$i] }}">
                                                    <td>{{ \App\Models\Course::find($training[$i])->name }} <input
                                                            type="hidden" value="{{ $training[$i] }}" name="training[]" />
                                                    </td>
                                                    <td><input name="training_qty[]" value="{{ $trainingsQty[$i] }}"
                                                            type="number" id="training_qty" min="1"
                                                            class="form-control"></td>
                                                    <td><input name="training_discount[]"
                                                            value="{{ $trainingsDiscount[$i] }}" type="number"
                                                            id="training_discount" min="0" class="form-control"></td>
                                                    <td><button type="button" class="btn btn-danger removeBtn"><i
                                                                class="ti ti-minus ti-xs"></i></button></td>
                                                </tr>
                                            @endfor
                                        @endempty
                                        <!-- Table body content will be added dynamically -->
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-3 mx-n4">
                            <div class="row m-sm-4 m-0">
                                <div class="mb-3">
                                    <label for="licenses" class="form-label fs-6">Select License:</label>
                                    <select id="licenses" class="form-select">
                                        <option value="" selected disabled>Select License</option>
                                    </select>
                                </div>
                                <table id="licenseTable" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%">License Name</th>
                                            <th>Qty</th>
                                            <th>Discout (%)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @empty($invoice->licence)
                                        @else
                                            @php
                                                $licenses = explode('_', $invoice->licence);
                                                $licensesQty = explode('_', $invoice->licence_qty);
                                                $licensesDiscount = explode('_', $invoice->licence_discount);
                                                $count = count($licenses);
                                            @endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                <tr data-id="{{ $licenses[$i] }}">
                                                    <td>{{ \App\Models\Licence::find($licenses[$i])->name }} <input
                                                            type="hidden" value="{{ $licenses[$i] }}" name="licence[]" />
                                                    </td>
                                                    <td><input name="licence_qty[]" value="{{ $licensesQty[$i] }}"
                                                            type="number" id="licence_qty" min="1"
                                                            class="form-control"></td>
                                                    <td><input name="licence_discount[]"
                                                            value="{{ $licensesDiscount[$i] }}" type="number"
                                                            id="licence_discount" min="0" class="form-control">
                                                    </td>
                                                    <td><button type="button" class="btn btn-danger removeBtn2"><i
                                                                class="ti ti-minus ti-xs"></i></button></td>
                                                </tr>
                                            @endfor
                                        @endempty
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-3 mx-n4">
                            <div class="row p-0 p-sm-4">
                                <div class="col-md-7 mb-md-0 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="salesperson" class="form-label me-2 fw-medium"
                                            style="width: 40%">Client Name:</label>
                                        <select name="client_id" class="select2 form-select" required id="client_id">
                                            @foreach ($clients as $client)
                                                <option {{ $invoice->client_id == $client->id ? 'selected' : '' }}
                                                    value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-md-0 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="status" class="form-label me-2 fw-medium"
                                            style="width: 40%">Status:</label>
                                        <select name="status" class="form-select" required id="status">
                                            <option value="0" {{ $invoice->status == 0 ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $invoice->status == 1 ? 'selected' : '' }}>Complete</option>
                                        </select>
                                    </div>

                                </div>


                            </div>

                            <hr class="my-3 mx-n4">

                            <div class="row px-0 px-sm-4">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="note" class="form-label fw-medium">Note:</label>
                                        <div id="full-editor" style="height: 200px;max-height: 200px;">
                                            {!! $invoice->notes !!}</div>
                                        <input type="hidden" name="notes" id="notes-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row px-0 px-sm-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary d-grid mb-2 waves-effect waves-light">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap">Save
                                            Invoice</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
              <!-- Invoice Actions -->
              <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light"
                            data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-send ti-xs me-2"></i>Send Invoice</span>
                        </button>
                        <a href="{{ route('invoice.download', $invoice->id) }}" target="_blank"
                            class="btn btn-label-success d-grid w-100 mb-2 waves-effect">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-download ti-xs me-2"></i> Download</span>
                        </a>
                        <a class="btn btn-label-danger d-grid w-100 mb-2 waves-effect" target="_blank"
                            href="{{ route('invoice.print', $invoice->id) }}">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-printer ti-xs me-2"></i> Print</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>

    </div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script>
            "use strict";
            $(function() {
                var dtt = document.querySelector("#valid_date");
                dtt && dtt.flatpickr({
                    altInput: !0,
                    altFormat: "Y-m-d",
                    dateFormat: "Y-m-d",
                })
            });
            $(function() {
                var dtt = document.querySelector("#expired_date");
                dtt && dtt.flatpickr({
                    altInput: !0,
                    altFormat: "Y-m-d",
                    dateFormat: "Y-m-d",
                })
            });
        </script>


        <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
        <!-- Page JS -->
        {{-- <script src="{{ asset('assets/js/forms-editors.js') }}"></script> --}}
        <script>
            var quill = new Quill("#full-editor", {
                bounds: "#full-editor",
                placeholder: "Invoice note ...",
                modules: {
                    formula: !0,
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: "super"
                        }, {
                            script: "sub"
                        }],
                        [{
                                list: "ordered"
                            },
                            {
                                list: "bullet"
                            },
                            {
                                indent: "-1"
                            },
                            {
                                indent: "+1"
                            },
                        ],
                        ["link"],
                    ],
                },
                theme: "snow",
            });


            // Listen for changes in the Quill editor
            quill.on('text-change', function() {
                // Update the hidden input field with the editor's HTML content
                document.getElementById('notes-input').value = quill.root.innerHTML;
            });
        </script>
        <script>
            $(document).ready(function() {
                // Fetch trainings from backend
                $.ajax({
                    url: "{{ route('invoice.trainings') }}",
                    method: 'GET',
                    success: function(trainings) {
                        // Populate dropdown list with product options
                        trainings.forEach(training => {
                            $('#trainings').append(
                                `<option value="${training.id}">${training.name}</option>`);
                        });
                    }
                });

                // Handle product selection
                $('#trainings').change(function() {
                    var trainingId = $(this).val();
                    var trainingName = $(this).find('option:selected').text();

                    // Check if the product is already in the table
                    if ($('#trainingTable tr[data-id="' + trainingId + '"]').length > 0) {
                        alert('Training already added!');
                        return;
                    }

                    // Add selected product to the table
                    $('#trainingTable tbody').append(
                        `<tr data-id="${trainingId}"><td>${trainingName} <input type="hidden" value="${trainingId}" name="training[]"/></td>
                            <td><input name="training_qty[]" value="1" type="number" id="training_qty" min="1" class="form-control"></td>
                            <td><input name="training_discount[]" value="0" type="number" id="training_discount" min="0"
                                                            class="form-control"></td>
                            <td><button type="button" class="btn btn-danger removeBtn"><i class="ti ti-minus ti-xs"></i></button></td>
                            </tr>`
                    );
                });

                // Handle removing items from the table
                $(document).on('click', '.removeBtn', function() {
                    $(this).closest('tr').remove();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Fetch licenses from backend
                $.ajax({
                    url: "{{ route('invoice.licenses') }}",
                    method: 'GET',
                    success: function(licenses) {
                        // Populate dropdown list with product options
                        licenses.forEach(license => {
                            $('#licenses').append(
                                `<option value="${license.id}">${license.name}</option>`);
                        });
                    }
                });

                // Handle product selection
                $('#licenses').change(function() {
                    var licenseId = $(this).val();
                    var licenseName = $(this).find('option:selected').text();

                    // Check if the product is already in the table
                    if ($('#licenseTable tr[data-id="' + licenseId + '"]').length > 0) {
                        alert('License already added!');
                        return;
                    }

                    // Add selected product to the table
                    $('#licenseTable tbody').append(
                        `<tr data-id="${licenseId}"><td>${licenseName} <input type="hidden" value="${licenseId}" name="licence[]"/></td>
                            <td><input name="licence_qty[]" value="1" type="number" id="licence_qty" min="1" class="form-control"></td>
                            <td><input name="licence_discount[]" value="0" type="number" id="licence_discount" min="0"
                                                            class="form-control"></td>
                            <td><button type="button" class="btn btn-danger removeBtn2"><i class="ti ti-minus ti-xs"></i></button></td>
                            </tr>`
                    );
                });

                // Handle removing items from the table
                $(document).on('click', '.removeBtn2', function() {
                    $(this).closest('tr').remove();
                });
            });
        </script>
    @endsection
</x-app-layout>

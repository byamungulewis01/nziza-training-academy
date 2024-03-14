@section('title', 'Invoice Create')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row invoice-add">
            <!-- Invoice Add-->
            <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <form action="{{ route('storeQuote') }}" method="post">
                            @csrf
                            @if (session()->has('warning1'))
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-warning me-2">
                                        <i class="ti ti-ban ti-xs"></i>
                                    </span>
                                    {{ session()->get('warning1') }}
                                </div>
                            @endif
                            <h4>Create Quotation</h4>
                            <div class="row m-sm-4 m-2">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fs-6" for="fname">First Name <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" name="fname" value="{{ old('fname') }}"
                                        class="form-control" id="fname" placeholder="First Name" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fs-6" for="lname">Last Name<span
                                            class="text-danger">*</span></label>
                                    <input required type="text" id="lname" name="lname"
                                        value="{{ old('lname') }}" class="form-control" placeholder="Last Name" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fs-6" for="company_name">Campany Name<span
                                            class="text-danger">*</span></label>
                                    <input required name="company_name" value="{{ old('company_name') }}"
                                        type="text" class="form-control" id="company_name"
                                        placeholder="Company Name" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fs-6" for="position">Position</label>
                                    <input type="text" class="form-control" name="position"
                                        value="{{ old('position') }}" placeholder="Position">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fs-6" for="phone">Phone Number<span
                                            class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" name="phone"
                                        value="{{ old('phone') }}" id="phone" placeholder="Phone Number" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fs-6" for="email">Work Email<span
                                            class="text-danger">*</span></label>
                                    <input required type="email" class="form-control"
                                        placeholder="email@gmail.com" name="email" id="email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <hr class="my-3 mx-n4">
                            <div class="row m-sm-4 m-0">
                                <div class="mb-3">
                                    <label for="trainings" class="form-label fs-6">Select Training:</label>
                                    <select id="trainings" class="select2 form-select">
                                        <option value="" selected disabled>Select Training</option>
                                    </select>
                                </div>
                                <table id="trainingTable" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 65%">Training Name</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body content will be added dynamically -->
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-3 mx-n4">
                            <div class="row m-sm-4 m-0">
                                <div class="mb-3">
                                    <label for="licenses" class="form-label fs-6">Select License:</label>
                                    <select id="licenses" class="select2 form-select">
                                        <option value="" selected disabled>Select License</option>
                                    </select>
                                </div>
                                <table id="licenseTable" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 65%">License Name</th>
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body content will be added dynamically -->
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-3 mx-n4">


                            <hr class="my-3 mx-n4">

                            <div class="row px-0 px-sm-4">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="note" class="form-label fw-medium">Comment:</label>
                                        <div id="full-editor" style="height: 200px;max-height: 200px;"></div>
                                        <input type="hidden" name="comments" id="notes-input">
                                    </div>
                                </div>
                            </div>
                            <div class="row px-0 px-sm-4">
                                <div class="col-12">
                                    <button class="btn btn-primary d-grid mb-2 waves-effect waves-light">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap">Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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

        <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
        <!-- Page JS -->
        {{-- <script src="{{ asset('assets/js/forms-editors.js') }}"></script> --}}
        <script>
            var quill = new Quill("#full-editor", {
                bounds: "#full-editor",
                placeholder: "Add Comment ...",
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

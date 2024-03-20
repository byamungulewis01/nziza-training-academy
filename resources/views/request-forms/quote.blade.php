<x-request-layout>
    <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container" style="width: 80%">

            <h1 class="text-center mb-1 mt-5"> Ready to go digital?</h1>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">Our programs is what you have been always missing. Let us train
                you on the tools that enable you to adopt digital workflows as the future obliges. </p>
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="position-relative border p-2 h-100">
                        <img src="{{ asset('assets/img/front-pages/icons/contact-border.png') }}" alt="contact border"
                            class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
                        <img src="{{ asset('assets/img/nziza/demo.png') }}" alt="contact customer service"
                            class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">Email</p>
                                            <h5 class="mb-0">
                                                <span class="text-heading">sales@nzizatraining.ac.rw</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2"><i
                                                class="ti ti-phone ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">Phone</p>
                                            <h5 class="mb-0">
                                                <span class="text-heading">+250785568718</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-success me-2">
                                        <i class="ti ti-check ti-xs"></i>
                                    </span>
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-danger me-2">
                                        <i class="ti ti-ban ti-xs"></i>
                                    </span>
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            @if (session()->has('warning1'))
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-warning me-2">
                                        <i class="ti ti-ban ti-xs"></i>
                                    </span>
                                    {{ session()->get('warning1') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <span class="alert-icon text-danger me-2">
                                            <i class="ti ti-ban ti-xs"></i>
                                        </span>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            <h4 class="mb-4">Quotation Request Form</h4>
                            <form action="{{ route('storeQuote') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="fname">First Name <span
                                                class="text-danger">*</span></label>
                                        <input required type="text" name="fname" value="{{ old('fname') }}"
                                            class="form-control" id="fname" placeholder="First Name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="lname">Last Name<span
                                                class="text-danger">*</span></label>
                                        <input required type="text" id="lname" name="lname"
                                            value="{{ old('lname') }}" class="form-control" placeholder="Last Name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="company_name">Campany Name<span
                                                class="text-danger">*</span></label>
                                        <input required name="company_name" value="{{ old('company_name') }}"
                                            type="text" class="form-control" id="company_name"
                                            placeholder="Company Name" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="position">Position</label>
                                        <input type="text" class="form-control" name="position"
                                            value="{{ old('position') }}" placeholder="Position">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="phone">Phone Number<span
                                                class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" id="phone" placeholder="Phone Number" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="email">Work Email<span
                                                class="text-danger">*</span></label>
                                        <input required type="email" class="form-control"
                                            placeholder="email@gmail.com" name="email" id="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    <hr class="my-3">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="trainings" class="form-label fs-6">Select Training:</label>
                                            <select id="trainings" class="form-select">
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
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="licenses" class="form-label fs-6">Select License:</label>
                                            <select id="licenses" class="form-select">
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

                                    <div class="col-12">
                                        <label class="form-label fs-6" for="contact-form-message">Comment</label>
                                        <textarea id="contact-form-message" name="comment" class="form-control" rows="3"
                                            placeholder="Write a comment here"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    @endsection
    @section('js')
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
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
</x-request-layout>

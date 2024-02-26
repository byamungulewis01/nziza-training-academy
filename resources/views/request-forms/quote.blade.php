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
                                                <a href="mailto:example@gmail.com"
                                                    class="text-heading">example@gmail.com</a>
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
                                    <div class="col-md-6 mb-4">
                                        <div class="form-check custom-option custom-option-basic checked">
                                            <label
                                                class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                                for="trainingCheck">
                                                <input name="requestType" class="form-check-input" type="radio"
                                                    value="training" id="trainingCheck" checked="">
                                                <span class="custom-option-body">
                                                    <img src="{{ asset('assets/img/nziza/train.png') }}"
                                                        alt="visa-card" width="58"
                                                        data-app-light-img="nziza/train.png"
                                                        data-app-dark-img="nziza/train.png">
                                                    <span class="ms-3">Training</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-check custom-option custom-option-basic">
                                            <label
                                                class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                                for="licenceCheck">
                                                <input name="requestType" class="form-check-input" type="radio"
                                                    value="licence" id="licenceCheck">
                                                <span class="custom-option-body">
                                                    <img src="{{ asset('assets/img/nziza/licence.png') }}"
                                                        alt="paypal" width="58"
                                                        data-app-light-img="nziza/licence.png"
                                                        data-app-dark-img="nziza/licence.png">
                                                    <span class="ms-3">Licence</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 trainingDiv">
                                        <table id="item_table" style="width: 96%">
                                            <tr>
                                                <td>
                                                    <div class="row mb-3">
                                                        <div class="col-8">
                                                            <label class="form-label fs-6" for="training">Training
                                                                Name</label>

                                                            <select name="training[]" class="form-select"
                                                                id="training">
                                                                <option value="" selected disabled>Select </option>
                                                                @foreach ($trainings as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <label class="form-label fs-6"
                                                                for="contact-form-email">Trainees</label>

                                                            <input value="" name="trainee_number[]" type="number"
                                                                min="1" class="form-control">
                                                        </div>
                                                        <div class="col-1">
                                                            <label class="form-label fs-6"
                                                                for="contact-form-email"></label>

                                                            <button type="button" class="btn btn-primary add"><i
                                                                    class="ti ti-plus ti-xs"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-12 licenceDiv" style="display: none">
                                        <table id="item_table2" style="width: 96%">
                                            <tr>
                                                <td>
                                                    <div class="row mb-3">
                                                        <div class="col-8">
                                                            <label class="form-label fs-6" for="licence">Licence
                                                                Name</label>

                                                            <select name="licence[]" class="form-select"
                                                                id="licence">
                                                                <option value="" selected disabled>Select</option>
                                                                @foreach ($licences as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <label class="form-label fs-6"
                                                                for="trainee">Trainees</label>

                                                            <input name="licence_number[]" type="number"
                                                                id="trainee" min="1"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-1">
                                                            <label class="form-label fs-6"
                                                                for="contact-form-email"></label>

                                                            <button type="button" class="btn btn-primary add2"><i
                                                                    class="ti ti-plus ti-xs"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fs-6" for="contact-form-message">Comment</label>
                                        <textarea id="contact-form-message" name="comment" class="form-control" rows="8"
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
    @section('js')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.add', function() {
                    var html = '';
                    var number_of_rows = $('#item_table tr').length;

                    html +=
                        `<tr><td><div class="row mb-3">
                    <div class="col-8">
                    <select name="training[${number_of_rows}]" class="form-select" id="">
                        <option value="" selected disabled>Select
                        </option> @foreach ($trainings as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                    </select></div>
                  <div class="col-3"><input name="trainee_number[${number_of_rows}]" type="number" min="1" class="form-control">
                                                        </div>
                <div class="col-1"> <button class="btn btn-danger remove"><i class="ti ti-minus"></i></button></div></div></td></tr>`;
                    $('#item_table').append(html);
                });

                $(document).on('click', '.remove', function() {
                    $(this).closest('tr').remove();
                });

            });
        </script>
        <script>
            $(document).ready(function() {

                $(document).on('click', '.add2', function() {
                    var html = '';
                    var number_of_rows = $('#item_table2 tr').length;

                    html +=
                        `<tr><td><div class="row mb-3">
                    <div class="col-8">
                        <select name="licence[${number_of_rows}]" class="form-select"
                            id="">
                            <option value="" selected disabled>Select
                            </option>
                            @foreach ($licences as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                    </div>
                  <div class="col-3"><input name="licence_number[${number_of_rows}]" type="number" min="1"
                                                                value="1" class="form-control">
                                                        </div>
                <div class="col-1"> <button class="btn btn-danger remove2"><i class="ti ti-minus"></i></button></div></div></td></tr>`;
                    $('#item_table2').append(html);
                });

                $(document).on('click', '.remove2', function() {
                    $(this).closest('tr').remove();
                });

            });
        </script>
        <script>
            $(document).on('click', '#trainingCheck', function() {
                $(".trainingDiv").show();
                $(".licenceDiv").hide();
            });
        </script>
        <script>
            $(document).on('click', '#licenceCheck', function() {
                $(".trainingDiv").hide();
                $(".licenceDiv").show();
            });
        </script>
    @endsection
</x-request-layout>

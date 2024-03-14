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
                                        <img src="{{ asset('assets/logo/Nziza_Global_TZ_LOGO_PNG.png') }}" class="mt-1" alt="Nziza Logo"
                                            width="170">

                                    </div>
                                    <p class="mb-2">2F DERM PLAZA, Makumbusho | Dar es Salaam</p>
                                    <p class="mb-2">Hotline: +255 752 303 123</p>
                                    <p class="mb-2">Website: <a
                                            href="https://nzizaglobal.co.tz/">https://nzizaglobal.co.tz/</a></p>
                                    <p class="mb-2">Email: info@nzizaglobal.co.tz</p>
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
                            <div class="source-item pt-4 px-0 px-sm-4">

                                <div class="col-md-12 trainingDiv">
                                    <h6>CERTIFIED TRAINING PROGRAM</h6>
                                    <table id="item_table" style="width: 97%">
                                        @empty($invoice->training)
                                            <tr>
                                                <td>
                                                    <div class="row mb-3">
                                                        <div class="col-7">
                                                            <label class="form-label fs-6" for="training">Training
                                                                Name</label>
                                                            <select name="training[]" class="form-select" id="training">
                                                                <option value="" selected disabled>Select </option>
                                                                @foreach ($trainings as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <label class="form-label fs-6" for="training_qty">Qty</label>
                                                            <input value="1" name="training_qty[]" type="number"
                                                                min="1" class="form-control">
                                                        </div>
                                                        <div class="col-2">
                                                            <label class="form-label fs-6" for="training_discount">Discout
                                                                (%)</label>
                                                            <input value="0" name="training_discount[]" type="number"
                                                                min="0" max="100" class="form-control">
                                                        </div>
                                                        <div class="col-1">
                                                            <label class="form-label fs-6" for="contact-form"></label>
                                                            <button type="button" class="btn btn-primary add"><i
                                                                    class="ti ti-plus ti-xs"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @php
                                                $training = explode('_', $invoice->training);
                                                $trainingsQty = explode('_', $invoice->training_qty);
                                                $trainingsDiscount = explode('_', $invoice->training_discount);
                                                $count = count($training);
                                            @endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                <tr>
                                                    <td>
                                                        <div class="row mb-3">
                                                            <div class="col-7">
                                                                @unless ($i > 0)
                                                                    <label class="form-label fs-6" for="training">Training
                                                                        Name</label>
                                                                @endunless
                                                                <select name="training[]" class="form-select"
                                                                    id="training">
                                                                    <option value="" selected disabled>Select
                                                                    </option>
                                                                    @foreach ($trainings as $item)
                                                                        <option
                                                                            {{ $item->id == $training[$i] ? 'selected' : '' }}
                                                                            value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-2">
                                                                @unless ($i > 0)
                                                                    <label class="form-label fs-6"
                                                                        for="training_qty">Qty</label>
                                                                @endunless
                                                                <input value="{{ $trainingsQty[$i] }}"
                                                                    name="training_qty[]" type="number" min="1"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-2">
                                                                @unless ($i > 0)
                                                                    <label class="form-label fs-6"
                                                                        for="training_discount">Discout
                                                                        (%)</label>
                                                                @endunless
                                                                <input value="{{ $trainingsDiscount[$i] }}"
                                                                    name="training_discount[]" type="number"
                                                                    min="0" max="100" class="form-control">
                                                            </div>
                                                            <div class="col-1">
                                                                @unless ($i == 0)
                                                                    <button class="btn btn-danger remove"><i
                                                                            class="ti ti-minus"></i></button>
                                                                @else
                                                                    <label class="form-label fs-6" for="contact-form"></label>
                                                                    <button type="button" class="btn btn-primary add"><i
                                                                            class="ti ti-plus ti-xs"></i></button>
                                                                @endunless
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endempty

                                    </table>
                                </div>
                                <hr class="my-3 mx-n4">
                                <div class="col-md-12 licenceDiv">
                                    <h6>SOFTWARE LICENSES</h6>
                                    <table id="item_table2" style="width: 97%">
                                        @empty($invoice->licence)
                                            <tr>
                                                <td>
                                                    <div class="row mb-3">
                                                        <div class="col-7">
                                                            <label class="form-label fs-6" for="licence">Licence
                                                                Name</label>

                                                            <select name="licence[]" class="form-select" id="licence">
                                                                <option value="" selected disabled>Select</option>
                                                                @foreach ($licences as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <label class="form-label fs-6" for="licence_qty">Qty</label>

                                                            <input name="licence_qty[]" value="1" type="number"
                                                                id="licence_qty" min="1" class="form-control">
                                                        </div>
                                                        <div class="col-2">
                                                            <label class="form-label fs-6" for="licence_discount">Discount
                                                                (%)</label>

                                                            <input name="licence_discount[]" value="0"
                                                                type="number" id="licence_discount" min="0"
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
                                        @else
                                            @php
                                                $licenses = explode('_', $invoice->licence);
                                                $licensesQty = explode('_', $invoice->licence_qty);
                                                $licensesDiscount = explode('_', $invoice->licence_discount);
                                                $count = count($licenses);
                                            @endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                <tr>
                                                    <td>
                                                        <div class="row mb-3">
                                                            <div class="col-7">
                                                                @unless ($i > 0)
                                                                    <label class="form-label fs-6" for="licence">Licence
                                                                        Name</label>
                                                                @endunless

                                                                <select name="licence[]" class="form-select"
                                                                    id="licence">
                                                                    <option value="" selected disabled>Select
                                                                    </option>
                                                                    @foreach ($licences as $item)
                                                                        <option {{ $item->id == $licenses[$i] ? 'selected' : '' }} value="{{ $item->id }}">
                                                                            {{ $item->name }}  </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-2">
                                                                @unless ($i > 0)
                                                                    <label class="form-label fs-6"
                                                                        for="licence_qty">Qty</label>
                                                                @endunless

                                                                <input name="licence_qty[]" value="{{ $licensesQty[$i] }}" type="number"
                                                                    id="licence_qty" min="1" class="form-control">
                                                            </div>
                                                            <div class="col-2">
                                                                @unless ($i > 0)
                                                                    <label class="form-label fs-6"
                                                                        for="licence_discount">Discount
                                                                        (%)</label>
                                                                @endunless
                                                                <input name="licence_discount[]" value="{{ $licensesDiscount[$i] }}"
                                                                    type="number" id="licence_discount" min="0"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col-1">
                                                                @unless ($i == 0)
                                                                    <button class="btn btn-danger remove2"><i
                                                                            class="ti ti-minus"></i></button>
                                                                @else
                                                                    <label class="form-label fs-6"
                                                                        for="contact-form-email"></label>

                                                                    <button type="button" class="btn btn-primary add2"><i
                                                                            class="ti ti-plus ti-xs"></i></button>
                                                                @endunless
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endempty
                                    </table>
                                </div>
                            </div>
                            <hr class="my-3 mx-n4">
                            <div class="row p-0 p-sm-4">
                                <div class="col-md-6 mb-md-0 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="salesperson"
                                            class="form-label me-2 fw-medium">Salesperson:</label>
                                        <input type="text" class="form-control ms-3" name="salesperson"
                                            value="{{ $invoice->salesperson }}" id="salesperson" required
                                            placeholder="John Doe">
                                    </div>

                                </div>
                                <div class="col-md-6 mb-md-0 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="address" class="form-label me-2 fw-medium">Address:</label>
                                        <input type="text" class="form-control ms-3" id="address" required
                                            name="address" value="{{ $invoice->address }}" placeholder="Address ">
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
                                    <button class="btn btn-primary d-grid mb-2 waves-effect waves-light">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap">Change
                                            Invoice</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /Invoice Add-->

            <!-- Invoice Actions -->
            {{-- <div class="col-lg-3 col-12 invoice-actions">
                <div class="card mb-4">
                    <div class="card-body">
                        <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light"
                            data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-send ti-xs me-2"></i>Send Invoice</span>
                        </button>
                        <a href="./app-invoice-preview.html"
                            class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">Preview</a>
                        <button type="button" class="btn btn-label-secondary d-grid w-100 waves-effect">Save</button>
                    </div>
                </div>

            </div> --}}
            <!-- /Invoice Actions -->
        </div>

    </div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
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
        <script>
            $(document).ready(function() {

                $(document).on('click', '.add', function() {
                    var html = '';
                    var number_of_rows = $('#item_table tr').length;

                    html +=
                        `<tr><td><div class="row mb-3">
                    <div class="col-7">
                    <select name="training[${number_of_rows}]" class="form-select" id="">
                        <option value="" selected disabled>Select
                        </option> @foreach ($trainings as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                    </select></div>
                  <div class="col-2"><input name="training_qty[${number_of_rows}]" type="number" min="1" value="1" class="form-control">
                                                        </div>
                  <div class="col-2"><input name="training_discount[${number_of_rows}]" type="number" min="0" max="100" value="0" class="form-control">
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
                    <div class="col-7">
                        <select name="licence[${number_of_rows}]" class="form-select"
                            id="">
                            <option value="" selected disabled>Select
                            </option>
                            @foreach ($licences as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                    </div>
                  <div class="col-2"><input name="licence_qty[${number_of_rows}]" type="number" min="1"
                                                                value="1" class="form-control"></div>
                  <div class="col-2"><input name="licence_discount[${number_of_rows}]" type="number" min="0" max="100"
                                                                value="0" class="form-control"></div>
                <div class="col-1"> <button class="btn btn-danger remove2"><i class="ti ti-minus"></i></button></div></div></td></tr>`;
                    $('#item_table2').append(html);
                });

                $(document).on('click', '.remove2', function() {
                    $(this).closest('tr').remove();
                });

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
    @endsection
</x-app-layout>

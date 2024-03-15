@section('title', 'Reports')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            {{-- <div class="card-header border-bottom"> --}}
            {{-- <h5 class="card-title mb-0">Dairly Report --}}
            {{-- <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                        data-bs-target="#addModel"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                            class="d-none d-sm-inline-block">ToDay</span></a> --}}
            {{-- </h5> --}}
            <!-- New User Modal -->
            {{-- <div class="modal fade" id="addModel" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                        <div class="modal-content p-3 p-md-5">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="text-center mb-">
                                    <h3 class="mb-2"><span class="text-warning">{{ now()->format('l') }}</span>'s
                                        report</h3>
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
                                <form action="{{ route('dairly_report.report') }}" class="row g-3" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="beforenoon" class="form-label fw-bold">BEFORENOON:</label>
                                            <div class="editor-beforenoon" style="height: 200px;max-height: 200px;">
                                                {!! @$report->beforenoon !!}</div>
                                            <input type="hidden" name="beforenoon" id="beforenoon">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="afternoon" class="form-label fw-bold">AFTERNOON:</label>
                                            <div class="editor-afternoon" style="height: 200px;max-height: 200px;">
                                                {!! @$report->afternoon !!}</div>
                                            <input type="hidden" name="afternoon" id="afternoon">
                                        </div>
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
                </div> --}}
            <!--/ New User Modal -->
            {{-- </div> --}}
            <div class="card-body">
                <!-- FullCalendar -->
                <div id="calendar"></div>

            </div>
        </div>
        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="makeReport" aria-hidden="true">
            <div class="offcanvas-header my-1">
                <h5 class="offcanvas-title">Report</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0 flex-grow-1">
                <form class="event-form pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="eventForm" onsubmit="return false" novalidate="novalidate" data-select2-id="eventForm">
                    <div class="mb-3 fv-plugins-icon-container">
                      <label class="form-label" for="eventTitle">Title</label>
                      <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Title">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                    <div class="mb-3" data-select2-id="25">
                      <label class="form-label" for="eventLabel">Label Color</label>
                      <div class="position-relative" data-select2-id="24"><select class="select2 select-event-label form-select select2-hidden-accessible" id="eventLabel" name="eventLabel" data-select2-id="eventLabel" tabindex="-1" aria-hidden="true">
                        <option data-label="primary" value="Business" selected="" data-select2-id="2">Blue</option>
                        <option data-label="danger" value="Personal" data-select2-id="26">Red</option>
                        <option data-label="warning" value="Family" data-select2-id="27">Green</option>
                      </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="1" style="width: 335.2px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-eventLabel-container"><span class="select2-selection__rendered" id="select2-eventLabel-container" role="textbox" aria-readonly="true" title="Business"><span class="badge badge-dot bg-primary me-2"> </span>Blue</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="eventDescription">Description</label>
                      <textarea class="form-control" rows="6" name="eventDescription" id="eventDescription"></textarea>
                    </div>
                    <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                      <div>
                        <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1 waves-effect waves-light">Add</button>
                        <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1 waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                      </div>
                      <div><button class="btn btn-label-danger btn-delete-event d-none waves-effect">Delete</button></div>
                    </div>
                  <input type="hidden"></form>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->
    </div>
    @section('css')
        <!-- Page JS -->


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" /> --}}

    @endsection

    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script> --}}
        <script>
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today,',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    new bootstrap.Offcanvas($('#makeReport')).show();
                    // Swal.fire({
                    //     title: "Good job!",
                    //     text: "You clicked the button!",
                    //     icon: "success"
                    // });
                },
            });
        </script>
        {{-- <script>
            var quill = new Quill(".editor-beforenoon", {
                bounds: ".editor-beforenoon",
                placeholder: "Before noon report...",
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


            quill.on('text-change', function() {
                document.getElementById('beforenoon').value = quill.root.innerHTML;
            });
        </script>
        <script>
            var quill2 = new Quill(".editor-afternoon", {
                bounds: ".editor-afternoon",
                placeholder: "After noon report...",
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

            quill2.on('text-change', function() {
                document.getElementById('afternoon').value = quill2.root.innerHTML;
            });
        </script> --}}
    @endsection
</x-app-layout>

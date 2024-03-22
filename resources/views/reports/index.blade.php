@section('title', 'Reports')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
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
                <form class="event-form pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="eventForm"
                    novalidate="novalidate" data-select2-id="eventForm">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="title">Title</label>
                        <input type="hidden" name="reported_by" value="{{ auth()->user()->id }}">
                        <input type="text" class="form-control" id="title" required name="title"
                            placeholder="Title">
                        <span id="titleError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" rows="10" required name="description" id="description"></textarea>
                        <span id="descriptionError" class="text-danger"></span>
                    </div>
                    <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                        <div>
                            <button
                                class="btn btn-primary btn-add-event me-sm-3 me-1 waves-effect waves-light">Add</button>
                            <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1 waves-effect"
                                data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                        <div><button class="btn btn-label-danger btn-delete-event d-none waves-effect">Delete</button>
                        </div>
                    </div>
                    <input type="hidden">
                </form>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->
        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="updateReport" aria-hidden="true">
            <div class="offcanvas-header my-1">
                <h5 class="offcanvas-title">Update Report</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0 flex-grow-1">
                <form class="event-form pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="eventFormUpdate"
                    novalidate="novalidate" data-select2-id="eventFormUpdate">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="titleUpdate">Title</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" id="titleUpdate" required name="title"
                            placeholder="Title">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="descriptionUpdate">Description</label>
                        <textarea class="form-control" rows="10" required name="description" id="descriptionUpdate"></textarea>
                    </div>

                    <div id="updateButtons" class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                        <div>
                            <button class="btn btn-primary btn-add-event me-sm-3 me-1 waves-effect waves-light">Save
                                Changes</button>
                            <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1 waves-effect"
                                data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                        <div>
                            <button type="button"
                                class="btn btn-label-danger btn-delete-event d-block waves-effect">Delete</button>
                        </div>
                    </div>
                    <input type="hidden">
                </form>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->
    </div>
    @section('css')
        <!-- Page JS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    @endsection

    @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today,',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: @json($events),
                selectable: true,
                selectHelper: true,

                eventRender: function(event, element) {
                    element.css({
                        color: 'white',
                        fontSize: '15px'
                    }); // Set text color to white
                    // element.find('.fc-title').append('<br/><span class="fc-time">' + moment(event.start).format('LT') + ' - ' + moment(event.end).format('LT') + '</span>');
                },
                select: function(start, end, allDays) {
                    if (!start.isSame(moment(), 'day')) {
                        // If not the current date, do not select
                        $('#calendar').fullCalendar('unselect');
                        Swal.fire({
                            title: "Warning!",
                            text: "Sorry make report to current date only.",
                            icon: "warning"
                        });
                        return false;
                    }
                    //  else if (start.isoWeekday() === 6 || start.isoWeekday() === 7) {
                    //     // If it's a weekend, do not select
                    //     $('#calendar').fullCalendar('unselect');
                    //     return false;
                    // }

                    new bootstrap.Offcanvas($('#makeReport')).show();
                    $('#eventForm').submit(function(e) {
                        e.preventDefault(); // Prevent the default form submission

                        // Get form data
                        var formData = $(this).serializeArray();
                        console.log(formData);
                        // AJAX request to send form data to Laravel backend
                        $.ajax({
                            url: "{{ route('dairly_report.report') }}", // Replace this with your Laravel backend route
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start': response.start,
                                    'description': response.description,
                                    'end': response.end,
                                    'color': response.color
                                });
                                $('#makeReport').offcanvas('hide');
                                // Optionally, display a success message
                                Swal.fire({
                                    title: "Success!",
                                    text: "Report created successfully.",
                                    icon: "success"
                                });
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                $('#makeReport').offcanvas('hide');
                                console.error(error);
                                // Optionally, display an error message
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occurred while creating the report.",
                                    icon: "error"
                                });
                            }
                        });
                    });

                },
                eventClick: function(event) {
                    // Open Offcanvas with data to update
                    new bootstrap.Offcanvas($('#updateReport')).show();
                    if (!event.start.isSame(moment(), 'day')) {
                        $('#updateButtons').addClass('d-none').removeClass('d-block');
                    } else {
                        $('#updateButtons').addClass('d-block').removeClass('d-none');
                    }

                    $('#titleUpdate').val(event.title);
                    $('#id').val(event.id);
                    $('#descriptionUpdate').val(event.description);
                    $('#eventFormUpdate').submit(function(e) {
                        e.preventDefault(); // Prevent the default form submission

                        // Get form data
                        var formData = $(this).serializeArray();
                        // AJAX request to send form data to Laravel backend

                        $.ajax({
                            url: "{{ route('dairly_report.report_update') }}", // Replace this with your Laravel backend route
                            type: "PATCH",
                            data: formData,
                            success: function(response) {
                                $('#calendar').fullCalendar('removeEvents', event.id);

                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'description': response.description,
                                    'start': response.start,
                                    'end': response.end,
                                    'color': response.color
                                });
                                $('#updateReport').offcanvas('hide');
                                // Optionally, display a success message
                                Swal.fire({
                                    title: "Success!",
                                    text: "Report updated successfully.",
                                    icon: "success"
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                $('#updateReport').offcanvas('hide');

                                console.error(error);
                                // Optionally, display an error message
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occurred while updatinng the report.",
                                    icon: "error"
                                });
                            }
                        });
                    });
                },
            });
        </script>
        <script>
            // Add click event listener to the delete button
            $('.btn-delete-event').click(function(event) {
                $('#updateReport').offcanvas('hide');
                // Display confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var eventId = $('#id').val();

                        var route = "{{ route('dairly_report.report_destroy', ['id' => ':id']) }}";
                        route = route.replace(':id', eventId);
                        $.ajax({
                            url: route, // Replace this with your Laravel backend route
                            type: "DELETE",
                            success: function(response) {

                                $('#calendar').fullCalendar('removeEvents', response);
                                Swal.fire({
                                    title: "Success!",
                                    text: "Report deleted successfully.",
                                    icon: "success"
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                // Optionally, display an error message
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occurred while updatinng the report.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });

            // Function to handle deletion of the event
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

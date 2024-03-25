@section('title', 'Employee Reports')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
     
        @include('employees.navigation')

        <!-- User Profile Content -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <!--/ User Profile Content -->

        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="updateReport" aria-hidden="true">
            <div class="offcanvas-header my-1">
                <h5 class="offcanvas-title">{{ explode(' ', auth()->user()->name)[1] }}'s Report</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0 flex-grow-1">
                <form class="event-form pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="eventFormUpdate"
                    novalidate="novalidate" data-select2-id="eventFormUpdate">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="titleUpdate">Title</label>
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="commented_by" value="{{ auth()->user()->id }}">
                        <input type="text" class="form-control" id="titleUpdate" disabled name="title"
                            placeholder="Title">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="descriptionUpdate">Description</label>
                        <textarea class="form-control" rows="10" disabled name="description" id="descriptionUpdate"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-danger" for="comment">Add Comment</label>
                        <textarea class="form-control border border-danger" rows="5" required name="comment" id="comment"></textarea>
                    </div>

                    <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                        <div>
                            <button class="btn btn-primary btn-add-event me-sm-3 me-1 waves-effect waves-light">Save
                                Changes</button>
                            <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1 waves-effect"
                                data-bs-dismiss="offcanvas">Cancel</button>
                        </div>

                    </div>
                    <input type="hidden">
                </form>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->

    </div>
    @section('css')
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
                            url: "{{ route('dairly_report.report_comment') }}", // Replace this with your Laravel backend route
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

    @endsection
</x-app-layout>

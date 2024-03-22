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

    @endsection
</x-app-layout>

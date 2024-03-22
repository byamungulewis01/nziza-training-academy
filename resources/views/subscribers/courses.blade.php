@section('title', 'Training Subscription')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">Training Subscribers
                            <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                                data-bs-target="#newCourse"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                    class="d-none d-sm-inline-block">Add New</span></a>

                        </h5>

                        <!-- New User Modal -->
                        <div class="modal fade" id="newCourse" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Trainee Subscription</h3>
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
                                        <form action="{{ route('training-subscribers.store') }}" class="row g-3"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12">
                                                <label class="form-label" for="trainee_id">Trainee Name</label>
                                                <select class="form-select" required name="trainee_id" id="trainee_id">
                                                    <option value="" disabled selected>-- Select --</option>
                                                    @foreach ($trainees as $trainee)
                                                        <option
                                                            {{ old('trainee_id') == $trainee->id ? 'selected' : '' }}
                                                            value="{{ $trainee->id }}">{{ $trainee->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="course_id">Course Name</label>
                                                <select class="form-select" required name="course_id" id="course_id">
                                                    <option value="" disabled selected>-- Select --</option>
                                                    @foreach ($courses as $course)
                                                        <option {{ old('course_id') == $course->id ? 'selected' : '' }}
                                                            value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="dealDuration">Deal Duration</label>
                                                <input type="text" id="dealDuration" name="duration"
                                                    value="{{ old('duration') }}"
                                                    class="form-control flatpickr-input dealDuration"
                                                    placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1">Submit</button>
                                                <button type="reset" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ New User Modal -->


                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables table border-top">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Start Date</th>
                                    <th>END Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $item)
                                    <tr class="odd">
                                        <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->trainee->name }}</td>
                                        <td>{{ $item->trainee->email }}</td>
                                        <td>{{ $item->trainee->phone }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>
                                            <div class="d-flex align-items-center"><a href="javascript:;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateModel{{ $item->id }}"
                                                    class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>
                                                <a href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModel{{ $item->id }}"
                                                    class="text-danger delete-record{{ $item->id }}">
                                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                                </a>
                                            </div>
                                            <!-- New User Modal -->
                                            <div class="modal fade" id="updateModel{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                                    <div class="modal-content p-3 p-md-5">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h3 class="mb-2">Trainee Subscription</h3>
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <p><strong>Opps Something went wrong</strong>
                                                                        </p>
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>* {{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <form
                                                                action="{{ route('training-subscribers.update', $item->id) }}"
                                                                class="row g-3" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="trainee_id">Trainee
                                                                        Name</label>
                                                                    <select class="form-select" required
                                                                        name="trainee_id" id="trainee_id">
                                                                        <option value="" disabled selected>--
                                                                            Select --</option>
                                                                        @foreach ($trainees as $trainee)
                                                                            <option
                                                                                {{ old('trainee_id', $item->trainee_id) == $trainee->id ? 'selected' : '' }}
                                                                                value="{{ $trainee->id }}">
                                                                                {{ $trainee->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="course_id">Course
                                                                        Name</label>
                                                                    <select class="form-select" required
                                                                        name="course_id" id="course_id">
                                                                        <option value="" disabled selected>--
                                                                            Select --</option>
                                                                        @foreach ($courses as $course)
                                                                            <option
                                                                                {{ old('course_id', $item->course_id) == $course->id ? 'selected' : '' }}
                                                                                value="{{ $course->id }}">
                                                                                {{ $course->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    @php
                                                                        $duration =
                                                                            $item->start_date .' to ' . $item->end_date;
                                                                    @endphp
                                                                    <label class="form-label" for="dealDuration">Deal
                                                                        Duration</label>
                                                                    <input type="text" id="dealDuration"
                                                                        name="duration" value="{{ old('duration',$duration ) }}"
                                                                        class="form-control flatpickr-input dealDuration"
                                                                        placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                                        readonly="readonly">
                                                                </div>
                                                                <div class="col-12 text-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary me-sm-3 me-1">Save
                                                                        Change</button>
                                                                    <button type="reset"
                                                                        class="btn btn-label-secondary"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/ New User Modal -->
                                            <!-- New User Modal -->
                                            <div class="modal fade" id="deleteModel{{ $item->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-simple">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h5 class="mb-2">Are you sure you want to delete
                                                                    this?</h5>
                                                            </div>
                                                            <form
                                                                action="{{ route('training-subscribers.destroy', $item->id) }}"
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
        </div>
    </div>

    @section('css')
        @include('layouts.extra.datatable_css')
        @include('layouts.extra.datepicker_css')
        @include('layouts.extra.select2_css')
    @endsection

    @section('js')
        @include('layouts.extra.datatable_js')
        @include('layouts.extra.datepicker_js')
        @include('layouts.extra.select2_js')

        <script>
            "use strict";
            ! function() {
                var e = $('.dealDuration'),
                    e = (e && e.flatpickr({
                        mode: "range",
                        minDate: "today"
                    }), window.Helpers.initCustomOptionCheck());
            }();
        </script>

    @endsection
</x-app-layout>

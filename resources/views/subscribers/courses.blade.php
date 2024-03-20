@section('title', 'Courses Subscription')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">Courses
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
                                        <form action="{{ route('course.store') }}" class="row g-3" method="post">
                                            @csrf

                                            <div class="col-md-12">
                                                <label class="form-label" for="name">Course Name</label>
                                                <input type="text" id="name" name="name" required
                                                    class="form-control" placeholder="Course Name"
                                                    value="{{ old('name') }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="timing">Timing</label>
                                                <input type="number" min="0" id="timing" required
                                                    name="timing" class="form-control" placeholder="Time"
                                                    value="{{ old('timing') }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="price">Price</label>
                                                <input type="number" min="0" id="price" required
                                                    name="price" class="form-control" placeholder="Price ($)"
                                                    value="{{ old('price') }}" />
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1">Submit</button>

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
                                    <th>Name</th>
                                    <th>Time</th>
                                    <th>Price($)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $item)
                                    <tr class="odd">
                                        <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->timing }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <div class="d-flex align-items-center"><a href="javascript:;"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateCourse{{ $item->id }}"
                                                    class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>
                                                <a href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCourse{{ $item->id }}"
                                                    class="text-body delete-record{{ $item->id }}">
                                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                                </a>
                                            </div>
                                            <!-- New User Modal -->
                                            <div class="modal fade" id="updateCourse{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-simple modal-edit-user">
                                                    <div class="modal-content p-3 p-md-5">
                                                        <div class="modal-body">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="text-center mb-4">
                                                                <h3 class="mb-2">Edit Course</h3>
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
                                                            <form action="{{ route('course.update', $item->id) }}"
                                                                class="row g-3" method="post">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="name">Course
                                                                        Name</label>
                                                                    <input type="text" id="name" name="name"
                                                                        class="form-control"
                                                                        value="{{ $item->name }}" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="timing">Timing</label>
                                                                    <input type="number" min="0"
                                                                        id="timing" required name="timing"
                                                                        class="form-control" placeholder="Time"
                                                                        value="{{ $item->timing }}" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="price">Price</label>
                                                                    <input type="number" min="0"
                                                                        id="price" required name="price"
                                                                        class="form-control" placeholder="Price ($)"
                                                                        value="{{ $item->price }}" />
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
                                            <div class="modal fade" id="deleteCourse{{ $item->id }}"
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
                                                            <form action="{{ route('course.destroy', $item->id) }}"
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
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.datatables').DataTable();
            });
        </script>

    @endsection
</x-app-layout>

@section('title', 'Employee Profile')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        @include('employees.navigation')

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="card-text text-uppercase">About</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Full Name:</span>
                                <span>{{ $employee->name }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-check text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Status:</span>
                                <span>{{ ucfirst($employee->status) }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Role:</span>
                                <span>{{ ucfirst($employee->role) }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Country:</span>
                                <span>{{ ucfirst($employee->branch->name) }}</span></li>
                        </ul>
                        <small class="card-text text-uppercase">Contacts</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span
                                    class="fw-medium mx-2 text-heading">Contact:</span>
                                <span>{{ $employee->phone }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-mail"></i><span
                                    class="fw-medium mx-2 text-heading">Email:</span>
                                <span>{{ $employee->email }}</span></li>
                        </ul>

                    </div>
                </div>
                <!--/ About User -->
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 ">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">

                </div>

            </div>
        </div>
        <!--/ User Profile Content -->

    </div>
    @section('css')

    @endsection

    @section('js')
    @endsection
</x-app-layout>

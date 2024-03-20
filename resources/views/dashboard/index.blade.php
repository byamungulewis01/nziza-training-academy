@section('title', 'Dashboard')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- View sales -->
            <div class="col-xl-4 mb-4 col-lg-5 col-12">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-7">
                            <div class="card-body text-nowrap">
                                <h5 class="card-title mb-0">Welcome, {{ auth()->user()->name }}!</h5>
                                <p class="mb-2">Todays reminder</p>
                                <h4 class="text-primary mb-1">0</h4>
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- View sales -->


        </div>
    </div>
</x-app-layout>

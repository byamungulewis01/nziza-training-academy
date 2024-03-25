@section('title', 'monthly Goals')
<x-app-layout>
    @php
        $currentDate = now();
        $lastDayOfMonth = now()->endOfMonth();
        $remainingDays = $currentDate->diffInDays($lastDayOfMonth);

        $nextMonth = now()->addMonth()->firstOfMonth()->format('Y-m-d');
        $reported = App\Models\MonthlyGoal::where('month',$nextMonth)->where('user_id' ,auth()->user()->id)->first();

    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-3">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Monthly Goals
                    @if ($remainingDays <= 4 && !$reported)
                        <a class="btn btn-dark text-white pull-left float-end"
                            href="{{ route('monthly_goals.create') }}"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                class="d-none d-sm-inline-block">Create
                                List</span></a>
                    @endif


                </h5>

            </div>
        </div>

        <div class="row">
            @foreach ($collection as $item)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="mb-0">{{ \Carbon\Carbon::parse($item->month)->format('F Y') }}
                                </h5>
                                <small class="text-muted">$ {{ number_format($item->total_achieves_revenues) }} Current
                                    Achieves</small>
                            </div>
                            @if ($remainingDays <= 4  && !$reported)
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign"
                                    style="">
                                    <a class="dropdown-item"
                                        href="{{ route('monthly_goals.edit', $item->id) }}">Edit</a>
                                    <a class="dropdown-item"
                                        href="{{ route('monthly_goals.show', $item->id) }}">Review</a>
                                    <a data-bs-toggle="modal" data-bs-target="#deleteModel{{ $item->id }}"
                                        class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">

                            <div class="d-flex align-items-start mb-3">
                                <div class="badge rounded bg-label-primary p-2 me-3 rounded"><i
                                        class="ti ti-currency-dollar ti-sm"></i></div>
                                <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                    <div class="me-2">
                                        <h6 class="mb-0">${{ number_format($item->total_estimate_revenues) }}</h6>
                                        <small class="text-muted">Expected Revenues</small>
                                    </div>
                                    @php

                                        $endDate = date('Y-m-t', strtotime($item->month));
                                        // Get the current date
                                        $currentDate = new DateTime();

                                        // Convert $endDate to a DateTime object
                                        $endDateTime = new DateTime($endDate);

                                        // Check if the month is in the past relative to the current month
                                        if ($endDateTime < $currentDate) {
                                            $totalDays = 0;
                                            $message = "<span class='badge bg-label-danger ms-auto'>$totalDays Day left</span>";
                                            $ds= 'disabled';
                                        } else {
                                            $interval = $currentDate->diff($endDateTime);

                                            $totalDays = $interval->days;
                                            $ds= '';
                                            if ($totalDays <= 5) {
                                                $message = "<span class='badge bg-label-danger ms-auto'>$totalDays Day left</span>";
                                            } elseif ($totalDays >= 6 && $totalDays <= 15) {
                                                $message = "<span class='badge bg-label-warning ms-auto'>$totalDays Day left</span>";
                                            } else {
                                                $message = "<span class='badge bg-label-success ms-auto'>$totalDays Day left</span>";
                                            }
                                        }

                                    @endphp
                                    {!! $message !!}
                                </div>
                            </div>
                            @php
                                $percentage = round(
                                    ($item->total_achieves_revenues / $item->total_estimate_revenues) * 100,
                                );
                                if ($percentage < 70) {
                                    $message = 'Fail';
                                    $color = 'danger';
                                } elseif ($percentage >= 70 && $percentage <= 100) {
                                    $message = 'Success';
                                    $color = 'success';
                                } else {
                                    $message = 'Excellent';
                                    $color = 'info';
                                }
                            @endphp
                            <div class="d-flex justify-content-between gap-3 mb-1">
                                <p class="mb-0">Progress - {{ $message }}</p>
                                <span class="text-muted">{{ $percentage }}%</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="progress w-100" style="height: 8px;">
                                    <div class="progress-bar bg-{{ $color }}"
                                        style="width: {{ $percentage }}%" role="progressbar"
                                        aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>


                            <div class="text-center mt-1">
                                <a href="{{ route('monthly_goals.show', $item->id) }}"
                                    class="btn rounded-pill btn-outline-primary waves-effect {{ $ds }}">Make
                                    Review</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-simple">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="text-center mb-4">
                                    <h5 class="mb-2">Are you sure you want to delete
                                        this?</h5>
                                </div>
                                <form action="{{ route('monthly_goals.destroy', $item->id) }}" class="row g-3"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-danger me-sm-3 me-1">Yes
                                            Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    @section('css')

    @endsection

    @section('js')

    @endsection
</x-app-layout>

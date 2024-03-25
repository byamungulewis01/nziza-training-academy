@section('title', 'Employee Reports')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        @include('employees.navigation')

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
                                        } else {
                                            $interval = $currentDate->diff($endDateTime);

                                            $totalDays = $interval->days;
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
                                <a href="{{ route('employee.monthly_reports_review', [$id,$item->id]) }}"
                                    class="btn rounded-pill btn-outline-primary waves-effect"> Review</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>



    </div>
    @section('css')

    @endsection

</x-app-layout>

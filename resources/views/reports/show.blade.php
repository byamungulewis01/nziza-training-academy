@section('title', 'monthly Goals')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Review Your Goals
                </h5>
            </div>
            <div class="card-body">
                <div class="row px-0 px-sm-4">
                    <form action="{{ route('monthly_goals.update_revenues', $id) }}" method="post">
                        @method('PUT')
                        @if (session()->has('warning1'))
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                    <i class="ti ti-ban ti-xs"></i>
                                </span>
                                {{ session()->get('warning1') }}
                            </div>
                        @endif
                        @csrf
                        <div class="col-12 mb-2">
                            <table id="item_table" style="width: 95%">
                                @foreach ($collection as $item)
                                    <tr>
                                        <td>
                                            <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item=""
                                                style="">
                                                <div class="d-flex border rounded position-relative pe-0">
                                                    <div class="row w-100 p-3">
                                                        <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                            <p class="mb-2 repeater-title">Service Type</p>
                                                            <select name="type[]" class="form-select mb-3" disabled>
                                                                <option
                                                                    {{ $item->type == 'training' ? 'selected' : '' }}
                                                                    value="training">Training Sales</option>
                                                                <option {{ $item->type == 'license' ? 'selected' : '' }}
                                                                    value="license">License Sales</option>
                                                            </select>
                                                            <div class="row">
                                                                <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                                    <p class="mb-2 repeater-title">Numbers | Trainees
                                                                    </p>
                                                                    <input type="number" name="quality[]" disabled
                                                                        class="form-control" disabled
                                                                        value="{{ $item->quality }}" min="1">
                                                                </div>
                                                                <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                                    <p class="mb-2 repeater-title">Estimated Revenues
                                                                        <strong>(USD)</strong>
                                                                    </p>
                                                                    <input type="number" name="revenue[]" disabled
                                                                        class="form-control mb-3"
                                                                        value="{{ $item->revenue }}" min="1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12 mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title text-warning">Achieved
                                                                    Revenues
                                                                    <strong>(USD)</strong>
                                                                </p>
                                                                <input type="hidden" name="id[]"
                                                                    value="{{ $item->id }}">
                                                                <input type="number" name="revenue[]"
                                                                    class="form-control mb-3 border border-warning"
                                                                    value="{{ $item->achieves_revenue }}" min="0">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                            <p class="mb-2 repeater-title">Targeting Client</p>
                                                            <input type="text" class="form-control mb-3"
                                                                name="client_name[]" value="{{ $item->client_name }}"
                                                                disabled>
                                                            <textarea class="form-control" disabled name="description[]" rows="3" placeholder="Deal Description">{{ $item->description }}</textarea>

                                                            <div class="py-3">
                                                                @php
                                                                    $percentage = round(
                                                                        ($item->achieves_revenue /
                                                                            $item->revenue) *
                                                                            100,
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
                                                                    <span
                                                                        class="text-muted">{{ $percentage }}%</span>
                                                                </div>
                                                                <div class="d-flex align-items-center mb-3">
                                                                    <div class="progress w-100" style="height: 8px;">
                                                                        <div class="progress-bar bg-{{ $color }}"
                                                                            style="width: {{ $percentage }}%"
                                                                            role="progressbar"
                                                                            aria-valuenow="{{ $percentage }}"
                                                                            aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @section('css')

    @endsection

    @section('js')

    @endsection
</x-app-layout>

@section('title', 'Invoices List')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                    <img src="{{ asset('assets/logo/logo.png') }}" class="mt-1" alt="Nziza Logo"
                                        width="170">

                                </div>
                                <p class="mb-2">2F DERM PLAZA, Makumbusho | Dar es Salaam</p>
                                <p class="mb-2">Hotline: +255 752 303 123</p>
                                <p class="mb-2">Website: <a
                                        href="https://nzizaglobal.co.tz/">https://nzizaglobal.co.tz/</a></p>
                                <p class="mb-2">Email: info@nzizaglobal.co.tz</p>
                            </div>
                            <div>
                                <h4 class="fw-medium mb-2">Proforma # <strong>{{ $invoice->invoice_no }}</strong></h4>
                                <div class="mb-2 pt-1">
                                    <span>Valid Date:</span>
                                    <span
                                        class="fw-medium">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $invoice->valid_date)->format('F j, Y') }}</span>
                                </div>
                                <div class="pt-1">
                                    <span>Expiry Date:</span>
                                    <span
                                        class="fw-medium">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $invoice->expired_date)->format('F j, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                <h6 class="mb-3">PREPARED FOR </h6>
                                <p class="mb-1">{{ $invoice->salesperson }}</p>
                                <p class="mb-1">{{ $invoice->address }}</p>
                            </div>
                        </div>
                    </div>
                    @if ($invoice->training != null)
                        @php
                            $trainings = explode('_', $invoice->training);
                            $trainingsQty = explode('_', $invoice->training_qty);
                            $trainingsDiscount = explode('_', $invoice->training_discount);
                            $count = count($trainings);
                        @endphp
                        <div class="table-responsive border-top mb-4">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>CERTIFIED TRAINING PROGRAM</th>
                                        <th>TIMING</th>
                                        <th>QTY</th>
                                        <th>UNIT PRICE</th>
                                        <th>Discount</th>
                                        <th>AMOUNT (USD)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalTraining = 0;
                                    @endphp
                                    @for ($i = 0; $i < $count; $i++)
                                        @php
                                            $course = \App\Models\Course::find($trainings[$i]);
                                            $discount = $course->price * ($trainingsDiscount[$i] / 100);
                                            $total = $course->price - $discount;
                                            $totalTraining += $total;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->timing }} Hours</td>
                                            <td>{{ $trainingsQty[$i] }}</td>
                                            <td>${{ $course->price }}</td>
                                            <td>{{ $trainingsDiscount[$i] }} %</td>
                                            <td>${{ $total }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2"><strong>Total Amount</strong></td>
                                        <td>${{ $totalTraining }}</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    @endif
                    @if ($invoice->licence != null)
                        @php
                            $licenses = explode('_', $invoice->licence);
                            $licensesQty = explode('_', $invoice->licence_qty);
                            $licensesDiscount = explode('_', $invoice->licence_discount);
                            $count = count($licenses);
                        @endphp
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>SOFTWARE LICENSES</th>
                                        <th>LICENSE TYPE</th>
                                        <th>QTY</th>
                                        <th>UNIT PRICE</th>
                                        <th>Discount</th>
                                        <th>AMOUNT (USD)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalLicense = 0;
                                    @endphp
                                    @for ($i = 0; $i < $count; $i++)
                                        @php
                                            $license = \App\Models\Licence::find($licenses[$i]);
                                            $discount = $license->price * ($licensesDiscount[$i] / 100);
                                            $total = $license->price - $discount;
                                            $totalLicense += $total;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $license->name }}</td>
                                            <td>{{ $license->licence_type }}</td>
                                            <td>{{ $licensesQty[$i] }}</td>
                                            <td>${{ $license->price }}</td>
                                            <td>{{ $licensesDiscount[$i] }} %</td>
                                            <td>${{ $total }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2"><strong>Total Amount</strong></td>
                                        <td>$ {{ $totalLicense }}</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    @endif
                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12">
                                <p class="fw-bold">Note:</p>
                                <span>{!! $invoice->notes !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light"
                            data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-send ti-xs me-2"></i>Send Invoice</span>
                        </button>
                        <button class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">
                            Download
                        </button>
                        <a class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect" target="_blank"
                            href="./app-invoice-print.html">
                            Print
                        </a>
                        <a href="{{ route('invoice.edit', $invoice->id) }}"
                            class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">
                            Edit Invoice
                        </a>
                      
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>

    </div>
    @section('css')
    @endsection

    @section('js')

    @endsection
</x-app-layout>

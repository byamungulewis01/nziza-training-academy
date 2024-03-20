@section('title', 'Invoices List')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-header">
                        <h3>Edit Quotation</h3>
                    </div>
                    <div class="card-body">

                        @if ($invoice->training != null)
                            @php
                                $trainings = explode('_', $invoice->training);
                                $trainingsQty = explode('_', $invoice->training_qty);
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
                                                $total = $course->price * $trainingsQty[$i];
                                                $totalTraining += $total;
                                            @endphp
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->timing }} Hours</td>
                                                <td>{{ $trainingsQty[$i] }}</td>
                                                <td>$ {{ $course->price }} </td>
                                                <td>$ {{ $total }}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><strong>Sub Total</strong></td>
                                            <td>$ {{ $totalTraining }}</td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        @endif
                        @if ($invoice->licence != null)
                            @php
                                $licenses = explode('_', $invoice->licence);
                                $licensesQty = explode('_', $invoice->licence_qty);
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
                                                $total = $license->price * $licensesQty[$i];
                                                $totalLicense += $total;
                                            @endphp
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $license->name }}</td>
                                                <td>{{ $license->licence_type }}</td>
                                                <td>{{ $licensesQty[$i] }}</td>
                                                <td>$ {{ $license->price }}</td>
                                                <td>$ {{ $total }}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><strong>Sub Total</strong></td>
                                            <td>$ {{ $totalLicense }}</td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-8 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-1">
                                <h6 class="mb-3">PREPARED FOR </h6>
                                <p class="mb-1">{{ $invoice->name }}</p>
                            </div>
                            <div class="col-xl-4 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-1">
                                @php
                                    $subtotal = @$totalLicense + @$totalTraining;
                                    $vat_perc = $subtotal * 0.18;
                                @endphp
                                <p class="mb-1">Total : <strong>$ {{ $subtotal }}</strong></p>
                                <p class="mb-1">Tax VAT(18%): <strong>$ {{ $vat_perc }}</strong></p>
                                <p class="mb-1">Grand Total : <strong>$ {{ $subtotal + $vat_perc }}</strong></p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12">
                                <p class="fw-bold">Comments:</p>
                                <span>{!! $invoice->comments !!}</span>
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
                            data-bs-toggle="offcanvas" data-bs-target="#sendQuotationOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-send ti-xs me-2"></i>Send Quotation</span>
                        </button>
                        <a href="{{ route('request.quotation.download', $invoice->id) }}" target="_blank"
                            class="btn btn-label-success d-grid w-100 mb-2 waves-effect">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-download ti-xs me-2"></i> Download</span>
                        </a>
                        <a class="btn btn-label-danger d-grid w-100 mb-2 waves-effect" target="_blank"
                            href="{{ route('request.quotation.print', $invoice->id) }}">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-printer ti-xs me-2"></i> Print</span>
                        </a>
                        <a href="{{ route('request.quotation.edit', $invoice->id) }}"
                            class="btn btn-label-warning d-grid w-100 mb-2 waves-effect">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-edit ti-xs me-2"></i> Edit Quote</span>
                        </a>

                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>

    </div>
    <!-- Send Invoice Sidebar -->
    <div class="offcanvas offcanvas-end" id="sendQuotationOffcanvas" aria-hidden="true">
        <div class="offcanvas-header my-1">
            <h5 class="offcanvas-title">Send Quotation</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pt-0 flex-grow-1">
            <form action="{{ route('request.quotation.send_quotation', $invoice->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="invoice-from" class="form-label">From</label>
                    <input type="text" class="form-control" name="from" required id="invoice-from"
                    value="{{ env('MAIL_FROM_ADDRESS') }}" readonly placeholder="company@email.com" />
                </div>
                <div class="mb-3">
                    <label for="invoice-to" class="form-label">To</label>
                    <input type="text" class="form-control" name="to" required id="invoice-to"
                        value="{{ $invoice->email }}" placeholder="custemer@email.com" />
                </div>
                <div class="mb-3">
                    <label for="invoice-subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" required id="invoice-subject"
                        value="Invoice of purchased Training License"
                        placeholder="Invoice of purchased Training License" />
                </div>
                <div class="mb-3">
                    <label for="invoice-message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" required id="invoice-message" cols="3" rows="8">Dear {{ $invoice->name }}, Thank you for your business, always a pleasure to work with you! We have generated a new quotation</textarea>
                </div>
                <div class="mb-4">
                    <span class="badge bg-label-primary">
                        <i class="ti ti-link ti-xs"></i>
                        <span class="align-middle">Quotation Attached</span>
                    </span>
                </div>
                <div class="mb-3 d-flex flex-wrap">
                    <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                    <button type="button" class="btn btn-label-secondary"
                        data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Send Invoice Sidebar -->

    @section('css')
    @endsection

    @section('js')

    @endsection
</x-app-layout>

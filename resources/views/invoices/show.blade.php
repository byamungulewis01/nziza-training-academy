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
                                <p class="mb-2">Kigali, Rwanda KICUKIRO, KK 15 RD</p>
                                <p class="mb-2">Hotline: +25078556718</p>
                                <p class="mb-2">Website: <a
                                        href="https://nzizatraining.ac.rw">https://nzizatraining.ac.rw</a></p>
                                <p class="mb-2">Email: sales@nzizatraining.ac.rw</p>
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
                                            $total = $course->price * $trainingsQty[$i];
                                            $disount = $total * ($trainingsDiscount[$i] * 0.01);
                                            $totalTraining += $total - $disount;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->timing }} Hours</td>
                                            <td>{{ $trainingsQty[$i] }}</td>
                                            <td>$ {{ $course->price }} </td>
                                            <td>{{ $trainingsDiscount[$i] }} %</td>
                                            <td>$ {{ $total - $disount }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
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
                                            $total = $license->price * $licensesQty[$i];
                                            $disount = $total * ($licensesDiscount[$i] * 0.01);
                                            $totalLicense += $total - $disount;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $license->name }}</td>
                                            <td>{{ $license->licence_type }}</td>
                                            <td>{{ $licensesQty[$i] }}</td>
                                            <td>$ {{ $license->price }}</td>
                                            <td>{{ $licensesDiscount[$i] }} %</td>
                                            <td>$ {{ $total - $disount }}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2"><strong>Sub Total</strong></td>
                                        <td>$ {{ $totalLicense }}</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    @endif
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-8 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-1">
                                <h6 class="mb-3">PREPARED FOR </h6>
                                <p class="mb-1">{{ $invoice->client->name }}</p>
                                <p class="mb-1">{{ $invoice->client->address }}</p>
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
                        <a href="{{ route('invoice.download', $invoice->id) }}" target="_blank"
                            class="btn btn-label-success d-grid w-100 mb-2 waves-effect">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-download ti-xs me-2"></i> Download</span>
                        </a>
                        <a class="btn btn-label-danger d-grid w-100 mb-2 waves-effect" target="_blank"
                            href="{{ route('invoice.print', $invoice->id) }}">
                            <span class="d-flex align-items-center justify-content-center text-nowrap">
                                <i class="ti ti-printer ti-xs me-2"></i> Print</span>
                        </a>
                        @if ($invoice->status == 0)
                            <a href="{{ route('invoice.edit', $invoice->id) }}"
                                class="btn btn-label-warning d-grid w-100 mb-2 waves-effect">
                                <span class="d-flex align-items-center justify-content-center text-nowrap">
                                    <i class="ti ti-edit ti-xs me-2"></i> Edit Invoice</span>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
            <div class="offcanvas-header my-1">
                <h5 class="offcanvas-title">Send Invoice</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0 flex-grow-1">
                <form action="{{ route('invoice.send_invoice', $invoice->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="invoice-from" class="form-label">From</label>
                        <input type="text" class="form-control" name="from" required id="invoice-from"
                            value="{{ env('MAIL_FROM_ADDRESS') }}" readonly placeholder="company@email.com" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-to" class="form-label">To</label>
                        <input type="text" class="form-control" name="to" required id="invoice-to"
                            value="{{ $invoice->client->email }}" placeholder="custemer@email.com" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" required id="invoice-subject"
                            value="Invoice of purchased Training License"
                            placeholder="Invoice of purchased Training License" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-message" class="form-label">Message</label>
                        <textarea class="form-control" name="message" required id="invoice-message" cols="3" rows="8">Dear {{ $invoice->client->name }}, Thank you for your business, always a pleasure to work with you! We have generated a new invoice , We would appreciate payment of this invoice by {{ $invoice->expired_date }}</textarea>
                    </div>
                    <div class="mb-4">
                        <span class="badge bg-label-primary">
                            <i class="ti ti-link ti-xs"></i>
                            <span class="align-middle">Invoice Attached</span>
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

    </div>
    @section('css')
    @endsection

    @section('js')

    @endsection
</x-app-layout>

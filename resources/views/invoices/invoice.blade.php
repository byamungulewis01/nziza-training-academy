<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $invoice->invoice_no }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 13px;

        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        header img {
            width: 150px;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            padding: 0;
        }

        main {
            border: 3px solid #221c1c;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        th {
            text-align: left;
        }

        tfoot {
            font-weight: bold;
        }

        p {
            margin-top: 10px;
        }

        /* Customizing the layout for the invoice elements */

        .training-table,
        .software-table {
            margin-bottom: 20px;
        }

        .training-table th,
        .software-table th {
            text-align: center;
        }

        .training-table th:nth-child(odd),
        .software-table th:nth-child(odd) {
            width: 10%;
        }

        .training-table th:nth-child(2n),
        .software-table th:nth-child(2n) {
            width: 30%;
        }

        .training-table th:nth-child(3n),
        .software-table th:nth-child(3n),
        .training-table th:nth-child(4n),
        .software-table th:nth-child(4n),
        .training-table th:nth-child(5n),
        .software-table th:nth-child(5n),
        .training-table th:nth-child(6n),
        .software-table th:nth-child(6n) {
            width: 15%;
        }

        .training-table th:nth-child(7n),
        .software-table th:nth-child(7n),
        .training-table th:nth-child(8n),
        .software-table th:nth-child(8n),
        .training-table th:nth-child(9n),
        .software-table th:nth-child(9n),
        .training-table th:nth-child(10n),
        .software-table th:nth-child(10n),
        .training-table th:nth-child(11n),
        .software-table th:nth-child(11n),
        .training-table th:nth-child(12n),
        .software-table th:nth-child(12n) {
            width: 10%;
        }

        footer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            text-align: right;
            font-size: 10px;
            color: #888;
            /* Adjust color as needed */
        }


        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            header,
            main {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <main>
        <header>
            <table border="0" width="100%">
                <tr>
                    <td width="65%" style="border: 0px;">
                        <img src="{{ public_path('assets/logo/logo.png') }}" alt="Nziza Logo"width="170">
                        <p>Kigali, Rwanda KICUKIRO, KK 15 RD<br>
                            Hotline: +25078556718<br>
                            Website: <a href="https://nzizatraining.ac.rw">https://nzizatraining.ac.rw</a><br>
                            Email: sales@nzizatraining.ac.rw</p>


                    </td>
                    <td width="35%" style="border: 0px;">
                        <h4>SOFTWARE & TRAINING QUOTATION</h4>
                        <p>Proforma # [{{ $invoice->invoice_no }}]<br>
                            Valid Date:
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $invoice->valid_date)->format('F j, Y') }}<br>
                            Expiry Date:
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $invoice->expired_date)->format('F j, Y') }}
                        </p>

                    </td>
                </tr>
            </table>
        </header>
        <h3 style="padding : 1px;font-size : 13px; background-color: #1c1717; color:#ffffff; ">PREPARED FOR</h3>

        <p>{{ $invoice->client->name }}<br>
            {{ $invoice->client->address }}</p>
        @if ($invoice->training != null)
            @php
                $trainings = explode('_', $invoice->training);
                $trainingsQty = explode('_', $invoice->training_qty);
                $trainingsDiscount = explode('_', $invoice->training_discount);
                $count = count($trainings);
            @endphp
            <table border="1" style="width: 100%;">
                <thead style="font-size : 11px; background-color: #1c1717; color:#ffffff;">
                    <tr>
                        <th>S/N</th>
                        <th>CERTIFIED TRAINING PROGRAM</th>
                        <th>TIMING</th>
                        <th>QTY</th>
                        <th>UNIT PRICE</th>
                        <th>DISCOUNT</th>
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
                            <td>${{ $course->price }}</td>
                            <td>{{ $trainingsDiscount[$i] }} %</td>
                            <td>${{ $total - $disount }}</td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td><strong>Sub Total</strong></td>
                        <td>${{ $totalTraining }}</td>
                    </tr>
                </tfoot>
            </table>
        @endif
        <br>
        @if ($invoice->licence != null)
            <table border="1" style="width: 100%;">
                @php
                    $licenses = explode('_', $invoice->licence);
                    $licensesQty = explode('_', $invoice->licence_qty);
                    $licensesDiscount = explode('_', $invoice->licence_discount);
                    $count = count($licenses);
                @endphp
                <thead style="font-size : 11px;background-color: #1c1717; color:#ffffff;">
                    <tr>
                        <th>S/N</th>
                        <th>SOFTWARE LICENSES</th>
                        <th>LICENSE TYPE</th>
                        <th>QTY</th>
                        <th>UNIT PRICE</th>
                        <th>DISCOUNT</th>
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
                            <td>${{ $license->price }}</td>
                            <td>{{ $licensesDiscount[$i] }} %</td>
                            <td>${{ $total - $disount }}</td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td><strong>Sub Total</strong></td>
                        <td>$ {{ $totalLicense }}</td>
                    </tr>
                </tfoot>
            </table>
        @endif
        <div>
            @php
                $subtotal = @$totalLicense + @$totalTraining;
                $vat_perc = $subtotal * 0.18;
            @endphp
            <p class="mb-1">Total : <strong>$ {{ $subtotal }}</strong></p>
            <p class="mb-1">Tax VAT(18%): <strong>$ {{ $vat_perc }}</strong></p>
            <p class="mb-1">Grand Total : <strong>$ {{ $subtotal + $vat_perc }}</strong></p>
        </div>
        <br>
        <h3 style="padding : 1px;background-color: #1c1717; color:#ffffff;">USEFULL NOTES:</h3>
        <p>{!! $invoice->notes !!}</p>
    </main>
    <footer style="position: fixed; bottom: 20px; right: 20px;">
        <span style="color: #4a4a4a"> Powered by Nziza MIS</span>
     </footer>

</body>

</html>

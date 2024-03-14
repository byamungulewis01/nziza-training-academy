<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->invoice_no }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
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
                        <img src="{{ public_path('assets/logo/Nziza_Global_TZ_LOGO_PNG.png') }}"
                            alt="Nziza Logo"width="170">
                        <p>2F DERM PLAZA, Makumbusho | Dar es Salaam<br>
                            Hotline: +255 752 303 123<br>
                            Website: https://nzizaglobal.co.tz/<br>
                            Email: info@nzizaglobal.co.tz</p>

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
        <h3 style="background-color: #1c1717; color:#ffffff;">PREPARED FOR</h3>
        <p>{{ $invoice->salesperson }}<br>
            {{ $invoice->address }}</p>
        @if ($invoice->training != null)
            @php
                $trainings = explode('_', $invoice->training);
                $trainingsQty = explode('_', $invoice->training_qty);
                $trainingsDiscount = explode('_', $invoice->training_discount);
                $count = count($trainings);
            @endphp
            <table border="1" style="width: 100%;">
                <thead style="background-color: #1c1717; color:#ffffff;">
                    <tr>
                        <th colspan="2">S/N</th>
                        <th colspan="2">CERTIFIED TRAINING PROGRAM</th>
                        <th colspan="2">TIMING</th>
                        <th colspan="2">QTY</th>
                        <th colspan="2">UNIT PRICE</th>
                        <th colspan="2">DISCOUNT</th>
                        <th colspan="2">AMOUNT (USD)</th>
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
                            <td colspan="2">{{ $i + 1 }}</td>
                            <td colspan="2">{{ $course->name }}</td>
                            <td colspan="2">{{ $course->timing }} Hours</td>
                            <td colspan="2">{{ $trainingsQty[$i] }}</td>
                            <td colspan="2">${{ $course->price }}</td>
                            <td colspan="2">{{ $trainingsDiscount[$i] }} %</td>
                            <td colspan="2">${{ $total }}</td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="8"><strong>Total Amount</strong></td>
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
                <thead style="background-color: #1c1717; color:#ffffff;">
                    <tr>
                        <th colspan="2">S/N</th>
                        <th colspan="2">SOFTWARE LICENSES</th>
                        <th colspan="2">LICENSE TYPE</th>
                        <th colspan="2">QTY</th>
                        <th colspan="2">UNIT PRICE</th>
                        <th colspan="2">DISCOUNT</th>
                        <th colspan="2">AMOUNT (USD)</th>
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
                            <td colspan="2">{{ $i + 1 }}</td>
                            <td colspan="2">{{ $license->name }}</td>
                            <td colspan="2">{{ $license->licence_type }}</td>
                            <td colspan="2">{{ $licensesQty[$i] }}</td>
                            <td colspan="2">${{ $license->price }}</td>
                            <td colspan="2">{{ $licensesDiscount[$i] }} %</td>
                            <td colspan="2">${{ $total }}</td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="8"><strong>Total Amount</strong></td>
                        <td>$ {{ $totalLicense }}</td>
                    </tr>
                </tfoot>
            </table>
        @endif
        <br>
        <h3 style="background-color: #1c1717; color:#ffffff;">USEFULL NOTES:</h3>
        <p>{!! $invoice->notes !!}</p>
    </main>
</body>

</html>

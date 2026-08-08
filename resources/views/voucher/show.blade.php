<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Htoo - Invoice</title>
    <style>
        @font-face {
            font-family: 'myanmar';
            src: url('{{ public_path('fonts/Noto_Sans_Myanmar/NotoSansMyanmar-Light.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'poppins';
            src: url('{{ public_path('fonts/Poppins/Poppins-Regular.ttf') }}');
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-size: 14px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        th {
            background-color: #1b5f21 !important;
            color: white;
            font-weight: 600;
            text-align: center;
            font-family: 'poppins' !important;
        }

        th,
        td {
            padding: 3px 10px;
            height: 25px;
            width: 1%;
            white-space: nowrap !important;
            background-color: #f1f2f380;
            vertical-align: middle;
        }

        td {
            text-align: right;
        }

        td:not(:first-child):not(:last-child) {
            width: auto !important;
        }

        .customer-info {
            font-family: 'poppins' !important;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .customer-info>div {
            width: 30%;
            display: flex;
        }

        .customer-info>div:nth-of-type(2),
        .customer-info>div:nth-of-type(5) {
            width: 40%;
        }

        .customer-info>div p:first-of-type {
            color: gray;
        }

        .customer-info p {
            display: inline-block;
            padding: 3px 0;
            padding-right: 5px;
            font-family: 'myanmar' !important;
        }

        .invoice-info td {
            font-family: 'myanmar' !important;
        }

        .invoice-info td:nth-child(2) {
            text-align: left;
        }

        .invoice-info td:nth-child(3) {
            text-align: center;
        }

        .invoice-info th,
        .invoice-info td {
            width: 20mm;
        }

        .invoice-info th:first-child,
        .invoice-info td:first-child {
            width: 10mm;
        }

        .invoice-info th:nth-child(2),
        .invoice-info td:nth-child(2) {
            width: 90mm;
        }

        .summary-info th:first-child,
        .summary-info td:first-child {
            width: 10mm;
        }

        .summary-info th:nth-child(2),
        .summary-info td:nth-child(2) {
            width: 120mm;
        }

        .summary-info td:nth-child(2) {
            text-align: left;
        }

        .summary-info th:last-child,
        .summary-info td:last-child {
            width: 20mm;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break:last-child {
            page-break-after: never;
        }
    </style>
</head>

<body>
    @php
        $items = collect($data['items']);
        $chunks = collect();

        $defaultRows = 16;
        $firstPageRows = $defaultRows + 5;
        $nextPageRows = $firstPageRows + 2;

        if ($items->isNotEmpty()) {
            $chunks->push($items->slice(0, $defaultRows));
            $remainingItems = $items->slice($defaultRows);
            if ($remainingItems->isNotEmpty()) {
                $chunks = collect();
                $chunks->push($items->slice(0, $firstPageRows));
                $remainingItems = $items->slice($firstPageRows);

                foreach ($remainingItems->chunk($nextPageRows) as $chunk) {
                    $chunks->push($chunk);
                }
            }
        }

        $allPageTotal = 0;
        $subPageTotal = [];
    @endphp

    <div class="main">
        <div class="customer-info">
            <div>
                <p>Date:</p>
                <p>{{ date_format($data->date, 'd-M-Y') }}</p>
            </div>
            <div>
                <p>Customer:</p>
                <p>
                    {{ $data->car->customer_name ?? '' }}
                    {{ $data->car->customer_phone ?? '' }}
                </p>
            </div>
            <div>
                <p>Invoice No:</p>
                <p>{{ $data->record_number ?? '' }}</p>
            </div>
            <div>
                <p>Car Number:</p>
                <p>{{ $data->car->car_number ?? '' }}</p>
            </div>
            <div>
                <p>Car Brand:</p>
                <p>{{ $data->car->car_brand ?? '' }}</p>
            </div>
            <div>
                <p>Car Model:</p>
                <p>{{ $data->car->car_model ?? '' }}</p>
            </div>
        </div>

        @foreach ($chunks as $pageIndex => $chunk)
            @php
                $columnSum = 0;
            @endphp

            @if ($pageIndex !== 0)
                <div class="customer-info">
                    <div></div>
                    <div></div>
                    <div>
                        <p>Invoice No:</p>
                        <p>{{ $data->record_number ?? '' }}</p>
                    </div>
                </div>
            @endif

            <div class="{{ count($chunks) > 1 ? 'page-break' : '' }} invoice-info">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chunk as $key => $item)
                            @php
                                $columnSum += $item['total'];
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['unit_price']) }}</td>
                                <td>{{ number_format($item['total']) }}</td>
                            </tr>
                            @php
                                if (count($chunks) > 1 && $pageIndex === 0) {
                                    $remainingRows = $firstPageRows - count($chunk);
                                } elseif (count($chunks) > 1 && $pageIndex !== 0) {
                                    $remainingRows = $nextPageRows - count($chunk);
                                } else {
                                    $remainingRows = $defaultRows - count($chunk);
                                }
                            @endphp
                        @endforeach
                        @for ($i = 0; $i < $remainingRows; $i++)
                            <tr>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">SubTotal</td>
                            <td>{{ number_format($columnSum) }}</td>
                        </tr>
                        @if (count($chunks) === 1)
                            <tr>
                                <td colspan="4">Discount</td>
                                <td>{{ number_format($data['discount']) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">Advance</td>
                                <td>{{ number_format($data['advance']) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">Grand Total</td>
                                <td>{{ number_format($columnSum) }}</td>
                            </tr>
                            @if ($data['payment_status'] === 'paid')
                                <tr>
                                    <td colspan="4">Paid</td>
                                    <td>{{ number_format($columnSum) }}</td>
                                </tr>
                            @endif
                        @endif
                    </tfoot>
                </table>
                @if (count($chunks) === 1)
                    @if ($data['payment_status'] === 'paid')
                        @include('partials._paidstamp')
                    @endif
                    @include('partials._note&sign')
                @endif
            </div>
            @php
                $subPageTotal[] = $columnSum;
                $allPageTotal += $columnSum;
            @endphp
        @endforeach

        @if (count($chunks) > 1)
            <div class="customer-info">
                <div>
                    <p>Date:</p>
                    <p>{{ date_format($data->date, 'd-M-Y') }}</p>
                </div>
                <div>
                    <p>Customer:</p>
                    <p>
                        {{ $data->car->customer_name ?? '' }}
                        {{ $data->car->customer_phone ?? '' }}
                    </p>
                </div>
                <div>
                    <p>Invoice No:</p>
                    <p>{{ $data->record_number ?? '' }}</p>
                </div>
                <div>
                    <p>Car Number:</p>
                    <p>{{ $data->car->car_number ?? '' }}</p>
                </div>
                <div>
                    <p>Car Brand:</p>
                    <p>{{ $data->car->car_brand ?? '' }}</p>
                </div>
                <div>
                    <p>Car Model:</p>
                    <p>{{ $data->car->car_model ?? '' }}</p>
                </div>
            </div>
            <div class="summary-info">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subPageTotal as $index => $subPage)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>Page {{ $index + 1 }}</td>
                                <td>{{ number_format($subPage) }}</td>
                            </tr>
                        @endforeach
                        @php
                            $summaryRemainingRows = $defaultRows - count($subPageTotal);
                        @endphp
                        @for ($i = 0; $i < $summaryRemainingRows; $i++)
                            <tr>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                                <td>
                                    <div></div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">SubTotal</td>
                            <td>{{ number_format($allPageTotal) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Discount</td>
                            <td>{{ number_format($data['discount']) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Advance</td>
                            <td>{{ number_format($data['advance']) }}</td>
                        </tr>

                        <tr>
                            <td colspan="2">Grand Total</td>
                            <td>{{ number_format($data['grand_total']) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @include('partials._note&sign')
        @endif

        @include('partials._watermark')
    </div>

</body>

</html>

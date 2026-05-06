<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Htoo - Invoice</title>
    <style>
        @font-face {
            font-family: 'padauk';
            src: url('{{ storage_path('fonts/Padauk-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            line-height: 1.5;
            font-family: 'padauk';
        }

        table {
            font-size: 12px;
            width: 100%;
        }

        thead th {
            background-color: #1b5f21;
            color: white;
            font-weight: 600;
            text-align: center;
            font-family: 'Poppins';
        }

        th:not(:first-child) {
            width: 12%;
        }

        th,
        td {
            padding: 5px 10px;
            background-color: #f1f2f380;
            height: 32.5px;
            text-align: right;
        }

        td:first-child {
            text-align: left;
        }

        tfoot td {
            font-weight: 600;
            text-align: right !important;
        }

        h3 {
            font-weight: 500;
        }

        .watermark {
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            opacity: 0.3;
            width: 500px;
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
        $rows = 15;
        $chunks = $data['items']->chunk($rows);

        $rows = count($data['items']->chunk($rows)) > 1 ? 15 : 10;

        $allPageTotal = 0;
        $subPageTotal = [];
    @endphp

    <div class="main">
        @foreach ($chunks as $chunk)
            @php $columnSum = 0; @endphp
            <div class="{{ count($data['items']->chunk($rows)) > 1 ? 'page-break' : '' }}">
                <table>
                    <thead>
                        <tr>
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
                                <td>{{ $item['description'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['unit_price']) }}</td>
                                <td>{{ number_format($item['total']) }}</td>
                            </tr>
                            @php
                                $remainingRows = $rows - count($chunk);
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
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">SubTotal</td>
                            <td>{{ number_format($columnSum) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Discount</td>
                            <td>{{ number_format($data['discount']) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Advance</td>
                            <td>{{ number_format($data['advance']) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>{{ number_format($columnSum) }}</td>
                        </tr>
                    </tfoot>
                </table>
                @if (count($chunks) == 1)
                    @include('partials._note&sign')
                @endif
            </div>
            @php
                $subPageTotal[] = $columnSum;
                $allPageTotal += $columnSum;
            @endphp
        @endforeach

        @if (count($chunks) > 1)
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subPageTotal as $index => $subPage)
                        <tr>
                            <td>Page {{ $index + 1 }}</td>
                            <td>{{ number_format($subPage) }}</td>
                        </tr>
                    @endforeach
                    @php
                        $summaryRemainingRows = $rows - count($subPageTotal) - 4;
                    @endphp
                    @for ($i = 0; $i < $summaryRemainingRows; $i++)
                        <tr>
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
                        <td>SubTotal</td>
                        <td>{{ number_format($allPageTotal) }}</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>{{ number_format($data['discount']) }}</td>
                    </tr>
                    <tr>
                        <td>Advance</td>
                        <td>{{ number_format($data['advance']) }}</td>
                    </tr>

                    <tr>
                        <td>Total</td>
                        <td>{{ number_format($data['grand_total']) }}</td>
                    </tr>
                </tfoot>
            </table>
            @include('partials._note&sign')
        @endif

        @include('partials._watermark')
    </div>

</body>

</html>

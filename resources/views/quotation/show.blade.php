<style>
    * {
        font-family: "Roboto Mono";
        line-height: 1.5;
    }

    table {
        font-size: 12px;
    }

    th,
    td {
        padding: 5px;
        background-color: #f1f2f380;
    }

    td:first-child {
        text-align: left;
    }

    td,
    td[colspan="3"] {
        text-align: right;
    }

    td[colspan="3"] {
        font-family: Poppins;
        font-weight: 600;
    }

    th {
        background-color: #1b5f21;
        color: white;
        font-family: Poppins;
        font-weight: 600;
    }

    h3 {
        font-family: Poppins;
        font-weight: 500;
    }

    .watermark {
        position: fixed;
        top: 25%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
        opacity: 0.2;
        width: 500px;
    }
</style>

<div class="main">

    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['items'] as $item)
                <tr>
                    <td style="font-family: Poppins;">{{ $item['description'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['unit_price']) }}</td>
                    <td style="font-weight: 600;">{{ number_format($item['total']) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">SubTotal</td>
                <td style="font-weight: 600;">{{ number_format($data['sub_total']) }}</td>
            </tr>
            <tr>
                <td colspan="3">Discount</td>
                <td style="font-weight: 600;">{{ number_format($data['discount']) }}</td>
            </tr>
            @isset($data['advance'])
                <tr>
                    <td colspan="3">Advance</td>
                    <td style="font-weight: 600;">{{ number_format($data['advance']) }}</td>
                </tr>
            @endisset
            <tr>
                <td colspan="3">Discount</td>
                <td style="font-weight: 600;">{{ number_format($data['discount']) }}</td>
            </tr>
            <tr>
                <td colspan="3">Total</td>
                <td style="font-weight: 600;">{{ number_format($data['grand_total']) }}</td>
            </tr>
        </tbody>
    </table>

    @if ($data['remark'])
        <div style="margin-top: 5px; font-size:12px;">
            <label for="remark" style="font-family: Poppins;">Note:</label>
            <p style="font-family: Poppins; ">{{ $data['remark'] }}</p>
        </div>
    @endif

    <div style="text-align: right;">
        <div style="text-align: center; display: inline-block">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/signature.png'))) }}"
                alt="" height="70">
            <p style="font-family: Poppins; font-family: 500;">AUNG KO HEIN</p>
            <p style="font-family: Poppins; font-weight: 700;">HTOO AUTOMOBILE SERVICE</p>
        </div>
    </div>

    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/htoo_logo_gray.png'))) }}"
        alt="" class="watermark">
</div>

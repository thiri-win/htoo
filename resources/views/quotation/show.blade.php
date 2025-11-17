<style>
    * {
        font-family: "Roboto Mono";
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

    .payment-info {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin: 10mm 0;
        page-break-inside: avoid;
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
            @foreach ($quotation['items'] as $item)
                <tr>
                    <td style="font-family: Poppins;">{{ $item['description'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['unit_price']) }}</td>
                    <td style="font-weight: 600;">{{ number_format($item['total']) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">SubTotal</td>
                <td style="font-weight: 600;">{{ number_format($quotation['sub_total']) }}</td>
            </tr>
            <tr>
                <td colspan="3">Discount</td>
                <td style="font-weight: 600;">{{ number_format($quotation['discount']) }}</td>
            </tr>
            <tr>
                <td colspan="3">Total</td>
                <td style="font-weight: 600;">{{ number_format($quotation['grand_total']) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="payment-info">
        <div>
            <h3>Payment Information</h3>
            <div style="font-family: monospace">
                <p style="font-family: monospace">KBZ Bank -
                    <strong style="font-family: monospace">2353 0105 7008 30201</strong>
                    (<strong style="font-family: monospace">THIRI WIN</strong>)
                </p>
                <p style="font-family: monospace">AYA Bank -
                    <strong style="font-family: monospace">2000 4254 047</strong>
                    (<strong style="font-family: monospace">THIRI WIN</strong>)
                </p>
                <p style="font-family: monospace">UAB Bank -
                    <strong style="font-family: monospace">0243 3010 0011 287</strong>
                    (<strong style="font-family: monospace">AUNG KO HEIN</strong>)
                </p>
            </div>
        </div>
        <div style="text-align: center;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/signature.png'))) }}"
                alt="" height="70">
            <p style="font-family: Poppins; font-family: 500;">AUNG KO HEIN</p>
            <p style="font-family: Poppins; font-weight: 700;">HTOO AUTOMOBILE SERVICE</p>
        </div>
    </div>

    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/htoo_logo_gray.png'))) }}"
        alt="" class="watermark">
</div>

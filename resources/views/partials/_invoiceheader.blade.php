<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        line-height: 1.5;
        font-size: 14px;
        font-family: "Poppins";
        font-weight: 400;
    }

    .header {
        width: 100%;
        padding: 10mm;
    }

    .container {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .container img,
    .container .content {
        text-align: right;
    }

    h1 {
        text-align: center;
        color: #1b5f21;
        text-transform: uppercase;
        margin: 20px 0;
        font-size: 30px;
        font-weight: 700;
        font-family: "Poppins";
    }

    h2 {
        font-family: "Poppins";
        font-weight: 600;
    }

    .footer {
        width: 100%;
        padding: 10mm;
        font-size: 16px;
        text-align: center;
        font-family: Poppins;
    }

    td {
        padding: 5px;
    }
</style>

<div class="header">

    <div class="container">
        <div>
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/htoo_logo_green.png'))) }}"
                alt="" style="height: 120px">
        </div>
        <div class="content">
            <h2>Htoo Automobile Service</h2>
            <p>(29/B), Shwe Ta Gar St, Bon Shay Gone Ward</p>
            <p>Shwe Pyi Thar Township, Yangon</p>
            <p>&phone; 09 443067898, &phone; 09 795355487</p>
        </div>
    </div>

    <h1>Invoice</h1>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="font-size: 12px; max-width:60px;">Date:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px;px;">
                    {{ date_format($quotation->date, 'd-M-Y') }}</td>

                <td style="font-size: 12px; max-width:60px;">Customer Name:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px;">{{ $quotation->car->customer_name }}</td>

                <td style="font-size: 12px; max-width:60px;">Customer Phone:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px;">{{ $quotation->car->customer_phone }}</td>
            </tr>
            <tr>
                <td style="font-size: 12px; max-width:60px;">Car Number:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px;">{{ $quotation->car->car_number }}</td>

                <td style="font-size: 12px; max-width:60px;">Car Brand:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px;">{{ $quotation->car->car_brand }}</td>

                <td style="font-size: 12px; max-width:60px;">Car Model:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px;">{{ $quotation->car->car_model }}</td>
            </tr>
        </tbody>

        {{-- {{ $quotation->sub_total }}
        {{ $quotation->discount }}
        {{ $quotation->grand_total }}
        {{ $quotation->remark }}

        {{ $quotation->items }} --}}
    </table>

</div>

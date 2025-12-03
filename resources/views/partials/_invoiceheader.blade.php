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
        font-size: 16px;
    }

    td {
        padding: 5px;
    }

    .content p,
    .content strong {
        font-size: 12px;
    }
</style>

<header class="header">
    <div class="container">
        <div>
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/htoo_logo_green.png'))) }}"
                alt="" style="height: 150px;">
        </div>
        <div class="content">
            <h2>Htoo Automobile Service</h2>
            <p>(29/B), Shwe Ta Gar St, Bon Shay Gone Ward</p>
            <p>Shwe Pyi Thar Township, Yangon</p>
            <p>&#9742; 09 443067898, &#9742;09 795355487</p>
            <p style="font-family: Poppins;">&blacktriangleright; UAB Bank -
                <strong style="font-family: Poppins;">0243 3010 0011 287</strong>
                [<strong>AUNG KO HEIN</strong>]
            </p>
            <p style="font-family: Poppins;">&blacktriangleright; KBZ Bank -
                <strong style="font-family: Poppins;">2353 0105 7008 30201</strong>
                [<strong>THIRI WIN</strong>]
            </p>
            <p style="font-family: Poppins;">&blacktriangleright; AYA Bank -
                <strong style="font-family: Poppins;">2000 4254 047</strong>
                [<strong>THIRI WIN</strong>]
            </p>
        </div>
    </div>

    <h1>Invoice</h1>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="font-size: 12px;">Date:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; min-width: 65px;">
                    {{ date_format($data->date, 'd-M-Y') }}
                </td>

                <td style="font-size: 12px;">Customer Name:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; min-width: 65px;">
                    {{ $data->car->customer_name ?? '' }}
                </td>

                <td style="font-size: 12px;">Customer Phone:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; min-width: 65px;">
                    {{ $data->car->customer_phone ?? '' }}
                </td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Car Number:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; min-width: 65px;">
                    {{ $data->car->car_number ?? '' }}
                </td>

                <td style="font-size: 12px;">Car Brand:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; min-width: 65px;">
                    {{ $data->car->car_brand ?? '' }}
                </td>

                <td style="font-size: 12px;">Car Model:</td>
                <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; min-width: 65px;">
                    {{ $data->car->car_model ?? '' }}
                </td>
            </tr>
        </tbody>
    </table>
</header>

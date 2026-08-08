<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'poppins';
            src: url('{{ public_path('fonts/Poppins/Poppins-Medium.ttf') }}');
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            line-height: 1.5;
            font-size: 14px;
            font-family: 'poppins' !important;
        }

        .header {
            width: 100%;
            padding: 5mm;
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
            margin: 3mm 0;
            font-size: 30px;
            font-weight: 700;
            font-family: "poppins" !important;
        }

        h2 {
            font-family: "poppins" !important;
            font-weight: 600;
            font-size: 16px;
        }

        p {
            font-family: 'poppins' !important;
        }

        .content {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <div>
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/htoo_logo_green.png'))) }}" alt="" style="height: 150px;">
            </div>
            <div class="content">
                <h2>Htoo Automobile Service</h2>
                <p>(29/B), Shwe Ta Gar St, Bon Shay Gone Ward</p>
                <p>Shwe Pyi Thar Township, Yangon</p>
                <p>&#9742; 09 443067898, &#9742;09 795355487</p>
                <p>&blacktriangleright; UAB Bank -
                    <span>0243 3010 0011 287</span>
                    [<span>AUNG KO HEIN</span>]
                </p>
                <p>&blacktriangleright; KBZ Bank -
                    <span>1225 1105 7008 30201</span>
                    [<span>THIRI WIN</span>]
                </p>
                <p>&blacktriangleright; AYA Bank -
                    <span>2000 4254 047</span>
                    [<span>THIRI WIN</span>]
                </p>
                <p>&blacktriangleright; KBZ Pay -
                    <span>09443067898</span>
                    [<span>AUNG KO HEIN</span>]
                </p>
            </div>
        </div>

        <h1>Invoice</h1>

        {{-- <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size:12px; width:16%">
                    </td>

                    <td style="font-size: 12px;"></td>
                    <td style="font-size:12px; width:16%">
                    </td>

                    <td style="font-size: 12px;">Invoice No:</td>
                    <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; width:16%">
                        {{ $data->record_number ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px;">Date:</td>
                    <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; width:16%">
                        {{ date_format($data->date, 'd-M-Y') }}
                    </td>

                    <td style="font-size: 12px;">Customer Name:</td>
                    <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; width:16%">
                        {{ $data->car->customer_name ?? '' }}
                    </td>

                    <td style="font-size: 12px;">Customer Phone:</td>
                    <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; width:16%">
                        {{ $data->car->customer_phone ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px;">Car Number:</td>
                    <td style="border-bottom: 1px solid #f1f2f3; font-size:12px; width:16%">
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
        </table> --}}
    </header>
</body>

</html>

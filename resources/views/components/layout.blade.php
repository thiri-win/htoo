<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Quotation</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url("{{ public_path('fonts/Poppins/Poppins-Medium.ttf') }}");
        }

        @font-face {
            font-family: 'notosan';
            src: url("{{ public_path('fonts/Noto_Sans_Myanmar/NotoSansMyanmar-Medium.ttf') }}")
        }

        body {
            font-family: 'Poppins', 'sans-serif';
            background-color: green;
        }

        h1 {
            font-family: 'notosan';
        }
    </style>
</head>

<body>
    <div style="padding: 50px 20px;">
        <div style="padding: 50px 20px;">
    <table style="width: 100%;">
        <thead style="background-color: #f3f4f6;">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 50; $i++)
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;">LINE</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">line {{ $i }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>

    </div>
</body>

</html>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        line-height: 1.7;
        font-size: 16px;
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

    .info {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .footer {
        width: 100%;
        padding: 10mm;
        font-size: 16px;
        text-align: center;
        font-family: Poppins;
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
            <p>09 443067898, 09 795355487</p>
        </div>
    </div>

    <h1>Sales Quotation</h1>

    <div class="info">
        <div>
            <p>
                <span>Date:</span>
                <strong>{{ $quotation['date'] }}</strong>
            </p>
            <p>
                <span>Subject:</span>
                <strong>{{ $quotation['subject'] }}</strong>
            </p>
        </div>
        <div>
            <span>To:</span><br>
            <strong>{{ $quotation['to'] }}</strong>
        </div>
    </div>

</div>

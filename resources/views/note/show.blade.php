<style>
    .watermark {
        position: fixed;
        top: 25%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
        opacity: 0.2;
        width: 500px;
    }
    * {
        font-family: "Poppins";
        line-height: 1.5;
    }
</style>
<div>
     {!! $data !!}
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/htoo_logo_gray.png'))) }}"
        alt="" class="watermark">
</div>

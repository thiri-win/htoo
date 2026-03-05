@if ($data['remark'])
    <div style="margin-top: 5px; font-size:12px;">
        <label for="remark" style="font-family: Poppins;">Note:</label>
        <p style="font-family: Poppins;">{{ $data['remark'] }}</p>
    </div>
@endif

<div style="text-align: right;">
    <div style="text-align: center; display: inline-block">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/signature.png'))) }}" alt="" height="50">
        <p style="font-family: Poppins; font-family: 500;">AUNG KO HEIN</p>
        <p style="font-family: Poppins; font-weight: 700;">HTOO AUTOMOBILE SERVICE</p>
    </div>
</div>

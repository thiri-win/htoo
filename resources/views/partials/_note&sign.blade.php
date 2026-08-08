<div style="display: flex; gap: 1rem; align-items: flex-start; margin:2mm 0;">

    <div style="margin-top: 5px; font-size:12px; width: 80%">
        @if ($data['remark'])
            <label for="remark" style="font-family: Poppins;">
                Note:
            </label>
        @endif
        <p style="font-family: Poppins;">{{ $data['remark'] }}</p>
    </div>

    <div style="text-align: right;">
        <div style="text-align: center; display: inline-block">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/signature.png'))) }}" alt="" height="50">
            <p style="font-family: Poppins; font-family: 500;">AUNG KO HEIN</p>
            <p style="font-family: Poppins; font-weight: 700;white-space:nowrap;">HTOO AUTOMOBILE SERVICE</p>
        </div>
    </div>

</div>

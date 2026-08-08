<style>
    .stamp {
        background-color: #f1f2f3;
        display: inline-block;
        position: absolute;
        left: 50%;
        top: 73%;
        transform: translate(-50%, -50%) rotate(-15deg);
        text-align: center;
        padding: 1rem;
    }

    .stamp p {
        font-size: 3rem;
        font-weight: 900;
        letter-spacing: .5rem;
    }
</style>
<div class="stamp">
    <p>PAID</p>
    <span>{{ $data['payment_date'] }}</span>
</div>

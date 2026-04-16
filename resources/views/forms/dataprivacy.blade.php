@extends('layouts.app')

@section('content')



<style>
    .rfa-wrapper{
        min-height:100vh;
        /* background-image:url("{{ asset('images/dmw_office.webp') }}"); */
        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:20px;
    }

    .notice-card{
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(6px);
        border-radius:12px;
        padding:30px;
        max-width:700px;
        width:100%;
        box-shadow:0 10px 25px rgba(0,0,0,0.15);
    }

    .notice-card ul{
        padding-left:18px;
    }

    .notice-card li{
        margin-bottom:10px;
    }

    .rfa-card {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        padding: 35px 40px;
        max-width: 700px;
        width: 100%;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .rfa-title {
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .rfa-card ul {
        padding-left: 18px;
        font-size: 16px;
    }

    .btn-continue {
        background-color: #3b66b0;
        color: white;
        padding: 8px 30px;
        border-radius: 8px;
        float: right;
    }

    .btn-continue:hover {
        background-color: #2f5597;
        color: #fff;
    }

    .error-tooltip {
        position: absolute;
        top: 35px;
        left: 0;
        background: #f1f193;
        border: 1px solid #c9c9c9;
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 14px;
        color: #333;
        width: 300px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);

        /* hidden state */
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        pointer-events: none;

        transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s;
    }

    .error-tooltip.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }

    /* arrow */
    .error-tooltip::after {
        content: "";
        position: absolute;
        top: -8px;
        left: 12px;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 8px solid #f1f193;
    }

    .error-tooltip::before {
        content: "";
        position: absolute;
        top: -9px;
        left: 11px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-bottom: 9px solid #f1f193;
    }

    @media(max-width:768px){
        .rfa-card{
            padding:25px;
        }

        .rfa-title{
            font-size:22px;
        }
    }
</style>


<div class="rfa-wrapper">
    <div class="notice-card">
        <h3 class="fw-bold mb-3">Mga Paalala</h3>

        <ul>
            <li>Pinatutunayan ko na ang aking mga ibinigay na impormasyon ay totoo at tama. Sa pagpapatuloy, binibigyan ko ng pahintulot ang DMW na:</li>
            <li>Iproseso ang aking datos (pagkolekta, pag-update, at pag-imbak) alinsunod sa R.A. 10173.</li>
            <li>Ibahagi ang aking impormasyon sa ibang ahensya ng gobyerno at LGU upang mapabilis ang pagpapaabot ng karagdagang tulong o serbisyo.</li>
            <li>Kinikilala ko ang aking mga karapatan sa ilalim ng Data Privacy Act of 2012, kabilang ang karapatang mag-access, magtama, o magbura ng aking personal na datos</li>
        </ul>

        <p>
            I-access at basahin ang DMW Data Privacy Notice na nakalakip na link bago magpatuloy. Ang pagpapatuloy ng aplikasyon ay nangangahulugang nabasa
            at naunawaan mo ang nilalaman nito alinsunod sa Data Privacy Act of 2012 (R.A. 10173).  
        </p>

        <a href="#">DMW Data Privacy Notice</a>

        
        <div class="form-check mt-3 position-relative">
            <input class="form-check-input" type="checkbox" id="agree">

            <label class="form-check-label" for="agree">
                Oo, sumasang-ayon ako.
            </label>

            <!-- Tooltip bubble -->
            <div id="agreeTooltip" class="error-tooltip">
                Pakicheck muna ang checkbox upang magpatuloy.
            </div>
        </div>

        <div class="text-end mt-3">
            <button class="btn btn-primary btn-continue px-4" id="continueBtn">Continue</button>
        </div>
    </div>

    

    
</div>

<<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkbox = document.getElementById('agree');
    const tooltip = document.getElementById('agreeTooltip');
    const continueBtn = document.getElementById('continueBtn');

    let hideTimeout;

    continueBtn.addEventListener('click', function () {

        if (!checkbox.checked) {

            // show tooltip with animation
            tooltip.classList.add('show');

            // clear previous timeout if clicked again
            clearTimeout(hideTimeout);

            // auto hide after 3 seconds
            hideTimeout = setTimeout(() => {
                tooltip.classList.remove('show');
            }, 3000);

            return;
        }

        // proceed if checked
        // window.location.href = "/next-page";
    });

    checkbox.addEventListener('change', function () {

        if (this.checked) {
            tooltip.classList.remove('show');
        }
    });

});
</script>

@endsection
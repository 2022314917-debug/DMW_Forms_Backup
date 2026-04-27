@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alyamama&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alyamama&family=Bebas+Neue&display=swap" rel="stylesheet">

<style>

    
.notice-wrapper{
    width:100%;
    display:flex;
    justify-content:center;
    margin-top:40px;
    height: fit-content;
    align-items:center;
    min-height:300px;
    position:relative;
}

.notice-wrapper::before {
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background:linear-gradient(135deg, rgba(220,200,100,0.1) 0%, rgba(200,180,80,0.1) 100%);
    z-index:-1;
}

.notice-box{
    background: linear-gradient(135deg, #ffc800b0 0%, #ffc800b0 100%);
    border-radius:20px;
    padding:50px 40px;
    max-width:700px;
    width:90%;
    box-shadow:0 10px 40px rgba(0,0,0,0.15);
    animation:fadeIn .3s ease;
    position:relative;
    border:2px solid rgba(255,255,255,0.3);
}

#modalOne .notice-box {
    background: linear-gradient(135deg, #ffc800b0 0%, #ffc800b0 100%);
}

#modalOne .notice-box h4 {
    color: #2a2a2a;
    font-size: 28px;
    letter-spacing: 0.5px;
}

#modalOne .notice-box ul {
    color: #3a3a3a;
    font-size: 16px;
    margin: 20px 0;
    padding-left: 25px;
}

#modalOne .notice-box li {
    margin: 12px 0;
    font-weight: 500;
}

#modalOne .text-end {
    margin-top: 30px;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(10px);}
    to{opacity:1; transform:translateY(0);}
}

.error-tooltip {
    position: absolute;
    bottom: -35px;
    left: 0;
    background: #dc3545;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    display: none;
}

.btn-continue {
    background-color: #1e5a96;
    color: white;
    padding: 10px 40px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-continue:hover {
    background-color: #164178;
    color:white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(30, 90, 150, 0.3);
}
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container">
    <!-- MODAL 1 -->
    <div class="notice-wrapper" id="modalOne">
        <div class="notice-box">
            <h1 class="fs-md-1 mb-4 text-center" style="font-family: 'Bebas Neue', sans-serif;">ONLINE REQUEST FOR ASSISTANCE</h1>

            <ul class="px-1 px-md-5" style="font-family: 'Alyamama', sans-serif;">
                <li><p class="fs-md-5">Punan ang lahat ng hinihinging impormasyon ng RFA Online Form.</p></li>
                <li><p class="fs-md-5">Siguraduhing kumpleto at tama ang detalye bago isumite upang mabilis na maiproseso ang inyong application.</p></li>
            </ul>

            <div class="text-end mt-4">
                <button class="btn btn-continue" id="continueToSecond">
                    Continue
                </button>
            </div>
        </div>
    </div>


    <!-- MODAL 2 -->
    <div class="notice-wrapper" id="modalTwo" style="display:none;">
        <div class="notice-box">

            <p class="fs-1 mb-3" style="font-family: 'Bebas Neue', sans-serif;">Mga Paalala</p>

            <ul style="font-family: 'Alyamama', sans-serif;">
                <li><p class="fs-md-5">Pinatutunayan ko na ang aking mga ibinigay na impormasyon ay totoo at tama. Sa pagpapatuloy, binibigyan ko ng pahintulot ang DMW na:</p></li>
                <li><p class="fs-md-5">Iproseso ang aking datos (pagkolekta, pag-update, at pag-imbak) alinsunod sa R.A. 10173.</p></li>
                <li><p class="fs-md-5">Ibahagi ang aking impormasyon sa ibang ahensya ng gobyerno at LGU upang mapabilis ang pagpapaabot ng karagdagang tulong o serbisyo.</p></li>
                <li><p class="fs-md-5">Kinikilala ko ang aking mga karapatan sa ilalim ng Data Privacy Act of 2012, kabilang ang karapatang mag-access, magtama, o magbura ng aking personal na datos</p></li>
            </ul>

            <p>
                I-access at basahin ang DMW Data Privacy Notice bago magpatuloy.
            </p>

            <a href="#">DMW Data Privacy Notice</a>

            <div class="form-check mt-3 position-relative">
                <input class="form-check-input" type="checkbox" id="agree">
                <label class="form-check-label">
                    Oo, sumasang-ayon ako.
                </label>

                <div id="agreeTooltip" class="error-tooltip">
                    Pakicheck muna ang checkbox upang magpatuloy.
                </div>
            </div>

            <div class="text-end mt-3">
                <button class="btn btn-continue" id="continueBtn">
                    Continue
                </button>
            </div>

        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function(){

    const modalOne = document.getElementById('modalOne');
    const modalTwo = document.getElementById('modalTwo');

    document.getElementById('continueToSecond').addEventListener('click', function(){
        modalOne.style.display = 'none';
        modalTwo.style.display = 'flex';
    });

    const checkbox = document.getElementById('agree');
    const tooltip = document.getElementById('agreeTooltip');

    document.getElementById('continueBtn').addEventListener('click', function(){

        if(!checkbox.checked){
            tooltip.style.display = 'block';

            setTimeout(()=>{
                tooltip.style.display = 'none';
            },2500);

            return;
        }

        window.location.href = "{{ url('/forms/step/general') }}";
    });

});
</script>

@endsection
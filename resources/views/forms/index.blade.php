@extends('layouts.app')

@section('content')

<style>

    
.notice-wrapper{
    width:100%;
    display:flex;
    justify-content:center;
    margin-top:40px;
    height: fit-content; /* ← add this */
}

.notice-box{
    background: rgba(255,255,255,0.95);
    border-radius:12px;
    padding:30px;
    max-width:600px;
    width:100%;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    animation:fadeIn .3s ease;
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
    background-color: #3b66b0;
    color: white;
    padding: 8px 30px;
    border-radius: 8px;
}

.btn-continue:hover {
    background-color: #2a4d7c;
    color:white;
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
            <h4 class="fw-bold mb-3">Online Request For Assistance</h4>

            <ul>
                <li>Punan ang lahat ng hinihinging impormasyon ng RFA Online Form.</li>
                <li>Siguraduhing kumpleto at tama ang detalye bago isumite.</li>
            </ul>

            <div class="text-end mt-3">
                <button class="btn btn-continue" id="continueToSecond">
                    Continue
                </button>
            </div>
        </div>
    </div>


    <!-- MODAL 2 -->
    <div class="notice-wrapper" id="modalTwo" style="display:none;">
        <div class="notice-box">

            <h3 class="fw-bold mb-3">Mga Paalala</h3>

            <ul>
                <li>Pinatutunayan ko na ang aking mga ibinigay na impormasyon ay totoo at tama.</li>
                <li>Iproseso ang aking datos alinsunod sa R.A. 10173.</li>
                <li>Ibahagi ang aking impormasyon sa ibang ahensya ng gobyerno.</li>
                <li>Kinikilala ko ang aking mga karapatan sa ilalim ng Data Privacy Act.</li>
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
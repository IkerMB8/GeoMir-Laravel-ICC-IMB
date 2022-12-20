@extends('layouts.app')
@section('content')
<style>
    .imgSNF{
        filter: grayscale(100%);
    }
    .imgSNC{
        filter: contrast(200%);
    }
    .imgSN:hover {
        width: 300px;
        transition: width 2s;
    }

    @keyframes rotate {from {transform: rotate(0deg);}
        to {transform: rotate(360deg);}}
    @-webkit-keyframes rotate {from {-webkit-transform: rotate(0deg);}
        to {-webkit-transform: rotate(360deg);}}
    .imgSN:hover{
        -webkit-animation: 3s rotate linear infinite;
        animation: 3s rotate linear infinite;
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
    }
    #imagen{
        -webkit-animation-direction: reverse;
        animation-direction: reverse;
    }
    
</style>
<div class="contenidoSN">
    <audio id="españa">
        <source src="/img/españa.mp3" type="audio/mp3">
    </audio>
    <audio id="barsa">
        <source src="/img/barsa.mp3" type="audio/mp3">
    </audio>
    <div class="card">
        <img src="img_avatar.png" alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b>Iker Castellano</b></h4> 
            <p>Co-Owner</p> 
        </div>
    </div>
    <div class="card">
        <img src="img_avatar.png" alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b>Iker Castellano</b></h4> 
            <p>Co-Owner</p> 
        </div>
    </div>
</div>
@vite('resources/js/bootstrap.js')

@endsection
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


</div>
<script>
    var aud = document.getElementById("españa"); 
    var bar = document.getElementById("barsa");  

    //IMAGEN HOVER
    var imagen=document.getElementById('imagen');
    window.addEventListener('load', iniciar, false);
    window.addEventListener('load', parar, false);

    function iniciar(){
        imagen.addEventListener('mouseover', iniciarF, false);
    }

    function parar(){
        imagen.addEventListener('mouseout', pararF, false);
    }

    function pararF(){
        document.getElementById('imagen').src="/img/iker.png";
        aud.pause();
        imagen.classList.add('imgSNF');
        imagen.classList.remove('imgSNC');
    }

    function iniciarF(){
        document.getElementById('imagen').src="/img/image0.jpg";
        aud.play();
        imagen.classList.remove('imgSNF');
        imagen.classList.add('imgSNC');
    }

    

    
    var imagen2=document.getElementById('imagen2');
    window.addEventListener('load', iniciar2, false);
    window.addEventListener('load', parar2, false);

    function iniciar2(){
        imagen2.addEventListener('mouseover', iniciar2F, false);
    }

    function parar2(){
        imagen2.addEventListener('mouseout', parar2F, false);
    }

    function parar2F(){
        document.getElementById('imagen2').src="/img/iker.png";
        bar.pause();
        imagen2.classList.add('imgSNF');
        imagen2.classList.remove('imgSNC');
    }

    function iniciar2F(){
        document.getElementById('imagen2').src="/img/es.png";
        bar.play();
        imagen2.classList.remove('imgSNF');
        imagen2.classList.add('imgSNC');
    }



    var vid = document.getElementById("myVideo"); 

    function playVid() { 
        vid.play(); 
    } 

    function pauseVid() { 
        vid.pause(); 
    } 
</script>
@vite('resources/js/bootstrap.js')

@endsection
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
    <div class="arriba">
        <h1 class="h1SN">Conócenos</h1>
        <audio id="españa">
            <source src="/img/españa.mp3" type="audio/mp3">
        </audio>
        <audio id="barsa">
            <source src="/img/barsa.mp3" type="audio/mp3">
        </audio>
    </div>
    <div class="abajo">
        <div class="fotosSN">
            <button type="button" style="border:0; padding:0;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img class="imgSN imgSNF" id="imagen" src="img/iker.png"></img>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button onclick="playVid()" type="button">Play Video</button>
                    <button onclick="pauseVid()" type="button">Pause Video</button><br> 
                    <video id="myVideo" width="320px" height="176px">
                        <source src="mov_bbb.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
            </div>                                                                              






            <h4 class="h4SN">Iker Castellano</h4>
            <div class="cambiar">
                <a href="">
                <big>
                <p class="pSN">Co-Owner</p>
                </big>
                <span>
                    <p class="pSN">Soy amante del fútbol</p>
                </span>
                </a>
            </div>
        </div>
        <div class="fotosSN">
            <img class="imgSN imgSNF" id="imagen2" src="img/iker.png"></img>
            <h4 class="h4SN">Iker Martínez</h4>
            <div class="cambiar">
                <a href="">
                <big>
                <p class="pSN">Co-Owner</p>
                </big>
                <span>
                    <p class="pSN">Soy amante de los gatos</p>
                </span>
                </a>
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
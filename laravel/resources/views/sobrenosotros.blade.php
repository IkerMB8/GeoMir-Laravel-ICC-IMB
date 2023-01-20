@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<style>

    /* Aquesta clase (.botoneraVid) serveix per personalitzar el div dels botons per quan obres el modal de cada integrant del grup */
    .botoneraVid{
        width:100%;
        display:flex;
        justify-content:center;
    }

    /* Aquesta clase (video) serveix per modificar la grandària del video del modal */
    video{
        width: 100%;
        height: 100%;
    }

    /* Aquesta clase (.h1video) serveix per modificar el color del text (VIDEO) quan obres el modal */
    .h1video{
        color:white;
    }

    /* Aquesta clase (.modal-content) serveix per modificar el color de fons del modal */
    .modal-content{
        background-color: #1A1830 !important;
    }

    /* Aquesta clase (.modalBody) serveix per modificar la posició del lloc on es troben els botons del modal (Play Video i Pause Video) */
    .modalBody{
        display: flex;
        justify-content:center;
        flex-direction: column;
        width:10%;
    }


    /* Aquesta clase (.imgSNF) serveix per modificar el color de la foto sèria, aplicant el filtre en blanc i negre */
    .imgSNF{
        filter: grayscale(100%);
    }

    /* Aquesta clase (.imgSNC) serveix per modificar el color de la foto divertida, aplicant més contrast. */
    .imgSNC{
        filter: contrast(200%);
    }

    /* Aquesta clase (.btoVID) serveix per modificar el botó del modal, donant-li un color de fons, una vora, padding, etc... */
    .btoVID{
        padding:15px;
        border-radius: 25px;
        border: 2px solid black;
        background-color:white;
    }

    /* Això no és una clase però es l'animació que fa que les imatges girin continuament */
    @keyframes rotate {from {transform: rotate(0deg);}
        to {transform: rotate(360deg);}}
    @-webkit-keyframes rotate {from {-webkit-transform: rotate(0deg);}
        to {-webkit-transform: rotate(360deg);}}


    /* Aquesta clase (.cardgiratorio:hover) serveix per activar l'animació d'abans */
    .cardgiratorio:hover{
        -webkit-animation: 3s rotate linear infinite;
        animation: 3s rotate linear infinite;
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
    }

    /* Aquesta id (.imagen) serveix, entre d'altres, per fer que una imatge giri cap un costat i l'altre cap altra. */
    #imagen{
        -webkit-animation-direction: reverse;
        animation-direction: reverse;
    }

    /* Aquesta clase (.imagenIC) serveix per fer el sprite de la imatge sèria de l'Iker Castellano */
    .imagenIC{
        background: url(/img/collage.png) -14px -11px;  
        filter: grayscale(100%);
        height: 458px;
        width: 100%;
    }

    /* Aquesta clase (.imagenIC:hover) serveix per canviar la foto sèria de l'Iker Castellano a la divertida */
    .imagenIC:hover{
        background: url(/img/collage.png) -14px 450px;  
        filter: contrast(150%);
    }


    /* Aquesta clase (.imagenIM) serveix per fer el sprite de la imatge sèria de l'Iker Martinez */
    .imagenIM{
        background: url(/img/collage.png) -375px -485px;  
        filter: grayscale(100%);
        height: 458px;
        width: 100%;
    }

    /* Aquesta clase (.imagenIM:hover) serveix per canviar la foto sèria de l'Iker Martinez a la divertida */
    .imagenIM:hover{
        background: url(/img/collage.png) -375px -11px;
        filter: contrast(150%);  
    }

    
</style>


<!-- Modal Iker C -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="h1video" >VIDEO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="botoneraVid">
                                <div class="modalBody">
                                    <button onclick="playVid1()" class="btoVID" type="button">Play Video</button>
                                    <br>
                                    <button onclick="pauseVid1()" class="btoVID" type="button">Pause Video</button>
                                </div>
                            </div>
                            <br>
                            <video id="myVideo1" width="320px" height="176px">
                                <source src="/img/iniesta.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="carousel-item">
                            <div class="botoneraVid">
                                <div class="modalBody">
                                    <button onclick="playVid2()" class="btoVID" type="button">Play Video</button>
                                    <br>
                                    <button onclick="pauseVid2()" class="btoVID" type="button">Pause Video</button>
                                </div>
                            </div>
                            <br>
                            <video id="myVideo2" width="320px" height="176px">
                                <source src="/img/cocinero.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Iker M -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="h1video">VIDEO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <br> 
                <div id="carouselExampleControls2" class="carousel" data-bs-ride="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="botoneraVid">
                                <div class="modalBody">
                                    <button onclick="playVid3()" class="btoVID" type="button">Play Video</button>
                                    <br>
                                    <button onclick="pauseVid3()" class="btoVID" type="button">Pause Video</button>
                                </div>
                            </div>
                            <br>
                            <video id="myVideo3" width="320px" height="176px">
                                <source src="/img/rajoy.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="carousel-item">
                            <div class="botoneraVid">
                                <div class="modalBody">
                                    <button onclick="playVid4()" class="btoVID" type="button">Play Video</button>
                                    <br>
                                    <button onclick="pauseVid4()" class="btoVID" type="button">Pause Video</button>
                                </div>
                            </div>
                            <br>
                            <video id="myVideo4" width="320px" height="176px">
                                <source src="/img/españoles.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>  
            </div>
        </div>
    </div>
</div>
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
        <div class="card " style="width: 18rem;">
            <button type="button" style="border:0; padding:0;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <div class="card-img-top cardgiratorio imagenIC" id="imagen" alt="Card image cap"></div>
            </button>
            <div class="card-body">
                <h5 class="card-title">Iker Castellano</h5>
                <p class="card-text" id="S1">Co-Owner</p>
                <p class="card-text noshow" id="NS1">Amante de las pelotas</p>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <button type="button" style="border:0; padding:0;" data-bs-toggle="modal" data-bs-target="#Modal">
                <div class="card-img-top cardgiratorio imagenIM" id="imagen2" alt="Card image cap"></div>
            </button>
            <div class="card-body">
                <h5 class="card-title">Iker Martinez</h5>
                <p class="card-text" id="S2">Co-Owner</p>
                <p class="card-text noshow" id="NS2">Paseador de caracoles</p>
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
        // document.getElementById('imagenIC').src="/img/collage.png";
        aud.pause();
        imagen.classList.add('imgSNF');
        imagen.classList.remove('imgSNC');
        document.getElementById('S1').classList.remove('noshow');
        document.getElementById('NS1').classList.add('noshow');
    }

    function iniciarF(){
        // document.querySelectorAll('.imagenIC2').src="/img/collage.png";
        aud.play();
        imagen.classList.remove('imgSNF');
        imagen.classList.add('imgSNC');
        document.getElementById('S1').classList.add('noshow');
        document.getElementById('NS1').classList.remove('noshow');
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
        bar.pause();
        imagen2.classList.add('imgSNF');
        imagen2.classList.remove('imgSNC');
        document.getElementById('S2').classList.remove('noshow');
        document.getElementById('NS2').classList.add('noshow');
    }

    function iniciar2F(){
        bar.play();
        imagen2.classList.remove('imgSNF');
        imagen2.classList.add('imgSNC');
        document.getElementById('S2').classList.add('noshow');
        document.getElementById('NS2').classList.remove('noshow');
    }


    var vid = document.getElementById("myVideo1"); 

    function playVid1() { 
        vid.play(); 
    } 

    function pauseVid1() { 
        vid.pause(); 
    }

    var vid2 = document.getElementById("myVideo2"); 

    function playVid2() { 
        vid2.play(); 
    } 

    function pauseVid2() { 
        vid2.pause(); 
    }


    var vid3 = document.getElementById("myVideo3"); 

    function playVid3() { 
        vid3.play(); 
    } 

    function pauseVid3() { 
        vid3.pause(); 
    }



    var vid4 = document.getElementById("myVideo4"); 

    function playVid4() { 
        vid4.play(); 
    } 

    function pauseVid4() { 
        vid4.pause(); 
    }

    const drag = document.querySelector(".abajo");

        Sortable.create(drag, {
            animation: 350,
            dragClass: "drag"
        }
    );
</script>
@env(['local','development'])
    @vite('resources/js/bootstrap.js')
@endenv
@endsection
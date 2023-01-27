@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<style>
.navegador {
    width: 100%;
    height: 79px;
    background-color: white;
    top: 0;
    margin: 0;
    position: absolute !important;
    display: flex;
    background-color: #1A1830;
}

.navfiltros{
    display:none !important;
}

.divVideo{
    margin-top: 56px;
    text-align:center;
    background-color: black;
}

.web-accessibility-menu-button{
    display:none !important;
}

.gif{
    width: 100%;
    opacity: 0.4;
}

.encima{
    position: absolute;
    top: 45%;
    left: 42%;
    color: white;
}

.encima2{
    position: absolute;
    top: 50%;
    left: 42.5%;
    color: white;
}

.btnGif{
    position: absolute;
    top: 55%;
    color: white;
    background-color: #1a1830;
    left: 44.5%;
    opacity: 0.6;
    border: 1px solid lightgray;
    padding: 10px;
    border-radius: 15px;
}

.pie{
    height: 15vh;
    width: 100%;
    background-color: #1a1830;
    display: flex;
    justify-content: center;
    color: white;
    position: absolute;
}

.pie_div{
    display: flex;
    flex-direction: row;
    gap: 18px;
    align-items: center;
    justify-content: center;
}

.pie_tabla{
    text-align: center;
    justify-content: center;
    font-size: 0.6em;
}

.pie_RS{
    display: flex;
    justify-content: space-evenly;
}

a{
    text-decoration: none;
    color: white;
}

a:hover{
    color:white;
}

.divMAPA{
    background-color: #fafce1;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.divMAPA_h1{
    margin-top: 2%;
    font-size: 3em;
}

.divMAPA_img{
    width:950px; 
    height: 700px
}
</style>

<div class="divVideo">
    <img class="gif" src="/img/paisaje.gif"/>
    <h1 class="encima">CONTACTA'NS!</h1>
    <h3 class="encima2">Envia el teu missatge</h3>
    <a class="btnGif" href="./contact" target="blank">Formulario de Contacto</a>
</div>
<div class="divMAPA">
    <h1 class="divMAPA_h1">Vols visitar-nos?</h1>
    <h4>Ubica'ns al mapa!</h4>
    <img class="divMAPA_img" src="/img/mapa.png">
</div>
<div class="pie">
    <div class="pie_div">
        <div class="pie_tabla">
            <table>
                <tr>
                    <td>
                        <h3>SÍGUENOS EN REDES!</h3>
                    </td>
                </tr>
                <tr>
                    <td class="pie_RS">
                        <a href="https://twitter.com/ikercc44/" class="fa-brands fa-3x fa-twitter"></a>
                        <a href="https://instagram.com/ikercc4/" class="fa-brands fa-3x fa-instagram"></a>
                        <a href="https://www.facebook.com/iker.castellano.3154" class="fa-3x fa fa-facebook"></a>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
</div>
<script>

</script>
@vite('resources/js/bootstrap.js')

@endsection
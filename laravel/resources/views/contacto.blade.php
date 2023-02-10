@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>
<script src="keymaster.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

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

#map { 
    height: 80%;
    width: 70%;
}


</style>

<div class="divVideo">
    <img class="gif" src="/img/paisaje.gif"/>
    <h1 class="encima">CONTACTA'NS!</h1>
    <h3 class="encima2">Envia el teu missatge</h3>
    <a class="btnGif" href="./contact" accesskey="f" target="blank">Formulario de Contacto</a>
</div>
<div class="divMAPA">
    <h1 class="divMAPA_h1">Vols visitar-nos?</h1>
    <h4>Ubica'ns al mapa!</h4>
    <div id="map">
        <script>
            var map = L.map('map').setView([41.2310177, 1.7279358], 19);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            L.Routing.control({
            waypoints: [
                L.latLng(41.2313177, 1.72849),
                L.latLng(41.22256157954006, 1.710204524207295)
            ]
            }).addTo(map);
        </script>
    </div>
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
                        <a href="https://twitter.com/ikercc44/" accesskey="t" class="fa-brands fa-3x fa-twitter"></a>
                        <a href="https://instagram.com/ikercc4/" accesskey="i" class="fa-brands fa-3x fa-instagram"></a>
                        <a href="https://www.facebook.com/iker.castellano.3154" accesskey="a" class="fa-3x fa fa-facebook"></a>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
</div>
<script>
    ///Circulo MIR
    L.circle([41.2313177, 1.72869], {color: 'red',fillColor: '#f03',fillOpacity: 0.5,radius: 50}).addTo(map);

    // 4.2 ATAJOS DE TECLADO

    document.onkeyup = function(e) {
        if (e.ctrlKey && e.altKey && e.which == 71){
            var opciones = {
                enableHighAccuracy: true,
                timeout: 6000,
                maximumAge: 0
            };
            navigator.geolocation.getCurrentPosition( success, error, options );
            function success(position) {
                var coordenadas = position.coords;
                alert("Tu posición actual es: "+
                "\n- Latitud: " + coordenadas.latitude+
                "\n- Longitude: " + coordenadas.longitude+
                "\n- Rango de error de " + coordenadas.accuracy + " metros");
            };
            function error(error) {
                console.warn('ERROR(' + error.code + '): ' + error.message);
            };
        }   else if (e.ctrlKey && e.altKey && e.which == 67){
            map.remove();
            map = L.map('map').setView([41.2313177,  1.72869], 19);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
                maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a'
            }).addTo(map);

            circle = L.circle([41.2313, 1.72867], {color: 'red',fillColor: '#f03',fillOpacity: 0.5,radius:50}).addTo(map);
            // navigator.geolocation.getCurrentPosition(showPosition);

            // function showPosition(position) {
            //     marker = L.marker([position.coords.latitude , position.coords.longitude])addTo(map);
            // }
            L.Routing.control({
            waypoints: [
                L.latLng(41.2313177, 1.72849),
                L.latLng(41.22256157954006, 1.710204524207295)
            ]
            }).addTo(map);
        }
    };

</script>

@vite('resources/js/bootstrap.js')

@endsection
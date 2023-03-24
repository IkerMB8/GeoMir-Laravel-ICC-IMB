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
    .divVideo__titulo{
        color: white;
        margin: 0;
        margin-bottom: 20px;
    }
    .divVideo__btnGif{
        color: white;
        background-color: #1a1830;
        border: 1px solid lightgray;
        padding: 10px;
        border-radius: 15px;
    }
    .divVideo__btnGif:hover{
        filter: invert(100%);
    }
    .divVideo{
        background-color: black;
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(./img/paisaje.gif);
        background-position: center;
        height: 950px;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .divVideo div{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    
    /* DEFINIMOS EL NAV DE ARRIBA, SU COLOR, POSICION, ETC */
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

    /* DEFINIMOS QUE NO QUEREMOS QUE APAREZCAN LOS FILTROS */
    .navfiltros{
        display:none !important;
    }

    /* DEFINIMOS QUE NO SALGA EL BOTON DE ACCESIBILIDAD */
    .web-accessibility-menu-button{
        position: absolute;
    }

    /* DEFINIMOS LA ANCHURA DEL VIDEO Y SU OPACIDAD */
    .gif{
        width: 100%;
        opacity: 0.4;
    }

    /* DEFINIMOS LOS OBJETOS DEL FOOTER */
    .encima{
        position: absolute;
        top: 45%;
        left: 42%;
        color: white;
    }

    /* DEFINIMOS LA POSICION DEL H3 */
    .encima2{
        position: absolute;
        top: 50%;
        left: 42.5%;
        color: white;
    }

    /* DEFINIMOS EL BOTON DE CONTACTO */
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

    /* DEFINIMOS EL FOOTER */
    .pie{
        height: 15vh;
        width: 100%;
        background-color: #1a1830;
        display: flex;
        justify-content: center;
        color: white;
        position: absolute;
    }

    /* DEFINIMOS EL DIV DEL FOOTER */
    .pie_div{
        display: flex;
        flex-direction: row;
        gap: 18px;
        align-items: center;
        justify-content: center;
    }

    /* DEFINIMOS LOS OBJETOS DEL FOOTER */
    .pie_tabla{
        text-align: center;
        justify-content: center;
        font-size: 0.6em;
    }

    /* DEFINIMOS LA SEPARACION DE LOS OBJETOS DEL FOOTER */
    .pie_RS{
        display: flex;
        justify-content: space-evenly;
    }

    /* DEFINIMOS EL COLOR DE LOS LINKS Y QUE NO ESTEN SUBRAYADOS */
    a{
        text-decoration: none;
        color: white;
    }

    /* DEFINIMOS EL COLOR DE LOS LINKS AL PASAR POR ENCIMA DE ELLOS */
    a:hover{
        color:white;
    }

    /* DEFINIMOS EL COLOR DE FONDO, ALTURA, I PERSONALIZAMOS EL DIV DONDE ESTA SITUADO EL MAPA */
    .divMAPA{
        background-color: #fafce1;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* DEFINIMOS EL TAMAÑO DEL TEXTO "VOLS VISITAR-NOS" */
    .divMAPA_h1{
        margin-top: 2%;
        font-size: 3em;
    }

    /* DEFINIMOS LA ALTURA I LA ANCHURA DE LA IMAGEN DE FONDO */
    .divMAPA_img{
        width:950px; 
        height: 700px
    }

    /* DEFINIMOS LA ALTURA I LA ANCHURA DEL MAPA */
    #map { 
        height: 80%;
        width: 70%;
    }


</style>

<div class="divVideo">
    <div>
        <h1 class="divVideo__titulo">CONTACTA'NS!</h1>
        <h2 class="divVideo__titulo">Envia el teu missatge</h2>
        <a class="divVideo__btnGif" href="./contact" accesskey="f" target="blank">Formulario de Contacto</a>
    </div>
</div>
<div class="divMAPA">
    <h1 class="divMAPA_h1">Vols visitar-nos?</h1>
    <h4>Ubica'ns al mapa!</h4>
    <div id="map">
        <script>
            ///  DEFINIMOS El MAPA, Y LE DAMOS UNAS COORDENADAS INICIALES
            var map = L.map('map').setView([41.2310177, 1.7279358], 19);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            ///DEFINIMOS AMBAS PARTES DE LA RUTA
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
                <th><h3>SÍGUENOS EN REDES!</h3></th>
                <tr>
                    <td class="pie_RS">
                        <a href="https://twitter.com/ikercc44/" accesskey="t" class="fa-brands fa-3x fa-twitter"><span class="noshow">Twitter</span></a>
                        <a href="https://instagram.com/ikercc4/" accesskey="i" class="fa-brands fa-3x fa-instagram"><span class="noshow">Instagram</span></a>
                        <a href="https://www.facebook.com/iker.castellano.3154" accesskey="a" class="fa-3x fa fa-facebook"><span class="noshow">Facebook</span></a>
                        <a href="https://www.w3.org/WAI/WCAG2AAA-Conformance" title="Explanation of WCAG 2 Level AAA Conformance">
                            <img height="32" width="88" src="https://www.w3.org/WAI/WCAG21/wcag2.1AAA-v" alt="Level AAA conformance,W3C WAI Web Content Accessibility Guidelines 2.1">
                        </a>
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
            navigator.geolocation.getCurrentPosition( success, error, opciones );
            function success(position) {
                var coordenadas = position.coords;
                alert("Tus coordenadas son: "+
                "\nLatitud: " + coordenadas.latitude+
                "\nLongitude: " + coordenadas.longitude+
                "\nRango de error de " + coordenadas.accuracy + " metros");
            };
            function error(error) {
                console.warn('ERROR(' + error.code + '): ' + error.message);
            };
        }   else if (e.ctrlKey && e.altKey && e.which == 67){  ///PRESIONANDO CTRL + ALT + C HACEMOS QUE EL MAPA SE REINICIE.
            map.remove();
            map = L.map('map').setView([41.2313177,  1.72869], 19);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
                maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a'
            }).addTo(map);

            circle = L.circle([41.2313, 1.72867], {color: 'red',fillColor: '#f03',fillOpacity: 0.5,radius:50}).addTo(map);
           
            L.Routing.control({
            waypoints: [
                L.latLng(41.2313177, 1.72849),
                L.latLng(41.22256157954006, 1.710204524207295)
            ]
            }).addTo(map);
        }
    };
    
    /////////////////////////////////////////////////////////////////////
    // AQUI EMPIEZA JS DE ACCESIBILIDAD
    /////////////////////////////////////////////////////////////////////

    const recognition = new webkitSpeechRecognition();

    // Configuramos la instancia
    recognition.continuous = true;
    recognition.interimResults = false;
    recognition.lang = 'es-ES';

    // Al dar al botón, comienza a escuchar la voz del usuario
    document.getElementById('voice').addEventListener('click', () => {
        recognition.start();
    });

    // Cuando se detecta una palabra clave, hace una función
    recognition.onresult = (event) => {
    const last = event.results.length - 1;
    const command = event.results[last][0].transcript.toLowerCase();
    console.log(command);
    // Al detectar la palabra subir página, sube la vista de la página
    if (command.includes('subir página')) {
        window.scrollBy(0, -window.innerHeight);
    // Al detectar la palabra bajar página, baja la vista de la página
    }else if (command.includes('bajar página')) {
        window.scrollBy(0, window.innerHeight);
    // Al detectar la palabra alejar mas, aleja el zoom de la página
    }else if (command.includes('alejar más')) {
        document.body.style.zoom="50%"
    // Al detectar la palabra alejar, deja el zoom default
    }else if (command.includes('alejar')) {
        document.body.style.zoom="100%"
    // Al detectar la palabra acercar, pone el zoom de la página a 150%
    }else if (command.includes('acercar')) {
        document.body.style.zoom="150%"
    // Al detectar la palabra acercar mas, pone el zoom de la página a 200%
    }else if (command.includes('acercar más')) {
        document.body.style.zoom="200%"
    }
    };

    // Al detectar la combinación ctrl, alt + l reinicia el zoom y sube arriba del todo de la página
    document.addEventListener("keydown", (e) => {
    if (e.ctrlKey && e.altKey && e.key === "l") {
        document.body.style.zoom="100%"
        window.scrollBy(-50, -window.innerHeight);
    }
    });
</script>

@vite('resources/js/bootstrap.js')
@endsection
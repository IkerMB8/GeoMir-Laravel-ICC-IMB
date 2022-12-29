import _ from 'lodash';
window._ = _;

import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });


// const toggle = document.querySelector(".toggle");
// const menu = document.querySelector(".menu");
// const items = document.querySelectorAll(".item");

// /* Toggle mobile menu */
// function toggleMenu() {
//   if (menu.classList.contains("active")) {
//     menu.classList.remove("active");
//     toggle.querySelector("a").innerHTML = "<i class='fas fa-bars'></i>";
//   } else {
//     menu.classList.add("active");
//     toggle.querySelector("a").innerHTML = "<i class='fas fa-times'></i>";
//   }
// }

// /* Activate Submenu */
// function toggleItem() {
//   if (this.classList.contains("submenu-active")) {
//     this.classList.remove("submenu-active");
//   } else if (menu.querySelector(".submenu-active")) {
//     menu.querySelector(".submenu-active").classList.remove("submenu-active");
//     this.classList.add("submenu-active");
//   } else {
//     this.classList.add("submenu-active");
//   }
// }

// /* Close Submenu From Anywhere */
// function closeSubmenu(e) {
//   if (menu.querySelector(".submenu-active")) {
//     let isClickInside = menu
//       .querySelector(".submenu-active")
//       .contains(e.target);

//     if (!isClickInside && menu.querySelector(".submenu-active")) {
//       menu.querySelector(".submenu-active").classList.remove("submenu-active");
//     }
//   }
// }
// /* Event Listeners */
// toggle.addEventListener("click", toggleMenu, false);
// for (let item of items) {
//   if (item.querySelector(".submenu")) {
//     item.addEventListener("click", toggleItem, false);
//   }
//   item.addEventListener("keypress", toggleItem, false);
// }
// document.addEventListener("click", closeSubmenu, false);

(function() {

  let boton = document.getElementById("cambiaColor1");
  boton.addEventListener("click", cambia);
  
  let contador = 0;
  
  function cambia() {
    if (contador % 2 ==0) {
        boton.style.backgroundColor= "#EFCEFF";
    } else {
        boton.style.backgroundColor = "white";
    }
    contador += 1;
  }
})();

(function() {

  let boton = document.getElementById("cambiaColor2");
  boton.addEventListener("click", cambia);
  
  let contador = 0;
  
  function cambia() {
    if (contador % 2 ==0) {
        boton.style.backgroundColor= "#EFCEFF";
    } else {
        boton.style.backgroundColor = "white";
    }
    contador += 1;
  }
})();

(function() {

  let boton = document.getElementById("cambiaColor3");
  boton.addEventListener("click", cambia);
  
  let contador = 0;
  
  function cambia() {
    if (contador % 2 ==0) {
        boton.style.backgroundColor= "#EFCEFF";
    } else {
        boton.style.backgroundColor = "white";
    }
    contador += 1;
  }
})();

(function() {

  let boton = document.getElementById("cambiaColor4");
  boton.addEventListener("click", cambia);
  
  let contador = 0;
  
  function cambia() {
    if (contador % 2 ==0) {
        boton.style.backgroundColor= "#EFCEFF";
    } else {
        boton.style.backgroundColor = "white";
    }
    contador += 1;
  }
})();

(function() {

  let boton = document.getElementById("cambiaColor5");
  boton.addEventListener("click", cambia);
  
  let contador = 0;
  
  function cambia() {
    if (contador % 2 ==0) {
        boton.style.backgroundColor= "#EFCEFF";
    } else {
        boton.style.backgroundColor = "white";
    }
    contador += 1;
  }
})();

// // POPUP BOTÓN AÑADIR
// var btnPopupAddO = document.getElementById('open-add'),
//     overlayadd = document.getElementById('overlayadd'),
//     popupadd = document.getElementById('popupadd'),
//     btnPopupAddC = document.getElementById('close-add');

// btnPopupAddO.addEventListener('click', function(){
//     overlayadd.classList.add('active');
//     popupadd.classList.add('active');
// });

// btnPopupAddC.addEventListener('click', function(e){
//     e.preventDefault();
//     overlayadd.classList.remove('active');
//     popupadd.classList.remove('active');
// });

// POPUP LOGIN
var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
    overlay = document.getElementById('overlay'),
    popup = document.getElementById('popup'),
    btnCerrarPopup = document.getElementById('btn-cerrar-popup');

btnAbrirPopup.addEventListener('click', function(){
    overlay.classList.add('active');
    popup.classList.add('active');
});

btnCerrarPopup.addEventListener('click', function(e){
    e.preventDefault();
    overlay.classList.remove('active');
    popup.classList.remove('active');
});

// POPUP REGISTER
var btnAbrirPopup2 = document.getElementById('btn-abrir-popup2'),
    overlay2 = document.getElementById('overlay2'),
    popup2 = document.getElementById('popup2'),
    btnCerrarPopup2 = document.getElementById('btn-cerrar-popup2');

btnAbrirPopup2.addEventListener('click', function(){
    overlay2.classList.add('active');
    popup2.classList.add('active');
});

btnCerrarPopup2.addEventListener('click', function(e){
    e.preventDefault();
    overlay2.classList.remove('active');
    popup2.classList.remove('active');
});


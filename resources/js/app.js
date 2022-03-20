require('./bootstrap');



import 'alpinejs'
import Swal from 'sweetalert2'
import Compress from 'compressorjs'



var Turbolinks = require("turbolinks");
//Turbolinks.start();

document.addEventListener("turbolinks:load", function(event){
    Turbolinks.start(); 
});

// document.addEventListener("turbolinks:load", function(event){
//     Turbolinks.start(); //window.livewire.restart();
// });
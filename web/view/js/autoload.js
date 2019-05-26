var url = window.location;
var buscar = decodeURI(url).split('/');
var contarArray = buscar.length;
var importar = document.createElement('script');
importar.src = './view/js/' + buscar[contarArray - 1] + '.js';
document.head.appendChild(importar);
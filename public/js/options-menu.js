/******/ (() => { // webpackBootstrap
/*!**************************************!*\
  !*** ./resources/js/options-menu.js ***!
  \**************************************/
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.options-icon').forEach(function (icon) {
    icon.addEventListener("click", function (event) {
      event.stopPropagation();

      // Cierra todos los menús abiertos
      document.querySelectorAll('.options-menu').forEach(function (menu) {
        menu.style.display = "none";
      });

      // Toggle el menú de opciones correspondiente
      var optionsMenu = this.nextElementSibling;
      optionsMenu.style.display = optionsMenu.style.display === "block" ? "none" : "block";
    });
  });

  // Cerrar el menú al hacer clic fuera
  document.addEventListener('click', function (event) {
    if (!event.target.closest('.btn-container')) {
      document.querySelectorAll('.options-menu').forEach(function (menu) {
        menu.style.display = 'none';
      });
    }
  });
});
/******/ })()
;
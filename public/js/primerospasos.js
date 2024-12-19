/******/ (() => { // webpackBootstrap
/*!***************************************!*\
  !*** ./resources/js/primerospasos.js ***!
  \***************************************/
document.addEventListener('DOMContentLoaded', function () {
  var slides = document.querySelectorAll('.carousel-slide');
  var slideIndex = 0;
  var mostrarSlide = function mostrarSlide(index) {
    slides.forEach(function (slide, i) {
      return slide.classList.toggle('active', i === index);
    });
  };
  document.querySelectorAll('.boton-siguiente').forEach(function (button) {
    button.addEventListener('click', function () {
      slideIndex = (slideIndex + 1) % slides.length;
      mostrarSlide(slideIndex);
    });
  });
  document.querySelectorAll('.boton-anterior').forEach(function (button) {
    button.addEventListener('click', function () {
      slideIndex = (slideIndex - 1 + slides.length) % slides.length;
      mostrarSlide(slideIndex);
    });
  });
  var finalizarButton = document.getElementById('finalizar-tutorial');
  if (finalizarButton) {
    finalizarButton.addEventListener('click', function () {
      fetch('/tutorial-visto', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        }
      }).then(function (response) {
        if (!response.ok) {
          throw new Error("HTTP error! status: ".concat(response.status));
        }
        return response.json();
      }).then(function (data) {
        if (data.success) {
          var tutorialModal = document.getElementById('tutorial-modal');
          if (tutorialModal) {
            tutorialModal.classList.remove('active');
          }
        } else {
          console.error('Error en la respuesta del servidor:', data.error);
        }
      })["catch"](function (error) {
        return console.error('Error al finalizar el tutorial:', error);
      });
    });
  }
});
/******/ })()
;
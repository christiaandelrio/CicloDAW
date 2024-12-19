/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/modal.js ***!
  \*******************************/
$(document).ready(function () {
  var formToSubmit; // Guarda el formulario a enviar

  // Función para abrir el modal de confirmación
  $('body').on('click', '.open-delete-modal', function (e) {
    e.preventDefault(); // Evita el envío inmediato del formulario
    formToSubmit = $(this).closest('form'); // Encuentra el formulario correspondiente
    showModal(); // Abre el modal
  });
  function showModal() {
    // Agrega el modal al DOM si no existe
    if (!$('#contenedor-modal').length) {
      var modalHtml = "\n                <div id=\"contenedor-modal\" class=\"active\">\n                    <div id=\"modal-confirmation\">\n                        <div class=\"modal-header\"><h3>\xBFEst\xE1s seguro de que quieres eliminar este gasto? Esta acci\xF3n es irreversible.</h3></div>\n                        <div id=\"modal-buttons\">\n                            <button id=\"modal-button-no\" class=\"modal-button\">No</button>\n                            <button id=\"modal-button-yes\" class=\"modal-button\">S\xED</button>\n                        </div>\n                    </div>\n                </div>";
      $('body').append(modalHtml);
    } else {
      $('#contenedor-modal').addClass('active');
    }

    // Eventos de cierre y confirmación
    $('#modal-button-no').off('click').click(closeModal);
    $('#modal-button-yes').off('click').click(function () {
      formToSubmit.submit(); // Envía el formulario
      closeModal();
    });
  }
  function closeModal() {
    $('#contenedor-modal').removeClass('active').fadeOut(300, function () {
      $(this).remove(); // Elimina el modal del DOM
    });
  }
});
/******/ })()
;
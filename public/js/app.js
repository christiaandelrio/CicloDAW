/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/datatable.js":
/*!***********************************!*\
  !*** ./resources/js/datatable.js ***!
  \***********************************/
/***/ (() => {

$(document).ready(function () {
  $('#tablaGastos').DataTable({
    paging: true,
    searching: true,
    language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    }
  });
});

/***/ }),

/***/ "./resources/js/graficas.js":
/*!**********************************!*\
  !*** ./resources/js/graficas.js ***!
  \**********************************/
/***/ (() => {

function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
document.addEventListener("DOMContentLoaded", function () {
  var url = "/dashboard/chart-data";
  fetch(url).then(function (response) {
    return response.json();
  }).then(function (data) {
    function createChart(ctx, type, data, options) {
      return new Chart(ctx, {
        type: type,
        data: data,
        options: options
      });
    }
    function updateCharts() {
      var isDarkMode = document.body.classList.contains('dark');
      var colors = isDarkMode ? {
        background: ['#050B0D', '#A1A5A6', '#F0F2F2', '#0D2626', '#5F7373'],
        text: '#F0F2F2',
        // Blanco roto para modo oscuro
        grid: '#A1A5A6',
        // Gris claro para líneas de cuadrícula
        border: '#F0F2F2'
      } : {
        background: ['#BF5F56', '#BF3326', '#BFCDD9', '#6D8BA6', '#586F8C'],
        text: '#050B0D',
        // Negro azabache para modo claro
        grid: '#BFCDD9',
        // Celeste pastel para líneas de cuadrícula
        border: '#586F8C'
      };

      // Configuración de la gráfica de quesitos
      var pieCanvas = document.getElementById('graficaPie');
      if (pieCanvas) {
        var pieData = {
          labels: data.categorias,
          datasets: [{
            data: data.valores,
            backgroundColor: colors.background,
            hoverOffset: 4
          }]
        };
        var pieOptions = {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              labels: {
                color: colors.text // Asegura que el texto de la leyenda use el color correcto
              }
            }
          }
        };
        createChart(pieCanvas.getContext('2d'), 'pie', pieData, pieOptions);
      }

      // Configuración de la gráfica de barras
      var barCanvas = document.getElementById('graficaBar');
      if (barCanvas) {
        var barData = {
          labels: data.categorias,
          datasets: [{
            label: 'Gastos por Categoría (€)',
            data: data.valores,
            backgroundColor: colors.background.slice(0, 3) // Usar solo 3 colores
          }]
        };
        var barOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              ticks: {
                color: colors.text,
                // Color del texto de categorías
                font: {
                  family: 'Roboto',
                  // Asegura que no se hereden estilos inesperados
                  size: 12
                }
              },
              grid: {
                color: colors.grid // Color de la cuadrícula
              }
            },
            y: {
              ticks: {
                color: colors.text,
                // Color del texto de valores
                font: {
                  family: 'Roboto',
                  size: 12
                }
              },
              grid: {
                color: colors.grid // Color de la cuadrícula
              }
            }
          },
          plugins: {
            legend: {
              display: true,
              labels: {
                color: colors.text,
                // Color del texto de la leyenda
                font: {
                  family: 'Roboto',
                  size: 14
                }
              }
            }
          }
        };
        createChart(barCanvas.getContext('2d'), 'bar', barData, barOptions);
      }

      // Configuración de la gráfica de líneas
      var lineCanvas = document.getElementById('graficaLine');
      if (lineCanvas) {
        var lineData = {
          labels: data.fechas,
          datasets: [{
            label: 'Gastos Acumulados (€)',
            data: data.valoresPorFecha,
            borderColor: colors.border,
            fill: false
          }]
        };
        var lineOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              ticks: {
                color: colors.text,
                // Color del texto de categorías
                font: {
                  family: 'Roboto',
                  size: 12
                }
              },
              grid: {
                color: colors.grid // Color de la cuadrícula
              }
            },
            y: {
              ticks: {
                color: colors.text,
                // Color del texto de valores
                font: {
                  family: 'Roboto',
                  size: 12
                }
              },
              grid: {
                color: colors.grid // Color de la cuadrícula
              }
            }
          },
          plugins: {
            legend: {
              position: 'top',
              labels: {
                color: colors.text,
                // Color del texto de la leyenda
                font: {
                  family: 'Roboto',
                  size: 14
                }
              }
            }
          }
        };
        createChart(lineCanvas.getContext('2d'), 'line', lineData, lineOptions);
      }
    }

    // Inicializa las gráficas con los colores correctos
    updateCharts();

    // Esto es importante, antes no me funcionaba porque solo realizaba la verificación del modo oscuro
    //al cargar el DOM. Con el MutationObserver está pendiente de los cambios 
    var observer = new MutationObserver(function (mutations) {
      var _iterator = _createForOfIteratorHelper(mutations),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var mutation = _step.value;
          if (mutation.attributeName === 'class') {
            updateCharts();
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    });
    observer.observe(document.body, {
      attributes: true
    });
  })["catch"](function (error) {
    console.error('Error al cargar los datos de las gráficas:', error);
  });
});

/***/ }),

/***/ "./resources/js/modal.js":
/*!*******************************!*\
  !*** ./resources/js/modal.js ***!
  \*******************************/
/***/ (() => {

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

/***/ }),

/***/ "./resources/js/options-menu.js":
/*!**************************************!*\
  !*** ./resources/js/options-menu.js ***!
  \**************************************/
/***/ (() => {

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

/***/ }),

/***/ "./resources/js/popup.js":
/*!*******************************!*\
  !*** ./resources/js/popup.js ***!
  \*******************************/
/***/ (() => {

/**
 * Muestra el popup con un mensaje específico.
 * @param {string} mensaje - El texto que se mostrará en el popup.
 */
function mostrarPopup(mensaje) {
  var popup = document.getElementById('popup-alerta');
  var mensajePopup = document.getElementById('mensaje-popup');
  mensajePopup.textContent = mensaje; // Establece el texto del mensaje
  popup.classList.add('mostrar'); // Muestra el popup

  // Oculta el popup automáticamente después de 3 segundos
  setTimeout(function () {
    popup.classList.remove('mostrar');
  }, 3000);
}

/***/ }),

/***/ "./resources/js/primerospasos.js":
/*!***************************************!*\
  !*** ./resources/js/primerospasos.js ***!
  \***************************************/
/***/ (() => {

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

/***/ }),

/***/ "./resources/js/scroll.js":
/*!********************************!*\
  !*** ./resources/js/scroll.js ***!
  \********************************/
/***/ (() => {

document.addEventListener("DOMContentLoaded", function () {
  var sections = document.querySelectorAll(".tarjeta-gastos");
  var dots = document.querySelectorAll(".scroll-dot");
  function activateDot(index) {
    dots.forEach(function (dot) {
      return dot.classList.remove("active");
    });
    if (dots[index]) dots[index].classList.add("active");
  }
  function updateDotOnScroll() {
    var currentIndex = 0;
    sections.forEach(function (section, index) {
      var rect = section.getBoundingClientRect();
      if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
        currentIndex = index;
      }
    });
    activateDot(currentIndex);
  }
  window.addEventListener("scroll", updateDotOnScroll);
  updateDotOnScroll();
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
// resources/js/app.js

__webpack_require__(/*! ./datatable */ "./resources/js/datatable.js");
__webpack_require__(/*! ./modal */ "./resources/js/modal.js");
__webpack_require__(/*! ./primerospasos */ "./resources/js/primerospasos.js");
__webpack_require__(/*! ./options-menu */ "./resources/js/options-menu.js");
__webpack_require__(/*! ./scroll */ "./resources/js/scroll.js");
__webpack_require__(/*! ./graficas */ "./resources/js/graficas.js");
__webpack_require__(/*! ./popup */ "./resources/js/popup.js");
})();

/******/ })()
;
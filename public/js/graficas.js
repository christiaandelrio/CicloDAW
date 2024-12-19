/******/ (() => { // webpackBootstrap
/*!**********************************!*\
  !*** ./resources/js/graficas.js ***!
  \**********************************/
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
/******/ })()
;
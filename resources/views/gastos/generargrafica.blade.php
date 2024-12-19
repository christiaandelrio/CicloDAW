<!-- resources/views/generar-graficas.blade.php -->
@extends('layouts.app')

@section('title', 'Generar Gráfica de Gastos')

@section('content')
<div class="contenedor-generar">
    <h2>Generar Gráfica de Gastos</h2>
    <div class="formulario">
        <form id="fecha-form">
            <div class="formulario-grupo">
                <label for="fecha_inicio" class="formulario-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="formulario-input" required>
            </div>

            <div class="formulario-grupo">
                <label for="fecha_fin" class="formulario-label">Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="formulario-input" required>
            </div>

            <button type="submit" class="boton-enviar">Generar Gráfica</button>
        </form>

        <!-- Canvas para la gráfica -->
        <h2>Gráfica de Gastos</h2>
        <div class="formulario-grupo">
            <canvas id="gastosChart"></canvas>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fechaForm = document.getElementById('fecha-form');
    if (fechaForm) {
        fechaForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;

            fetch("{{ route('gastos.generargrafica.data') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ fecha_inicio: fechaInicio, fecha_fin: fechaFin })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud al servidor");
                }
                return response.json();
            })
            .then(data => {
                if (window.gastosChart instanceof Chart) {
                    window.gastosChart.destroy();
                }

                function getChartColors() {
                    const isDarkMode = document.body.classList.contains('dark');
                    return isDarkMode
                        ? {
                            background: ['#050B0D', '#A1A5A6', '#F0F2F2', '#0D2626', '#5F7373'],
                            text: '#F0F2F2', // Blanco roto para modo oscuro
                            grid: '#A1A5A6', // Gris claro para líneas de cuadrícula
                            border: '#F0F2F2'
                        }
                        : {
                            background: ['#BF5F56', '#BF3326', '#BFCDD9', '#6D8BA6', '#586F8C'],
                            text: '#050B0D', // Negro azabache para modo claro
                            grid: '#BFCDD9', // Celeste pastel para líneas de cuadrícula
                            border: '#586F8C'
                        };
                }

                const colors = getChartColors();

                const ctx = document.getElementById('gastosChart').getContext('2d');
                window.gastosChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data),
                        datasets: [{
                            label: 'Gastos por Categoría',
                            data: Object.values(data),
                            backgroundColor: colors.background,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total en Gastos',
                                    color: colors.text
                                },
                                ticks: {
                                    color: colors.text
                                },
                                grid: {
                                    color: colors.grid
                                }
                            },
                            x: {
                                ticks: {
                                    color: colors.text
                                },
                                grid: {
                                    color: colors.grid
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: colors.text
                                }
                            }
                        }
                    }
                });

                // Observa cambios en la clase del body para actualizar los colores de la gráfica
                const observer = new MutationObserver(mutations => {
                    mutations.forEach(mutation => {
                        if (mutation.attributeName === 'class') {
                            const newColors = getChartColors();
                            window.gastosChart.data.datasets[0].backgroundColor = newColors.background;
                            window.gastosChart.options.scales.y.ticks.color = newColors.text;
                            window.gastosChart.options.scales.y.grid.color = newColors.grid;
                            window.gastosChart.options.scales.x.ticks.color = newColors.text;
                            window.gastosChart.options.scales.x.grid.color = newColors.grid;
                            window.gastosChart.options.plugins.legend.labels.color = newColors.text;
                            window.gastosChart.update();
                        }
                    });
                });

                observer.observe(document.body, { attributes: true });
            })
            .catch(error => console.error('Error al obtener los datos o generar la gráfica:', error));
        });
    } else {
        console.error("El formulario de fechas (fecha-form) no se encontró en el DOM.");
    }
});

</script>
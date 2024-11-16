@extends('layouts.app')

@section('title', 'Generar Gráfica de Gastos')

@section('content')
<div class="contenedor-formulario">
    <div class="formulario">
            <h2>Generar Gráfica de Gastos</h2>
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
document.addEventListener('DOMContentLoaded', function() {


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

                const ctx = document.getElementById('gastosChart').getContext('2d');
                window.gastosChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data),
                        datasets: [{
                            label: 'Gastos por Categoría',
                            data: Object.values(data),
                            backgroundColor: [
                             '#BF5F56', '#BF3326', '#BFCDD9', '#6D8BA6', '#586F8C'
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total en Gastos'
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos o generar la gráfica:', error));
        });
    } else {
        console.error("El formulario de fechas (fecha-form) no se encontró en el DOM.");
    }
});
</script>
@extends('layouts.app')

@section('title', 'Generar Gráfica de Gastos')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h2>Generar Gráfica de Gastos</h2>
        </div>
        <div class="card-body">
            <form id="fecha-form">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin">Fecha de Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Generar Gráfica</button>
            </form>
        </div>
    </div>

    <!-- Canvas para la gráfica -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Gráfica de Gastos</h2>
        </div>
        <div class="card-body">
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
                                '#4CAF50', '#FF9800', '#2196F3', '#FFC107', '#E91E63', '#9C27B0'
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
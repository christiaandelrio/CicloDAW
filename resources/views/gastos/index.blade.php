@extends('layouts.app')

@section('content')
<div class="home-container" style="text-align: center; padding: 50px;">
    <h1>Bienvenido a la Aplicación de Control de Gastos</h1>
    <p>Gestiona tus gastos de forma sencilla y eficiente.</p>


    <div class="card-container">
        <!-- Tarjeta para el gráfico -->
        <div class="card">
            <div class="header">Gastos Mensuales</div>
            <canvas id="monthlyExpensesChart"></canvas> <!-- Contenedor para la gráfica -->
        </div>
        <!-- Agrega más tarjetas con gráficos según sea necesario -->
    </div>
    <div class="card-container">
        <!-- Tarjeta para el gráfico -->
        <div class="card">
            <div class="header">Gastos Mensuales</div>
            <canvas id="monthlyExpensesChart"></canvas> <!-- Contenedor para la gráfica -->
        </div>
        <!-- Agrega más tarjetas con gráficos según sea necesario -->
    </div>
</div>

<script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('monthlyExpensesChart').getContext('2d');
        const monthlyExpensesChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico (puede ser 'line', 'bar', 'pie', etc.)
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'], // Etiquetas para el eje X
                datasets: [{
                    label: 'Gastos',
                    data: [1200, 1900, 3000, 2500, 2200, 4000, 3200], // Datos para el gráfico
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                    borderWidth: 1 // Ancho del borde
                }]
            },
            options: {
                responsive: true, // Hacer que el gráfico sea responsivo
                scales: {
                    y: {
                        beginAtZero: true // Iniciar el eje Y en cero
                    }
                }
            }
        });
    });
</script>
@endsection






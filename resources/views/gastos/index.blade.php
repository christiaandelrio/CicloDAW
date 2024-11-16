@extends('layouts.app')

@section('title', 'Dashboard')
@section('body-class', 'dashboard-page')

@section('content')

<div class="first-section">
    
    <!-- Esta es la sección inicial con la imagen de fondo -->
    <h1>Bienvenido a Huchapp</h1>
</div>

<div class="second-section">
    <div class="home-container">
        <h1>Tus ahorros bajo control</h1>
        <!-- Contenedor de gráficas y artículos -->
        <div class="chart-container">
            <div class="chart">
                <h3>Gráfico de Barras</h3>
                <canvas id="barChart"></canvas>
            </div>
            <div class="description-article">
                <h3>Huchapp: Gestiona tus Gastos y Ahorros de Forma Inteligente</h3>
                <p>Descubre cómo Huchapp facilita la administración de tus finanzas diarias...</p>
            </div>
        </div>
        <div class="chart-container">
            <div class="chart">
                <h3>Gráfico de Quesitos</h3>
                <canvas id="pieChart"></canvas>
            </div>
            <div class="description-article">
                <h3>Controla tus Finanzas y Simplifica tus Gastos con Huchapp</h3>
                <p>Huchapp es tu aliado para mejorar la organización de tus finanzas...</p>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')


<!-- Scripts de las gráficas -->
<script>
    var barChartContext = document.getElementById('barChart').getContext('2d');
    var pieChartContext = document.getElementById('pieChart').getContext('2d');

    var barChart = new Chart(barChartContext, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Gastos',
                data: [1200, 1500, 800, 1100, 1300],
                backgroundColor: '#BF5F56'
            }]
        }
    });

    var pieChart = new Chart(pieChartContext, {
        type: 'pie',
        data: {
            labels: ['Comida', 'Transporte', 'Entretenimiento', 'Salud', 'Otros'],
            datasets: [{
                data: [300, 150, 100, 250, 200],
                backgroundColor: ['#BF5F56', '#BF3326', '#BFCDD9', '#6D8BA6', '#586F8C']
            }]
        }
    });

document.addEventListener('DOMContentLoaded', function() {
    const chartContainers = document.querySelectorAll('.chart-container, .description-article');

    // Muestra los elementos con efecto de desvanecimiento al hacer scroll
    window.addEventListener('scroll', () => {
        chartContainers.forEach((container) => {
            const rect = container.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                container.classList.add('visible');
            }
        });
    });
});

</script>
@endsection









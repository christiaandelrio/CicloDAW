@extends('layouts.app')

@section('title', 'Dashboard')
@section('body-class', 'index-background') <!-- Clase solo para el index -->

@section('content')
<div class="home-container">
    <h1>Aprende a gastar con sentidiño</h1>
    <!-- Contenedor de gráficas y artículos -->
    <div class="chart-container">
        <div class="chart">
            <h3>Gráfico de Barras</h3>
            <canvas id="barChart"></canvas>
        </div>
        <div class="description-article">
            <h3>Artículo Informativo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>
    <div class="chart-container">
        <div class="chart">
            <h3>Gráfico de Quesitos</h3>
            <canvas id="pieChart"></canvas>
        </div>
        <div class="description-article">
            <h3>Otro Artículo Informativo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                backgroundColor: '#4CAF50'
            }]
        }
    });

    var pieChart = new Chart(pieChartContext, {
        type: 'pie',
        data: {
            labels: ['Comida', 'Transporte', 'Entretenimiento', 'Salud', 'Otros'],
            datasets: [{
                data: [300, 150, 100, 250, 200],
                backgroundColor: ['#4CAF50', '#8BC34A', '#C5E1A5', '#388E3C', '#66BB6A']
            }]
        }
    });
</script>
@endsection









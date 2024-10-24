@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container" style="padding-top: 50px; text-align: center;">
    <!-- Contenedor de gráficas y artículos -->
    <div class="chart-container" style="display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap; gap: 20px;">
        
        <!-- Gráfico de barras -->
        <div class="chart" style="flex: 1; background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <h3 style="color: #3B4013;">Gráfico de Barras</h3>
            <canvas id="barChart" style="width: 100%; height: 400px;"></canvas>
        </div>

        <!-- Artículo de texto centrado -->
        <div class="description-article" style="flex: 1; background-color: #F2F4F5; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
            <h3 style="color: #3B4013;">Artículo Informativo</h3>
            <p style="color: #0D0D0D;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>

    <div class="chart-container" style="display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap; gap: 20px; margin-top: 50px;">
        
        <!-- Gráfico de quesitos -->
        <div class="chart" style="flex: 1; background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <h3 style="color: #3B4013;">Gráfico de Quesitos</h3>
            <canvas id="pieChart" style="width: 100%; height: 400px;"></canvas>
        </div>

        <!-- Otro artículo de texto -->
        <div class="description-article" style="flex: 1; background-color: #F2F4F5; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
            <h3 style="color: #3B4013;">Otro Artículo Informativo</h3>
            <p style="color: #0D0D0D;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>
</div>

<!-- Scripts para las gráficas -->
<script>
    var barChartContext = document.getElementById('barChart').getContext('2d');
    var pieChartContext = document.getElementById('pieChart').getContext('2d');

    // Ejemplo de gráfico de barras
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

    // Ejemplo de gráfico de quesitos
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








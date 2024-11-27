document.addEventListener("DOMContentLoaded", function () {
    const url = "/dashboard/chart-data";

    fetch(url)
        .then(response => response.json())
        .then(data => {
            function createChart(ctx, type, data, options) {
                return new Chart(ctx, {
                    type: type,
                    data: data,
                    options: options
                });
            }

            // Verificar si el body tiene la clase 'body.dark'
            const isDarkMode = document.body.classList.contains('body.dark');

            // Colores definidos según el modo
            const colors = isDarkMode
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

            // Configuración de la gráfica de quesitos
            const pieCanvas = document.getElementById('graficaPie');
            if (pieCanvas) {
                const pieData = {
                    labels: data.categorias,
                    datasets: [{
                        data: data.valores,
                        backgroundColor: colors.background,
                        hoverOffset: 4
                    }]
                };

                const pieOptions = {
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
            const barCanvas = document.getElementById('graficaBar');
            if (barCanvas) {
                const barData = {
                    labels: data.categorias,
                    datasets: [{
                        label: 'Gastos por Categoría (€)',
                        data: data.valores,
                        backgroundColor: colors.background.slice(0, 3) // Usar solo 3 colores
                    }]
                };

                const barOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: colors.text, // Color del texto de categorías
                                font: {
                                    family: 'Roboto', // Asegura que no se hereden estilos inesperados
                                    size: 12
                                }
                            },
                            grid: {
                                color: colors.grid // Color de la cuadrícula
                            }
                        },
                        y: {
                            ticks: {
                                color: colors.text, // Color del texto de valores
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
                                color: colors.text, // Color del texto de la leyenda
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
            const lineCanvas = document.getElementById('graficaLine');
            if (lineCanvas) {
                const lineData = {
                    labels: data.fechas,
                    datasets: [{
                        label: 'Gastos Acumulados (€)',
                        data: data.valoresPorFecha,
                        borderColor: colors.border,
                        fill: false
                    }]
                };

                const lineOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: colors.text, // Color del texto de categorías
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
                                color: colors.text, // Color del texto de valores
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
                                color: colors.text, // Color del texto de la leyenda
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
        })
        .catch(error => {
            console.error('Error al cargar los datos de las gráficas:', error);
        });
});


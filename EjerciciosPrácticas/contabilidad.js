$(document).ready(function() {

    // Función para obtener la fecha en formato 'YYYY-MM-DD'
    function formatDate(date) {
        let d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    // Establecer fechas por defecto
    let today = new Date();
    let primerDiaMesAnterior = new Date(today.getFullYear(), today.getMonth() - 1, 1);
    primerDiaMesAnterior.setHours(23,0,0);
    let ultimoDiaMesAnterior = new Date(today.getFullYear(), today.getMonth(), 0);
    ultimoDiaMesAnterior.setHours(23,0,0);

    $('#fechaInicioCompra').val(formatDate('2023-01-01T00:00'));
    $('#fechaFinCompra').val(formatDate(ultimoDiaMesAnterior));
    $('#fechaInicioVenta').val(formatDate(primerDiaMesAnterior));
    $('#fechaFinVenta').val(formatDate(ultimoDiaMesAnterior));

    // Inicializamos DataTables al cargar la página
    $('#tablaAlbaranes').DataTable();

    // Evento para el botón "Obtener Albaranes"
    $("#btnObtenerAlbaranes").click(function(e) {
        e.preventDefault(); // Prevenir el envío del formulario

        // Obtenemos el formulario según su id
        let form = $("#formAlbaranes");

        // Llamamos a la función para obtener albaranes
        obtenerAlbaranes(form);
    });

    // Función para obtener albaranes
    function obtenerAlbaranes(form) {
        cargando(true);

        let info = {
            url: URL_BASE + "Contabilidad/ajax?action=generarExcel",
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                cargando(false);

                if (response.exito) {
                    // Mostrar el HTML de la tabla en el contenedor
                    $("#resultadoAlbaranes").html(response.html);
                    alerta("Albaranes obtenidos", "Informe generado correctamente!", "success");

                    // Inicializar DataTables después de cargar la tabla
                    $('#tablaAlbaranes').DataTable();

                    // Redirigir para descargar el archivo generado
                    window.location.href = response.mensaje;

                    // Acceder a los datos del gráfico en response.data.datosGrafico
                    if (response.data && response.data.datosGrafico) {
                        mostrarGraficoPesos(response.data.datosGrafico);
                        // Llamamos a la nueva función para llenar la tabla de pesos
                        rellenarTablaPesos(response.data.datosGrafico);
                    } else {
                        console.error("No se encontraron datos para el gráfico.");
                    }
                } else {
                    alerta("Error al obtener los albaranes", response.mensaje, "danger");
                }
            }
        };

        // Realizamos la llamada AJAX
        callAjax(info);
    }

    // Función para mostrar el gráfico de barras
    function mostrarGraficoPesos(datosGrafico) {
        let proveedores = datosGrafico.map(d => d.CodigoProveedor);
        let pesoCompras = datosGrafico.map(d => d.PesoTotalComprasProveedor);
        let pesoVentas = datosGrafico.map(d => d.PesoTotalVentasProveedor);

        // Destruir el gráfico anterior si existe
        if (window.myChart) {
            window.myChart.destroy();
        }

        // Crear el gráfico de barras
        let ctx = document.getElementById("graficoPesos").getContext("2d");
        window.myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: proveedores, // Proveedores en el eje X
                datasets: [
                    {
                        label: 'Peso Compras',
                        backgroundColor: 'rgba(54, 162, 235, 0.7)', // Color para compras
                        data: pesoCompras
                    },
                    {
                        label: 'Peso Ventas',
                        backgroundColor: 'rgba(255, 99, 132, 0.7)', // Color para ventas
                        data: pesoVentas
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Código de Proveedor'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Peso Total'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Nueva función para llenar la tabla de pesos
    function rellenarTablaPesos(datosGrafico) {
        let tablaBody = $('#tablaPesos tbody');
        tablaBody.empty();  // Limpiar tabla antes de agregar nuevas filas

        let totalCompras = 0;
        let totalVentas = 0;

        // Agregar filas con los datos de pesos
        datosGrafico.forEach(dato => {
            let fila = `
                <tr>
                    <td>${dato.CodigoProveedor}</td>
                    <td>${dato.PesoTotalComprasProveedor.toFixed(2)}</td>
                    <td>${dato.PesoTotalVentasProveedor.toFixed(2)}</td>
                </tr>
            `;
            tablaBody.append(fila);

            // Sumar totales
            totalCompras += dato.PesoTotalComprasProveedor;
            totalVentas += dato.PesoTotalVentasProveedor;
        });

        // Agregar fila con los totales
        let filaTotales = `
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>${totalCompras.toFixed(2)}</strong></td>
                <td><strong>${totalVentas.toFixed(2)}</strong></td>
            </tr>
        `;
        tablaBody.append(filaTotales);
    }

});



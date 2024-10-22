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
    let ultimoDiaMesAnterior = new Date(today.getFullYear(), today.getMonth(), 0);

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
        console.log(form);
        console.log(form.serialize());
        cargando(true);

        let info = {
            url: "http://localhost/Contabilidad/ajax?action=generarExcel", // Cambia la URL según tu configuración
            type: "POST",
            data: form.serialize(), // Serializamos el formulario
            success: function(data) {
                console.log(data);
                cargando(false);

                if (data.exito) {
                    // Si se obtuvieron los albaranes correctamente, mostramos los resultados
                    $("#resultadoAlbaranes").html(data.html); // Cargamos el contenido html de data en el div de resultados
                    alerta("Albaranes obtenidos", data.mensaje, "success");

                    // Inicializamos DataTables nuevamente después de actualizar el contenido
                    $('#tablaAlbaranes').DataTable(); // Re-inicializamos DataTable

                    // Redirigimos a la URL para la descarga del archivo
                    window.location.href = data.mensaje;
                } else {
                    // Si hubo un error, mostramos un mensaje de error
                    alerta("Error al obtener los albaranes", data.mensaje, "danger");
                }
            },

        };

        // Realizamos la llamada AJAX
        callAjax(info);
    }

});



{{-- resources/views/gastos/escanearRecibo.blade.php --}}
@extends('layouts.app')

@section('title', 'Escanear Ticket de Compra')

@section('content')
<div class="contenedor-formulario" id="contenedor-ticket">
    <h2 class="text-center">Escanea tu Ticket de Compra</h2>
    <div class="formulario">
        <p class="instruccion">Selecciona una imagen desde la galería o usa la cámara.</p>
        <button id="captureReceiptBtn" class="boton-enviar">Abrir Cámara o Galería</button>
        <input type="file" id="uploadReceipt" accept="image/*" style="display:none;">
    </div>
</div>

<div class="contenedor-imagenes" id="contenedor-imagenes">
    <div class="tarjeta">
        <img src="/images/ticket_fondo.jpg" alt="Imagen 1" class="imagen-tarjeta">
    </div>
    <div class="flecha">
        <i class="fa-solid fa-arrow-right"></i>
    </div>
    <div class="tarjeta">
        <img src="/images/finanzas.jpg" alt="Imagen 2" class="imagen-tarjeta">
    </div>
</div>

<div class="previsualizacion" id="previsualizacion" style="display:none;">
    <div class="tarjeta-blanca">
        <img id="ticketPreview" src="" alt="Previsualización del Ticket" class="previsualizacion-imagen">
        <div id="datosDetectados" class="detalles-detectados"></div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const captureButton = document.querySelector('#captureReceiptBtn');
    const fileInput = document.querySelector('#uploadReceipt');
    const contenedorImagenes = document.getElementById('contenedor-imagenes');
    const previsualizacion = document.getElementById('previsualizacion');
    const ticketPreview = document.getElementById('ticketPreview');
    const datosDetectados = document.getElementById('datosDetectados');

    captureButton.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function (event) {
        if (!fileInput.files.length) {
            mostrarPopup("Por favor, selecciona una imagen primero.");
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            ticketPreview.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);

        // Ocultar imágenes iniciales y mostrar previsualización
        contenedorImagenes.style.opacity = '0';
        setTimeout(() => {
            contenedorImagenes.style.display = 'none';
            previsualizacion.style.display = 'block';
        }, 500);

        const formData = new FormData();
        formData.append('receipt', fileInput.files[0]);

        fetch('{{ route('gastos.processReceipt') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
            .then(response => {
                if (!response.ok) throw new Error("Error en la respuesta del servidor");
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    mostrarPopup("¡Gasto creado con éxito!");
                    datosDetectados.innerHTML = `
                        <div class="detalles-gasto">
                            <h3>Detalles detectados:</h3>
                            <p><strong>Nombre:</strong> ${data.detected_data.nombre || 'No detectado'}</p>
                            <p><strong>Total:</strong> ${data.detected_data.total || 'No detectado'} €</p>
                            <p><strong>Fecha:</strong> ${data.detected_data.fecha || 'No detectado'}</p>
                        </div>
                    `;
                    setTimeout(() => {
                        window.location.href = `/gastos/${data.gasto_id}/edit`;
                    }, 5000); // Mostrar los datos por más tiempo (5 segundos)
                } else {
                    mostrarPopup(data.error || 'Error desconocido');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarPopup('Error al procesar la imagen. Inténtalo nuevamente.');
            });
    });
});


</script>
@endsection



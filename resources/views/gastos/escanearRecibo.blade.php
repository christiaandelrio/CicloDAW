{{-- resources/views/gastos/escanearRecibo.blade.php --}}
@extends('layouts.app')

@section('title', 'Escanear Ticket de Compra')

@section('content')
<div class="contenedor-formulario">
    <h2 class="text-center">Escanea tu Ticket de Compra</h2>
    <div class="formulario">
        <!-- Botón para abrir la cámara o galería -->
        <button id="captureReceiptBtn" class="boton-enviar">Abrir Cámara o Galería</button>
        <input type="file" id="uploadReceipt" accept="image/*" capture="environment" style="display:none;">
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const captureButton = document.querySelector('#captureReceiptBtn');
        const fileInput = document.querySelector('#uploadReceipt');

        // Muestra el selector de archivos al hacer clic en el botón
        captureButton.addEventListener('click', function() {
            fileInput.click();
        });

        // Maneja la carga de archivos
        fileInput.addEventListener('change', function(event) {
            if (!fileInput.files.length) {
                mostrarPopup("Por favor, selecciona una imagen primero.");
                return;
            }

            let formData = new FormData();
            formData.append('receipt', fileInput.files[0]);

            fetch('{{ route('gastos.processReceipt') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    mostrarPopup(data.message);
                } else {
                    mostrarPopup('Error: ' + (data.error || 'Error desconocido'));
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



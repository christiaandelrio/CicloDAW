{{-- resources/views/gastos/escanearRecibo.blade.php --}}
@extends('layouts.app')

@section('title', 'Escanear Ticket de Compra')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Escanea tu Ticket de Compra</h2>
    <div class="card p-4">
        <button id="captureReceiptBtn" class="btn btn-primary btn-block mb-3">Abrir Cámara o Galería</button>
        <input type="file" id="uploadReceipt" accept="image/*" capture="environment" style="display:none;">

        <div id="preview" class="mt-3"></div> <!-- Vista previa de la imagen si es necesario -->
    </div>
</div>

<script>
// Escucha del botón para activar la selección de archivo
document.querySelector('#captureReceiptBtn').addEventListener('click', function() {
    document.querySelector('#uploadReceipt').click();
});

document.querySelector('#uploadReceipt').addEventListener('change', function(event) {
    const fileInput = event.target;
    if (!fileInput.files.length) {
        alert("Por favor, selecciona una imagen primero.");
        return;
    }

    let formData = new FormData();
    formData.append('receipt', fileInput.files[0]);

    fetch('/gastos/process-receipt', {
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
            alert(data.message);
        } else {
            alert('Error: ' + (data.error || 'Error desconocido'));
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>
@endsection



$(document).ready(function() {
    let formToSubmit; // Guarda el formulario a enviar

    // Función para abrir el modal de confirmación
    $('body').on('click', '.open-delete-modal', function(e) {
        e.preventDefault(); // Evita el envío inmediato del formulario
        formToSubmit = $(this).closest('form'); // Encuentra el formulario correspondiente
        showModal(); // Abre el modal
    });

    function showModal() {
        // Agrega el modal al DOM si no existe
        if (!$('#contenedor-modal').length) {
            const modalHtml = `
                <div id="contenedor-modal" class="active">
                    <div id="modal-confirmation">
                        <div class="modal-header"><h3>¿Estás seguro de que quieres eliminar este gasto? Esta acción es irreversible.</h3></div>
                        <div id="modal-buttons">
                            <button id="modal-button-no" class="modal-button">No</button>
                            <button id="modal-button-yes" class="modal-button">Sí</button>
                        </div>
                    </div>
                </div>`;
            $('body').append(modalHtml);
        } else {
            $('#contenedor-modal').addClass('active');
        }

        // Eventos de cierre y confirmación
        $('#modal-button-no').off('click').click(closeModal);
        $('#modal-button-yes').off('click').click(function() {
            formToSubmit.submit(); // Envía el formulario
            closeModal();
        });
    }

    function closeModal() {
        $('#contenedor-modal').removeClass('active').fadeOut(300, function() {
            $(this).remove(); // Elimina el modal del DOM
        });
    }
});


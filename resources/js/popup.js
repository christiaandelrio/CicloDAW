/**
 * Muestra el popup con un mensaje específico.
 * @param {string} mensaje - El texto que se mostrará en el popup.
 */
function mostrarPopup(mensaje) {
    const popup = document.getElementById('popup-alerta');
    const mensajePopup = document.getElementById('mensaje-popup');

    mensajePopup.textContent = mensaje; // Establece el texto del mensaje
    popup.classList.add('mostrar'); // Muestra el popup

    // Oculta el popup automáticamente después de 3 segundos
    setTimeout(() => {
        popup.classList.remove('mostrar');
    }, 3000);
}

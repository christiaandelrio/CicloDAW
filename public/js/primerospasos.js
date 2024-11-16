document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.carousel-slide');
    let slideIndex = 0;

    const mostrarSlide = (index) => {
        slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
    };

    document.querySelectorAll('.boton-siguiente').forEach(button => {
        button.addEventListener('click', () => {
            slideIndex = (slideIndex + 1) % slides.length;
            mostrarSlide(slideIndex);
        });
    });

    document.querySelectorAll('.boton-anterior').forEach(button => {
        button.addEventListener('click', () => {
            slideIndex = (slideIndex - 1 + slides.length) % slides.length;
            mostrarSlide(slideIndex);
        });
    });

    const finalizarButton = document.getElementById('finalizar-tutorial');
    if (finalizarButton) {
        finalizarButton.addEventListener('click', () => {
            fetch('/tutorial-visto', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const tutorialModal = document.getElementById('tutorial-modal');
                    if (tutorialModal) {
                        tutorialModal.classList.remove('active');
                    }
                } else {
                    console.error('Error en la respuesta del servidor:', data.error);
                }
            })
            .catch(error => console.error('Error al finalizar el tutorial:', error));
        });
    }
});

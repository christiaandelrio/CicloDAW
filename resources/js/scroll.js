document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".tarjeta-gastos");
    const dots = document.querySelectorAll(".scroll-dot");

    function activateDot(index) {
        dots.forEach(dot => dot.classList.remove("active"));
        if (dots[index]) dots[index].classList.add("active");
    }

    function updateDotOnScroll() {
        let currentIndex = 0;
        sections.forEach((section, index) => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
                currentIndex = index;
            }
        });
        activateDot(currentIndex);
    }

    window.addEventListener("scroll", updateDotOnScroll);
    updateDotOnScroll();
});
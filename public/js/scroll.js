/******/ (() => { // webpackBootstrap
/*!********************************!*\
  !*** ./resources/js/scroll.js ***!
  \********************************/
document.addEventListener("DOMContentLoaded", function () {
  var sections = document.querySelectorAll(".tarjeta-gastos");
  var dots = document.querySelectorAll(".scroll-dot");
  function activateDot(index) {
    dots.forEach(function (dot) {
      return dot.classList.remove("active");
    });
    if (dots[index]) dots[index].classList.add("active");
  }
  function updateDotOnScroll() {
    var currentIndex = 0;
    sections.forEach(function (section, index) {
      var rect = section.getBoundingClientRect();
      if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
        currentIndex = index;
      }
    });
    activateDot(currentIndex);
  }
  window.addEventListener("scroll", updateDotOnScroll);
  updateDotOnScroll();
});
/******/ })()
;
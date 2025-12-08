document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper(".myFullSectionSwiper", {
        loop: true,
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
      
    });
});

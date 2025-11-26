
import '../css/styles/style.scss';
// Import our custom CSS

// // Import all of Bootstrap’s JS
// import * as bootstrap from 'bootstrap'


document.addEventListener('DOMContentLoaded', function () {
    const navbarToggler = document.querySelector('.my-navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-nav');
    const dropdownToggle = document.querySelector('.my-nav-link-toggle');
    const dropdownMenu = document.querySelector('.my-nav-link-menu');


    navbarToggler.addEventListener('click', function () {
        navbarCollapse.classList.toggle('show');
        // Cambiar ícono del botón
        const icon = this.querySelector('i');
        if (navbarCollapse.classList.contains('show')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });

    /* if (dropdownToggle) {
        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();
            dropdownMenu.classList.toggle('show');
        });
    } */

    document.addEventListener('click', function (e) {
        // Cerrar my-my-nav-link si se hace clic fuera
        if (dropdownToggle && dropdownMenu && !e.target.matches('.my-nav-link-toggle') && !e.target.closest('.my-my-nav-link-menu')) {
            dropdownMenu.classList.remove('show');
        }

        /* if (window.innerWidth <= 992 && e.target.matches('.nav-link')) {
            navbarCollapse.classList.remove('show');
            const icon = navbarToggler.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        } */
    });

    const track = document.querySelector('.carousel-track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.next-btn');
    const prevButton = document.querySelector('.prev-btn');

    let currentIndex = 0;
    let autoSlideInterval;

    function updateCarousel() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;

        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentIndex);
        });
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(function () {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        }, 5000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    nextButton.addEventListener('click', function () {
        stopAutoSlide();
        currentIndex = (currentIndex + 1) % slides.length;
        updateCarousel();
        startAutoSlide();
    });

    prevButton.addEventListener('click', function () {
        stopAutoSlide();
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateCarousel();
        startAutoSlide();
    });

    startAutoSlide();

    track.addEventListener('mouseenter', stopAutoSlide);
    track.addEventListener('mouseleave', startAutoSlide);

    const backToTopButton = document.querySelector('.back-to-top');

    window.addEventListener('scroll', function () {
        if (window.pageYOffset > 300) {
            backToTopButton.style.display = 'flex';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    backToTopButton.addEventListener('click', function (e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});


const toggle = document.getElementById("menuToggle");
const menu = document.getElementById("mobileMenu");

toggle.addEventListener("click", () => {
    menu.classList.toggle("show");
});
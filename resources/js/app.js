import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import Swal from 'sweetalert2';
window.Swal = Swal;

/* import '../sass/app.scss' */

window.initDashboardUI = function () {

    const sidebar = document.getElementById('appSidebar');
    const overlay = document.getElementById('mobileOverlay');
    const toggleSidebar = document.getElementById('sidebar-toggle');

    if (toggleSidebar)
        toggleSidebar.addEventListener('click', () => {
            if (sidebar) sidebar.classList.add('open');
            if (overlay) overlay.classList.add('active');
            closeAllDropdowns();
        })

    if (overlay) {
        overlay.addEventListener('click', () => {
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            closeAllDropdowns();
        });
    }

    /* const toggleSubmenus = document.querySelectorAll('.toggle-submenu');
    if (toggleSubmenus.length) {
        toggleSubmenus.forEach((ts, i) => {
            ts.addEventListener("click", () => {
                const submenu = ts.nextElementSibling;
                const isOpen = submenu.classList.contains('show');

                // Cerrar todos
                document.querySelectorAll('.sidebar-submenu').forEach(s => s.classList.remove('show'));
                document.querySelectorAll('.has-submenu').forEach(i => i.classList.remove('active'));

                // Abrir el clicado (si no estaba abierto)
                if (!isOpen) {
                    submenu.classList.add('show');
                    element.classList.add('active');
                }
            });
        });
    } */
   const toggleSubmenus = document.querySelectorAll('.toggle-submenu');
    if (toggleSubmenus.length) {
        toggleSubmenus.forEach((ts, i) => {
            ts.addEventListener("click", () => toggleSubmenu(ts));
        });
    }
    // Submenús
    function toggleSubmenu(element) {
        const submenu = element.nextElementSibling;
        const isOpen = submenu.classList.contains('show');

        // Cerrar todos
        document.querySelectorAll('.sidebar-submenu').forEach(s => s.classList.remove('show'));
        document.querySelectorAll('.has-submenu').forEach(i => i.classList.remove('active'));

        // Abrir el clicado (si no estaba abierto)
        if (!isOpen) {
            submenu.classList.add('show');
            element.classList.add('active');
        }
    }

    // === Selectores de dropdowns (personalizados) ===
    const dropdownConfigs = [
        {
            toggleId: 'btnNotifyToggle',
            menuId: 'menuNotifyToggle',
            toggleClass: 'topbar-action-toggle',
            menuClass: 'topbar-action-menu',
        },
        {
            toggleId: 'btnProfileToggle',
            menuId: 'menuProfileToggle',
            toggleClass: 'topbar-action-toggle', // puedes cambiar a 'profile-toggle' si quieres diferenciar
            menuClass: 'topbar-action-menu',
        },
    ];

    // === Función para cerrar todos los dropdowns ===
    const closeAllDropdowns = () => {
        dropdownConfigs.forEach(config => {
            const menu = document.getElementById(config.menuId);
            const toggle = document.getElementById(config.toggleId);
            if (menu) menu.classList.remove('is-open');
            if (toggle) {
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    dropdownConfigs.forEach(config => {
        const toggle = document.getElementById(config.toggleId);
        const menu = document.getElementById(config.menuId);

        if (!toggle || !menu) return;

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();

            const isOpen = menu.classList.contains('is-open');
            closeAllDropdowns();

            if (!isOpen) {
                menu.classList.add('is-open');
                toggle.classList.add('active');
                toggle.setAttribute('aria-expanded', 'true');
            }
        });
    });

    document.addEventListener('click', (e) => {
        const isClickInsideAnyDropdown = dropdownConfigs.some(config => {
            const toggle = document.getElementById(config.toggleId);
            const menu = document.getElementById(config.menuId);
            return toggle?.contains(e.target) || menu?.contains(e.target);
        });
        if (!isClickInsideAnyDropdown) closeAllDropdowns();
    });

    // === Cerrar con tecla ESC ===
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (sidebar) sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            closeAllDropdowns();
        }
    });

};

window.initLandingUI = function () {

    const toggle = document.querySelector('.nav-toggle');
    const menu = document.querySelector('.nav-menu');

    if (toggle) {
        toggle.addEventListener('click', () => {
            if (menu)
                menu.classList.toggle('active');
            const icon = toggle.querySelector('i');
            if (icon && menu) {
                if (menu.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }

    const dropdowns = document.querySelectorAll(".my-nav-dropdown");

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector(".my-nav-dropdown-toggle");
        const menu = dropdown.querySelector(".my-nav-dropdown-menu");

        // Abrir/cerrar el menú al hacer clic en el toggle
        toggle.addEventListener("click", (e) => {
            e.stopPropagation();

            // Cerrar los demás menús abiertos
            dropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.querySelector(".my-nav-dropdown-toggle").classList.remove("show");
                    d.querySelector(".my-nav-dropdown-menu").classList.remove("show");
                }
            });

            toggle.classList.toggle("show");
            menu.classList.toggle("show");
        });

        menu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", () => {
                toggle.classList.remove("show");
                menu.classList.remove("show");
            });
        });
    });

    document.addEventListener("click", () => {
        dropdowns.forEach(dropdown => {
            dropdown.querySelector(".my-nav-dropdown-toggle").classList.remove("show");
            dropdown.querySelector(".my-nav-dropdown-menu").classList.remove("show");
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {

    initDashboardUI();
    initLandingUI();

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

});


window.SwalToast = Swal.mixin({
    toast: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 5000,
    title: "Hello world",
    timerProgressBar: true,
    showCloseButton: true,
    customClass: {
    },
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})


window.SwalToastSuccess = SwalToast.mixin({
    icon: 'success',
    customClass: {
        popup: 'swal2-toast swal2-success',
    }
})

window.SwalToastError = SwalToast.mixin({
    icon: 'error',
    customClass: {
        popup: 'swal2-toast swal2-error',
    }
})

window.SwalToastWarning = SwalToast.mixin({
    icon: 'warning',
    customClass: {
        popup: 'swal2-toast swal2-warning',
    }
})

window.SwalToastInfo = SwalToast.mixin({
    icon: 'info',
    customClass: {
        popup: 'swal2-toast swal2-info',
    }
})

window.SwalToastQuestion = SwalToast.mixin({
    icon: 'question',
    customClass: {
        popup: 'swal2-toast swal2-question',
    }
})

window.SwalConfirm = Swal.mixin({
    title: '',
    text: '',
    showCancelButton: true,
    showConfirmButton: true,
    confirmButtonText: `<i class='fas fa-check'></i> Accept`,
    cancelButtonText: `<i class='fas fa-times'></i> Cancel`,
    focusConfirm: false,
    focusCancel: false,
    customClass: {
        confirmButton: 'btn btn-primary me-1',
        cancelButton: 'btn btn-danger ms-1',
    },
    buttonsStyling: false
})

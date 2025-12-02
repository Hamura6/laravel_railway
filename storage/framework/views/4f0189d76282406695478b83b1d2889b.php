<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    
    <title>
        <?php echo e($institution->initials); ?>

    </title>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
        rel="stylesheet" />
        <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    </head>

<body>
    <div class="layout-wrapper">



        <?php echo $__env->make('pages.layouts.app.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>







        <div class="overlay-mobile" id="mobileOverlay" id="sidebar-overlay"></div>

        <div class="main-container">

            <!-- TOPBAR -->
            <?php echo $__env->make('pages.layouts.app.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


            <!-- CONTENT -->
            <main class="content">
                <?php echo e($slot); ?>

            </main>

            <!-- FOOTER -->
            <footer class="dashboard-footer">
                <div class="footer-content"></div>
                <div class="footer-bottom">
                    <p>&copy; <span id="year"></span> ICAP Potosi. Todos los derechos reservados.</p>
                    <p>Diseño y desarrollo web por <a href="" target="_blank">Hamura</a></p>
                </div>
            </footer>

            <script>
                document.getElementById("year").textContent = new Date().getFullYear();
            </script>
        </div>

    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>



    <script data-navigate-once>
        document.addEventListener('livewire:navigated', () => {
            initDashboardUI();
        });
        document.addEventListener('DOMContentLoaded', () => {
            initDashboardUI();
        });
    </script>

    


    <script data-navigate-once>
        document.addEventListener('DOMContentLoaded', function() {
            //   window.Toast = Swal.mixin({
            //     toast: true,
            //     position: 'top-right',
            //     showConfirmButton: false,
            //     timer: 4000,
            //     timerProgressBar: true,
            //     showCloseButton: true,
            //     // background: '#EDEEF5',
            //     customClass: {
            //       popup: 'border-primary',
            //       title: 'mx-1 fw-bold fs-5',
            //     },
            //     didOpen: (toast) => {
            //       // toast.addEventListener('click', Swal.clickConfirm)
            //       toast.addEventListener('mouseenter', Swal.stopTimer)
            //       toast.addEventListener('mouseleave', Swal.resumeTimer)
            //     }
            //   })
        });


        Livewire.on('notify', (data) => {
            notify(data);
        });


        Livewire.on('close-modal', () => {
            const modalEl = document.getElementById('myModal');
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.hide(); // cierra el modal
        });

        Livewire.on('show-modal', () => {
            const modalEl = document.getElementById('myModal');
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show(); // abre el modal
        });


        function Confirm(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: "btn btn-danger",
                    confirmButton: "btn btn-dark mx-1"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Confirmar",
                text: "Desea eliminar el registro?",
                icon: "question",
                showCancelButton: true,
                cancelButtonText: "<i class='fas fa-ban fs-6'></i> Cancelar",
                confirmButtonText: "<i class='fas fa-check-circle fs-6'></i> Aceptar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('delete', {
                        id
                    });
                }
            });

        }


        function Question(id, ms, method) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: "btn btn-danger",
                    confirmButton: "btn btn-dark mx-1"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Confirmar",
                text: ms,
                icon: "question",
                showCancelButton: true,
                cancelButtonText: "<i class='fas fa-ban fs-6'></i> Cancelar",
                confirmButtonText: "<i class='fas fa-check-circle fs-6'></i> Aceptar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(method, {
                        id
                    });
                }
            });

        }

        function notify(ms) {
            if (ms.icon == "success") {
                SwalToastSuccess.fire({
                    icon: ms.icon || 'success',
                    title: ms.title || '',
                    html: ms.text || ''
                });
            } else if (ms.icon == "error") {
                SwalToastError.fire({
                    icon: ms.icon || 'error',
                    title: ms.title || '',
                    html: ms.text || ''
                });
            } else if (ms.icon == "warning") {
                SwalToastWarning.fire({
                    icon: ms.icon || 'warning',
                    title: ms.title || '',
                    html: ms.text || ''
                });
            } else if (ms.icon == "info") {
                SwalToastInfo.fire({
                    icon: ms.icon || 'info',
                    title: ms.title || '',
                    html: ms.text || ''
                });
            } else {
                SwalToastQuestion.fire({
                    icon: ms.icon || 'info',
                    title: ms.title || '',
                    html: ms.text || ''
                });
            }
            /*  Toast.fire({
                 icon: ms.icon || 'success',
                 title: ms.title || '',
                 html: ms.text || ''
             }); */
        }


</script>
</body>

</html>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>
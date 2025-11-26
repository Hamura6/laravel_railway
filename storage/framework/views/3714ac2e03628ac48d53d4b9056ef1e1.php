<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    
    <title>
        Corporate UI by Creative Timsdadsadas
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

                <?php if (isset($component)) { $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card-header','data' => ['title' => 'Editar | Requisitos de inscripción','name' => 'Saldos']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Editar | Requisitos de inscripción','name' => 'Saldos']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26)): ?>
<?php $attributes = $__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26; ?>
<?php unset($__attributesOriginalf8fdb5e325b86ec4fcbd12174b8a2d26); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26)): ?>
<?php $component = $__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26; ?>
<?php unset($__componentOriginalf8fdb5e325b86ec4fcbd12174b8a2d26); ?>
<?php endif; ?>
                <div class="card border m-0  border-dark h-80">
                    <div class="card-body p-2">
                        <form action="<?php echo e(route('save')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Requisitos</label>
                                        <textarea id="myeditor" name="requirement" class="form-control ckeditor"  >
                                            <?php echo old('requirement', $requirement ?? ''); ?>

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 pt-4">
                                <a href="<?php echo e(route('institution.configuration')); ?>" class="btn btn-sm btn-secondary "> <i class='fas fa-ban '></i> Cancelar</a>
                                <button type="submit" class="btn btn-sm btn-dark"> <i class="fas  fa-save "></i> Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
                <script>
                    tinymce.init({
                        selector: '#myeditor',
                        height: 400,
                        menubar: false,
                        plugins: 'advlist autolink lists wordcount code',
                        toolbar: `  undo redo | 
                        formatselect | 
                        fontselect fontsizeselect | 
                        bold italic underline strikethrough | 
                        forecolor backcolor | 
                        alignleft aligncenter alignright alignjustify | 
                        bullist numlist outdent indent | 
                        removeformat | code`,
                        style_formats: [{
                                title: 'Encabezado 1',
                                format: 'h1'
                            },
                            {
                                title: 'Encabezado 2',
                                format: 'h2'
                            },
                            {
                                title: 'Encabezado 3',
                                format: 'h3'
                            },
                            {
                                title: 'Encabezado 4',
                                format: 'h4'
                            },
                            {
                                title: 'Encabezado 5',
                                format: 'h5'
                            },
                            {
                                title: 'Encabezado 6',
                                format: 'h6'
                            },
                            {
                                title: 'Párrafo',
                                format: 'p'
                            },
                            {
                                title: 'Cita',
                                format: 'blockquote'
                            }
                        ],

                        font_formats: "Arial=arial,helvetica,sans-serif;" +
                            "Courier New=courier new,courier,monospace;" +
                            "Georgia=georgia,palatino,serif;" +
                            "Tahoma=tahoma,arial,helvetica,sans-serif;" +
                            "Times New Roman=times new roman,times,serif;" +
                            "Verdana=verdana,geneva,sans-serif;",

                        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",

                        branding: false,
                        content_style: "body { font-family:Arial,sans-serif; font-size:14px }"
                    });
                </script>


            </main>

            <!-- FOOTER -->
            <footer class="dashboard-footer ">
                <div class="footer-content"></div>
                <div class="footer-bottom">
                    <p>&copy; <span id="year"></span> ICAP Potosi. Todos los derechos reservados.</p>
                    <p>Diseño y desarrollo web por <a href="https://github.com/JEdwinCrower" target="_blank">J.
                            Edwin</a></p>
                </div>
            </footer>

            <script>
                document.getElementById("year").textContent = new Date().getFullYear();
            </script>
        </div>

    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>




</body>

</html>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/prueba/requirement.blade.php ENDPATH**/ ?>
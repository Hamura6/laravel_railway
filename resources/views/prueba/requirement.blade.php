<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    {{--   <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{'assets/img/favicon.png'}} "> --}}
    <title>
        Corporate UI by Creative Timsdadsadas
    </title>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
        rel="stylesheet" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div class="layout-wrapper">



        @include('pages.layouts.app.sidebar')







        <div class="overlay-mobile" id="mobileOverlay" id="sidebar-overlay"></div>

        <div class="main-container">

            <!-- TOPBAR -->
             @include('pages.layouts.app.header')
            <!-- CONTENT -->
            <main class="content">

                <x-card-header title="Editar | Requisitos de inscripción" name="Saldos" />
                <div class="card border m-0  border-dark h-80">
                    <div class="card-body p-2">
                        <form action="{{ route('save') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Requisitos</label>
                                        <textarea id="myeditor" name="requirement" class="form-control ckeditor"  >
                                            {!! old('requirement', $requirement ?? '') !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 pt-4">
                                <a href="{{ route('institution.configuration') }}" class="btn btn-sm btn-secondary "> <i class='fas fa-ban '></i> Cancelar</a>
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

    @livewireScripts



</body>

</html>


<?php $__env->startSection('content'); ?>
    <div class="banner">
        <img class="img-banner" src="<?php echo e(asset('assets/img/single.jpg')); ?>" alt="Cursos">
        <div class="banner-content">
            <h2 class="title-banner">Eventos</h2>
            <p class="desc-banner">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, ullam ad minima a
                aliquid aut quia.</p>
        </div>
    </div>


    <section class="timeline-section py-5 bg-dark">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-warning mb-3">
                    Hitos Institucionales
                </h2>
                <p class="lead text-light opacity-90">
                    Más de 130 años forjando la excelencia jurídica en Bolivia
                </p>
            </div>

            <div id="timeline" class="timeline">

                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('site.events.galery',$event->id)); ?>">
                        <div class="timeline-item" data-id="112">
                            <div class="timeline-date">
                                <span class="year text-warning fw-bold">
                                    <?php echo e(\Carbon\Carbon::parse($event->date)->format('Y')); ?>

                                </span>
                                <span class="month text-light small d-block">
                                    <?php echo e(\Carbon\Carbon::parse($event->date)->translatedFormat('F')); ?>

                                </span>
                            </div>

                            <div class="timeline-marker">
                                <div class="marker-dot"></div>
                                <div class="marker-line"></div>
                            </div>

                            <div class="timeline-content shadow-lg">
                                
                                <img src="<?php echo e(asset('storage/event_photos/' . $event->firstPhoto->name)); ?>" alt="1212sd"
                                    class="timeline-img">
                                

                                <div class="p-4">
                                    <h3 class="timeline-title text-warning fw-bold">
                                        <?php echo e($event->title); ?>

                                    </h3>
                                    <p class="timeline-text text-light mb-0">
                                        <?php echo e($event->description); ?>

                                    </p>
                                    <small class="text-light opacity-70">
                                        Publicado el
                                        <?php echo e(\Carbon\Carbon::parse($event->created_at)->translatedFormat('d \\d\\e F \\d\\e Y')); ?>

                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <div id="loading" class="text-center mt-5" style="display:none;">
                <div class="spinner-border text-warning" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="text-light mt-3">Cargando más hitos...</p>
            </div>

            
            <div class="text-center mt-5">
                <form action="<?php echo e(route('site.events',$total+5)); ?>" method="GET">
                    <?php echo csrf_field(); ?>
                    <button id="loadMore" type="submit" class="btn btn-outline-warning btn-lg px-5">
                        Cargar más
                    </button>
                </form>
            </div>
            
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ICAPV4\ICAP\resources\views/site/pages/events.blade.php ENDPATH**/ ?>
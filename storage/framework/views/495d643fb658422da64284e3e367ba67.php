 <div class="card border m-0  border-dark h-100">
     <div class="card-header p-2 border-bottom">
         <div class="row g-1 ustify-content-between">
            <!--[if BLOCK]><![endif]--><?php if(isset($header)): ?>
            <?php echo e($header); ?>

            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
         </div>
     </div>
     <div class="card-body p-2">
        <?php echo e($slot); ?>

     </div>
 </div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/components/card-body.blade.php ENDPATH**/ ?>
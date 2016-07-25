<div class="flash-message">
    <?php foreach(['danger', 'warning', 'success', 'info'] as $msg): ?>
      <?php if(Session::has('alert-' . $msg)): ?>
       <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> 

        <?php if($msg == 'danger'): ?>
        <i class="fa fa-remove"></i>
        <?php elseif($msg == 'info'): ?>
        <i class="fa fa-check"></i>
        <?php endif; ?>
         
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

      </p>
      <?php endif; ?>
    <?php endforeach; ?>
  </div> <!-- end .flash-message -->

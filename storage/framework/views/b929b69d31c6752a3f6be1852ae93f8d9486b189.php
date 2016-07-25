<div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="<?php echo e(url('/')); ?>" class="brand">
                     DOLPINI
                        <small style="font-size:50%">
                            <i class="icon-leaf"></i>
                          Speak the truth
                        </small>
                    </a><!--/.brand-->

                    <!-- SETELAH LOGIN MUNCULNYA -->
                    <?php if(Auth::check() && Auth::user()->level == 'user'): ?>
                        <?php echo $__env->make('layouts.navbar_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif(Auth::check() && Auth::user()->level == 'admin'): ?>
                        <?php echo $__env->make('layouts.navbar_menu_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>

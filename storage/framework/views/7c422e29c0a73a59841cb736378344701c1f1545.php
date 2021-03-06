<?php $__env->startSection('content'); ?>

                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li class="active">
                            <i class="icon-home home-icon"></i>
                            <a href="<?php echo e(url('/')); ?>">Home</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        <li class="active">
                            <a href="<?php echo e(url('badwords/admin')); ?>">Pengaturan Sensor Kata</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        <li class="active"> <b>Penambahan Sensor Kata</b></li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>


<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(\Session::has('errors')): ?>

    <div class="alert alert-danger">
    <?php foreach($errors->all() as $message): ?>
    <li><?php echo e($message); ?></li>
    <?php endforeach; ?>
    </div>

<?php endif; ?>
                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <div class="span5">
                                        <div class="widget-box">
                                            <div class="widget-header">
                                                <h4>
                                                    <i class="fa fa-warning"></i>
                                                    Edit Sensor Kata
                                                </h4>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main">
                                                   
                                                   <form action="<?php echo e(url('badwords/edit')); ?>" method="POST" id="badwords-form">

                                                    <?php echo csrf_field(); ?>

                                                    <input type="hidden" name="id" id="id" class="autosize-transition span12" placeholder="Forbidden word" value="<?php echo e($badword->id); ?>">
                                                     <div class="controls">
                                                        <label>Forbidden words</label>
                                                        <input type="text" name="word" id="word" class="autosize-transition span12" placeholder="Forbidden word" value="<?php echo e($badword->word); ?>">
                                                    </div>
                                                   <div class="controls">
                                                         <label>Replacement words</label>
                                                        <input type="text" name="replace_to" id="replace_to" class="autosize-transition span12" placeholder="Replacement word" value="<?php echo e($badword->replace_to); ?>">
                                                    </div>
                                                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                                                    </form>

                                                    <form method="post" action="<?php echo e(url('badwords/forceDelete')); ?>">
                                                        <?php echo csrf_field(); ?>

                                                        <input type="hidden" name="id" value="<?php echo e($badword->id); ?>">
                                                        <button type="submit" class="btn btn-block btn-danger" onclick="if (!confirm('Hapus Sensor kata ini?'))
                                                            {
                                                                return false;
                                                            }
                                                            ;"><i class="fa fa-trash"></i> Delete</button> 
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                        </div>
                    </div>
            </div><!--/.page-content-->




</div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <?php echo $__env->make('library', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('admin.badwords.badwords_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
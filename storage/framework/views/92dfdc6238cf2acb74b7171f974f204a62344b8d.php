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

                        <li class="active"> <b>Pengaturan Sensor Kata</b></li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>


<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <a href="<?php echo e(url('badwords/create')); ?>" class="btn btn-mini btn-info"> 
                                <i class="fa fa-plus"></i> 
                                Word</a>

                            <table id="badwords-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">Sensor id</th>
                                        <th>Kata</th>
                                        <th>Ubah Menjadi</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php foreach($word as $w): ?>
                                       <tr>
                                        <td><?php echo e($w->id); ?></td>
                                        <td><?php echo e($w->word); ?></td>
                                        <td><?php echo e($w->replace_to); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('badwords/edit',$w->id)); ?>" class="btn btn-mini btn-info">
                                                <i class="fa fa-search"></i> 
                                            </a>
                                           

                                        </td>
                                       </tr>
                                   <?php endforeach; ?>
                                </tbody>
                            </table>

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
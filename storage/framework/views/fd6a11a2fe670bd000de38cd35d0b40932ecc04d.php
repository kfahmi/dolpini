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

                        <li class="active"> <b>Pengaturan Hashtag</b></li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>


<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <table id="tag-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">id</th>
                                        <th><i class="fa fa-hashtag"></i> Hashtag</th>
                                        <th>Used in (post/topic)</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php foreach($tag as $t): ?>
                                       <tr>
                                        <td><?php echo e($t->id); ?></td>
                                        <td><?php echo e($t->tag_name); ?></td>
                                        <td><?php echo e($t->hasPostTag->count()); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('/home',$t->id)); ?>" class="btn btn-mini btn-info">
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
        <?php echo $__env->make('admin.tag.tag_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
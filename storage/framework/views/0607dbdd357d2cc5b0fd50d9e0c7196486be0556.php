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

                        <li class="active"> <b>Pengaturan Komentar</b></li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>


<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                              <table id="reply-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">Komentar id</th>
                                        <th width="15%">User</th>
                                        <th>Komentar</th>
                                        <th> @kubu  - Topic </th>
                                        <th width="5%">Status</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php foreach($replyKubu as $r): ?>
                                   <tr>
                                    <td><?php echo e($r->id); ?></td>
                                    <td><?php echo e($r->user->real_name); ?></td>
                                    <td><?php echo e($r->text); ?></td>
                                    <td>@ <?php echo e($r->kubu->label); ?> - [<?php echo e($r->kubu->post->type); ?>] <?php echo e($r->kubu->post->title); ?></td>
                                    <td><?php echo e(Helper::kontenStatus($r->id,'replyKubu','html')); ?></td>
                                    <td>
                                        <!-- jika belom dihapus -->
                                        <form method="post" action="<?php echo e(url('post/reply/deleteRestoreReply')); ?>">
                                            <?php echo csrf_field(); ?>


                                            <a href="<?php echo e(url('post/detail',$r->kubu->post->id)); ?>" class="btn btn-mini btn-info">
                                                    <i class="fa fa-search"></i>
                                            </a>

                                            <input type="hidden" name="id" value="<?php echo e($r->id); ?>">
                                            <!-- kalo blm dihapus -->
                                            <?php if(!isset($r->deleted_at)): ?>
                                              <button type="submit" class="btn btn-mini btn-danger" onclick="if (!confirm('Hapus / Non Aktifkan komentar ini?'))
                                                {
                                                    return false;
                                                }
                                                ;"><i class="fa fa-trash"></i> </button> 
                                            <?php else: ?>
                                                <button type="submit" class="btn btn-mini btn-success" onclick="if (!confirm('Restore / Aktifkan komentar ini?'))
                                                {
                                                    return false;
                                                }
                                                ;"><i class="fa fa-refresh"></i> </button> 

                                            <?php endif; ?>
                                        </form>
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
        <?php echo $__env->make('admin.post.post_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
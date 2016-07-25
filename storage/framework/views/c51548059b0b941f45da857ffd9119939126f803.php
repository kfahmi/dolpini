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

                        <li class="active"> <b>Pengaturan User</b></li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>


<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">

                            <table id="user-datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">user id</th>
                                        <th width="5%">Level</th>
                                        <th>Real name</th>
                                        <th>Nick name</th>
                                        <th>Email</th>
                                        <th>Join Date</th>
                                        <th>Status</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php foreach($user as $u): ?>


                                   <tr>
                                    <td><?php echo e($u->id); ?></td>
                                    <td><?php echo e($u->level); ?></td>
                                    <td><?php echo e($u->real_name); ?></td>
                                    <td><?php echo e($u->nick_name); ?></td>
                                    <td><?php echo e($u->email); ?></td>
                                    <td><?php echo e($u->created_at); ?></td>
                                    <td><?php echo e(Helper::userStatus($u->id,'html')); ?></td>
                                    <td>
                                        <form method="post" action="<?php echo e(url('user/deleteRestore')); ?>">
                                            <?php echo csrf_field(); ?>


                                          

                                            <input type="hidden" name="id" value="<?php echo e($u->id); ?>">
                                            <!-- kalo blm dihapus -->
                                            <?php if(!isset($u->deleted_at)): ?>
                                               <a href="<?php echo e(url('user/profile',$u->nick_name)); ?>" class="btn btn-mini btn-info">
                                                <i class="fa fa-search"></i>
                                             </a>

                                              <button type="submit" class="btn btn-mini btn-danger" onclick="if (!confirm('Hapus / Non Aktifkan user ini?'))
                                                {
                                                    return false;
                                                }
                                                ;"><i class="fa fa-trash"></i> </button> 
                                            <?php else: ?>
                                                <button type="submit" class="btn btn-mini btn-success" onclick="if (!confirm('Restore / Aktifkan user ini?'))
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
        <?php echo $__env->make('admin.user.user_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <li class="active"><?php echo e(Helper::showName($user->id)); ?></li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<div class="page-content">
					<div class="page-header position-relative">
						
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<?php if(Auth::user()->nick_name == $user->nick_name || Auth::user()->level == 'admin'): ?>

							<!-- EDIT -->
							<div class="clearfix editbtn">
								<div class="pull-left alert alert-success inline no-margin" id="editProfileBtn">
									<!-- <button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button> -->

									<i class="icon-pencil bigger-120 blue"></i>
									Edit profile
								</div>
							</div>

							<div class="clearfix showbtn" style="display:none;">
								<div class="pull-left alert alert-success inline no-margin" id="showProfileBtn">
									<!-- <button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button> -->

									<i class="icon-remove bigger-120 blue"></i>
									cancel edit
								</div>
							</div>
							<!-- END EDIT -->
							<?php echo $__env->make('layouts.errorform', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<div class="hr dotted"></div>
							<?php endif; ?>



								<?php echo $__env->make('user.profile_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

								<?php echo $__env->make('user.profile_show', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



							
						
							</div>
						</div><!--/.row-fluid-->
					</div><!--/.page-content-->
</div><!--/.main-content-->
        <?php echo $__env->make('library', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <!-- KALAU PROFILE MILIK SENDIRI INI DI INCLUDE BUAT EDIT -->
        <?php if(Auth::user()->nick_name == $user->nick_name || Auth::user()->level == 'admin'): ?>
      	  <?php echo $__env->make('user.profile_own_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
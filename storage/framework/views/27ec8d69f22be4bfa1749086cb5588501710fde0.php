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

                        <?php if(Auth::user()->level == 'admin'): ?>
                        <li class="active">
                            <a href="<?php echo e(url('/post/admin')); ?>"> Pengaturan Topik</a>
                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        <?php endif; ?>

                         <li class="active">
                            <a href="<?php echo e(url('/post/detail',$post->id)); ?>">[<u><?php echo e($post->type); ?></u>] <?php echo e(Helper::lessChar($post->title,100)); ?></a>
                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        <li class="active">Edit</li>
                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	

				<div class="page-content">
					<div class="row-fluid">
							<div class="span12 widget-container-span">
									<div class="widget-box transparent">
										<div class="widget-header">
											<h4 class="lighter">
												<small>
												Posted by : <a href="<?php echo e(url('user/profile',$post->user->nick_name)); ?>"><?php echo e(Helper::showName($post->user_id)); ?></a>
												<i class="fa fa-ellipsis-v"></i>
												<i class="icon-time"></i> Dibuat <span class="green"><?php echo e(Helper::postDateFormat($post->created_at)); ?></span>
												<i class="fa fa-ellipsis-v"></i> <i class="icon-time"></i> Aktivitas terakhir <span class="green"><?php echo e(Helper::postDateFormat($post->updated_at)); ?></span> 
											</small></h4>

											<div class="widget-toolbar no-border">
												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>
											</div>
										</div>

										<div class="widget-body">

											<div class="tabbable">
		                                        <ul class="nav nav-tabs" id="myTab">

		                                            <li class="active">
		                                                <a data-toggle="tab" href="#post">
		                                                    <i class="blue icon-comments bigger-110"></i>

		                                                    <b>
		                                                      Post
		                                                    </b>
		                                                       
		                                                </a>
		                                            </li>

		                                            <li>
		                                                <a data-toggle="tab" href="#detail">
		                                                    <i class="blue fa fa-th-list bigger-110"></i>

		                                                    <b>
		                                                      Detail
		                                                    </b>
		                                                       
		                                                </a>
		                                            </li>
<!-- 
		                                            <li>
		                                                <a data-toggle="tab" href="#hashtag">
		                                                    <i class="blue fa fa-hashtag bigger-110"></i>
		                                                    <b>
		                                                      hashtag
		                                                    </b>
		                                                       
		                                                </a>
		                                            </li>

		                                            <li>
		                                                <a data-toggle="tab" href="#kubu">
		                                                    <i class="blue icon-comments bigger-110"></i>

		                                                    <b>
		                                                      kubu
		                                                    </b>
		                                                       
		                                                </a>
		                                            </li> -->
		                                      

		                                        </ul>

		                                        <div class="tab-content">
		                                            <div id="post" class="tab-pane in active">
		                                                <?php echo $__env->make('post.edit_post', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		                                            </div>
		                                            <div id="detail" class="tab-pane">
		                                                <?php echo $__env->make('post.edit_post_detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		                                            </div>
		                                            <div id="hashtag" class="tab-pane">
		                                               <?php echo $__env->make('post.edit_post_hashtag', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		                                            </div>
		                                            <div id="kubu" class="tab-pane">
		                                               <?php echo $__env->make('post.edit_post_kubu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		                                            </div>
		                                      
		                                        </div>
		                                    </div>

											</div>
										</div>
									</div>
								</div>

								<div class="hr hr-dotted span12" style="margin:0 !important;"></div>

				</div><!--/.page-content-->



</div><!--/.main-content-->
        <?php echo $__env->make('library', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php echo $__env->make('post.view_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
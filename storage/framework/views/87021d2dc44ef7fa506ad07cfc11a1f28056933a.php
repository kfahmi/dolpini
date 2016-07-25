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

                  	 <li class="active">[<u><?php echo e($post->type); ?></u>] <?php echo e(Helper::lessChar($post->title,100)); ?></li>

                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>

<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<div class="page-content">
					<div class="row-fluid">
							<div class="span12 widget-container-span">
									<div class="widget-box transparent">


										<?php if(Auth::user()->level == 'admin' && Helper::kontenStatus($post->id,'post','value') == 'reported'): ?>
										<div class="alert alert-important"><i class="fa fa-warning fa-2x"></i> Topik ini dilaporkan oleh beberapa user. Apakah topik ini aman?
												<a href="<?php echo e(url('post/cleanReported',$post->id)); ?>" onclick="if (!confirm('jika Topik aman, maka laporan tentang topik ini akan di hapus. setuju ?')){return false;};"> <i class="fa fa-check"></i> Ya, topik ini aman </a> 

												<a href="<?php echo e(url('post/delete',$post->id)); ?>" onclick="if (!confirm('Non Aktifkan /  Delete Topik ?')){return false;};" class="red"> <i class="fa fa-remove"></i> Tidak, Topik tidak aman </a> 
										</div><hr>
										<?php elseif(isset($post->deleted_at)): ?>

										<div class="alert alert-important"><i class="fa fa-warning fa-2x"></i> Topik ini sudah di non-Aktifkan 

											<?php if(Auth::user()->id == $post->user_id || Auth::user()->level == 'admin'): ?>
											<i class="fa fa-ellipsis-v"></i>
												<a href="<?php echo e(url('post/reactivate',$post->id)); ?>" onclick="if (!confirm('Aktifkan Topik?')){return false;};"> <i class="fa fa-refresh"></i> Aktifkan kembali </a>
											<?php endif; ?>


										</div><hr>

										<?php endif; ?>


										<div class="widget-header">
											<h4 class="lighter"> <b>[<u><?php echo e($post->type); ?></u>]</b> <?php echo e($post->title); ?> 
												<small>
												<i class="fa fa-ellipsis-v"></i> Posted by : <a href="<?php echo e(url('user/profile',$post->user->nick_name)); ?>"><?php echo e(Helper::showName($post->user_id)); ?></a>
												<i class="fa fa-ellipsis-v"></i>
												<i class="icon-time"></i> Dibuat <span class="green"><?php echo e(Helper::postDateFormat($post->created_at)); ?></span>
												<i class="fa fa-ellipsis-v"></i> <i class="icon-time"></i> Aktivitas terakhir <span class="green"><?php echo e(Helper::postDateFormat($post->updated_at)); ?></span> 
											</small></h4>

											<div class="widget-toolbar no-border">
												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!-- tombol admin atau owner post -->
												<?php if(Auth::user()->id == $post->user_id || Auth::user()->level == 'admin'): ?>
													<?php if(!isset($post->deleted_at)): ?>
													<a href="<?php echo e(url('post/delete',$post->id)); ?>" onclick="if (!confirm('Non Aktifkan /  Delete Topik?')){return false;};">
														<i class="icon-remove"></i>
													</a>

													<a href="<?php echo e(url('post/edit',$post->id)); ?>" onclick="if (!confirm('Edit topik?')){return false;};">
														<i class="icon-pencil"></i>
													</a>
													<?php endif; ?>
												<?php endif; ?>
												<!-- end tombol admin atau owner post -->

												<!-- //subscribe -->
												<?php if(Helper::alreadySubscribe($post->id,Auth::user()->id) == true): ?>
												<a href="<?php echo e(url('/post/subscribe',$post->id)); ?>" class="btn btn-app btn-minier btn-danger" style="padding:5px;font-size:90%;" onclick="if (!confirm('Stop Mengikuti Topik ini?')){return false;};">
													<i class="fa fa-check"></i> <?php echo e($post->subscriber->count()); ?> Pengikut
												</a>
												<?php elseif(Helper::alreadySubscribe($post->id) == false): ?>
												<a href="<?php echo e(url('/post/subscribe',$post->id)); ?>" class="btn btn-app btn-minier btn-primary" style="padding:5px;font-size:90%;" onclick="if (!confirm('Ikuti Topik ini?')){return false;};">
													<i class="fa fa-retweet"></i> Ikuti 
												</a>
												<?php endif; ?>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main padding-6 no-padding-left no-padding-right">
												
												<div class="padding-6 center hideable">
												<?php echo e($post->header_content); ?>

												</div>

												<!-- POSTDETAILS -->
												<?php if(count($post->postDetails) > 0): ?>
													<div id="details_<?php echo e($post->id); ?>">
													<br>
														<?php if(count($post->postDetailsImage) > 0): ?>
														<div class="span11">
															<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
															<h4><i class="icon-camera"></i></h4>
															<?php foreach($post->postDetailsImage as $pd): ?>
															<div class="pull-left" style="margin:5px;">
																<img class="editable" alt="image" src="<?php echo e(URL::asset('uploads/post/'.$pd->id.$pd->content)); ?>" width="450px" style="display: block;margin: 0 auto;"/>
															</div>
															<?php endforeach; ?>

														</div>
														<?php endif; ?>

														
														<?php if(count($post->postDetailsYoutube) > 0): ?>
														<div class="span11">
															<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
															<h4><i class="icon-youtube icon-large"></i></h4>
															<?php foreach($post->postDetailsYoutube as $pd): ?>
															<div class="pull-left" style="margin:5px;">
																<iframe width="450" height="260" src="https://www.youtube.com/embed/<?php echo e($pd->content); ?>" frameborder="0" allowfullscreen></iframe>
															</div>
															<?php endforeach; ?>

														</div>
														<?php endif; ?>

														<?php if(count($post->postDetailsUrl) > 0): ?>
														<div class="span11">
															<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
															<h4><i class="fa fa-globe fa-spin"></i></h4>
															<?php $i=0;?>
															<?php foreach($post->postDetailsUrl as $pd): ?>
															<div class="pull-left urlive-container" style="margin:5px;">
																<a href="<?php echo e($pd->content); ?>" class="urlData" target="_blank" style="display:none;"><?php echo e($pd->content); ?></a>
															</div>


															<div class="pureUrl">
																<i class="fa fa-spin fa-spinner"></i> Memuat Content... 
																<a href="<?php echo e($pd->content); ?>"><?php echo e($pd->content); ?></a>
															</div>

															<?php $i++;?>
															<?php endforeach; ?>
														</div>
														<?php endif; ?>
													</div>
												<?php endif; ?>
												<!-- ENDPOSTDETAILS -->

												<!-- POSTTAGS -->
												<?php if(count($post->postTags)>0): ?>
													<div id='postTag' class="span11">
														<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
														<b>Tags:</b><br>
														<?php foreach($post->postTags as $pt): ?>

														<a href="<?php echo e(url('/home',$pt->tag_id)); ?>">#<?php echo e($pt->tag->tag_name); ?></a>

														<?php endforeach; ?>
													</div>
												<?php endif; ?>	
												<!-- ENDPOSTTAGS -->

													<div class="span12 tools">
														<?php if($post->userLiked->count() >  0): ?>
														<a class="btn btn-minier btn-info">
															<?php echo e($post->hasLikes->count()); ?> <i class="fa fa-thumbs-o-up"></i>
														</a>
														<?php else: ?>
														<a href="<?php echo e(url('/post/flag/like',$post->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Like?')){return false;};">
															<?php echo e($post->hasLikes->count()); ?> <i class="fa fa-thumbs-o-up"></i>
														</a>
														<?php endif; ?>

														<?php if($post->userDisliked->count() > 0): ?>
														<a class="btn btn-minier btn-warning">
															<?php echo e($post->hasDislikes->count()); ?> <i class="fa fa-thumbs-o-down"></i>
														</a>
														<?php else: ?>
														<a href="<?php echo e(url('/post/flag/dislike',$post->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Dislike?')){return false;};">
															<?php echo e($post->hasDislikes->count()); ?> <i class="fa fa-thumbs-o-down"></i>
														</a>
														<?php endif; ?>

														<?php if($post->userReported->count() > 0): ?>
														<a class="btn btn-minier btn-danger">
															<?php echo e($post->hasReports->count()); ?> <i class="fa fa-warning"></i>
														</a>
														<?php else: ?>
														<a href="<?php echo e(url('/post/flag/report',$post->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Report?')){return false;};">
															<?php echo e($post->hasReports->count()); ?> <i class="fa fa-warning"></i>
														</a>
														<?php endif; ?>
													</div>

											</div>
										</div>
									</div>
								</div>

								<div class="hr hr-dotted span12" style="margin:0 !important;"></div>

								<?php if(!isset($post->deleted_at)): ?>
								<?php foreach($post->postKubu as $kubu): ?>

									<?php if($post->type != 'artikel'): ?>
										<div class="span6 widget-container-span" style="margin:0 5px 0 0 !important;">
									<?php else: ?>
										<div class="span12 widget-container-span" style="margin:0 5px 0 0 !important;">
									<?php endif; ?>

										<div class="widget-box">
											<div class="widget-header header-color-dark">
												
												<!-- jika bukan artikel -->
												<?php if($post->type != 'artikel'): ?>
												<h5 class="bigger lighter"><?php echo e($kubu->label); ?>

													<!-- //jika dia kubu ini -->
															<?php if(Helper::checkKubu(Auth::user()->id,$kubu->id) == true): ?>
																(Kamu berpihak disini)
															<?php endif; ?>
												</h5>
												<div class="widget-toolbar">
													<div class="progress progress-danger progress-striped active" style="width:100px;" data-percent="<?php echo e(Counter::kubuPercentage($kubu->id,$post->id)); ?> %">
														<div class="bar" style="width:<?php echo e(Counter::kubuPercentage($kubu->id,$post->id)); ?>%"></div>
													</div>
												</div>
												<?php else: ?>
												<h5 class="bigger lighter"><?php echo e($kubu->label); ?>

												</h5>

												<?php endif; ?>
											</div>

											<div class="widget-body">

												


												<div class="widget-main">

												<?php if(count($kubu->replies) > 0): ?>
													<?php echo $__env->make('post.replies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
												<?php else: ?>
													<div class="alert alert-info">Belum ada balasan</div>
												<?php endif; ?>
												</div>
												<!-- endwidgetmain -->
												<?php if(Helper::checkKubu(Auth::user()->id,$kubu->id) == true || Helper::checkReplyPost(Auth::user()->id,$post->id) == false): ?>
												<div class="alert alert-info">
												<form onsubmit="submitForm()" action="<?php echo e(url('/post/reply')); ?>" method="POST" id="reply-form" enctype="multipart/form-data">
													<?php echo csrf_field(); ?>

													<input type="hidden" name="post_kubu_id" value="<?php echo e($kubu->id); ?>" required>
										            <input type="hidden" name="post_id" value="<?php echo e($kubu->post_id); ?>" required>  	      
													  	<div class="controls">
									                        <textarea name="text" id="text" class="autosize-transition span12" placeholder="ketik opini disini" required><?php echo e(Input::old('text')); ?></textarea>
									                        <?php if($errors->has('text')): ?>
									                            <span class="help-block">
									                                <strong><?php echo e($errors->first('text')); ?></strong>
									                            </span>
									                        <?php endif; ?>
									                    </div>
														<button type="submit" class="btn btn-small btn-success">
															<i class="fa fa-comment"></i>
															Balas
														</button>

								                </form>
								            	</div>
												<?php endif; ?>



											</div>
										</div>
									</div>
								<?php endforeach; ?>
								<?php endif; ?>


					</div>
				</div><!--/.page-content-->



</div><!--/.main-content-->
        <?php echo $__env->make('library', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php echo $__env->make('post.view_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
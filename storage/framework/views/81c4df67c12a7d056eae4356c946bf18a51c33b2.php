<div id="profileShow">


	<?php if($user->show_as == 'anonim' && Auth::user()->nick_name != $user->nick_name): ?>

	<div class="alert alert-danger">
		Anda tidak bisa melihat profile anonim
	</div>

	<?php else: ?>
								<div id="user-profile-1" class="user-profile row-fluid">
									<div class="span3 center">
										<div>
											<span class="profile-picture">

												<?php if($user->img != '' || !empty($user->img)): ?>
													<img id="avatar" class="editable" alt="Alex's Avatar" src="<?php echo e(URL::asset('uploads/userImg/'.$user->img)); ?>" />
												<?php else: ?>
													<h4 id="avatar" class="editable" style="font-size:500%;padding:9px;"><?php echo e($userInitial); ?></h4>
												<?php endif; ?>

											</span>

											<div class="space-4"></div>

											<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
												<div class="inline position-relative">
													<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
														<i class="icon-circle light-green middle"></i>
														&nbsp;
														<span class="white middle bigger-120"><?php echo e($user->real_name); ?> a.k.a <?php echo e($user->nick_name); ?></span>
													</a>

													<?php if(Auth::user()->nick_name == $user->nick_name): ?>
													<!-- <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
														<li class="nav-header"> Change Status </li>

														<li>
															<a href="#">
																<i class="icon-circle green"></i>
																&nbsp;
																<span class="green">Available</span>
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-circle red"></i>
																&nbsp;
																<span class="red">Busy</span>
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-circle grey"></i>
																&nbsp;
																<span class="grey">Invisible</span>
															</a>
														</li>
													</ul> -->
													<?php endif; ?>


												</div>
											</div>
										</div>

										<div class="space-6"></div>

										<!-- //kalau lihat profile orang -->
										<?php if(Auth::user()->nick_name != $user->nick_name): ?>
										<div class="profile-contact-info">
											<div class="profile-contact-links align-left">

												<?php if($relationStatus == 'none'): ?>
													<a class="tombolProses btn btn-link" href="<?php echo e(url('/follow/add',$user->id)); ?>" onclick="if (!confirm('Are you sure want to follow <?php echo e($user->nick_name); ?>?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;">
														<i class="icon-exchange bigger-120 green"></i>
														Follow
													</a>
												<?php elseif($relationStatus == 'waiting'): ?>
														<i class="icon-spin icon-spinner bigger-120 green"></i>
														Waiting for approval
												<?php elseif($relationStatus == 'approved'): ?>
														<i class="icon-retweet bigger-120 green"></i>
														Followed
												<?php endif; ?>

											
											</div>

											<div class="space-6"></div>

											<div class="profile-social-links center">
												<a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
													<i class="middle icon-facebook-sign icon-2x blue"></i>
												</a>

												<a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
													<i class="middle icon-twitter-sign icon-2x light-blue"></i>
												</a>

												<a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
													<i class="middle icon-pinterest-sign icon-2x red"></i>
												</a>
											</div>
										</div>
										<?php endif; ?>

										<div class="hr hr12 dotted"></div>

										<div class="clearfix">
											<div class="grid2">
												<span class="bigger-175 blue"><?php echo e($user->followers->count()); ?></span>

												<br />
												Followers
											</div>

											<div class="grid2">
												<span class="bigger-175 blue"><?php echo e($user->followings->count()); ?></span>

												<br />
												Following
											</div>
										</div>

										<div class="hr hr16 dotted"></div>
									</div>

									<div class="span9">
										<?php echo $__env->make('user.profile_counter_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

										<div class="space-12"></div>

										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> Nick name </div>

												<div class="profile-info-value">
													<span class="editable" id="nick_name"><?php echo e($user->nick_name); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Real name </div>

												<div class="profile-info-value">
													<span class="editable" id="real_name"><?php echo e($user->real_name); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Email </div>

												<div class="profile-info-value">
													<span class="editable" id="real_name"><?php echo e($user->email); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Mobile Phone </div>

												<div class="profile-info-value">
													<span class="editable" id="mobile_phone"><?php echo e($user->mobile_phone); ?></span>
												</div>
											</div>

										</div>

										<div class="space-20"></div>

										<?php if($user->confirmation_code != null && Auth::user()->level == 'admin'): ?>
										<a href="<?php echo e(url('user/sendCode',$user->id)); ?>" onclick="if (!confirm('send confrimation code to <?php echo e($user->nick_name); ?> (<?php echo e($user->email); ?>)?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;" class="pull-left alert alert-info inline no-margin" >
											<span id="editProfileBtn">
												<i class="fa fa-upload bigger-120 blue"></i>
												Send Confirmation Code
											</span>
										</a>
										<br>
										<br>
										OR
										<br>

										<a href="<?php echo e(url('user/verify_unverify_ByAdmin',$user->id)); ?>" onclick="if (!confirm('Are you sure want to verify and activate <?php echo e($user->nick_name); ?>?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;" class="pull-left alert alert-danger inline no-margin" >
											<span id="editProfileBtn">
												<i class="fa fa-spin fa-spinner bigger-120 blue"></i>
												Unverified User, Verify and Activate Now?
											</span>
										</a>

										

										
										<?php elseif($user->confirmation_code == null && Auth::user()->level == 'admin'): ?>
										<a href="<?php echo e(url('user/verify_unverify_ByAdmin',$user->id)); ?>" onclick="if (!confirm('Are you sure want to Unverify and deactivate <?php echo e($user->nick_name); ?>?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;">
											<span class="pull-left alert alert-success inline no-margin" id="editProfileBtn">
												<i class="fa fa-check bigger-120 blue"></i>
												Verified User, Unverify and Deactivate Now?
											</span>
										</a>
										<?php endif; ?>
							
										</div>
								</div>

		<?php endif; ?>
</div>
<!-- END PROFILE SHOW -->
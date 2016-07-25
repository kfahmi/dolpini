<div id="profileEdit" style="display:none;">
	<form method="post" action="<?php echo e(url('/user/edit')); ?>" enctype="multipart/form-data" onsubmit="submitForm()">
	<?php echo csrf_field(); ?>


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

												</div>
											</div>
										</div>

										<div class="space-6"></div>

										<!-- //kalau lihat profile orang -->
										<?php if(Auth::user()->nick_name != $user->nick_name): ?>
										<div class="profile-contact-info">
											<div class="profile-contact-links align-left">

												<?php if($relationStatus == 'none'): ?>
													<a class="btn btn-link" href="<?php echo e(url('/follow/add',$user->id)); ?>" onclick="if (!confirm('Are you sure want to follow <?php echo e($user->nick_name); ?>?'))
									                    {
									                        return false;
									                    }
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

											<input type="hidden" value="<?php echo e($user->id); ?>" name="id"/>
											<div class="profile-info-row">
												<div class="profile-info-name"> Nick name </div>

												<div class="profile-info-value">
													<span class="editable" id="nick_name"><?php echo e($user->nick_name); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Real name </div>

												<div class="profile-info-value">
													<input type="text" value="<?php echo e($user->real_name); ?>" name="real_name"/>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Email </div>

												<div class="profile-info-value">
													<input type="text" value="<?php echo e($user->email); ?>" name="email"/>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Mobile Phone </div>

												<div class="profile-info-value">
													<input type="text" value="<?php echo e($user->mobile_phone); ?>" name="mobile_phone"/>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> New Photo </div>

												<div class="profile-info-value">
													<input type="file" name="newPhoto"/>
												</div>
											</div>

											<!-- <div class="profile-info-row">
												<div class="profile-info-name"> Notifikasi Email</div>

												<div class="profile-info-value">
														<div class="controls">
															<label>
															<input name="email_notif" class="ace-switch ace-switch-2" type="checkbox" <?php echo e(($user->email_notif)=='1' ? 'checked' : ""); ?>/>
															<span class="lbl"></span>
															</label>
														</div>
												</div>
											</div> -->

											<div class="profile-info-row">
												<div class="profile-info-name"> Terima Follow Otomatis</div>

												<div class="profile-info-value">
														<div class="controls">
															<label>
															<input name="auto_accept_follower" class="ace-switch ace-switch-2" type="checkbox" <?php echo e(($user->auto_accept_follower)=='1' ? 'checked' : ""); ?>/>
															<span class="lbl"></span>
															</label>
														</div>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Ditampilkan sebagai</div>

												<div class="profile-info-value">
														<div class="controls">
															<label>
																<input name="show_as" type="radio" value="real" <?php echo e(($user->show_as)=='real' ? 'checked' : ""); ?>/>
																<span class="lbl"><?php echo e($user->real_name); ?></span>
															</label>

															<label>
																<input name="show_as" type="radio" value="nick" <?php echo e(($user->show_as)=='nick' ? 'checked' : ""); ?>/>
																<span class="lbl"><?php echo e($user->nick_name); ?></span>
															</label>

															<label>
																<input name="show_as" type="radio" value="anonim" <?php echo e(($user->show_as)=='anonim' ? 'checked' : ""); ?>/>
																<span class="lbl">Anonim</span>
															</label>

														</div>
												</div>
											</div>

										</div>

										<div class="space-20"></div>

										<button type="submit" class="pull-left btn btn-small btn-primary">
                                            <i class="icon-save"></i>
                                           Update
                                        </button>
										</div>
								</div>
					</form>
</div>
							<!-- END PROFILE SHOW -->
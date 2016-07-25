<div id="profileShow">


	@if($user->show_as == 'anonim' && Auth::user()->nick_name != $user->nick_name)

	<div class="alert alert-danger">
		Anda tidak bisa melihat profile anonim
	</div>

	@else
								<div id="user-profile-1" class="user-profile row-fluid">
									<div class="span3 center">
										<div>
											<span class="profile-picture">

												@if($user->img != '' || !empty($user->img))
													<img id="avatar" class="editable" alt="Alex's Avatar" src="{{URL::asset('uploads/userImg/'.$user->img)}}" />
												@else
													<h4 id="avatar" class="editable" style="font-size:500%;padding:9px;">{{$userInitial}}</h4>
												@endif

											</span>

											<div class="space-4"></div>

											<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
												<div class="inline position-relative">
													<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
														<i class="icon-circle light-green middle"></i>
														&nbsp;
														<span class="white middle bigger-120">{{$user->real_name}} a.k.a {{$user->nick_name}}</span>
													</a>

													@if(Auth::user()->nick_name == $user->nick_name)
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
													@endif


												</div>
											</div>
										</div>

										<div class="space-6"></div>

										<!-- //kalau lihat profile orang -->
										@if(Auth::user()->nick_name != $user->nick_name)
										<div class="profile-contact-info">
											<div class="profile-contact-links align-left">

												@if($relationStatus == 'none')
													<a class="tombolProses btn btn-link" href="{{url('/follow/add',$user->id)}}" onclick="if (!confirm('Are you sure want to follow {{$user->nick_name}}?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;">
														<i class="icon-exchange bigger-120 green"></i>
														Follow
													</a>
												@elseif($relationStatus == 'waiting')
														<i class="icon-spin icon-spinner bigger-120 green"></i>
														Waiting for approval
												@elseif($relationStatus == 'approved')
														<i class="icon-retweet bigger-120 green"></i>
														Followed
												@endif

											
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
										@endif

										<div class="hr hr12 dotted"></div>

										<div class="clearfix">
											<div class="grid2">
												<span class="bigger-175 blue">{{$user->followers->count()}}</span>

												<br />
												Followers
											</div>

											<div class="grid2">
												<span class="bigger-175 blue">{{$user->followings->count()}}</span>

												<br />
												Following
											</div>
										</div>

										<div class="hr hr16 dotted"></div>
									</div>

									<div class="span9">
										@include('user.profile_counter_info')

										<div class="space-12"></div>

										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> Nick name </div>

												<div class="profile-info-value">
													<span class="editable" id="nick_name">{{$user->nick_name}}</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Real name </div>

												<div class="profile-info-value">
													<span class="editable" id="real_name">{{$user->real_name}}</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name">Email </div>

												<div class="profile-info-value">
													<span class="editable" id="real_name">{{$user->email}}</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Mobile Phone </div>

												<div class="profile-info-value">
													<span class="editable" id="mobile_phone">{{$user->mobile_phone}}</span>
												</div>
											</div>

										</div>

										<div class="space-20"></div>

										@if($user->confirmation_code != null && Auth::user()->level == 'admin')
										<a href="{{url('user/sendCode',$user->id)}}" onclick="if (!confirm('send confrimation code to {{$user->nick_name}} ({{$user->email}})?'))
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

										<a href="{{url('user/verify_unverify_ByAdmin',$user->id)}}" onclick="if (!confirm('Are you sure want to verify and activate {{$user->nick_name}}?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;" class="pull-left alert alert-danger inline no-margin" >
											<span id="editProfileBtn">
												<i class="fa fa-spin fa-spinner bigger-120 blue"></i>
												Unverified User, Verify and Activate Now?
											</span>
										</a>

										

										
										@elseif($user->confirmation_code == null && Auth::user()->level == 'admin')
										<a href="{{url('user/verify_unverify_ByAdmin',$user->id)}}" onclick="if (!confirm('Are you sure want to Unverify and deactivate {{$user->nick_name}}?'))
									                    {
									                        return false;
									                    }submitForm();
									                    ;">
											<span class="pull-left alert alert-success inline no-margin" id="editProfileBtn">
												<i class="fa fa-check bigger-120 blue"></i>
												Verified User, Unverify and Deactivate Now?
											</span>
										</a>
										@endif
							
										</div>
								</div>

		@endif
</div>
<!-- END PROFILE SHOW -->
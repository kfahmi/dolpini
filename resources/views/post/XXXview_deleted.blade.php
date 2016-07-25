@extends('layouts.app')

@section('content')

				<div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li class="active">
                            <i class="icon-home home-icon"></i>
                            <a href="{{url('/')}}">Home</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                          @if(Auth::user()->level == 'admin')
                        <li class="active">
                            <a href="{{url('/post/admin')}}"> Pengaturan Topik</a>
                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>
                        @endif

                        <li class="active">[<u>{{$post->type}}</u>] {{Helper::lessChar($post->title,100)}}</li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>

@include('layouts.flashmessage')

				<div class="page-content">
					<div class="row-fluid">
							<div class="span12 widget-container-span">
									<div class="widget-box transparent">
										<div class="alert alert-important"><i class="fa fa-warning fa-2x"></i> Topik ini sudah di non-Aktifkan 

											@if(Auth::user()->id == $post->user_id || Auth::user()->level == 'admin')
											<i class="fa fa-ellipsis-v"></i>

												<a href="{{url('post/reactivate',$post->id)}}" onclick="if (!confirm('Aktifkan Topik?')){return false;};"> <i class="fa fa-refresh"></i> Aktifkan kembali </a>
											@endif


										</div><hr>
										<div class="widget-header">
											<h4 class="lighter"><b>[<u>{{$post->type}}</u>]</b> {{$post->title}} 
												<small>
												<i class="fa fa-ellipsis-v"></i> Posted by : <a href="{{url('user/profile',$post->user->nick_name)}}">{{Helper::showName($post->user_id)}}</a>
												<i class="fa fa-ellipsis-v"></i>
												<i class="icon-time"></i> Dibuat <span class="green">{{Helper::postDateFormat($post->created_at)}}</span>
												<i class="fa fa-ellipsis-v"></i> <i class="icon-time"></i> Aktivitas terakhir <span class="green">{{Helper::postDateFormat($post->updated_at)}}</span> 
												<i class="fa fa-ellipsis-v"></i> <i class="icon-time"></i> Non-Aktif <span class="green">{{Helper::postDateFormat($post->deleted_at)}}</span> 
												</small>
											</h4>

											<div class="widget-toolbar no-border">
												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!-- //subscribe -->
												<a class="btn btn-app btn-minier btn-danger" style="padding:5px;font-size:90%;">
													<i class="fa fa-check"></i> {{$post->subscriber->count()}} Pengikut
												</a>
											
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main padding-6 no-padding-left no-padding-right">
												
												<div class="padding-6 center hideable">
												{{$post->header_content}}
												</div>

												<!-- POSTDETAILS -->
												@if(count($post->postDetails) > 0)
													<div id="details_{{$post->id}}">
													<br>
														@if(count($post->postDetailsImage) > 0)
														<div class="span11">
															<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
															<h4><i class="icon-camera"></i></h4>
															@foreach($post->postDetailsImage as $pd)
															<div class="pull-left" style="margin:5px;">
																<img class="editable" alt="image" src="{{ URL::asset('uploads/post/'.$pd->content) }}" width="450px" style="display: block;margin: 0 auto;"/>
															</div>
															@endforeach

														</div>
														@endif

														
														@if(count($post->postDetailsYoutube) > 0)
														<div class="span11">
															<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
															<h4><i class="icon-youtube icon-large"></i></h4>
															@foreach($post->postDetailsYoutube as $pd)
															<div class="pull-left" style="margin:5px;">
																<iframe width="450" height="260" src="https://www.youtube.com/embed/{{$pd->content}}" frameborder="0" allowfullscreen></iframe>
															</div>
															@endforeach

														</div>
														@endif

														@if(count($post->postDetailsUrl) > 0)
														<div class="span11">
															<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
															<h4><i class="fa fa-globe fa-spin"></i></h4>
															<?php $i=0;?>
															@foreach($post->postDetailsUrl as $pd)
															<div class="pull-left urlive-container" style="margin:5px;">
																<a href="{{$pd->content}}" class="urlData" target="_blank" style="display:none;">{{$pd->content}}</a>
															</div>
															<?php $i++;?>
															@endforeach
														</div>
														@endif
													</div>
												@endif
												<!-- ENDPOSTDETAILS -->

												<!-- POSTTAGS -->
												@if(count($post->postTags)>0)
													<div id='postTag' class="span11">
														<div class="hr hr-dotted span12" style="margin:10px !important;"></div>
														<b>Tags:</b><br>
														@foreach($post->postTags as $pt)

														<a href="{{url('/home',$pt->tag_id)}}">#{{$pt->tag->tag_name}}</a>

														@endforeach
													</div>
												@endif	
												<!-- ENDPOSTTAGS -->

													<div class="span12 tools">
														<a class="btn btn-minier btn-info">
															{{$post->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
														</a>
														<a class="btn btn-minier btn-warning">
															{{$post->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
														</a>
														<a class="btn btn-minier btn-danger">
															{{$post->hasReports->count()}} <i class="fa fa-warning"></i>
														</a>
													</div>

											</div>
										</div>
									</div>
								</div>

								<div class="hr hr-dotted span12" style="margin:0 !important;"></div>


								@foreach($post->postKubu as $kubu)

								@if($post->type != 'artikel')
									<div class="span6 widget-container-span" style="margin:0 5px 0 0 !important;">
								@else
									<div class="span12 widget-container-span" style="margin:0 5px 0 0 !important;">
								@endif

									<div class="widget-box">
										<div class="widget-header header-color-dark">
											
											<!-- jika bukan artikel -->
											@if($post->type != 'artikel')
											<h5 class="bigger lighter">{{$kubu->label}}
												<!-- //jika dia kubu ini -->
														@if(Helper::checkKubu(Auth::user()->id,$kubu->id) == true)
															(Kamu berpihak disini)
														@endif
											</h5>
											<div class="widget-toolbar">
												<div class="progress progress-danger progress-striped active" style="width:100px;" data-percent="{{Counter::kubuPercentage($kubu->id,$post->id)}} %">
													<div class="bar" style="width:{{Counter::kubuPercentage($kubu->id,$post->id)}}%"></div>
												</div>
											</div>
											@else
											<h5 class="bigger lighter">{{$kubu->label}}
											</h5>

											@endif
										</div>

										<div class="widget-body">

											


											<div class="widget-main">

											@if(count($kubu->replies) > 0)
												<div class="dialogs">
												@foreach(Helper::getReplies($kubu->id) as $r)
													<div class="itemdiv dialogdiv">
														<div class="user">
															 @if($r->user->img != '' || !empty($r->user->img))
												                <img src="{{URL::asset('uploads/userImg/'.$r->user->img)}}" />
												            @else
												                <i class="badge  badge-default">{{Helper::userInitial($r->user->id)}}</i>
												            @endif
														</div>

														<div class="body">
															<div class="time">
																<i class="icon-time"></i>
																<span class="green">{{Helper::postDateFormat($r->created_at)}}</span>
															</div>

															<div class="name">
																<a href="{{url('user/profile',$r->user->nick_name)}}">{{Helper::showName($r->user_id)}}</a>
															</div>
															<div class="text">
																<div class="row-fluid">
																	<div class="span12 hideable" style="margin-bottom:15px !important;">
																		 {{$r->text}} 
																	</div>
																</div>
															</div>
															
															<div class="tools" style="display:block !important;">
																<a class="btn btn-minier btn-info">
																	{{$r->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
																</a>
																<a class="btn btn-minier btn-warning">
																	{{$r->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
																</a>
																<a class="btn btn-minier btn-danger">
																	{{$r->hasReports->count()}} <i class="fa fa-warning"></i>
																</a>
															</div>
															
														</div>
													</div>
			

												@endforeach
												</div>
											@else
												<div class="alert alert-info">Belum ada balasan</div>
											@endif
											</div>


										</div>
									</div>
								</div>
								@endforeach


					</div>
				</div><!--/.page-content-->



</div><!--/.main-content-->
        @include('library')


        @include('post.view_script')
  
@endsection	
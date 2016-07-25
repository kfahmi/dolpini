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


										@if(Auth::user()->level == 'admin' && Helper::kontenStatus($post->id,'post','value') == 'reported')
										<div class="alert alert-important"><i class="fa fa-warning fa-2x"></i> Topik ini dilaporkan oleh beberapa user. Apakah topik ini aman?
												<a href="{{url('post/cleanReported',$post->id)}}" onclick="if (!confirm('jika Topik aman, maka laporan tentang topik ini akan di hapus. setuju ?')){return false;};"> <i class="fa fa-check"></i> Ya, topik ini aman </a> 

												<a href="{{url('post/delete',$post->id)}}" onclick="if (!confirm('Non Aktifkan /  Delete Topik ?')){return false;};" class="red"> <i class="fa fa-remove"></i> Tidak, Topik tidak aman </a> 
										</div><hr>
										@elseif(isset($post->deleted_at))

										<div class="alert alert-important"><i class="fa fa-warning fa-2x"></i> Topik ini sudah di non-Aktifkan 

											@if(Auth::user()->id == $post->user_id || Auth::user()->level == 'admin')
											<i class="fa fa-ellipsis-v"></i>
												<a href="{{url('post/reactivate',$post->id)}}" onclick="if (!confirm('Aktifkan Topik?')){return false;};"> <i class="fa fa-refresh"></i> Aktifkan kembali </a>
											@endif


										</div><hr>

										@endif


										<div class="widget-header">
											<h4 class="lighter"> <b>[<u>{{$post->type}}</u>]</b> {{$post->title}} 
												<small>
												<i class="fa fa-ellipsis-v"></i> Posted by : <a href="{{url('user/profile',$post->user->nick_name)}}">{{Helper::showName($post->user_id)}}</a>
												<i class="fa fa-ellipsis-v"></i>
												<i class="icon-time"></i> Dibuat <span class="green">{{Helper::postDateFormat($post->created_at)}}</span>
												<i class="fa fa-ellipsis-v"></i> <i class="icon-time"></i> Aktivitas terakhir <span class="green">{{Helper::postDateFormat($post->updated_at)}}</span> 
											</small></h4>

											<div class="widget-toolbar no-border">
												<a href="#" data-action="collapse">
													<i class="icon-chevron-up"></i>
												</a>

												<!-- tombol admin atau owner post -->
												@if(Auth::user()->id == $post->user_id || Auth::user()->level == 'admin')
													@if(!isset($post->deleted_at))
													<a href="{{url('post/delete',$post->id)}}" onclick="if (!confirm('Non Aktifkan /  Delete Topik?')){return false;};">
														<i class="icon-remove"></i>
													</a>

													<a href="{{url('post/edit',$post->id)}}" onclick="if (!confirm('Edit topik?')){return false;};">
														<i class="icon-pencil"></i>
													</a>
													@endif
												@endif
												<!-- end tombol admin atau owner post -->

												<!-- //subscribe -->
												@if(Helper::alreadySubscribe($post->id,Auth::user()->id) == true)
												<a href="{{url('/post/subscribe',$post->id)}}" class="btn btn-app btn-minier btn-danger" style="padding:5px;font-size:90%;" onclick="if (!confirm('Stop Mengikuti Topik ini?')){return false;};">
													<i class="fa fa-check"></i> {{$post->subscriber->count()}} Pengikut
												</a>
												@elseif(Helper::alreadySubscribe($post->id) == false)
												<a href="{{url('/post/subscribe',$post->id)}}" class="btn btn-app btn-minier btn-primary" style="padding:5px;font-size:90%;" onclick="if (!confirm('Ikuti Topik ini?')){return false;};">
													<i class="fa fa-retweet"></i> Ikuti 
												</a>
												@endif
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
																<img class="editable" alt="image" src="{{ URL::asset('uploads/post/'.$pd->id.$pd->content) }}" width="450px" style="display: block;margin: 0 auto;"/>
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


															<div class="pureUrl">
																<i class="fa fa-spin fa-spinner"></i> Memuat Content... 
																<a href="{{$pd->content}}">{{$pd->content}}</a>
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
														@if($post->userLiked->count() >  0)
														<a class="btn btn-minier btn-info">
															{{$post->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
														</a>
														@else
														<a href="{{url('/post/flag/like',$post->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Like?')){return false;};">
															{{$post->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
														</a>
														@endif

														@if($post->userDisliked->count() > 0)
														<a class="btn btn-minier btn-warning">
															{{$post->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
														</a>
														@else
														<a href="{{url('/post/flag/dislike',$post->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Dislike?')){return false;};">
															{{$post->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
														</a>
														@endif

														@if($post->userReported->count() > 0)
														<a class="btn btn-minier btn-danger">
															{{$post->hasReports->count()}} <i class="fa fa-warning"></i>
														</a>
														@else
														<a href="{{url('/post/flag/report',$post->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Report?')){return false;};">
															{{$post->hasReports->count()}} <i class="fa fa-warning"></i>
														</a>
														@endif
													</div>

											</div>
										</div>
									</div>
								</div>

								<div class="hr hr-dotted span12" style="margin:0 !important;"></div>

								@if(!isset($post->deleted_at))
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
													@include('post.replies')
												@else
													<div class="alert alert-info">Belum ada balasan</div>
												@endif
												</div>
												<!-- endwidgetmain -->
												@if(Helper::checkKubu(Auth::user()->id,$kubu->id) == true || Helper::checkReplyPost(Auth::user()->id,$post->id) == false)
												<div class="alert alert-info">
												<form onsubmit="submitForm()" action="{{url('/post/reply')}}" method="POST" id="reply-form" enctype="multipart/form-data">
													{!! csrf_field() !!}
													<input type="hidden" name="post_kubu_id" value="{{$kubu->id}}" required>
										            <input type="hidden" name="post_id" value="{{$kubu->post_id}}" required>  	      
													  	<div class="controls">
									                        <textarea name="text" id="text" class="autosize-transition span12" placeholder="ketik opini disini" required>{{Input::old('text')}}</textarea>
									                        @if ($errors->has('text'))
									                            <span class="help-block">
									                                <strong>{{ $errors->first('text') }}</strong>
									                            </span>
									                        @endif
									                    </div>
														<button type="submit" class="btn btn-small btn-success">
															<i class="fa fa-comment"></i>
															Balas
														</button>

								                </form>
								            	</div>
												@endif



											</div>
										</div>
									</div>
								@endforeach
								@endif


					</div>
				</div><!--/.page-content-->



</div><!--/.main-content-->
        @include('library')


        @include('post.view_script')
  
@endsection	
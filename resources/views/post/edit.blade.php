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

                         <li class="active">
                            <a href="{{url('/post/detail',$post->id)}}">[<u>{{$post->type}}</u>] {{Helper::lessChar($post->title,100)}}</a>
                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        <li class="active">Edit</li>
                    </ul><!--.breadcrumb-->

                    @include('layouts.search')
                </div>

@include('layouts.flashmessage')
	

				<div class="page-content">
					<div class="row-fluid">
							<div class="span12 widget-container-span">
									<div class="widget-box transparent">
										<div class="widget-header">
											<h4 class="lighter">
												<small>
												Posted by : <a href="{{url('user/profile',$post->user->nick_name)}}">{{Helper::showName($post->user_id)}}</a>
												<i class="fa fa-ellipsis-v"></i>
												<i class="icon-time"></i> Dibuat <span class="green">{{Helper::postDateFormat($post->created_at)}}</span>
												<i class="fa fa-ellipsis-v"></i> <i class="icon-time"></i> Aktivitas terakhir <span class="green">{{Helper::postDateFormat($post->updated_at)}}</span> 
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
		                                                @include('post.edit_post')
		                                            </div>
		                                            <div id="detail" class="tab-pane">
		                                                @include('post.edit_post_detail')
		                                            </div>
		                                            <div id="hashtag" class="tab-pane">
		                                               @include('post.edit_post_hashtag')
		                                            </div>
		                                            <div id="kubu" class="tab-pane">
		                                               @include('post.edit_post_kubu')
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
        @include('library')


        @include('post.view_script')
  
@endsection	
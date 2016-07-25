<div class="dialogs">

	<!-- //sorting berdasarkan yang paling banyak dikomen -->
@if(count($allPost) < 1)

<div class="alert alert-danger">
	Topik tidak ditemukan
</div>

@else
	@foreach($allPost as $p)
	<div class="itemdiv dialogdiv">
		<div class="user">
			 @if($p->user->img != '' || !empty($p->user->img))
                <img src="{{URL::asset('uploads/userImg/'.$p->user->img)}}" />
            @else
                <i class="badge  badge-default">{{Helper::userInitial($p->user->id)}}</i>
            @endif
		</div>

		<div class="body">
			<div class="time">
				<i class="fa fa-users"></i>
				<span class="red">{{$p->subscriber->count()}} Pengikut</span>

				<i class="icon-time"></i>
				<span class="green">{{Helper::postDateFormat($p->updated_at)}}</span>
			</div>

			<div class="name">
				<a href="{{url('user/profile',$p->user->nick_name)}}">{{Helper::showName($p->user_id)}}</a> posting 

				<a href="{{url('/post/detail',$p->id)}}" style="font-size:120%;"><b> [<u style="text-transform: uppercase;">{{$p->type}}</u>] {{Helper::lessChar($p->title,100)}}</b></a>
			</div>
			<div class="text">
				<div class="hr hr-dotted span12" style="margin:0 !important;"></div>
				<div class="row-fluid">
					<div class="span12 hideable">
						{{$p->header_content}}
					</div>

					

					<!-- POSTTAGS -->
					<div id='postTag' class="span12" style="margin:0 0 20px 0 !important;">
					@if(count($p->postTags)>0)
							<b>Tags:</b><br>
							@foreach($p->postTags as $pt)

							<a href="{{url('/home',$pt->tag_id)}}">#{{$pt->tag->tag_name}}</a>

							@endforeach
					@endif	
					</div>
					<!-- ENDPOSTTAGS -->

				</div>
			</div>

			<div class="tools" style="display:block !important;">
				@if($p->userLiked->count() >  0)
				<a class="btn btn-minier btn-info">
					{{$p->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
				</a>
				@else
				<a href="{{url('/post/flag/like',$p->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Like?')){return false;};">
					{{$p->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
				</a>
				@endif

				@if($p->userDisliked->count() > 0)
				<a class="btn btn-minier btn-warning">
					{{$p->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
				</a>
				@else
				<a href="{{url('/post/flag/dislike',$p->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Dislike?')){return false;};">
					{{$p->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
				</a>
				@endif


				@if($p->userReported->count() > 0)
				<a class="btn btn-minier btn-danger">
					{{$p->hasReports->count()}} <i class="fa fa-warning"></i>
				</a>
				@else
				<a href="{{url('/post/flag/report',$p->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Report?')){return false;};">
					{{$p->hasReports->count()}} <i class="fa fa-warning"></i>
				</a>
				@endif
			</div>

			
		</div>
	</div>
	@endforeach
@endif
</div>
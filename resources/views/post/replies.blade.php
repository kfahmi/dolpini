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

		<div class="body" id="replyBody_{{$r->id}}">
				@if(Auth::user()->level == 'admin' && Helper::kontenStatus($r->id,'replyKubu','value') == 'reported')
				<div class="alert alert-important"><i class="fa fa-warning"></i> Komentar ini dilaporkan oleh user. Apakah Komentar ini aman?
						<a href="{{url('post/reply/cleanReported',$r->id)}}" onclick="if (!confirm('jika komentar aman, maka laporan tentang komentar ini akan di hapus. maka komentar akan tetap tersimpan di dolpini. setuju ?')){return false;};"> <i class="fa fa-check"></i> Ya </a> 

						<a href="#" class="hapusReply_{{$r->id}}"> <i class="fa fa-remove red"></i> Tidak </a> 
				</div><hr>
				@endif
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
				@if($r->userLiked->count() >  0)
				<a class="btn btn-minier btn-info">
					{{$r->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
				</a>
				@else
				<a href="{{url('/post/reply/flag/like',$r->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Like?')){return false;};">
					{{$r->hasLikes->count()}} <i class="fa fa-thumbs-o-up"></i>
				</a>
				@endif

				@if($r->userDisliked->count() > 0)
				<a class="btn btn-minier btn-warning">
					{{$r->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
				</a>
				@else
				<a href="{{url('/post/reply/flag/dislike',$r->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Dislike?')){return false;};">
					{{$r->hasDislikes->count()}} <i class="fa fa-thumbs-o-down"></i>
				</a>
				@endif

				@if($r->userReported->count() > 0)
				<a class="btn btn-minier btn-danger">
					{{$r->hasReports->count()}} <i class="fa fa-warning"></i>
				</a>
				@else
				<a href="{{url('/post/reply/flag/report',$r->id)}}" class="btn btn-minier btn-default" onclick="if (!confirm('Report?')){return false;};">
					{{$r->hasReports->count()}} <i class="fa fa-warning"></i>
				</a>
				@endif


				@if($r->user_id == Auth::user()->id || Auth::user()->level == 'admin')
				<span class="hapusReply_{{$r->id}}">
					<a class="btn btn-minier btn-danger">
						<i class="fa fa-trash"></i> hapus
					</a>
				</span>
				@endif

			</div>
			
		</div>
	</div>


@endforeach
</div>
<div class="dialogs">

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
				<i class="icon-time"></i>
				<span class="green">{{$p->created_at}}</span>
			</div>

			<div class="name">
				<a href="{{url('user/profile',$p->user->nick_name)}}">{{Helper::showName($p->user_id)}}</a>
			</div>
			<div class="text">
				<div class="row-fluid">
					<div class="span12">
						{{$p->header_content}}
					</div>

					<!-- POSTDETAILS -->
					<!-- @if(count($p->postDetails) > 0)
						<a class="btn btn-mini btn-info" id="btnShow_{{$p->id}}"onClick="showMore({{$p->id}})"> More </a>
						<a class="btn btn-mini btn-danger" id="btnHide_{{$p->id}}"onClick="showMore({{$p->id}})" style="display:none;"> Hide </a>
						
						<div id="details_{{$p->id}}" style="display:none;">
							@if(count($p->postDetailsImage) > 0)
							<div class="span11">
								<div class="hr hr-dotted span12" style="margin:0 !important;"></div>
								@foreach($p->postDetailsImage as $pd)
								<div class="span3">
									<img src="{{ URL::asset('uploads/post/'.$pd->content) }}" width="500px"/>
								</div>
								@endforeach

							</div>
							@endif

							
							@if(count($p->postDetailsYoutube) > 0)
							<div class="span11">
								<div class="hr hr-dotted span12" style="margin:0 !important;"></div>
								@foreach($p->postDetailsYoutube as $pd)
								<div class="span5">
									<iframe width="450" height="260" src="https://www.youtube.com/embed/{{$pd->content}}" frameborder="0" allowfullscreen></iframe>
								</div>
								@endforeach

							</div>
							@endif

							@if(count($p->postDetailsUrl) > 0)
							<div class="span11">
								<<div class="hr hr-dotted span12" style="margin:0 !important;"></div>
								@foreach($p->postDetailsUrl as $pd)
								<div class="span3">
									{{$pd->content}}
								</div>
								@endforeach

							</div>
							@endif
						</div>
					@endif -->
					<!-- ENDPOSTDETAILS -->

					<!-- POSTTAGS -->
					@if(count($p->postTags)>0)
						<div class="hr hr-dotted span12" style="margin:0 !important;"></div>
						<div id='postTag' class="span12" style="margin:0 !important;">
							<b>Tags:</b><br>
							@foreach($p->postTags as $pt)

							<a href="kepost yang pake tag ini">#{{$pt->tag->tag_name}}</a>

							@endforeach
						</div>
					@endif	
					<!-- ENDPOSTTAGS -->

				</div>
			</div>

			<div class="tools">
				<a href="#" class="btn btn-minier btn-info">
					<i class="icon-only icon-share-alt"></i>
				</a>
				<a href="{{url('/post/detail',$p->id)}}" class="btn btn-minier btn-info">
					<i class="icon-only icon-comment"></i>
				</a>
			</div>
		</div>
	</div>
	@endforeach
	
</div>
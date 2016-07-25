@foreach($post as $p)

<div class="itemdiv commentdiv">
    <div class="user">
        @if($p->user->img != '' || !empty($p->user->img))
                <img src="{{URL::asset('uploads/userImg/'.$p->user->img)}}" />
            @else
                <i class="badge  badge-default">{{Helper::userInitial($p->user_id)}}</i>
            @endif
    </div>

    <div class="body">
        <div class="name">
            <a href="{{url('user/profile',$p->user->nick_name)}}">{{Helper::showName($p->user_id)}}</a> recently posted


            <a href="{{url('post/detail',$p->id)}}">
            [{{ucfirst($p->type)}}] 
            {{Helper::lessChar($p->title,100)}}
            </a>

        </div>

        <div class="time">
            <i class="icon-time"></i>
            <span class="green">{{Helper::postDateFormat($p->created_at)}}</span>
        </div>

        <div class="text">
    
            <div class="hideable">
                        {{$p->header_content}}
             </div>

            <div id='postTag' style="margin:0 0 20px 0 !important;">
                    @if(count($p->postTags)>0)
                            <b>Tags:</b><br>
                            @foreach($p->postTags as $pt)

                            <a href="{{url('/home',$pt->tag_id)}}">#{{$pt->tag->tag_name}}</a>

                            @endforeach
                    @endif  
            </div>  
        </div>
    </div>
</div>


@endforeach
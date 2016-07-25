@foreach($replyKubu as $r)

<div class="itemdiv commentdiv">
    <div class="user">
        @if($r->user->img != '' || !empty($r->user->img))
                <img src="{{URL::asset('uploads/userImg/'.$r->user->img)}}" />
            @else
                <i class="badge  badge-default">{{Helper::userInitial($r->user_id)}}</i>
            @endif
    </div>

    <div class="body">
        <div class="name">
            <a href="{{url('user/profile',$r->user->nick_name)}}">{{Helper::showName($r->user_id)}}</a> @ {{$r->kubu->label}} - [{{ucfirst($r->kubu->post->type)}}] 

            {{Helper::lessChar($r->kubu->post->title,60)}}
        </div>

        <div class="time">
            <i class="icon-time"></i>
            <span class="green">{{Helper::postDateFormat($r->created_at)}}</span>
        </div>

        <div class="text">
            <i class="icon-quote-left"></i>

            {{Helper::lessChar($r->text,200)}} <a href="{{url('post/detail',$r->kubu->post_id)}}"> Read more..</a>
        </div>
    </div>
</div>


@endforeach
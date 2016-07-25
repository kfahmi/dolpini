Dear {{$data->user->real_name}},<br>

{{$data->activityReply->user->nick_name}} menanggapi komentar pada topik 
<a href="{{url('post/detail',$data->parent_id)}}">
[{{$data->parentPost->type}}] {{$data->parentPost->title}}.
</a>

dibawah ini adalah isi balasan dari dia<br>
<hr>
{{$data->activityReply->text}}
<hr>

<br><br><br>



-----------DO NOT REPLY THIS EMAIL, THIS IS AUTOMATICALLY SENT BY DOLPINI SYSTEM--------------
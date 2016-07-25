Dear {{$data->user->real_name}},<br>

{{$data->activityPost->user->nick_name}} membuat topik baru yaitu, 

<a href="{{url('post/detail',$data->activity_id)}}">
[{{$data->activityPost->type}}] {{$data->activityPost->title}}. 
</a>


<br><br><br>



-----------DO NOT REPLY THIS EMAIL, THIS IS AUTOMATICALLY SENT BY DOLPINI SYSTEM--------------
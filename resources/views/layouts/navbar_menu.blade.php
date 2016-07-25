<ul class="nav ace-nav pull-right">
    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="fa fa-retweet"></i>

            @if($followRequest->count() > 0)
            <span class="badge badge-important">{{$followRequest->count()}}</span>
            @elseif($followRequest->count() < 1)
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            @endif
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Follow request 
            </li>

            @if($followRequest->count() > 0)
            @foreach($followRequest as $fr)
                <li>
                    <div class="clearfix grey" style="border-bottom: 1px solid;border-bottom-color: #f3e4ec">
                        <span class="pull-left">
                            <i class="fa fa-retweet"></i>
                             {{Helper::showName($fr->user_id)}} wants to follow you<br>
                            <a href="{{url('/follow/app',$fr->id)}}" onclick="if (!confirm('Are you sure want to approve?'))
                                                    {
                                                        return false;
                                                    }submitForm();
                                                    ;" class="badge badge-info">
                                        <i class="fa fa-check"></i> Accept
                            </a>
                          <!--   <a href="{{url('/user/rejectFollowRequest',$fr->id)}}" >
                            <i class="fa fa-remove red"></i>
                            </a> -->
                        </span>
                    </div>
                </li>
            @endforeach
            @endif


            <li>
                <a href="#">
                    See all request
                    <i class="icon-arrow-right"></i>
                </a>
            </li>
        </ul>
    </li>

    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="notifBtn">

            @if($unseenNotif->count() > 0)
            <i class="icon-bell-alt icon-animated-bell"></i>
            <span class="badge badge-important">{{$unseenNotif->count()}}</span>
            @elseif($unseenNotif->count() < 1)
            <i class="icon-bell-alt"></i>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            @endif
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Notification
            </li>

            <!-- //SMUA NOTIF DILOOP YANG SEEN ATAU UNSEEN -->
            @if($allNotif->count() > 0)
                @foreach($allNotif as $n)
                <li>
                    @if($n->activity_id_type == 'ReplyKubu')
                    <a href="{{url('/post/detail',[$n->parent_id,$n->activity_id])}}" 
                        id="replyNotif_{{$n->activity_id}}"
                        @if($n->flag=='unseen') 
                        class="blue"
                        @endif>

                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-comments"></i>
                                 <b>{{Helper::showName($n->activityReply->user_id)}} </b>menanggapi topik
                            </span>
                        </div>
                    </a>
                    <!-- yang difollow submit post baru -->
                    @elseif($n->activity_id_type == 'Post')
                       <a href="{{url('/post/detail',$n->activity_id)}}"  
                        @if($n->flag=='unseen') 
                        class="blue"
                        @endif>

                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-pencil"></i>
                                 <b>{{Helper::showName($n->activityPost->user_id)}}</b> membuat <u style="text-transform: uppercase;">[{{$n->activityPost->type}}]</u> baru
                            </span>
                        </div>
                    </a>
                    @endif
                </li>
                @endforeach
            @endif


            <li>
                <a href="#">
                    See all notifications
                    <i class="icon-arrow-right"></i>
                </a>
            </li>
        </ul>
    </li>


    <li class="light-blue">
        <a data-toggle="dropdown" href="#" class="dropdown-toggle">

            @if(Auth::user()->img != '' || !empty(Auth::user()->img))
                <img id="avatar" class="nav-user-photo" src="{{URL::asset('uploads/userImg/'.Auth::user()->img)}}" />
            @else
                <i class="badge  badge-default">{{Helper::userInitial(Auth::user()->id)}}</i>
            @endif


            <span class="user-info">
                <small>Welcome,</small>
                {{Auth::user()->nick_name}}
            </span>

            <i class="icon-caret-down"></i>
        </a>

        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
            <!-- <li>
                <a href="{{url('user/setting')}}">
                    <i class="icon-cog"></i>
                    Settings
                </a>
            </li> -->

            <li>
                <a href="{{url('user/profile',Auth::user()->nick_name)}}">
                    <i class="icon-user"></i>
                    Profile
                </a>
            </li>

            <li class="divider"></li>

            <li>
                <a href="{{url('/logout')}}">
                    <i class="icon-off"></i>
                    Logout
                </a>
            </li>
        </ul>
    </li>
</ul><!--/.ace-nav-->
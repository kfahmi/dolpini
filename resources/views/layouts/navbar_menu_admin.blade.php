<ul class="nav ace-nav pull-right">

    <!-- REPORTED TOPIC FLAGG-->
    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="notifBtn">
            @if($reportedTopik->count() > 0)
            <i class="fa fa-warning"></i>
            <span class="badge badge-important">{{$reportedTopik->count()}}</span>
            @elseif($reportedTopik->count() < 1)
            <i class="fa fa-warning"></i>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            @endif
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Reported Topic
            </li>

            <!-- //SMUA NOTIF DILOOP YANG SEEN ATAU UNSEEN -->
            @if($reportedTopik->count() > 0)
                @foreach($reportedTopik as $f)
                <li>
                    <a href="{{url('/post/detail',$f->post_id)}}">
                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-comments"></i>
                                 [<u style="text-transform: uppercase;">{{$f->post->type}}</u>] {{Helper::lessChar($f->post->title,25)}}
                            </span>
                        </div>
                    </a>
                </li>
                @endforeach
               <li>
                    <a href="#">
                      --
                    </a>
                </li>
            @else
            <li>
                <a href="#">
                   Data tidak ditemukan
                </a>
            </li>
            @endif



            
        </ul>
    </li>
    <!-- END REPORTED CONTENT FLAGG-->


    <!-- REPORTED REPLY FLAGG-->
    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="notifBtn">
            @if($reportedReply->count() > 0)
            <i class="fa fa-warning"></i>
            <span class="badge badge-important">{{$reportedReply->count()}}</span>
            @elseif($reportedReply->count() < 1)
            <i class="fa fa-warning"></i>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            @endif
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Reported Comment
            </li>

            <!-- //SMUA NOTIF DILOOP YANG SEEN ATAU UNSEEN -->
            @if($reportedReply->count() > 0)
                @foreach($reportedReply as $r)
                <li>
                    <a href="{{url('/post/detail',[$r->reply->kubu->post_id,$r->reply_kubu_id])}}" id="replyNotif_{{$r->reply_kubu_id}}">
                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-comments"></i>
                                 Comment @[<u style="text-transform: uppercase;">{{$r->reply->kubu->post->type}}</u>] {{Helper::lessChar($r->reply->kubu->post->title,15)}}
                            </span>
                        </div>
                    </a>
                </li>
                @endforeach
                <li>
                    <a href="#">
                      --
                    </a>
                </li>
            @else
            <li>
                <a href="#">
                   Data tidak ditemukan
                </a>
            </li>
            @endif


            
        </ul>
    </li>
    <!-- END REPORTED CONTENT FLAGG-->



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

            <li>
                <a href="{{url('/logout')}}">
                    <i class="icon-off"></i>
                    Logout
                </a>
            </li>
        </ul>
    </li>
</ul><!--/.ace-nav-->
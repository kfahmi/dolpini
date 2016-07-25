@foreach($followRequest as $fr)
        <div class="widget-box">
                    <div class="widget-header header-color-dark">
                        <h5 class="bigger lighter"><a href="{{url('user/profile',$fr->user->nick_name)}}"><b class="badge badge-info">{{$fr->user->nick_name}}</b></a> sent you a follow request</h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-toolbox">
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a href="{{url('/follow/app',$fr->id)}}" class="btn btn-small btn-info" onclick="if (!confirm('Are you sure want to approve?'))
                                                    {
                                                        return false;
                                                    }
                                                    ;">
                                        <i class="icon-ok bigger-110"></i>
                                        Approve
                                    </a>

                                    <a href="{{url('/user/rejectFollowRequest',$fr->id)}}" class="btn btn-small btn-danger">
                                        <i class="icon-remove bigger-110"></i>
                                        Reject
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
          </div>
@endforeach
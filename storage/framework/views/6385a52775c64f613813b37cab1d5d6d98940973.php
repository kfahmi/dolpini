<ul class="nav ace-nav pull-right">
    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="fa fa-retweet"></i>

            <?php if($followRequest->count() > 0): ?>
            <span class="badge badge-important"><?php echo e($followRequest->count()); ?></span>
            <?php elseif($followRequest->count() < 1): ?>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            <?php endif; ?>
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Follow request 
            </li>

            <?php if($followRequest->count() > 0): ?>
            <?php foreach($followRequest as $fr): ?>
                <li>
                    <div class="clearfix grey" style="border-bottom: 1px solid;border-bottom-color: #f3e4ec">
                        <span class="pull-left">
                            <i class="fa fa-retweet"></i>
                             <?php echo e(Helper::showName($fr->user_id)); ?> wants to follow you<br>
                            <a href="<?php echo e(url('/follow/app',$fr->id)); ?>" onclick="if (!confirm('Are you sure want to approve?'))
                                                    {
                                                        return false;
                                                    }submitForm();
                                                    ;" class="badge badge-info">
                                        <i class="fa fa-check"></i> Accept
                            </a>
                          <!--   <a href="<?php echo e(url('/user/rejectFollowRequest',$fr->id)); ?>" >
                            <i class="fa fa-remove red"></i>
                            </a> -->
                        </span>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>


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

            <?php if($unseenNotif->count() > 0): ?>
            <i class="icon-bell-alt icon-animated-bell"></i>
            <span class="badge badge-important"><?php echo e($unseenNotif->count()); ?></span>
            <?php elseif($unseenNotif->count() < 1): ?>
            <i class="icon-bell-alt"></i>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            <?php endif; ?>
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Notification
            </li>

            <!-- //SMUA NOTIF DILOOP YANG SEEN ATAU UNSEEN -->
            <?php if($allNotif->count() > 0): ?>
                <?php foreach($allNotif as $n): ?>
                <li>
                    <?php if($n->activity_id_type == 'ReplyKubu'): ?>
                    <a href="<?php echo e(url('/post/detail',[$n->parent_id,$n->activity_id])); ?>" 
                        id="replyNotif_<?php echo e($n->activity_id); ?>"
                        <?php if($n->flag=='unseen'): ?> 
                        class="blue"
                        <?php endif; ?>>

                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-comments"></i>
                                 <b><?php echo e(Helper::showName($n->activityReply->user_id)); ?> </b>menanggapi topik
                            </span>
                        </div>
                    </a>
                    <!-- yang difollow submit post baru -->
                    <?php elseif($n->activity_id_type == 'Post'): ?>
                       <a href="<?php echo e(url('/post/detail',$n->activity_id)); ?>"  
                        <?php if($n->flag=='unseen'): ?> 
                        class="blue"
                        <?php endif; ?>>

                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-pencil"></i>
                                 <b><?php echo e(Helper::showName($n->activityPost->user_id)); ?></b> membuat <u style="text-transform: uppercase;">[<?php echo e($n->activityPost->type); ?>]</u> baru
                            </span>
                        </div>
                    </a>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            <?php endif; ?>


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

            <?php if(Auth::user()->img != '' || !empty(Auth::user()->img)): ?>
                <img id="avatar" class="nav-user-photo" src="<?php echo e(URL::asset('uploads/userImg/'.Auth::user()->img)); ?>" />
            <?php else: ?>
                <i class="badge  badge-default"><?php echo e(Helper::userInitial(Auth::user()->id)); ?></i>
            <?php endif; ?>


            <span class="user-info">
                <small>Welcome,</small>
                <?php echo e(Auth::user()->nick_name); ?>

            </span>

            <i class="icon-caret-down"></i>
        </a>

        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
            <!-- <li>
                <a href="<?php echo e(url('user/setting')); ?>">
                    <i class="icon-cog"></i>
                    Settings
                </a>
            </li> -->

            <li>
                <a href="<?php echo e(url('user/profile',Auth::user()->nick_name)); ?>">
                    <i class="icon-user"></i>
                    Profile
                </a>
            </li>

            <li class="divider"></li>

            <li>
                <a href="<?php echo e(url('/logout')); ?>">
                    <i class="icon-off"></i>
                    Logout
                </a>
            </li>
        </ul>
    </li>
</ul><!--/.ace-nav-->
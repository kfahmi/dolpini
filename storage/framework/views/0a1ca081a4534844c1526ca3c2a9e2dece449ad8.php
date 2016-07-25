<ul class="nav ace-nav pull-right">

    <!-- REPORTED TOPIC FLAGG-->
    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="notifBtn">
            <?php if($reportedTopik->count() > 0): ?>
            <i class="fa fa-warning"></i>
            <span class="badge badge-important"><?php echo e($reportedTopik->count()); ?></span>
            <?php elseif($reportedTopik->count() < 1): ?>
            <i class="fa fa-warning"></i>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            <?php endif; ?>
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Reported Topic
            </li>

            <!-- //SMUA NOTIF DILOOP YANG SEEN ATAU UNSEEN -->
            <?php if($reportedTopik->count() > 0): ?>
                <?php foreach($reportedTopik as $f): ?>
                <li>
                    <a href="<?php echo e(url('/post/detail',$f->post_id)); ?>">
                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-comments"></i>
                                 [<u style="text-transform: uppercase;"><?php echo e($f->post->type); ?></u>] <?php echo e(Helper::lessChar($f->post->title,25)); ?>

                            </span>
                        </div>
                    </a>
                </li>
                <?php endforeach; ?>
               <li>
                    <a href="#">
                      --
                    </a>
                </li>
            <?php else: ?>
            <li>
                <a href="#">
                   Data tidak ditemukan
                </a>
            </li>
            <?php endif; ?>



            
        </ul>
    </li>
    <!-- END REPORTED CONTENT FLAGG-->


    <!-- REPORTED REPLY FLAGG-->
    <li class="blue">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="notifBtn">
            <?php if($reportedReply->count() > 0): ?>
            <i class="fa fa-warning"></i>
            <span class="badge badge-important"><?php echo e($reportedReply->count()); ?></span>
            <?php elseif($reportedReply->count() < 1): ?>
            <i class="fa fa-warning"></i>
            <span class="badge badge-default"> &nbsp;&nbsp;</span>
            <?php endif; ?>
        </a>

        <ul class="pull-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-closer">
            <li class="nav-header">
                <i class="icon-warning-sign"></i>
                Reported Comment
            </li>

            <!-- //SMUA NOTIF DILOOP YANG SEEN ATAU UNSEEN -->
            <?php if($reportedReply->count() > 0): ?>
                <?php foreach($reportedReply as $r): ?>
                <li>
                    <a href="<?php echo e(url('/post/detail',[$r->reply->kubu->post_id,$r->reply_kubu_id])); ?>" id="replyNotif_<?php echo e($r->reply_kubu_id); ?>">
                        <div class="clearfix">
                            <span class="pull-left">
                                <i class="fa fa-comments"></i>
                                 Comment @[<u style="text-transform: uppercase;"><?php echo e($r->reply->kubu->post->type); ?></u>] <?php echo e(Helper::lessChar($r->reply->kubu->post->title,15)); ?>

                            </span>
                        </div>
                    </a>
                </li>
                <?php endforeach; ?>
                <li>
                    <a href="#">
                      --
                    </a>
                </li>
            <?php else: ?>
            <li>
                <a href="#">
                   Data tidak ditemukan
                </a>
            </li>
            <?php endif; ?>


            
        </ul>
    </li>
    <!-- END REPORTED CONTENT FLAGG-->



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

            <li>
                <a href="<?php echo e(url('/logout')); ?>">
                    <i class="icon-off"></i>
                    Logout
                </a>
            </li>
        </ul>
    </li>
</ul><!--/.ace-nav-->
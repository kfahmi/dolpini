<?php foreach($user as $u): ?>

<div class="itemdiv memberdiv">
    <div class="user">
         <?php if($u->img != '' || !empty($u->img)): ?>
                <img src="<?php echo e(URL::asset('uploads/userImg/'.$u->img)); ?>" />
            <?php else: ?>
                <i class="badge  badge-default"><?php echo e(Helper::userInitial($u->id)); ?></i>
            <?php endif; ?>
    </div>

    <div class="body">
        <div class="name">
            <a href="<?php echo e(url('user/profile',$u->nick_name)); ?>"><?php echo e($u->real_name); ?></a>
        </div>

        <div class="time">
            <i class="icon-time"></i>
            <span class="green"><?php echo e(Helper::postDateFormat($u->created_at,'monthyear')); ?></span>
        </div>

        <div>
            <?php echo e(Helper::userStatus($u->id,'html')); ?>


            <div class="inline position-relative">
                <button class="btn btn-minier bigger btn-yellow dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-angle-down icon-only bigger-120"></i>
                </button>

                <ul class="dropdown-menu dropdown-icon-only dropdown-blue pull-right dropdown-caret dropdown-close">
                    <li>
                        <a href="<?php echo e(url('user/profile',$u->nick_name)); ?>" class="tooltip-success" data-rel="tooltip" title="View">
                            <span class="info">
                                <i class="fa fa-pencil bigger-110"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>
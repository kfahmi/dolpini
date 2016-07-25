<?php foreach($replyKubu as $r): ?>

<div class="itemdiv commentdiv">
    <div class="user">
        <?php if($r->user->img != '' || !empty($r->user->img)): ?>
                <img src="<?php echo e(URL::asset('uploads/userImg/'.$r->user->img)); ?>" />
            <?php else: ?>
                <i class="badge  badge-default"><?php echo e(Helper::userInitial($r->user_id)); ?></i>
            <?php endif; ?>
    </div>

    <div class="body">
        <div class="name">
            <a href="<?php echo e(url('user/profile',$r->user->nick_name)); ?>"><?php echo e(Helper::showName($r->user_id)); ?></a> @ <?php echo e($r->kubu->label); ?> - [<?php echo e(ucfirst($r->kubu->post->type)); ?>] 

            <?php echo e(Helper::lessChar($r->kubu->post->title,60)); ?>

        </div>

        <div class="time">
            <i class="icon-time"></i>
            <span class="green"><?php echo e(Helper::postDateFormat($r->created_at)); ?></span>
        </div>

        <div class="text">
            <i class="icon-quote-left"></i>

            <?php echo e(Helper::lessChar($r->text,200)); ?> <a href="<?php echo e(url('post/detail',$r->kubu->post_id)); ?>"> Read more..</a>
        </div>
    </div>
</div>


<?php endforeach; ?>
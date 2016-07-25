<?php foreach($post as $p): ?>

<div class="itemdiv commentdiv">
    <div class="user">
        <?php if($p->user->img != '' || !empty($p->user->img)): ?>
                <img src="<?php echo e(URL::asset('uploads/userImg/'.$p->user->img)); ?>" />
            <?php else: ?>
                <i class="badge  badge-default"><?php echo e(Helper::userInitial($p->user_id)); ?></i>
            <?php endif; ?>
    </div>

    <div class="body">
        <div class="name">
            <a href="<?php echo e(url('user/profile',$p->user->nick_name)); ?>"><?php echo e(Helper::showName($p->user_id)); ?></a> recently posted


            <a href="<?php echo e(url('post/detail',$p->id)); ?>">
            [<?php echo e(ucfirst($p->type)); ?>] 
            <?php echo e(Helper::lessChar($p->title,100)); ?>

            </a>

        </div>

        <div class="time">
            <i class="icon-time"></i>
            <span class="green"><?php echo e(Helper::postDateFormat($p->created_at)); ?></span>
        </div>

        <div class="text">
    
            <div class="hideable">
                        <?php echo e($p->header_content); ?>

             </div>

            <div id='postTag' style="margin:0 0 20px 0 !important;">
                    <?php if(count($p->postTags)>0): ?>
                            <b>Tags:</b><br>
                            <?php foreach($p->postTags as $pt): ?>

                            <a href="<?php echo e(url('/home',$pt->tag_id)); ?>">#<?php echo e($pt->tag->tag_name); ?></a>

                            <?php endforeach; ?>
                    <?php endif; ?>  
            </div>  
        </div>
    </div>
</div>


<?php endforeach; ?>
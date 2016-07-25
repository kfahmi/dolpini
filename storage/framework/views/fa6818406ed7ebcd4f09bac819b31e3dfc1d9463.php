Dear <?php echo e($data->user->real_name); ?>,<br>

<?php echo e($data->activityPost->user->nick_name); ?> membuat topik baru yaitu, 

<a href="<?php echo e(url('post/detail',$data->activity_id)); ?>">
[<?php echo e($data->activityPost->type); ?>] <?php echo e($data->activityPost->title); ?>. 
</a>


<br><br><br>



-----------DO NOT REPLY THIS EMAIL, THIS IS AUTOMATICALLY SENT BY DOLPINI SYSTEM--------------
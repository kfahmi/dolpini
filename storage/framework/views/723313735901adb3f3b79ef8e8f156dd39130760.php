Dear <?php echo e($data->user->real_name); ?>,<br>

<?php echo e($data->activityReply->user->nick_name); ?> menanggapi komentar pada topik 
<a href="<?php echo e(url('post/detail',$data->parent_id)); ?>">
[<?php echo e($data->parentPost->type); ?>] <?php echo e($data->parentPost->title); ?>.
</a>

dibawah ini adalah isi balasan dari dia<br>
<hr>
<?php echo e($data->activityReply->text); ?>

<hr>

<br><br><br>



-----------DO NOT REPLY THIS EMAIL, THIS IS AUTOMATICALLY SENT BY DOLPINI SYSTEM--------------
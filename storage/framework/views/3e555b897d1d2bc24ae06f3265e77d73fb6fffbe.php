<?php foreach($post->postTags as $tag): ?>
	<span class="badge badge-primary"><i class="fa fa-hashtag"></i> <?php echo e($tag->tag->tag_name); ?></span><br>
<?php endforeach; ?>
<?php foreach($post->postKubu as $kubu): ?>
	<span class="badge badge-primary"><i class="fa fa-comments"></i> <?php echo e($kubu->label); ?></span><br>
<?php endforeach; ?>
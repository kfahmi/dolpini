<?php if(\Session::has('errors')): ?>

	<div class="alert alert-danger">
	<?php foreach($errors->all() as $message): ?>
	<li><?php echo e($message); ?></li>
	<?php endforeach; ?>
	</div>

<?php endif; ?>
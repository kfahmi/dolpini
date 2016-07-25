<div class="center">
	<span class="btn btn-app btn-small btn-light no-hover">
		<span class="bigger-150 blue"> <?php echo e($user->viewer); ?> </span>

		<br />
		<span class="smaller-90"> Views </span>
	</span>

	<span class="btn btn-app btn-small btn-yellow no-hover">
		<span class="bigger-175"> <?php echo e($user->hasTopics->count()); ?> </span>

		<br />
		<span class="smaller-90"> Topics </span>
	</span>

	<span class="btn btn-app btn-small btn-pink no-hover">
		<span class="bigger-175"> <?php echo e($user->hasTopTopics->count()); ?> </span>

		<br />
		<span class="smaller-90"> Top Topics </span>
	</span>
</div>
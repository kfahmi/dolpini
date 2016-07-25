<div class="dialogs">

	<!-- //sorting berdasarkan yang paling banyak dikomen -->
<?php if(count($allPost) < 1): ?>

<div class="alert alert-danger">
	Topik tidak ditemukan
</div>

<?php else: ?>
	<?php foreach($allPost as $p): ?>
	<div class="itemdiv dialogdiv">
		<div class="user">
			 <?php if($p->user->img != '' || !empty($p->user->img)): ?>
                <img src="<?php echo e(URL::asset('uploads/userImg/'.$p->user->img)); ?>" />
            <?php else: ?>
                <i class="badge  badge-default"><?php echo e(Helper::userInitial($p->user->id)); ?></i>
            <?php endif; ?>
		</div>

		<div class="body">
			<div class="time">
				<i class="fa fa-users"></i>
				<span class="red"><?php echo e($p->subscriber->count()); ?> Pengikut</span>

				<i class="icon-time"></i>
				<span class="green"><?php echo e(Helper::postDateFormat($p->updated_at)); ?></span>
			</div>

			<div class="name">
				<a href="<?php echo e(url('user/profile',$p->user->nick_name)); ?>"><?php echo e(Helper::showName($p->user_id)); ?></a> posting 

				<a href="<?php echo e(url('/post/detail',$p->id)); ?>" style="font-size:120%;"><b> [<u style="text-transform: uppercase;"><?php echo e($p->type); ?></u>] <?php echo e(Helper::lessChar($p->title,100)); ?></b></a>
			</div>
			<div class="text">
				<div class="hr hr-dotted span12" style="margin:0 !important;"></div>
				<div class="row-fluid">
					<div class="span12 hideable">
						<?php echo e($p->header_content); ?>

					</div>

					

					<!-- POSTTAGS -->
					<div id='postTag' class="span12" style="margin:0 0 20px 0 !important;">
					<?php if(count($p->postTags)>0): ?>
							<b>Tags:</b><br>
							<?php foreach($p->postTags as $pt): ?>

							<a href="<?php echo e(url('/home',$pt->tag_id)); ?>">#<?php echo e($pt->tag->tag_name); ?></a>

							<?php endforeach; ?>
					<?php endif; ?>	
					</div>
					<!-- ENDPOSTTAGS -->

				</div>
			</div>

			<div class="tools" style="display:block !important;">
				<?php if($p->userLiked->count() >  0): ?>
				<a class="btn btn-minier btn-info">
					<?php echo e($p->hasLikes->count()); ?> <i class="fa fa-thumbs-o-up"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo e(url('/post/flag/like',$p->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Like?')){return false;};">
					<?php echo e($p->hasLikes->count()); ?> <i class="fa fa-thumbs-o-up"></i>
				</a>
				<?php endif; ?>

				<?php if($p->userDisliked->count() > 0): ?>
				<a class="btn btn-minier btn-warning">
					<?php echo e($p->hasDislikes->count()); ?> <i class="fa fa-thumbs-o-down"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo e(url('/post/flag/dislike',$p->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Dislike?')){return false;};">
					<?php echo e($p->hasDislikes->count()); ?> <i class="fa fa-thumbs-o-down"></i>
				</a>
				<?php endif; ?>


				<?php if($p->userReported->count() > 0): ?>
				<a class="btn btn-minier btn-danger">
					<?php echo e($p->hasReports->count()); ?> <i class="fa fa-warning"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo e(url('/post/flag/report',$p->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Report?')){return false;};">
					<?php echo e($p->hasReports->count()); ?> <i class="fa fa-warning"></i>
				</a>
				<?php endif; ?>
			</div>

			
		</div>
	</div>
	<?php endforeach; ?>
<?php endif; ?>
</div>
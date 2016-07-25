<div class="dialogs">
<?php foreach(Helper::getReplies($kubu->id) as $r): ?>
	<div class="itemdiv dialogdiv">
		<div class="user">
			 <?php if($r->user->img != '' || !empty($r->user->img)): ?>
                <img src="<?php echo e(URL::asset('uploads/userImg/'.$r->user->img)); ?>" />
            <?php else: ?>
                <i class="badge  badge-default"><?php echo e(Helper::userInitial($r->user->id)); ?></i>
            <?php endif; ?>
		</div>

		<div class="body" id="replyBody_<?php echo e($r->id); ?>">
				<?php if(Auth::user()->level == 'admin' && Helper::kontenStatus($r->id,'replyKubu','value') == 'reported'): ?>
				<div class="alert alert-important"><i class="fa fa-warning"></i> Komentar ini dilaporkan oleh user. Apakah Komentar ini aman?
						<a href="<?php echo e(url('post/reply/cleanReported',$r->id)); ?>" onclick="if (!confirm('jika komentar aman, maka laporan tentang komentar ini akan di hapus. maka komentar akan tetap tersimpan di dolpini. setuju ?')){return false;};"> <i class="fa fa-check"></i> Ya </a> 

						<a href="#" class="hapusReply_<?php echo e($r->id); ?>"> <i class="fa fa-remove red"></i> Tidak </a> 
				</div><hr>
				<?php endif; ?>
			<div class="time">
				<i class="icon-time"></i>
				<span class="green"><?php echo e(Helper::postDateFormat($r->created_at)); ?></span>
			</div>

			<div class="name">
				<a href="<?php echo e(url('user/profile',$r->user->nick_name)); ?>"><?php echo e(Helper::showName($r->user_id)); ?></a>
			</div>
			<div class="text">
				<div class="row-fluid">
					<div class="span12 hideable" style="margin-bottom:15px !important;">
						 <?php echo e($r->text); ?> 
					</div>
				</div>
			</div>
			
			<div class="tools" style="display:block !important;">
				<?php if($r->userLiked->count() >  0): ?>
				<a class="btn btn-minier btn-info">
					<?php echo e($r->hasLikes->count()); ?> <i class="fa fa-thumbs-o-up"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo e(url('/post/reply/flag/like',$r->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Like?')){return false;};">
					<?php echo e($r->hasLikes->count()); ?> <i class="fa fa-thumbs-o-up"></i>
				</a>
				<?php endif; ?>

				<?php if($r->userDisliked->count() > 0): ?>
				<a class="btn btn-minier btn-warning">
					<?php echo e($r->hasDislikes->count()); ?> <i class="fa fa-thumbs-o-down"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo e(url('/post/reply/flag/dislike',$r->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Dislike?')){return false;};">
					<?php echo e($r->hasDislikes->count()); ?> <i class="fa fa-thumbs-o-down"></i>
				</a>
				<?php endif; ?>

				<?php if($r->userReported->count() > 0): ?>
				<a class="btn btn-minier btn-danger">
					<?php echo e($r->hasReports->count()); ?> <i class="fa fa-warning"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo e(url('/post/reply/flag/report',$r->id)); ?>" class="btn btn-minier btn-default" onclick="if (!confirm('Report?')){return false;};">
					<?php echo e($r->hasReports->count()); ?> <i class="fa fa-warning"></i>
				</a>
				<?php endif; ?>


				<?php if($r->user_id == Auth::user()->id || Auth::user()->level == 'admin'): ?>
				<span class="hapusReply_<?php echo e($r->id); ?>">
					<a class="btn btn-minier btn-danger">
						<i class="fa fa-trash"></i> hapus
					</a>
				</span>
				<?php endif; ?>

			</div>
			
		</div>
	</div>


<?php endforeach; ?>
</div>
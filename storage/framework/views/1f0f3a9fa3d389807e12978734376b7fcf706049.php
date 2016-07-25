

<h4>Trending Hashtags</h4>

<?php if(count($topTags) > 0): ?>

	<?php foreach($topTags->slice(0,Helper::limitData('limitTrendingTag')) as $t): ?>

	<a href="<?php echo e(url('home',$t->id)); ?>"><i class="fa fa-hashtag"></i><?php echo e($t->tag_name); ?></a> (<?php echo e($t->hasPostTag->count()); ?> Topic) <br>

	<?php endforeach; ?>
<?php else: ?>

<div class="alert alert-danger">Hashtag tidak ditemukan</div>
<?php endif; ?>
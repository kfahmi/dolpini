<form onsubmit="submitForm()" action="<?php echo e(url('/post/edit',$post->id)); ?>" method="POST" id="post-form" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>

<div class="controls">
    <select name="type_show" id="topicType" disabled>
        <option value="debat" <?php echo e($post->type == 'debat' ? '' : 'selected'); ?>>Debate</option>
        <option value="rating" <?php echo e($post->type == 'rating' ? '' : 'selected'); ?>>Rating</option>
        <option value="artikel" <?php echo e($post->type == 'artikel' ? '' : 'selected'); ?>>Article</option>
    </select>

     <input type="hidden" name="type" id="type" value="<?php echo e($post->getOriginal('type')); ?>" />
     
    <?php if($errors->has('type')): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first('type')); ?></strong>
        </span>
    <?php endif; ?>
</div>

    
    <div class="controls">
        <input type="text" name="title" id="title" class="autosize-transition span12" placeholder="title" value="<?php echo e($post->getOriginal('title')); ?>" />
        <?php if($errors->has('title')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('title')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

<!-- <div class="wysiwyg-editor" id="editora1"></div> -->
    <div class="controls">
        <textarea type="text" name="header_content" id="form-field-11" placeholder="spread your words" class="autosize-transition span12" rows="10"><?php echo e($post->getOriginal('header_content')); ?></textarea>
        <?php if($errors->has('header_content')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('header_content')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

 


    <hr>

<button type="submit" class="pull-left btn btn-small btn-success pull-right">
    <i class="fa fa-save"></i>
    Save Post
</button>
</form>
<?php $__env->startSection('content'); ?>

                <div class="breadcrumbs" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li class="active">
                            <i class="icon-home home-icon"></i>
                            <a href="<?php echo e(url('/')); ?>">Home</a>

                            <span class="divider">
                                <i class="icon-angle-right arrow-icon"></i>
                            </span>
                        </li>

                        <?php if(count($tag) > 0): ?>

                            <li class="active"><i class="blue fa fa-hashtag"></i><i><b><?php echo e($tag->tag_name); ?></b></i></li>

                        <?php endif; ?>


                    </ul><!--.breadcrumb-->

                    <?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>


<?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="page-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <!--PAGE CONTENT BEGINS-->

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">

                                            <?php if(!isset($tag) && Request::segment(2) != 'tagNotFound'): ?>
                                            <li class="active">
                                                <a data-toggle="tab" href="#home">
                                                    <i class="blue icon-comments bigger-110"></i>


                                                    <b id="labelTabTopic">
                                                        <?php if(Request::segment(2) == NULL): ?>
                                                            Semua Topik
                                                        <?php elseif(Request::segment(2) == 'subscribed'): ?>
                                                            Topik Diikuti
                                                        <?php elseif(Request::segment(2) == 'mostCommented'): ?>
                                                            Topik Paling Ditanggapi
                                                        <?php elseif(Request::segment(2) == 'mostSubscriber'): ?>
                                                            Topik Paling Diikuti    
                                                        <?php else: ?>
                                                            Topik <?php echo e(ucfirst(Request::segment(2))); ?>

                                                        <?php endif; ?>
                                                    </b>
                                                       
                                                </a>
                                            </li>
                                             <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <b class="fa fa-sort-amount-desc"></b> 
                                                    <b class="caret"></b>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="tab" href="#trendingTag"><i class="fa fa-hashtag"></i> Trending HashTags</a>
                                                    </li>

                                                    <li>
                                                        <a href="<?php echo e(url('home')); ?>"><i class="fa fa-comments"></i> Semua Topik</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(url('home/subscribed')); ?>"><i class="fa fa-retweet"></i>Topik Diikuti</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(url('home/mostCommented')); ?>"><i class="fa fa-star"></i> Topik Paling Ditanggapi</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(url('home/mostSubscriber')); ?>"><i class="fa fa-star"></i> Topik Paling Diikuti</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(url('home/artikel')); ?>"><i class="fa fa-book"></i> Topik Artikel</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(url('home/debat')); ?>"><i class="fa fa-users"></i> Topik Debat</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(url('home/rating')); ?>"><i class="fa fa-sort-numeric-asc"></i> Topik Rating</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <b class="icon-pencil"></b>
                                                    Buat Topic 
                                                    <b class="caret"></b>
                                                </a>

                                                <ul class="dropdown-menu dropdown-info">
                                                    <li>
                                                        <a data-toggle="tab" href="#dropdown2"><i class="icon-pencil"></i> Buat Topic</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php elseif(isset($tag)): ?>
                                            <li class="active">
                                                <a data-toggle="tab" href="#home">
                                                    <i class="blue fa fa-hashtag"></i>
                                                    <?php echo e($tag->tag_name); ?> (<?php echo e($allPost->count()); ?>)
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="active">
                                                <a data-toggle="tab" href="#home">
                                                    <i class="blue fa fa-hashtag"></i>
                                                    <?php echo e(Request::segment(2)); ?>

                                                </a>
                                            </li>
                                            <?php endif; ?>

                                        </ul>

                                        <div class="tab-content">
                                            <div id="home" class="tab-pane in active">
                                                <?php echo $__env->make('home_topic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            </div>

                                            <div id="trendingTopic" class="tab-pane">
                                                trending topic
                                            </div>
                                            <div id="trendingTag" class="tab-pane">
                                                <?php echo $__env->make('home_top_tag', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            </div>

                                            <div id="dropdown2" class="tab-pane">
                                                <div class="position-relative">
                                                            <div class="itemdiv dialogdiv">
                                                                <div class="user">
                                                                 <a href="#" class="btn btn-app btn-primary btn-mini span1" id="btnNewTopic" data-rel="tooltip"
                                                                  title="Post Topic"  placeholder="Click" title="Hello Tooltip!" data-placement="bottom" >
                                                                    <i class="icon-pencil"></i>
                                                                 </a>

                                                                </div>

                                                                <!-- FORM TOPIC -->
                                                                <?php echo $__env->make('bodyNewTopic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                                
                                                            </div>
                                                        
                                                    </div><!--/.page-header-->
                                            </div>
                                        </div>
                                    </div>
                                </div><!--/span-->

                                </div>
                            </div>
                        </div>
            </div><!--/.page-content-->




</div><!--/.main-content-->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

        <?php echo $__env->make('library', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
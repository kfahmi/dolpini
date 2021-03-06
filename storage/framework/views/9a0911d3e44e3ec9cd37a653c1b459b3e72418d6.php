<?php $__env->startSection('content'); ?>

    <body class="login-layout">
        <div class="main-container container-fluid">
            <div class="main-content">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="login-container">
                            

                            <div class="space-6"></div>

                            <div class="row-fluid">
                                <div class="position-relative">
                                    <?php echo $__env->make('layouts.flashmessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <div id="login-box" class="login-box visible widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                    <div class="row-fluid">
                                                        <div class="center">
                                                            <h1>
                                                                <a href="<?php echo e(url('/')); ?>">
                                                                <span class="blue">&copy;dolpini</span>
                                                                </a>
                                                            </h1>
                                                        </div>
                                                    </div>

                                                <div class="space-6"></div>

                                                    <form action="" method="post" id="login-form">
                                                     <?php echo csrf_field(); ?>

                                                    <fieldset>
                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="span12" placeholder="email" name="email"/>
                                                                <i class="icon-user"></i>
                                                            </span>
                                                        </label>

                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="password" class="span12" placeholder="Password" name="password" />
                                                                <i class="icon-lock"></i>
                                                            </span>
                                                        </label>

                                                        <?php if($errors->has('email')): ?>
                                                                <span class="help-block">
                                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                                </span>
                                                            <?php endif; ?>
                                                          <?php if($errors->has('password')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>

                                                        <div class="space"></div>

                                                        <div class="clearfix">
                                                            <label class="inline">
                                                                <input type="checkbox" name="remember"/>
                                                                <span class="lbl"> Remember Me</span>
                                                            </label>

                                                            <button type="submit" class="width-35 pull-right btn btn-small btn-primary">
                                                                <i class="icon-key"></i>
                                                                Login
                                                            </button>
                                                        </div>

                                                        <div class="space-4"></div>
                                                    </fieldset>
                                                </form>

                                                <!-- <div class="social-or-login center">
                                                    <span class="bigger-110">Or Login Using</span>
                                                </div>

                                                <div class="social-login center">
                                                    <a class="btn btn-primary">
                                                        <i class="icon-facebook"></i>
                                                    </a>

                                                    <a class="btn btn-info">
                                                        <i class="icon-twitter"></i>
                                                    </a>

                                                    <a class="btn btn-danger">
                                                        <i class="icon-google-plus"></i>
                                                    </a>
                                                </div> -->
                                            </div><!--/widget-main-->

                                            <div class="toolbar clearfix">
                                                <div>
                                                    <a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
                                                        <i class="icon-arrow-left"></i>
                                                        I forgot my password
                                                    </a>
                                                </div>

                                                <div>
                                                    <a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
                                                        I want to register
                                                        <i class="icon-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><!--/widget-body-->
                                    </div><!--/login-box-->

                                    <div id="forgot-box" class="forgot-box widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <h4 class="header red lighter bigger">
                                                    <i class="icon-key"></i>
                                                    Retrieve Password
                                                </h4>

                                                <div class="space-6"></div>
                                                <p>
                                                    Enter your email and to receive instructions
                                                </p>

                                                 <form method="POST" action="<?php echo e(url('/password/email')); ?>" id="forget-form">
                                                    <?php echo csrf_field(); ?>

                                                    <fieldset>
                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="email" class="span12" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" />
                                                                <i class="icon-envelope"></i>
                                                            </span>
                                                             <?php if($errors->has('email')): ?>
                                                                    <span class="help-block">
                                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                        </label>

                                                        <div class="clearfix">
                                                            <button type="submit" class="width-35 pull-right btn btn-small btn-danger">
                                                                <i class="icon-lightbulb"></i>
                                                                Send Me!
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div><!--/widget-main-->

                                            <div class="toolbar center">
                                                <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                    Back to login
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div><!--/widget-body-->
                                    </div><!--/forgot-box-->

                                    <div id="signup-box" class="signup-box widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <h4 class="header green lighter bigger">
                                                    <i class="icon-group blue"></i>
                                                    New User Registration
                                                </h4>

                                                <div class="space-6"></div>
                                                <p> Enter your details to begin: </p>
                                                <?php if(\Session::has('errors')): ?>

                                                    <div class="alert alert-danger">
                                                    <?php foreach($errors->all() as $message): ?>
                                                    <li><?php echo e($message); ?></li>
                                                    <?php endforeach; ?>
                                                    </div>

                                                <?php endif; ?>
                                                
                                                <form action="<?php echo e(url('/register')); ?>" method="post" id="register-form">
                                                <?php echo csrf_field(); ?>

                                                    <fieldset>
                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="span12" name="real_name" placeholder="Fullname"  id="real_name" value="<?php echo e(Input::old('real_name')); ?>"/>
                                                                <i class="icon-user"></i>
                                                            </span>
                                                            <?php if($errors->has('real_name')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('real_name')); ?></strong>
                                                            </span>
                                                             <?php endif; ?>
                                                        </label>
                                                         <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="span12" name="nick_name" placeholder="Nickname"  id="nick_name" value="<?php echo e(Input::old('nick_name')); ?>"/>
                                                                <i class="icon-user"></i>
                                                            </span>
                                                             <?php if($errors->has('nick_name')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('nick_name')); ?></strong>
                                                            </span>
                                                             <?php endif; ?>
                                                        </label>

                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="span12" name="birth_date" id="birth_date" placeholder="Date of Birth" data-date-format="yyyy-mm-dd" value="<?php echo e(Input::old('birth_date')); ?>"/>
                                                                <i class="icon-calendar"></i>
                                                            </span>
                                                             <?php if($errors->has('birth_date')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('birth_date')); ?></strong>
                                                            </span>
                                                             <?php endif; ?>
                                                        </label>

                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="span12" name="mobile_phone" placeholder="mobile phone" id="mobile_phone" value="<?php echo e(Input::old('mobile_phone')); ?>"/>
                                                                <i class="icon-phone"></i>
                                                            </span>
                                                             <?php if($errors->has('mobile_phone')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('mobile_phone')); ?></strong>
                                                            </span>
                                                             <?php endif; ?>
                                                        </label>
                                                         
                                                          <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select class="span12" name="gender" id="gender">
                                                                    <option value="">--Select Gender--</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                </select>
                                                                <i class="icon-user"></i>
                                                            </span>
                                                             <?php if($errors->has('gender')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('gender')); ?></strong>
                                                            </span>
                                                             <?php endif; ?>
                                                        </label>

                                                        <h4>Login Credentials</h4>
                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="email" class="span12" name="email" placeholder="Email" id="email"  value="<?php echo e(Input::old('email')); ?>"/>
                                                                <i class="icon-envelope"></i>
                                                            </span>
                                                            <?php if($errors->has('email')): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                                            </span>
                                                             <?php endif; ?>
                                                        </label>

                                                      

                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="password" class="span12" name="password" placeholder="Password" id="password" />
                                                                <i class="icon-lock"></i>
                                                                <?php if($errors->has('password')): ?>
                                                                <span class="help-block">
                                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                                </span>
                                                                 <?php endif; ?>
                                                            </span>
                                                        </label>

                                                        <label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="password" class="span12" name="password_confirmation" id="password_confirmation" placeholder="Repeat password" />
                                                                <i class="icon-retweet"></i>
                                                                <?php if($errors->has('password_confirmation')): ?>
                                                                <span class="help-block">
                                                                    <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                                                </span>
                                                                 <?php endif; ?>
                                                            </span>
                                                        </label>

                                                        <label>
                                                            <input type="checkbox" id="agree" name="agree"/>
                                                            <span class="lbl">
                                                                I accept the
                                                                <a href="#">User Agreement</a>
                                                            </span>

                                                             <?php if($errors->has('agree')): ?>
                                                                <span class="help-block">
                                                                    <strong><?php echo e($errors->first('agree')); ?></strong>
                                                                </span>
                                                            <?php endif; ?>
                                                        </label>

                                                        <div class="space-24"></div>

                                                        <div class="clearfix">
                                                            <button type="reset" class="width-30 pull-left btn btn-small">
                                                                <i class="icon-refresh"></i>
                                                                Reset
                                                            </button>

                                                            <button type="submit" class="width-65 pull-right btn btn-small btn-success">
                                                                Register
                                                                <i class="icon-arrow-right icon-on-right"></i>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>

                                            <div class="toolbar center">
                                                <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                                    <i class="icon-arrow-left"></i>
                                                    Back to login
                                                </a>
                                            </div>
                                        </div><!--/widget-body-->
                                    </div><!--/signup-box-->
                                </div><!--/position-relative-->
                            </div>
                        </div>
                    </div><!--/.span-->
                </div><!--/.row-fluid-->
            </div>
        </div><!--/.main-container-->

        <!--basic scripts-->
        <?php echo $__env->make('library', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('auth.login_script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
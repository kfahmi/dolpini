<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Dolpini - Share the truth</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo e(URL::asset('guest/assets/css/main.css')); ?>" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	    <style type="text/css">
        .morecontent span {
            display: none;
        }
        .morelink {
            display: block;
        }
        </style>
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="index.html">Dolpini</a> Share the truth</h1>
					<nav id="nav">
						<ul>
							<li><a href="<?php echo e(url('/login')); ?>" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<h2>DOLPINI</h2>
					<p>Share the truth, blast the opinion. !</p>
					<ul class="actions">
						<li><a href="<?php echo e(url('/login')); ?>" class="button special">Sign In</a></li>
						<li><a href="#" class="button">Learn More</a></li>
					</ul>
				</section>

			<!-- Main -->
				<section id="main" class="container">

					<?php foreach($allPost as $p): ?>
					<section class="box special">
						<header class="major">
							<h2><?php echo e($p->title); ?></h2>
							<h2 style="font-size:80%;">

								<i class="fa fa-users"> <?php echo e($p->subscriber->count()); ?> Pengikut </i>
								<i class="fa fa-clock-o"> <?php echo e(Helper::postDateFormat($p->updated_at)); ?></i>
							</h2>
							<p class="hideable"><?php echo e($p->header_content); ?></p>
						</header>
							<section class="box special features">
							<div class="features-row">
								<?php foreach($p->postKubu as $kubu): ?>
								<section>
									<span class="icon major fa-comments accent2"></span>
									<h3><?php echo e($kubu->label); ?></h3>
										<?php if($p->type != 'artikel'): ?>
											<h5 class="bigger lighter">
												<?php echo e(Counter::kubuPercentage($kubu->id,$p->id)); ?> %
											</h5>
											<?php else: ?>
											<h5 class="bigger lighter">
												<?php echo e(Counter::userInKubuCounter($kubu->id)); ?> User yang Berkomentar
											</h5>
										<?php endif; ?>
								</section>
								<?php endforeach; ?>
								
							</div>
							</section>

							<a href="<?php echo e(url('/post/detail',$p->id)); ?>"><i class="badge badge-info"> Lihat lebih lanjut..</i></a>

					</section>
					<?php endforeach; ?>

				</section>

			<!-- CTA -->
				<!-- <section id="cta">

					<h2>Sign up for beta access</h2>
					<p>Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc.</p>

					<form>
						<div class="row uniform 50%">
							<div class="8u 12u(mobilep)">
								<input type="email" name="email" id="email" placeholder="Email Address" />
							</div>
							<div class="4u 12u(mobilep)">
								<input type="submit" value="Sign Up" class="fit" />
							</div>
						</div>
					</form>

				</section> -->

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="<?php echo e(URL::asset('guest/assets/js/jquery.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('guest/assets/js/jquery.dropotron.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('guest/assets/js/jquery.scrollgress.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('guest/assets/js/skel.min.js')); ?>"></script>
			<script src="<?php echo e(URL::asset('guest/assets/js/util.js')); ?>"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="<?php echo e(URL::asset('guest/assets/js/main.js')); ?>"></script>
			<script type="text/javascript">
            $(document).ready(function() {
            // Configure/customize these variables.
            var showChar = 1000; // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "<i class='fa fa-chevron-down'></i> Show more";
            var lesstext = "<i class='fa fa-chevron-up'></i> Show less";
            

            $('.hideable').each(function() {
                var content = $(this).html();
         
                if(content.length > showChar) {
         
                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
         
                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">  ' + moretext + '</a></span>';
         
                    $(this).html(html);
                }
         
            });
         
            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle(500);
                $(this).prev().toggle(500);
                return false;
            });
        });
        </script>

	</body>
</html>
<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="Cino – Premium Bootstrap Dashboard Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html"/>

		<!-- Favicon -->
		<link rel="icon" href="/core/public/assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- Title -->
		<title><?php echo e(env('APP_NAME')); ?></title>

		<!--Bootstrap css-->
		<link rel="stylesheet" href="/core/public/assets/plugins/bootstrap/css/bootstrap.min.css">

		<!--Style css -->
		<link href="/core/public/assets/css/style.css" rel="stylesheet" />
		<link href="/core/public/assets/css/dark-style.css" rel="stylesheet" />
		<link href="/core/public/assets/css/skin-modes.css" rel="stylesheet">

		<!-- P-scrollbar css-->
		<link href="/core/public/assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link href="/core/public/assets/css/sidemenu.css" rel="stylesheet" />

		<!-- Rightsidebar css -->
		<link href="/core/public/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- INTERNAL Morris  Charts css-->
		<link href="/core/public/assets/plugins/morris/morris.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="/core/public/assets/css/icons.css" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="/core/public/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="/core/public/public/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />

	    <!-- Switcher css -->
		<link href="/core/public/assets/switcher/css/switcher.css" rel="stylesheet" type="text/css"/>
		<link href="/core/public/assets/switcher/demo.css" rel="stylesheet" type="text/css"/>
		
		

	</head>
	
	

	<body class="app sidebar-mini dark-menu">

		<!--Global-Loader-->
		<div id="global-loader">
			<img src="/core/public/assets/images/loader.svg" alt="loader">
		</div>
		<!--End Global-Loader-->

		<!-- Page -->
		<div class="page">
			<div class="page-main">

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar toggle-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="index.html">
							<img src="/core/public/assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="zdash logo">
							<img src="/core/public/assets/images/brand/logo-light.png" class="header-brand-img dark-logo" alt="zdash logo">
							<img src="/core/public/assets/images/brand/icon.png" class="header-brand-img mobile-logo" alt="zdash logo">
							<img src="/core/public/assets/images/brand/icon-light.png" class="header-brand-img darkmobile-logo" alt="zdash logo">
						</a>
					</div>
					<ul class="side-menu toggle-menu">
						<li class="slide">
							<a class="side-menu__item" href="/<?php echo e(Auth::user()->username); ?>/dashboard"><i class="side-menu__icon las la-home"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item"  href="/<?php echo e(Auth::user()->username); ?>/profile"><i class="side-menu__icon las la-grin"></i><span class="side-menu__label">Profile</span></a>
							
						</li>
						<li>
							<a class="side-menu__item" href="/<?php echo e(Auth::user()->username); ?>/wallet"><i class="side-menu__icon las la-wallet"></i><span class="side-menu__label">Wallet deposit</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" href="/<?php echo e(Auth::user()->username); ?>/send_money"><i class="side-menu__icon las la-receipt"></i><span class="side-menu__label">Transfer funds</span></a>
							
						</li>
						<li class="slide">
							<a class="side-menu__item" href="/<?php echo e(Auth::user()->username); ?>/investments"><i class="side-menu__icon las la-balance-scale"></i><span class="side-menu__label">My Investments</span></a>
						
						</li>
						<li class="slide">
							<a class="side-menu__item" href="/<?php echo e(Auth::user()->username); ?>/withdrawal"><i class="side-menu__icon las la-money-bill-alt"></i><span class="side-menu__label">Withdrawals</span></a>
							
						</li>
						<li class="slide">
							<a class="side-menu__item" href="/<?php echo e(Auth::user()->username); ?>/downlines"><i class="side-menu__icon las la-table"></i><span class="side-menu__label">Downlines</span></a>
							
						</li>
						<li>
							<a class="side-menu__item" href="/logout"><i class="side-menu__icon las la-sign-out-alt"></i><span class="side-menu__label">Logout</span></a>
						</li>
						
						<li>
							<a class="side-menu__item" href="#"><i class="side-menu__icon las la-life-ring"></i><span class="side-menu__label">Support</span></a>
						</li>
					</ul>
				</aside>
				<!--sidemenu end-->

				<!--app-header-->
				<div class="app-header header">
					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="index.html">
								<img src="/core/public/assets/images/brand/logo.png" class="header-brand-img main-logo" alt="Cino logo">
								<img src="core/public/assets/images/brand/logo-light.png" class="header-brand-img dark-main-logo" alt="Cino logo">
								<img src="core/public/assets/images/brand/icon-light.png" class="header-brand-img dark-icon-logo" alt="Cino logo">
								<img src="core/public/assets/images/brand/icon.png" class="header-brand-img icon-logo" alt="Cino logo">
							</a><!-- logo-->
							<div class="app-sidebar__toggle" data-toggle="sidebar">
								<a class="open-toggle"  href="#"><i class="fe fe-align-left"></i></a>
								<a class="close-toggle"  href="#"><i class="fe fe-x"></i></a>
							</div>
							<form class="form-inline">
								<div class="search-element">
									<button class="btn btn-primary-color" type="submit">
										<i class="fa fa-search"></i>
									</button>
									<input type="search" class="form-control header-search" placeholder="Search...." aria-label="Search" tabindex="1">
								</div>
							</form>
							<div class="d-flex order-lg-2 ml-auto header-right">
								<div class="dropdown navsearch">
									<a data-toggle="dropdown" class="nav-link icon">
										<i class="zmdi zmdi-search"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="p-2">
											<button class="btn btn-primary-color" type="submit">
												<i class="fa fa-search"></i>
											</button>
											<input type="search" class="form-control header-search" placeholder="Search...." aria-label="Search" tabindex="1">
										</div>
									</div>
								</div>
								<div class="d-md-flex">
									<a href="#" class="nav-link icon full-screen-link">
										<i class="zmdi zmdi-fullscreen fullscreen-button"></i>
									</a>
								</div>
								<div class="dropdown d-md-flex header-message">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="mdi mdi-bell-outline"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="dropdown-header">
											<h6 class="mb-0 fs-14">Notifications</h6>
											<span class="badge badge-danger ml-auto">3</span>
										</div>
										<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
											<span class="avatar mr-3 brround align-self-center avatar-md cover-image bg-primary">
												<i class="fe fe-mail"></i>
											</span>
											<div>
												<span class="font-weight-semibold"> Commented on your post </span>
												<div class="small text-muted d-flex">
													3 hours ago
												</div>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image bg-secondary">
												<i class="fe fe-download"></i>
											</span>
											<div>
												<span class="font-weight-semibold"> New file has been Uploaded </span>
												<div class="small text-muted d-flex">
													5 hour ago
												</div>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image bg-success">
												<i class="fe fe-user"></i>
											</span>
											<div>
												<span class="font-weight-semibold"> User account has Updated</span>
												<div class="small text-muted d-flex">
													20 mins ago
												</div>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-4 border-bottom" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image bg-danger">
												<i class="fe fe-shopping-cart"></i>
											</span>
											<div>
												<span class="font-weight-semibold"> New Order Recevied</span>
												<div class="small text-muted d-flex">
													1 hour ago

												</div>
											</div>
										</a>
										<div class="text-center dropdown-btn p-3">
											<a href="#" class="text-dark">See all recent notifications</a>
										</div>
									</div>
								</div>
								<div class="dropdown d-md-flex Sidebar-setting">
									<a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
										<i class="mdi mdi-tune"></i>
									</a>
								</div>
								<div class="dropdown header-profile">
									<a class="nav-link pr-lg-0 leading-none d-flex pt-1" data-toggle="dropdown" href="#">
										<span class="avatar avatar-md brround cover-image" data-image-src="core/public/assets/images/users/female/6.jpg"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-0">
										<div class="drop-heading">
											<div class="text-center">
												<h5 class="text-dark mb-0"><?php echo e(Auth::user()->username); ?></h5>
												<small class="text-muted"></small>
											</div>
										</div>
										<div class="dropdown-divider m-0"></div>
										<a class="dropdown-item border-bottom" href="/<?php echo e(Auth::user()->username); ?>/profile"><i class="dropdown-icon fe fe-user"></i>Profile</a>
										<a class="dropdown-item border-bottom" href="#"><i class="dropdown-icon fe fe-edit"></i>Schedule</a>
										<a class="dropdown-item border-bottom" href="#"><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
										<a class="dropdown-item border-bottom" href="#"><i class="dropdown-icon fe fe-unlock"></i> Look Screen</a>
										<a class="dropdown-item" href="/logout"><i class="dropdown-icon fe fe-power"></i> Log Out</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--app-header end-->
			
		
                	<div class="app-content toggle-content">
    					<div class="side-app">
    			<?php if(session()->has('error')): ?>
                <div class="alert alert-danger alert-block">  
                    <button type="button" class="close" data-dismiss="alert">X</button>   
                        <strong> <?php echo e(session()->get('error')); ?></strong>  
                </div>  
                <?php endif; ?> 
                  
                <?php if(session()->has('success')): ?>
                  <div class="alert alert-success alert-block">  
                    <button type="button" class="close" data-dismiss="alert">X</button>   
                        <strong> <?php echo e(session()->get('success')); ?></strong>  
                </div>  
                <?php endif; ?> 
                 
                
    			 
    				        <?php echo $__env->yieldContent('content'); ?>
        				</div>
    				</div>

				<!--Footer-->
				<footer class="footer side-footer">
					<div class="container">
						<div class="row align-items-center flex-row-reverse">
							<div class="col-lg-12 col-sm-12   text-center">
								Copyright © 2020 <a href="#">Cino</a>. Designed by <a href="https://www.spruko.com/">Spruko</a> All rights reserved.
							</div>
						</div>
					</div>
				</footer>
				<!-- End Footer-->

			</div>
		</div>
	

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- Jquery js-->
		<script src="<?php echo e(url('core/public/assets/js/jquery.min.js')); ?>"></script>

		<!--Bootstrap.min js-->
		<script src="<?php echo e(url('core/public/assets/plugins/bootstrap/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(url('core/public/assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

		<!--Jquery Sparkline js-->
		<script src="<?php echo e(url('core/public/assets/js/jquery.sparkline.min.js')); ?>"></script>

		<!-- Chart Circle js-->
		<script src="<?php echo e(url('core/public/assets/js/circle-progress.min.js')); ?>"></script>

		<!-- Star Rating js-->
		<script src="<?php echo e(url('core/public/assets/plugins/rating/jquery.rating-stars.js')); ?>"></script>

		<!--Moment js-->
		<script src="<?php echo e(url('core/public/assets/plugins/moment/moment.min.js')); ?>"></script>

		<!--Side-menu js-->
		<script src="<?php echo e(url('core/public/assets/plugins/sidemenu/sidemenu.js')); ?>"></script>

		<!-- P-scrollbar js-->
		<script src="<?php echo e(url('core/public/assets/plugins/p-scrollbar/p-scrollbar.js')); ?>"></script>
		<script src="<?php echo e(url('core/public/assets/plugins/p-scrollbar/p-scrollbar-leftmenu.js')); ?>"></script>

		<!--Peitychart js -->
		<script src="<?php echo e(url('core/public/assets/plugins/peitychart/jquery.peity.min.js')); ?>"></script>
		<script src="<?php echo e(url('core/public/assets/plugins/peitychart/peitychart.init.js')); ?>"></script>

		<!-- Rightsidebar js -->
		<script src="<?php echo e(url('core/public/assets/plugins/sidebar/sidebar.js')); ?>"></script>

		<!-- INTERNAL Apex-charts js-->
		<script src="<?php echo e(url('core/public/assets/js/apexcharts.js')); ?>"></script>

		<!-- INTERNAL Data tables js-->
		<script src="<?php echo e(url('core/public/assets/plugins/datatable/jquery.dataTables.min.js')); ?>"></script>
		<script src="<?php echo e(url('core/public/assets/plugins/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
		<script src="<?php echo e(url('core/public/assets/plugins/datatable/dataTables.responsive.min.js')); ?>"></script>

		<!-- INTERNAL JVectormap js-->
		<script src="<?php echo e(url('core/public/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')); ?>"></script>
       <script src="<?php echo e(url('core/public/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
        <script src="<?php echo e(url('core/public/assets/plugins/jvectormap/gdp-data.js')); ?>"></script>

		<!-- INTERNAL Charts js-->
		<script src="<?php echo e(url('core/public/assets/plugins/chart/chart.min.js')); ?>"></script>
		<script src="<?php echo e(url('core/public/assets/plugins/chart/chart.bundle.js')); ?>"></script>

		<!--INTERNAL Custom-charts js-->
		<script src="<?php echo e(url('core/public/assets/js/index.js')); ?>"></script>

		<!-- Custom js-->
		<script src="<?php echo e(url('core/public/assets/js/custom.js')); ?>"></script>

	</body>
</html><?php /**PATH /home/candlest/tru.candlesticktrade.xyz/core/resources/views/layouts/main.blade.php ENDPATH**/ ?>
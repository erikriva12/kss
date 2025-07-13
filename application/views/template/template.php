<?php
if (!$this->session->userdata('admin_session'))
{
	redirect('login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
	<title>Admin Dashboard |
		<?= nama_aplikasi ?>
	</title>
	<!-- Favicons -->
	<link href="<?= base_url(logo) ?>" rel="icon">
	<link href="<?= base_url(logo) ?>" rel="apple-touch-icon">
	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css" />
	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/jqvmap/dist/jqvmap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/summernote/summernote-bs4.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/modules/datatables/datatables.min.css">
	<link rel="stylesheet"
		href="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet"
		href="<?= base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/select2/dist/css/select2.min.css">
	<!-- Start GA -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> -->
	<!-- /END GA -->

	<!-- General JS Scripts -->
	<script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/popper.js"></script>
	<script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
	<script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
	<script src="<?= base_url() ?>assets/js/stisla.js"></script>
	<!-- JS Libraies -->
	<script src="<?= base_url() ?>assets/modules/jquery.sparkline.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/chart.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
	<script src="<?= base_url() ?>assets/modules/summernote/summernote-bs4.js"></script>
	<script src="<?= base_url() ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
	<script src="<?= base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
	<script
		src="<?= base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
	<script src="<?= base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
	<!-- Template JS File -->
	<script src="<?= base_url() ?>assets/js/scripts.js"></script>
	<script src="<?= base_url() ?>assets/js/custom.js"></script>
	<script src="https://cdn.tiny.cloud/1/rtwwhvxttwvfpujt6gk5r2tphanjg73g2zwuq7ax98f864g0/tinymce/6/tinymce.min.js"
		referrerpolicy="origin"></script>
	<script src="<?= base_url() ?>assets/modules/sweetalert2/sweetalert2.all.js"></script>
	<script src="<?= base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
			dataLayer.push(arguments);
		}
		gtag("js", new Date());
		gtag("config", "UA-94034622-3");
	</script>
	<script type="text/javascript">

		$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};
	</script>
</head>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li>
							<a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
									class="fas fa-bars"></i></a>
						</li>
						<li>
							<a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
									class="fas fa-search"></i></a>
						</li>
					</ul>

				</form>
				<ul class="navbar-nav navbar-right">
					<!-- <li class="dropdown dropdown-list-toggle">
						<a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i
								class="far fa-envelope"></i></a>
						<div class="dropdown-menu dropdown-list dropdown-menu-right">
							<div class="dropdown-header">
								Messages
								<div class="float-right">
									<a href="#">Mark All As Read</a>
								</div>
							</div>
							<div class="dropdown-list-content dropdown-list-message">
								<a href="#" class="dropdown-item dropdown-item-unread">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-1.png"
											class="rounded-circle" />
										<div class="is-online"></div>
									</div>
									<div class="dropdown-item-desc">
										<b>Kusnaedi</b>
										<p>Hello, Bro!</p>
										<div class="time">10 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item dropdown-item-unread">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-2.png"
											class="rounded-circle" />
									</div>
									<div class="dropdown-item-desc">
										<b>Dedik Sugiharto</b>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
										<div class="time">12 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item dropdown-item-unread">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-3.png"
											class="rounded-circle" />
										<div class="is-online"></div>
									</div>
									<div class="dropdown-item-desc">
										<b>Agung Ardiansyah</b>
										<p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										<div class="time">12 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-4.png"
											class="rounded-circle" />
									</div>
									<div class="dropdown-item-desc">
										<b>Ardian Rahardiansyah</b>
										<p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
										<div class="time">16 Hours Ago</div>
									</div>
								</a>
								<a href="#" class="dropdown-item">
									<div class="dropdown-item-avatar">
										<img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-5.png"
											class="rounded-circle" />
									</div>
									<div class="dropdown-item-desc">
										<b>Alfa Zulkarnain</b>
										<p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
										<div class="time">Yesterday</div>
									</div>
								</a>
							</div>
							<div class="dropdown-footer text-center">
								<a href="#">View All <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
					</li>
					 -->
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<?php if($this->session->userdata('foto_profil')){?>
								<img alt="image" src="<?= base_url($this->session->userdata('foto_profil')) ?>"
							<?php }else{?>

								<img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-1.png"
								<?php } ?>
								class="rounded-circle mr-1" />
							<div class="d-sm-none d-lg-inline-block">Hi,
								<?= $this->session->userdata('nama'); ?>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Logged in 5 min ago</div>
							<a href="<?= base_url('user/profile') ?>" class="dropdown-item has-icon"> <i
									class="far fa-user"></i> Profile </a>
							<a href="<?= base_url('login/logout') ?>" class="dropdown-item has-icon text-danger"> <i
									class="fas fa-sign-out-alt"></i>
								Logout </a>
						</div>
					</li>
				</ul>
			</nav>
			<div class="main-sidebar sidebar-style-2">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<a href="<?= base_url() ?>dashboard">KSS</a>
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="<?= base_url() ?>dashboard">KSS</a>
					</div>
					<ul class="sidebar-menu">
						<li class="<?= ($title == 'Dashboard') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="far fa-square"></i>
								<span>Dashboard</span>

							</a>
						</li>
						<li class="dropdown <?= ($title == 'Section') ? 'active' : '' ?>" disabled>
							<a href="#" class="nav-link has-dropdown"><i
									class="fas fa-fire"></i><span>Section</span></a>
							<ul class="dropdown-menu">
								<li class="<?= (@$sub_title == 'Daftar Section') ? 'active' : '' ?>">
									<a class="nav-link" href="<?= base_url('section') ?>">
										Daftar Section
									</a>
								</li>
								<li class="<?= (@$sub_title == 'Kategori Section') ? 'active' : '' ?>">
									<a class="nav-link" href="<?= base_url('section/kategori') ?>">
										Kategori Section
									</a>
								</li>
							</ul>
						</li>
						<li class="<?= ($title == 'Testimonial') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('testimonial') ?>"><i class="far fa-square"></i>
								<span>Testimonial</span>
							</a>
						</li>
						<li class="dropdown <?= ($title == 'Produk') ? 'active' : '' ?>" disabled>
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Produk</span></a>
							<ul class="dropdown-menu">
								<li class="<?= (@$sub_title == 'Daftar Produk') ? 'active' : '' ?>">
									<a class="nav-link" href="<?= base_url('produk') ?>">
										Daftar Produk
									</a>
								</li>
								<li class="<?= (@$sub_title == 'Kategori Produk') ? 'active' : '' ?>">
									<a class="nav-link" href="<?= base_url('produk/kategori') ?>">
										Kategori Produk
									</a>
								</li>
							</ul>
						</li>
						<li class="<?= ($title == 'konfigurasi') ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url('konfigurasi') ?>"><i class="fas fa-cogs"></i>
								<span>Konfigurasi</span>
							</a>
						</li>
						<li class="dropdown <?= ($title == 'Master') ? 'active' : '' ?>" disabled>
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master</span></a>
							<ul class="dropdown-menu">
								<li class="<?= (@$sub_title == 'Master User') ? 'active' : '' ?>">
									<a class="nav-link" href="<?= base_url('user') ?>">
										User
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<!-- <ul class="sidebar-menu">
						<li class="">
							<a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="far fa-square"></i>
								<span>Dashboard</span></a>
						</li>
						<li class="">
							<a class="nav-link" href="<?= base_url('section') ?>"><i class="far fa-square"></i>
								<span>Section</span></a>
						</li>

						<li class="menu-header">Dashboard</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i
									class="fas fa-fire"></i><span>Dashboard</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/index_0">General
										Dashboard</a></li>
								<li><a class="nav-link" href="<?= base_url() ?>dist/index">Ecommerce
										Dashboard</a></li>
							</ul>
						</li>
						<li class="menu-header">Starter</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
									class="fas fa-columns"></i> <span>Layout</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/layout_default">Default
										Layout</a></li>
								<li><a class="nav-link" href="<?= base_url() ?>dist/layout_transparent">Transparent
										Sidebar</a></li>
								<li><a class="nav-link" href="<?= base_url() ?>dist/layout_top_navigation">Top
										Navigation</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
								<span>Bootstrap</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_alert">Alert</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_badge">Badge</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_breadcrumb">Breadcrumb</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_buttons">Buttons</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_card">Card</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_carousel">Carousel</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_collapse">Collapse</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_dropdown">Dropdown</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_form">Form</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_list_group">List
										Group</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_media_object">Media Object</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_modal">Modal</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_nav">Nav</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_navbar">Navbar</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_pagination">Pagination</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_popover">Popover</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_progress">Progress</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/bootstrap_table">Table</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_tooltip">Tooltip</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/bootstrap_typography">Typography</a></li>
							</ul>
						</li>
						<li class="menu-header">Stisla</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
								<span>Components</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/components_article">Article</a></li>
								<li class=""><a class="nav-link beep beep-sidebar"
										href="<?= base_url() ?>dist/components_avatar">Avatar</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/components_chat_box">Chat
										Box</a></li>
								<li class=""><a class="nav-link beep beep-sidebar"
										href="<?= base_url() ?>dist/components_empty_state">Empty State</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/components_gallery">Gallery</a></li>
								<li class=""><a class="nav-link beep beep-sidebar"
										href="<?= base_url() ?>dist/components_hero">Hero</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/components_multiple_upload">Multiple Upload</a>
								</li>
								<li class=""><a class="nav-link beep beep-sidebar"
										href="<?= base_url() ?>dist/components_pricing">Pricing</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/components_statistic">Statistic</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/components_tab">Tab</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/components_table">Table</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/components_user">User</a>
								</li>
								<li class=""><a class="nav-link beep beep-sidebar"
										href="<?= base_url() ?>dist/components_wizard">Wizard</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
								<span>Forms</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/forms_advanced_form">Advanced Form</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/forms_editor">Editor</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/forms_validation">Validation</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google
									Maps</span></a>
							<ul class="dropdown-menu">
								<li class=""><a href="<?= base_url() ?>dist/gmaps_advanced_route">Advanced
										Route</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_draggable_marker">Draggable
										Marker</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_geocoding">Geocoding</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_geolocation">Geolocation</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_marker">Marker</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_multiple_marker">Multiple
										Marker</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_route">Route</a></li>
								<li class=""><a href="<?= base_url() ?>dist/gmaps_simple">Simple</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i>
								<span>Modules</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/modules_calendar">Calendar</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/modules_chartjs">ChartJS</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/modules_datatables">DataTables</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_flag">Flag</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_font_awesome">Font
										Awesome</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_ion_icons">Ion
										Icons</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_owl_carousel">Owl
										Carousel</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/modules_sparkline">Sparkline</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_sweet_alert">Sweet
										Alert</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_toastr">Toastr</a>
								</li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/modules_vector_map">Vector
										Map</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/modules_weather_icon">Weather Icon</a></li>
							</ul>
						</li>
						<li class="menu-header">Pages</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
							<ul class="dropdown-menu">
								<li><a href="<?= base_url() ?>dist/auth_forgot_password">Forgot Password</a></li>
								<li><a href="<?= base_url() ?>dist/auth_login">Login</a></li>
								<li><a href="<?= base_url() ?>dist/auth_register">Register</a></li>
								<li><a href="<?= base_url() ?>dist/auth_reset_password">Reset Password</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
								<span>Errors</span></a>
							<ul class="dropdown-menu">
								<li><a class="nav-link" href="<?= base_url() ?>dist/errors_503">503</a></li>
								<li><a class="nav-link" href="<?= base_url() ?>dist/errors_403">403</a></li>
								<li><a class="nav-link" href="<?= base_url() ?>dist/errors_404">404</a></li>
								<li><a class="nav-link" href="<?= base_url() ?>dist/errors_500">500</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i>
								<span>Features</span></a>
							<ul class="dropdown-menu">
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/features_activities">Activities</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/features_post_create">Post
										Create</a></li>
								<li class=""><a class="nav-link" href="<?= base_url() ?>dist/features_posts">Posts</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/features_profile">Profile</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/features_settings">Settings</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/features_setting_detail">Setting Detail</a>
								</li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/features_tickets">Tickets</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i>
								<span>Utilities</span></a>
							<ul class="dropdown-menu">
								<li><a href="<?= base_url() ?>dist/utilities_contact">Contact</a></li>
								<li class=""><a class="nav-link"
										href="<?= base_url() ?>dist/utilities_invoice">Invoice</a></li>
								<li><a href="<?= base_url() ?>dist/utilities_subscribe">Subscribe</a></li>
							</ul>
						</li>
						<li class="">
							<a class="nav-link" href="<?= base_url() ?>dist/credits"><i class="fas fa-pencil-ruler"></i>
								<span>Credits</span></a>
						</li>
					</ul> -->

				</aside>
			</div>
			<!-- Main Content -->
			<?= $contents ?>

			<footer class="main-footer">
				<div class="footer-left">
					&copy;
					<?= copyright ?>
				</div>
				<div class="footer-right"></div>
			</footer>
		</div>
	</div>

</body>
<script>
	function renderEditor() {
		if ($('textarea').hasClass("editor")) {

			tinymce.init({
				selector: '.editor',
				plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
				toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
				height: "300"
			});
		}
	}
	function renderSelect2() {
		if ($('select').hasClass("select2")) {
			$(".select2").select2();
		}
	}
	// Disable Enter Submit
	$(document).ready(function () {
		$(window).keydown(function (event) {
			if (event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});
	});
</script>

</html>
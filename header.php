<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body>
<div class="container bp-header py-4">
	<div class="navbar">
		<a class="navbar-brand" href="#">
			<img src="<?php bloginfo('template_url'); ?>/assets/img/logo.svg" width="48" height="48" class="d-inline-block align-text-middle">
			<?php echo get_bloginfo('name'); ?>
		</a>
		<div class="d-flex">
			<div class="w-100">
				<input class="form-control border border-dark border-2 rounded-pill search-box" type="search" placeholder="Search" name="search">
			</div>
		</div>
	</div>
</div>
<nav class="navbar navbar-expand-md bp-menu py-0">
	<div class="container">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="main-menu">
			<?php wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'container' => false,
				'menu_class' => '',
				'fallback_cb' => '__return_false',
				'items_wrap' => '<ul id="%1$s" class="position-relative navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
				'depth' => 0,
				'walker' => new Bootstrap_Nav_Walker()
			)); ?>
		</div>
		<?php if (is_user_logged_in()): ?>
		<div class="dropdown text-end" style="z-index: 2000;">
			<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle show" data-bs-toggle="dropdown" aria-expanded="true">
				<!--<?php echo get_avatar_url(get_current_user_id(), array('size'=>36));?>-->
				<img src="https://dn-qiniu-avatar.qbox.me/avatar/" class="rounded-circle" width="36" height="36">
			</a>
			<ul class="dropdown-menu text-sm">
				<li>
					<h5 class="dropdown-header">
						<?php $current_user = wp_get_current_user(); echo $current_user->user_login; ?>
					</h5>
				</li>
				<li><a href="<?php echo get_edit_profile_url(); ?>" class="dropdown-item">Edit Profile</a></li>
				<li><a href="<?php echo admin_url('post-new.php'); ?>" class="dropdown-item">Add New Post</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a href="<?php echo wp_logout_url(); ?>" class="dropdown-item">Log Out</a></li>
			</ul>
		</div>
		<?php else: ?>
		<div class="text-end">
			<a href="<?php echo wp_login_url(); ?>" class="btn btn-sm btn-light">Sign in</a>
			<a href="<?php wp_registration_url(); ?>" class="btn btn-sm btn-danger">Sign up</a>
		</div>
		<?php endif; ?>
	</div>
</nav>

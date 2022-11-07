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
				'depth' => 2,
				'walker' => new Bootstrap_Nav_Walker()
			)); ?>
		</div>
	</div>
</nav>

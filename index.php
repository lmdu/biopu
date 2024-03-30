<?php get_header(); ?>
<div class="container my-5 bp-body">
	<div id="slideshow" class="carousel slide mb-5" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#slideshow" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#slideshow" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#slideshow" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner rounded-3">
			<div class="carousel-item active">
				<img src="/wordpress/wp-content/uploads/03-38-58-887_1920x550.jpg" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/wordpress/wp-content/uploads/05-39-48-14_1920x550.webp" class="d-block w-100">
			</div>
			<div class="carousel-item">
				<img src="/wordpress/wp-content/uploads/03-03-45-83_1920x550.webp" class="d-block w-100">
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#slideshow" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#slideshow" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	<div class="row gx-5">
		<div class="col-md-8 pe-md-5">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="mb-5">
				<h3 class="post-title mb-3">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>

				<div class="post-meta mt-3">
					<!--<img width="20" height="20" src="<?php echo get_avatar_url(get_the_author_email()); ?>" class="rounded-circle" onerror="this.onerror=null;this.src='https://cdn.v2ex.com/gravatar';">-->
					<img width="20" height="20" class="rounded-circle" src="https://dn-qiniu-avatar.qbox.me/avatar/">
					<span class="align-middle"><?php the_author(); ?></span>
					<span class="ms-3">
						<img src="<?php bloginfo('template_url'); ?>/assets/img/clock.svg">
					</span>
					<span class="align-middle"><?php the_date('M j, Y'); ?></span>
					<span class="ms-3">
						<img src="<?php bloginfo('template_url'); ?>/assets/img/view.svg">
					</span>
					<span class="align-middle"><?php the_views(); ?></span>
					<span class="ms-3">
						<img src="<?php bloginfo('template_url'); ?>/assets/img/comment.svg">
					</span>
					<span class="align-middle"><?php comments_number($zero="0 Comment"); ?></span>
				</div>

				<div class="post-excerpt lh-lg">
					<?php the_excerpt(); ?>
				</div>
				
			</article>
			<?php endwhile; ?>
			<div class="page-nav">
				<ul class="pagination justify-content-center">
					<li class="page-item"><a class="page-link link-dark" href="<?php previous_posts(); ?>">&laquo; Newer posts</a></li>
					<li class="page-item"><a class="page-link link-dark" href="<?php next_posts(); ?>">Older posts &raquo;</a></li>
	    		</ul>
    		</div>
			<?php endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
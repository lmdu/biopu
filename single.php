<?php get_header(); ?>
<div class="container my-5 bp-body">
	<div class="row">
		<div class="col-md-9">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="mb-5">
				<h1 class="post-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h1>
				<div class="post-meta my-4">
					<!--<img width="20" height="20" src="<?php echo get_avatar_url(get_the_author_email()); ?>" class="rounded-circle" onerror="this.onerror=null;this.src='https://cdn.v2ex.com/gravatar';">-->
					<img width="20" height="20" class="rounded-circle" src="https://cdn.v2ex.com/gravatar">
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
					<span class="align-middle me-5"><?php comments_number($zero="0 Comment"); ?></span>
					<?php the_category(); ?>
				</div>
				<div class="post-excerpt lh-lg">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; endif; ?>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<?php get_footer(); ?>
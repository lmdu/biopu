<?php get_header(); ?>
<div class="container my-5 bp-body">
	<div class="row gx-5">
		<div class="col-md-9 pe-md-5">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="mb-5">
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="post-meta my-4">
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
					<span class="align-middle me-5"><?php comments_number($zero="0 Comment"); ?></span>
					<?php the_category(); ?>
				</div>

				<?php if (is_active_sidebar('post-header-ad')): ?>
				<?php dynamic_sidebar('post-header-ad'); ?>
				<?php endif; ?>

				<div class="post-excerpt lh-lg">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; endif; ?>
			<?php if (is_active_sidebar('post-header-ad')): ?>
			<?php dynamic_sidebar('post-header-ad'); ?>
			<?php endif; ?>
			<?php comments_template(); ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
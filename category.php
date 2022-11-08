<?php get_header(); ?>
<div class="container my-5 bp-body">
	<div class="row">
		<div class="col-md-9 pe-md-5">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="mb-5">
				<h3 class="post-title mb-3">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="post-excerpt lh-lg">
					<?php the_excerpt(); ?>
				</div>
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
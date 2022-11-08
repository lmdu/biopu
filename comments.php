<?php if (post_password_required()) { return; } ?>

<div class="comments">
	<hr>
	<?php if (have_comments()): ?>
	<ul class="comment-list list-unstyled">
		<?php wp_list_comments(array('callback'=>'biopu_comment_list')); ?>
	</ul>

	<?php if (! comments_open()) : ?>
	<p>Comments are closed</p>
	<?php endif; ?>

	<?php endif ;?>

	<?php 
		if (is_user_logged_in()) {
			$submit_before = '<div class="mt-2">';
		} else {
			$submit_before = '';
		}
	?>


	<?php comment_form(array(
		'comment_field' => '<div class="coment-form-comment"><textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true" placeholder="Your comment here ..."></textarea></div>',
		'fields' => array(
			'author' => '<div class="input-group mt-2"><input type="text" id="author" name="author" placeholder="Name*" class="form-control" aria-required="true">',
			'email' => '<input type="text" id="email" name="email" placeholder="Email*" class="form-control" aria-required="true">',
			'url' => '<input type="text" id="url" name="url" placeholder="URL" class="form-control">',
			'cookies' => '',
		),
		'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="btn btn-outline-secondary">%4$s</button>',
		'submit_field' => $submit_before . ' %2$s %1$s</div>',
		'title_reply_to' => 'Leave a Reply <span class="badge bg-secondary">@ %s</span>',
		'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
		'title_reply_after' => '</h4>',
		'cancel_reply_link' => ' '
	)); ?>
</div>
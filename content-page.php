<?php global $theme; ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content clearfix">
			<?php the_content(__('Read More', 'rockharbor')); ?>
			<?php echo $theme->render('pagination_posts'); ?>
		</div>

		<?php
		global $more;
		if ($more) {
			$theme->set('types', array('post', 'page'));
			$related = $theme->render('related_content');
			$comments = '';
			if (comments_open()) {
				// have to capture because wordpress just auto-echoes everything
				ob_start();
				comments_template('', true);
				$comments = ob_get_clean();
				$comments = trim(preg_replace('/\s+/', ' ', $comments));
			}
			if (!empty($related) || !empty($comments)) {
				echo $theme->Html->tag('footer', $related.$comments, array('class' => 'related clearfix'));
			}
		}
		?>
	</article>

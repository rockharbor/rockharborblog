<?php global $theme; ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if (!is_singular() || is_search()): ?>
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rockharbor'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php
			$theme->set('pubdate', true);
			$theme->set('date', $post->post_date);
			echo $theme->render('posted_date');
			?>
		</h2>
		<?php endif; ?>

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

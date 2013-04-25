<?php global $theme; ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if (has_post_thumbnail()): ?>
		<div class="entry-image">
			<?php
			$size = 'full';
			if (!is_single() || is_search()) {
				$size = 'thumbnail';
			}
			the_post_thumbnail($size);
			?>
		</div>
		<?php endif; ?>

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

		<div class="entry-content">
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
				?>

				<?php comments_template('', true); ?>
				<?php
				$comments = ob_get_clean();
			}
			if (!empty($related) || !empty($comments)) {
				echo $theme->Html->tag('footer', $related.$comments, array('class' => 'related clearfix'));
			}
		}
		?>
	</article>

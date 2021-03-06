<?php global $theme; ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if (!is_single() || is_search()): ?>
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'rockharbor'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<?php endif; ?>

		<div class="entry-meta clearfix">
			<?php
			$theme->set('pubdate', true);
			$theme->set('date', $post->post_date);
			echo $theme->render('posted_date');
			?>
			<span class="author">By: <?php echo get_the_author_link(); ?></span>
			<span class="tags">Posted in <?php the_category(', ') . the_tags(' | ', ', '); ?></span>
			<?php if (!is_single() || is_search()): ?>
			<span class="comments-link"><?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'rockharbor') . '</span>', __('<b>1</b> Reply', 'rockharbor'), __('<b>%</b> Replies', 'rockharbor')) ?></span>
			<?php endif; ?>
		</div>

		<?php if (has_post_thumbnail() && (!is_single() || is_search())): ?>
		<div class="entry-image">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('thumbnail'); ?>
			</a>
		</div>
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

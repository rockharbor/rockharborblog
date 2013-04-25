<?php
global $theme, $wp_query;
get_header();
$meta = $theme->metaToData($post->ID);
?>
		<header id="content-title">
			<h1><?php
			if (is_front_page()) {
				echo $post->post_title;
			} else {
				wp_title(false);
			}
			?></h1>
		</header>
		<?php
		$isFrontPage = false;
		if (is_front_page()) {
			$isFrontPage = true;
			$originalQuery = clone $wp_query;
			query_posts(array(
				'post_type' => 'post',
				'post_count' => get_option('posts_per_page')
			));
		}
		?>
		<section id="content" role="main">

			<?php if (is_single($post->ID) || is_front_page()): ?>
				<?php if (has_post_thumbnail($post->ID)): ?>
				<div class="entry-image">
					<?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
				</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (have_posts()):

				while (have_posts()) {
					the_post();
					$sub = get_post_type();
					get_template_part('content', $sub);
				}
				$theme->set('wp_rewrite', $wp_rewrite);
				$theme->set('wp_query', $wp_query);
				echo $theme->render('pagination');
			 else: ?>

			<article id="post-0" class="post no-results not-found">
				<header>
					<h1><?php _e('Nothing Found', 'rockharbor'); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'rockharbor'); ?></p>
					<?php get_search_form(); ?>
				</div>
			</article>

			<?php endif; ?>

		</section>
		<?php
		if ($isFrontPage) {
			// reset
			$wp_query = clone $originalQuery;
		}
		?>
		<section id="sidebar" role="complementary" class="clearfix">
			<?php
			$frontpage = is_front_page() ? '-frontpage' : null;
			dynamic_sidebar('sidebar'.$frontpage);
			?>
		</section>
<?php
get_footer();
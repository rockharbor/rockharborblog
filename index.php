<?php
global $theme, $wp_query, $frontpage, $post;
get_header();
$meta = $theme->metaToData($post->ID);
$isFrontpage = true;
if (!isset($frontpage) || empty($frontpage)) {
	$isFrontpage = false;
}
?>
		<?php if (has_post_thumbnail($post->ID)): ?>
		<div class="featured-image">
			<?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
		</div>
		<?php endif; ?>

		<?php if (!$isFrontpage): ?>
		<header id="content-title">
			<h1><?php wp_title(false); ?></h1>
		</header>
		<?php endif; ?>

		<section id="content" role="main">

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

		<section id="sidebar" role="complementary" class="clearfix">
			<?php
			dynamic_sidebar('sidebar' . ($isFrontpage ? '-frontpage' : null));
			?>
		</section>
<?php
get_footer();
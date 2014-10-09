<?php

class BlogTheme extends RockharborThemeBase {

	public function registerSidebars() {
		parent::registerSidebars();

		unregister_sidebar('sidebar-subnav');
		unregister_sidebar('sidebar-frontpage');

		register_sidebar(array(
			'name' => __('Front Page Widgets', 'rockharbor'),
			'id' => 'sidebar-frontpage',
			'description' => __('Widgets that appear on the homepage.', 'rockharbor'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</div></aside>",
			'before_title' => '<header><h1>',
			'after_title' => '</h1></header><div class="widget-body">',
		));
		register_sidebar(array(
			'name' => __('Widgets', 'rockharbor'),
			'id' => 'sidebar',
			'description' => __('Widgets that appear on other pages.', 'rockharbor'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</div></aside>",
			'before_title' => '<header><h1>',
			'after_title' => '</h1></header><div class="widget-body">',
		));
	}

	protected function after() {
		parent::after();
		unregister_nav_menu('footer');
		unregister_nav_menu('featured');
	}

	public function setupAssets() {
		add_filter('embed_oembed_html', array($this, 'responsiveVideo'), 10, 4);

		// register assets
		$base = $this->info('base_url');
		wp_deregister_script('jquery'); // deregister WP's version
		wp_register_script('jquery', "$base/js/jquery-1.7.2.min.js");
		wp_register_script('lightbox', "$base/js/jquery.lightbox.min.js");
		wp_register_script('media', "$base/js/mediaelement-and-player.min.js");
		wp_register_script('mediaCheck', "$base/js/mediaCheck.min.js");
		wp_register_script('initScripts', "$base/js/scripts.js");
		wp_register_script('fastclick', "$base/js/fastclick.js");
		wp_register_style('reset', "$base/css/reset.css");
		wp_register_style('fonts', "$base/css/fonts.css");
		wp_register_style('lightbox', "$base/css/lightbox.css");
		wp_deregister_style('media');
		wp_register_style('media', "$base/css/mediaelementplayer.css");

		$base = $this->info('url');
		wp_register_style('mobile', "$base/css/mobile.css");
		wp_register_style('tablet', "$base/css/tablet.css");
		wp_register_style('base', "$base/style.css");
		wp_register_script('fitVids', "$base/js/jquery.fitvids.js");
		wp_register_script('blog', "$base/js/blog.js");
		wp_register_script('touch', "$base/js/touch.js");

		// queue them
		wp_enqueue_style('reset');
		wp_enqueue_style('fonts');
		wp_enqueue_style('lightbox');
		wp_enqueue_style('media');
		wp_enqueue_style('base');
		wp_enqueue_style('tablet');
		wp_enqueue_style('mobile');

		wp_enqueue_script('jquery');
		wp_enqueue_script('lightbox');
		wp_enqueue_script('media');
		wp_enqueue_script('mediaCheck');
		wp_enqueue_script('initScripts');
		wp_enqueue_script('fastclick');
		wp_enqueue_script('fitVids');
		wp_enqueue_script('blog');
		wp_enqueue_script('touch');

		// dequeue stuff we don't need
		wp_dequeue_script('thickbox');
		wp_dequeue_style('thickbox');

		// conditional assets
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}

	public function responsiveVideo($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
		return $return;
	}

}
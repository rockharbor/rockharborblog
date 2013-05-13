<?php global $theme; ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1.0,width=device-width" />
<?php echo $theme->render('meta'); ?>
<title><?php
	wp_title('|', true, 'right');

	// Add the blog name.
	bloginfo('name');

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && is_front_page()) {
		echo " | $site_description";
	}
	?></title>
<link rel="icon" href="<?php echo $theme->info('url'); ?>/img/favicon.ico" type="image/x-icon" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 8]>
<link rel="stylesheet" media="all" href="<?php echo $theme->info('base_url'); ?>/css/ie8.css" />
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" media="all" href="<?php echo $theme->info('base_url'); ?>/css/ie7.css" />
<![endif]-->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script>var RH = RH || {}; RH.base_url = "<?php echo $theme->info('base_url'); ?>";</script>
<?php wp_head(); ?>
<!--[if lte IE 8]>
<script src="<?php echo $theme->info('base_url'); ?>/js/iefixes.js"></script>
<![endif]-->
<?php echo $theme->render('analytics'); ?>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed clearfix">

		<section class="main-navigation clearfix">

			<div class="branding">
				<h1 class="clearfix">
					<a href="/">
						<?php
						echo '<div class="logo">';
						echo $theme->Html->image('logo.png', array(
							'alt' => 'RH',
							'parent' => false
						));
						echo $theme->Html->tag('span', $theme->info('short_name'), array(
							'class' => 'title desktop-hide tablet-hide'
						));
						echo $theme->Html->image('textlogo-white.png', array(
							'alt' => 'ROCKHARBOR',
							'class' => 'mobile-hide',
							'parent' => true
						));
						echo '</div>';
						echo '<div class="title mobile-hide">';
						if (!$theme->info('hide_name_in_global_nav')) {
							echo $theme->Html->tag('span', $theme->info('name'));
						}
						echo '</div>';
						?>
					</a>
				</h1>
			</div>

			<div class="desktop-hide tablet-hide mobile-menu">
				<ul class="clearfix">
					<li class="menu"></li>
				</ul>
			</div>

			<nav class="access clearfix" role="navigation">
				<?php
				$locations = get_nav_menu_locations();
				$menu_items = wp_get_nav_menu_items($locations['main'], array('auto_show_children' => false));
				_wp_menu_item_classes_by_context($menu_items);
				$menu = array();
				foreach ($menu_items as $key => $menu_item) {
					$a = $theme->Html->tag('a', $menu_item->title, array('href' => $menu_item->url));
					$opts = array(
						'class' => implode(' ', $menu_item->classes)
					);
					$menu[] = array(
						'a' => $a,
						'opts' => $opts
					);
				}
				$output = '';
				foreach ($menu as $menuItem) {
					$output .= $theme->Html->tag('li', $menuItem['a'], $menuItem['opts']);
				}
				$title = $theme->Html->tag('span', 'Pages');
				$dropdown = $theme->Html->tag('div', $title.$theme->Html->tag('ul', $output, array('class' => 'submenu clearfix')), array('class' => 'dropdown'));
				echo $dropdown;
				?>
			</nav>

		</section>

		<?php
		get_sidebar();
		?>

		<?php
		if (isset($_SESSION['message'])) {
			echo $theme->Html->tag('div', $_SESSION['message'], array('class' => 'flash-message'));
			unset($_SESSION['message']);
		}
		?>

		<div id="main" class="clearfix">
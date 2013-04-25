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

		<nav id="access" role="navigation" class="clearfix">
			<?php
			$locations = get_nav_menu_locations();
			$menu_items = wp_get_nav_menu_items($locations['main'], array('auto_show_children' => true));
			_wp_menu_item_classes_by_context($menu_items);
			$menu = array();
			$ids = array();
			foreach ($menu_items as $key => $menu_item) {
				$a = $theme->Html->tag('a', $menu_item->title, array('href' => $menu_item->url));
				$opts = array(
					'class' => implode(' ', $menu_item->classes)
				);
				if ($menu_item->menu_item_parent == 0) {
					// top level
					$menu[] = array(
						'a' => $a,
						'opts' => $opts,
						'children' => array()
					);
					$ids[$menu_item->ID] = count($menu)-1;
				} else {
					// child
					$menu[$ids[$menu_item->menu_item_parent]]['children'][] = $theme->Html->tag('li', $a, $opts);
				}
			}
			$output = '';
			$max_row = 5;
			foreach ($menu as $key => $top_level_menu_item) {
				$children = null;
				if (!empty($top_level_menu_item['children'])) {
					$class = null;
					if (count($top_level_menu_item['children']) > $max_row) {
						$top_level_menu_item['children'] = array_chunk($top_level_menu_item['children'], $max_row);
						foreach ($top_level_menu_item['children'] as $col) {
							$children .= $theme->Html->tag('ul', implode('', $col));
						}
						$class = 'cols'.count($top_level_menu_item['children']);
					} else {
						$children = $theme->Html->tag('ul', implode('', $top_level_menu_item['children']));
					}
					$children = $theme->Html->tag('div', $children, array('class' => 'submenu '.$class));
				}
				$output .= $theme->Html->tag('li', $top_level_menu_item['a'].$children, $top_level_menu_item['opts']);
			}
			echo $theme->Html->tag('ul', $output, array('class' => 'menu clearfix'));
			?>
		</nav>

		<?php
		if (isset($_SESSION['message'])) {
			echo $theme->Html->tag('div', $_SESSION['message'], array('class' => 'flash-message'));
			unset($_SESSION['message']);
		}
		?>

		<div id="main" class="clearfix">
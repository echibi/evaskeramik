<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_front_page() ) : ?>
		<meta name="description" content="<?php echo Roots\Sage\Utils\get_frontpage_excerpt(); ?>">
	<?php endif; ?>
	<meta name="author" content="Eva Rensfeldt">
	<link rel="icon" type="image/png" href="<?php bloginfo( 'stylesheet_directory' ); ?>/dist/images/favicon.png">

	<?php wp_head(); ?>
</head>

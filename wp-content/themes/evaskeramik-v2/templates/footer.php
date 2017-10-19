<?php
$instaController = new \Evaskeramik\Controllers\InstagramController();
$aList           = $instaController->getList();
?>
<?php if ( ! empty( $aList ) ) : ?>
	<div class="instagram-wrap">
		<?php foreach ( $aList as $item ) : ?>
			<a href="<?php echo $item['url']; ?>"
			   class="instagram-item"
			   title="<?php echo $item['text']; ?>"
			   style="background-image:url('<?php echo $item['images']->low_resolution->url; ?>')">
				<img src="<?php echo $item['images']->low_resolution->url; ?>"
					 alt="<?php echo $item['text']; ?>"
					 class="instagram-item-image">
			</a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
<footer class="content-info" role="contentinfo">
	<span>&copy; <?php echo date( "Y" ) . " " . get_bloginfo( 'name' ); ?></span>
	<?php /*
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div>
	*/
	?>
</footer>

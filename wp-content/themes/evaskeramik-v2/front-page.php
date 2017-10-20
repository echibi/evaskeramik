<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 2015-05-17
 * Time: 02:24
 * Filename: front-page.php
 */
$controller = new \Evaskeramik\Controllers\Frontpage();
$images     = $controller->get_images( 5 );
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="frontpage-wrap<?php echo ! empty( $images ) ? ' has-images' : ''; ?>">
		<?php if ( ! empty( $images ) ) : ?>
			<div class="frontpage-images-container">
				<?php foreach ( $images as $id => $image ) : ?>
					<div class="frontpage-image-item" style="background-image: url('<?php echo $image->src; ?>')">
						<div class="overlay">
							<div class="overlay-inset-border"></div>
						</div>
						<img src="<?php echo $image->src; ?>" alt='<?php echo $image->alt; ?>' />
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="frontpage-content-wrap">
			<h1 class="frontpage-heading"><?php the_title(); ?></h1>
			<div class="frontpage-content"><?php the_content(); ?></div>
		</div>
	</div>
<?php endwhile; endif; ?>
<?php
$instaController = new \Evaskeramik\Controllers\InstagramController();
$aList           = $instaController->getList( 24 );
?>
<?php if ( ! empty( $aList ) ) : ?>
	<div class="instagram-wrap">
		<div class="instagram-header">
			<h2 class="instagram-title">F&ouml;lj mig p&aring; Instagram </h2>
		</div>
		<div class="instagram-list">
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
		<div class="instagram-footer">
			<a href="https://www.instagram.com/evaskeramik.se/" target="_blank">Visa fler</a>
		</div>
	</div>
<?php endif;
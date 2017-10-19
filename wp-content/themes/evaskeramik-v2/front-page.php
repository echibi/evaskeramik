<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 2015-05-17
 * Time: 02:24
 * Filename: front-page.php
 */

?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article class="gallery-img" id="post-<?php the_ID(); ?>">
		<?php
		$args = array(
			'numberposts'    => - 1, // Using -1 loads all posts
			'orderby'        => 'date menu_order', // This ensures images are in the order set in the page media manager
			'order'          => 'desc',
			'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos
			'post_parent'    => $post->ID, // Important part - ensures the associated images are loaded
			'post_status'    => null,
			'post_type'      => 'attachment'
		);

		$images = get_children( $args );
		if ( $images ) {
			?>
			<div class="gallery-container">
				<ul id="gallery">
					<?php foreach ( $images as $image => $imagePost ) {
						$image_src   = wp_get_attachment_image_src( $image, 'large', false );
						$alt_text = get_post_meta( $image, '_wp_attachment_image_alt', true );
						?><li>
						<a class="swipebox" rel="frontpage-gallery" href="<?php echo $imagePost->guid; ?>" style="background-image: url('<?php echo $image_src[0]; ?>')">
							<img src="<?php echo $image_src[0]; ?>" alt='<?php echo $alt_text; ?>'/>
						</a>
						</li><?php
					} ?>
				</ul>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<div class="entry">

			<?php the_content(); ?>

			<?php wp_link_pages( array( 'before' => 'Pages: ', 'next_or_number' => 'number' ) ); ?>

		</div>

	</article>

<?php endwhile; endif; ?>
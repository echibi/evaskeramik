<header class="header" role="banner">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<a class="brand" href="<?= esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>
			<nav class="col-sm-6" role="navigation">
				<?php
				if ( has_nav_menu( 'primary_navigation' ) ) :
					wp_nav_menu( [ 'theme_location' => 'primary_navigation', 'menu_class' => 'head-nav' ] );
				endif;
				?>
			</nav>
		</div>

	</div>
</header>

<header class="page-hero">
	<div class="bread container-lg">
		<a href="<?php echo esc_url(home_url('/')); ?>">home</a> <?php bread(); ?> <span class="low"><?php the_title(); ?></span>
	</div>
	<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
</header>
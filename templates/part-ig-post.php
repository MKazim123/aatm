<div class="flex">
	<h2 class="h1"><?php the_field('instagram_headline', 'options') ?></h2>
	<?php social(); ?>	
</div>
<div class="ig-post">
	<?php echo do_shortcode('[instagram-feed feed=2]'); ?>
</div>
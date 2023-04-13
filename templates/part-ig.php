<h2 class="h1"><?php the_field('instagram_headline', 'options') ?></h2>
<?php social(); ?>
<div class="container">
	<div class="ig-mod">
		<?php echo do_shortcode('[instagram-feed feed=1]'); ?>
	</div>
</div>
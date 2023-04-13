<?php $id = get_the_ID(); ?>
<div class="col-6 col-md-4 col-lg-4 col-xl-3">
	<div class="offer-wrap">
		<a href="<?php echo ($url = get_the_permalink($id)); ?>" class="thumb-link">
			<?php echo get_the_post_thumbnail($id, '400x400'); ?>
		</a>
		<h4 class="match fcc">
	    	<a href="<?php echo $url; ?>">
	    		<?php echo get_the_title($id); ?>
			</a>
		</h4>
		<a href="<?php echo $url; ?>" class="btn">shop now</a>
	</div>
</div>



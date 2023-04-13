<?php $id = get_the_ID(); ?>
<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
	<div class="post-wrap">
		<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link">
			<div class="img bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($id, '400x400'); ?>'); "></div>
		</a>
		<h2 class="h3"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
	</div>
</div>
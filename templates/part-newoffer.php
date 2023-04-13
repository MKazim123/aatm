<?php $id = get_the_ID(); ?>
<div class="offer-listing-cards mt-4">
	<div class="card">
		<div class="promo-sec">
			<div class="promo">
				<!-- <h3 class="percent-heading">25%</h3>
				<span>Code</span> -->
				<a href="<?php echo ($url = get_the_permalink($id)); ?>" class="thumb-link">
					<?php echo get_the_post_thumbnail($id, '400x400'); ?>
				</a>
			</div>
		</div>
		<div class="card-meta">
			<h3 class="meta-heading"><a href="<?php echo $url; ?>"><?php echo get_the_title($id); ?></a></h3>
			<p class="meta-desp"><?php echo get_the_excerpt($id); ?></p>
		</div>
		<div class="card-btn">
			<a href="<?php echo $url; ?>">Get The Offer</a>
		</div>
	</div>
</div>
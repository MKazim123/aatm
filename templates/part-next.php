<section class="read-next">
	<h2 class="h1">what to read next</h2>
	<div class="row">
	<?php
	$cat = get_the_category(get_the_ID())[0];
	$ignore = [get_the_ID()];
	$args = [
		'cat' => $cat->term_id,
		'post__not_in' => $ignore,
		'posts_per_page' => 4
	];
	$posts = get_posts($args);

	if (($count = sizeof($posts)) < 4):
		
		foreach ($posts as $post)
			$ignore[] = $post->ID;
		
		$parent = $cat->category_parent;
		$args = [
			'cat' => $parent,
			'post__not_in' => $ignore,
			'posts_per_page' => 4 - $count
		];
		$posts = array_merge($posts, get_posts($args));
	endif;

	foreach ($posts as $post): $id = $post->id ?>
		<div class="col-12 col-sm-6 col-md-4 col-lg-6">
			<div class="post-wrap">
				<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link">
					<div class="img bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($id, '670x670'); ?>'); "></div>
				</a>
				<h2 class="h3"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</section>
<?php wp_reset_query(); ?>
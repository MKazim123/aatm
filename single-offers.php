<?php get_header(); ?>
<main id="content" role="main">
<?php
/*
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
<?php endwhile; endif; ?>
<footer class="footer">
<?php get_template_part( 'nav', 'below-single' ); ?>
</footer>
*/
// Added to count post views, see https://www.isitwp.com/track-post-views-without-a-plugin-using-post-meta/
$pid = get_the_ID();
set_post_views($pid);
$slug = $post->post_name;
?>
	<header class="page-hero hide640">
		<div class="bread container-lg fc">
			<section class="fc">
				<a href="<?php echo esc_url(home_url('/')); ?>">home</a> 
				<?php bread(); ?>
				<a href="<?php echo get_post_type_archive_link('offers'); ?>"><span class="low">offers</span></a>
				<?php bread(); ?>
				<span><?php the_title(); ?></span>
			</section>
			<?php share(); ?>
		</div>
	</header>
	
	<?php
		$images = get_field('images');
		$no = '';
		if (!$images)
			$no = 'no-wrap';
		else
			if (sizeof($images) < 5)
				$no = 'no-wrap';
	?>
	<div class="container offer-info">		
		<div class="row larger">
			<div class="col-12 col-lg-6 flex hide640">
				<div class="thumbs-carousel <?php echo $no; ?>">
					<div>
						<section class="thumb-link tr">
							<img class="tr" src="<?php echo get_the_post_thumbnail_url($pid, 'thumbnail'); ?>" />
						</section>
					</div>
					<?php foreach ($images as $image): ?>
					<div>
						<section class="thumb-link tr">
							<img class="tr" src="<?php echo $image['images']['sizes']['thumbnail']; ?>" />
						</section>
					</div>
					<?php endforeach; ?>
					
				</div>

				<div class="img-carousel">
					<?php $count = 0; ?>
					<div>
						<img src="<?php echo get_the_post_thumbnail_url($pid, '670x670'); ?>"  class="modal-show" data-modal=".img-modal-<?php echo ++ $count; ?>"/>				
					</div>
					<?php foreach (get_field('images') as $image): ?>
					<div>
						<img src="<?php echo $image['images']['sizes']['670x670']; ?>"  class="modal-show" data-modal=".img-modal-<?php echo ++ $count; ?>"/>						
					</div>
					<?php endforeach; ?>
					<div>
						<img src="<?php echo get_the_post_thumbnail_url($pid, '670x670'); ?>"  class="modal-show" data-modal=".img-modal-<?php echo ++ $count; ?>"/>				
					</div>
					<?php foreach (get_field('images') as $image): ?>
					<div>
						<img src="<?php echo $image['images']['sizes']['670x670']; ?>"  class="modal-show" data-modal=".img-modal-<?php echo ++ $count; ?>"/>						
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-12 col-lg-6 txt">
				<div class="show640 soc">
					<?php share(); ?>
				</div>
				<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
				<h4 style="font-weight: 600;"><?php print_r(get_the_terms($pid, 'brand')[0]->name) ?></h4>
				<img class="show640" src="<?php echo get_the_post_thumbnail_url($pid, '670x670'); ?>" />
				<div class="txt">
					<?php the_post(); the_content(); ?>
					<?php foreach (get_field('links') as $link)
						echo '<p class="price">$'. $link['price'].', <a href="'.$link['link_url'].'" target="_blank">' .$link['link_name']. '</a></p>'; ?>
				</div>
			</div>
		</div>
		<?php
		$args = [
			's'=> $slug,
			'post_type' => 'post',
			'posts_per_page' => 3
		];
		$posts = get_posts($args);
		if (sizeof($posts)):
			if (sizeof($posts) < 3):
			$args2 = [
				'cat' => 32,
				'post_type'=> 'post',
				'posts_per_page' => 3 - sizeof($posts)
			];
			$posts2 = get_posts($args2);
			endif; ?>
		<div class="row posts-list">
			<div class="col-12">
				<?php
				if (sizeof($posts) < 3):
					$postList = [];
					foreach ($posts2 as $post):
						$check = 0;
						foreach (get_field('items', $post->ID) as $Item):
							$item = $Item['item'];
							if ($item->ID == $pid)
								$check = 1;
						endforeach;
						if ($check)
							$postList[] = $post;
					endforeach;
				endif;
				$posts = array_merge($posts, $postList) ?>
			</div>
			<h2 class="col-12">as mentioned in:</h2>
			<?php foreach ($posts as $post): $id = $post->ID; ?>
			<div class="col-12 col-md-6 col-lg-4 offset-md-3 offset-lg-0">
				<section class="fc">
					<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link">
						<?php echo get_the_post_thumbnail($id, 'thumbnail', array('itemprop' => 'image')); ?>
					</a>
					<h4><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h4>
				</section>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
	<section>
		<div class="container">
			<h2 class="h1">other offers you may love</h2>
			<?php
			$args = [
				'post_type' => 'offers',
				'orderby' => 'title',
				'posts_per_page' => 5,
				'post__not_in' => [$pid],
				'tax_query' => ['relation' => 'OR',
				    [
				       'taxonomy' => 'ages_stages',
				       'field' => 'term_id',
				       'terms' => get_the_terms($pid, 'ages_stages')[0]->term_id
				    ],
				    [
				       'taxonomy' => 'brand',
				       'field' => 'term_id',
				       'terms' => get_the_terms($pid, 'brand')[0]->term_id
				    ],
				    [
				       'taxonomy' => 'offer_category',
				       'field' => 'term_id',
				       'terms' => get_the_terms($pid, 'offer_category')[0]->term_id
				   ]
			    ]	  
			]; ?>
			<div class="offers-carousel owl-carousel owl-theme" data-pages="<?php echo sizeof(get_posts($args)); ?>">
				<?php foreach (get_posts($args) as $post): $id = $post->ID; ?>
					<div class="item offer-wrap">
				    	<a href="<?php echo ($url = get_the_permalink($id)); ?>" class="thumb-link">
				    		<?php echo get_the_post_thumbnail($id, '400x400', array('itemprop' => 'image'));?>
				    	</a>
				    	<h4 class="match fcc">
					    	<a href="<?php echo $url; ?>">
					    		<?php echo get_the_title($id); ?>
				    		</a>
				    	</h4>
			    		<a href="<?php echo $url; ?>" class="btn">shop now</a>
				    </div>
			    <?php endforeach; ?>
			</div>
		</div>
	</section>
	
	<?php echo get_template_part("templates/part", "nl"); ?>
	
	<section class="instagram_module">
		<?php echo get_template_part("templates/part", "ig"); ?>
	</section>

</main>

<?php $count = 0; ?>
<div class="modal img-modal img-modal-<?php echo ++ $count; ?>">
	<div class="overlay"></div>
	<div class="container-sm">
		<div class="modal-close tr"></div>
		<img src="<?php echo get_the_post_thumbnail_url($pid, '670x670'); ?>" />
	</div>
</div>
<?php foreach ($images as $image): ?>
<div class="modal img-modal img-modal-<?php echo ++ $count; ?>">
	<div class="overlay"></div>
	<div class="container-sm">
		<div class="modal-close tr"></div>
		<img src="<?php echo $image['images']['sizes']['670x670']; ?>" />
	</div>
</div>
<?php endforeach; ?>


<?php get_footer(); ?>
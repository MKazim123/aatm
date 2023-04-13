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
set_post_views(get_the_ID());
?>
	<hr class="show1366" />
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-9 txt">

				<h1><?php the_title(); ?></h1>
				<?php $uid = 'user_'.get_the_author_meta('ID'); ?>
				<p class="larger"><?php echo ($exc = get_field('excerpt')) ? $exc : get_the_excerpt(); ?></p>
				<div class="post-share fc">
					<section class="fc">
						<p class="hide640">By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name'); ?></a> </p>
						<p class="post-date">
							<span><?php echo get_the_date(); ?></span>
							<span class="show640"> by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name'); ?></a> </span>
						</p>
						<?php foreach (get_the_category() as $cat): ?>
							<?php if (!$cat->category_parent): ?>
								<p class="fc">
									<?php $parent = get_categories_parent_id($cat->term_id);
									echo wp_get_attachment_image(get_field('icon', 'category_'.$parent), 'thumbnail', '', array( 'class' => 'icon')); ?>
									<a href="<?php echo get_category_link($parent); ?>"><?php echo get_cat_name($parent); ?></a>
								</p>
							<?php endif; ?>
						<?php endforeach; ?>
					</section>
					<?php share(); ?>
				</div>

				<?php the_post_thumbnail( '1280x640', array( '1536x1536' => 'image', 'class' => 'post-thumbnail' ) ); ?>

				<?php if (in_category('ask-a-doc') || in_category('lizzies-list')): ?>
				<section class="author-info fc">
					<?php echo wp_get_attachment_image(get_field('img', $uid), '300x300'); ?>
					<div class="txt">
						<h3> about  <?php echo in_category('lizzies-list') ? 'lizzie’s list' : 'the doc'; ?></h3>
						<?php the_field('user_desc', $uid); ?>
						<div class="flex">
							<?php if ($field = get_field('ig', $uid)): ?>
								<a href="<?php echo $field; ?>" target="_blank" class="blink">
									<i class="fab fa-instagram"></i> <?php the_field('igh', $uid); ?>
								</a>
							<?php endif; ?>
							<?php if ($field = get_field('tw', $uid)): ?>
								<a href="<?php echo $field; ?>" target="_blank" class="blink">
									<i class="fab fa-twitter"></i> <?php the_field('twh', $uid); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</section>
				<?php endif; ?>
				<div class="txt post-content">
					<?php if (have_posts()): while (have_posts()): the_post(); the_content(); endwhile; endif; ?>
				</div>
				<?php if (have_rows('items')): ?>
					<?php foreach (get_field('items') as $key => $Item): $item = $Item['item'] ?>
						<?php if ($key == ceil(sizeof(get_field('items'))/2)) echo do_shortcode('[newsletter_form]') ?>
						<div class="lizzie-item fc">
							<a href="<?php echo $url = get_the_permalink($item); ?>" class="thumb-link">
								<?php echo get_the_post_thumbnail($item, '900x630'); ?>
							</a>
							<div class="txt">
								<h3>
									<a href="<?php echo $url; ?>">
										<span><?php echo $key+1 ?>. </span> <?php echo get_the_title($item); ?>
									</a>
								</h3>
								<h5><?php print_r(get_the_terms($item, 'brand')[0]->name) ?></h5>
								<?php echo ($text = $Item['desc']) ? $text : apply_filters('the_content', $item->post_content); ?>
								<?php if (have_rows('links', $item->ID)) echo '<h5> Shop Now: </h5>'; ?>
								<?php foreach (get_field('links', $item->ID) as $link)
									echo '<p class="price">$'. $link['price'].', <a href="'.$link['link_url'].'" target="_blank">' .$link['link_name']. '</a></p>'; ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
				
				<?php echo get_template_part("templates/part", "footer"); ?>

				<?php echo get_template_part("templates/part", "next"); ?>

				<section class="instagram_module">
					<?php echo get_template_part("templates/part", "ig-post"); ?>
				</section>
				
			</div>

			<div class="col-12 col-lg-4 col-xl-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
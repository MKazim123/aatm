<?php get_header(); ?>
<main id="content" role="main">
<?php /*
<header class="header">
	<h1 class="entry-title" itemprop="name"><?php single_term_title(); ?></h1>
	<div class="archive-meta" itemprop="description"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></div>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
*/ ?>
<header class="page-hero">
	<div class="bread container-lg">
		<a href="<?php echo esc_url(home_url('/')); ?>">home</a> <?php bread(); ?> <span class="low"><?php single_term_title(); ?></span>
	</div>
	<h1 class="entry-title" itemprop="name"><?php single_term_title(); ?></h1>
</header>

<?php
	$slug = get_queried_object()->slug;
	$args = ([
		'cat' => '',
		'posts_per_page' => -1,
		'tax_query' => [
			[
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => $slug
			]
		]
	]);
	/*
	$argsNext = ([
		'cat' => '',
		'posts_per_page' => 12,
		'paged' => 2,
		'tax_query' => [
			[
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => $slug
			]
		]
	]);
	*/

	$loop = new WP_Query($args);
	// $loopNext = new WP_Query($argsNext);

	if ($loop->have_posts()): ?>
	
	<form id="more_form" class="row fcc">
		<input type="hidden" name="paged" value="1" />
		<input type="hidden" name="ignore" value="" />
		<input type="hidden" name="cat" value="" />
		<input type="hidden" name="tag" value="<?php echo $slug; ?>" />
		<input type="hidden" name="action" value="more_form" />
		<?php wp_nonce_field('more_form'); ?>
	</form>

	<div class="container more-wrap posts-wrap tr">
		<div class="more-posts" style="background: none; padding: calc(0.4 * var(--pad)) 0 0;">
			<div class="row">
				<?php while ($loop->have_posts()): $loop->the_post();
					echo get_template_part("templates/part", "post");
				endwhile; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php /*if ($loopNext->have_posts()): ?>
		<div class="more-load-more load-more tr">
			<button class="btn">load more</button>
		</div>
	<?php endif;*/ ?>

</main>
<?php get_footer(); ?>
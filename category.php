<?php get_header(); ?>
<main id="content" role="main">
	<?php
	$category = get_queried_object();
	$catID = 'category_'.$category->cat_ID;
	$parent = ($parents = (get_ancestors($category->cat_ID, 'category'))) ? $parents[sizeof($parents) - 1] : 0;

	?>
	<header class="header bg" style="background-image: url('<?php echo (sizeof($parents) == 2) ? get_field('hero', 'category_'.$parents[0])['sizes']['2048x2048'] : get_field('hero', $catID)['sizes']['2048x2048']; ?>');">
		<div class="overlay" style="<?php echo (sizeof($parents) == 2) ? get_field('overlay', 'category_'.$parents[0]) : get_field('overlay', $catID); ?>"></div>
		<div class="container-lg txt larger">
			<div class="bread">
				<a href="<?php echo esc_url(home_url('/')); ?>">home</a>
				<?php bread(); ?>
				<?php if ($parent): ?>
					<?php foreach (array_reverse($parents) as $par): ?>
					<a class="no-line" href="<?php echo get_category_link($par); ?>"><?php echo get_cat_name($par); ?></a>
					<?php bread(); ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<span class="low"><?php if ($parent && ($title = get_field('custom_title', $catID))) echo $title; else single_cat_title(); ?></span>
			</div>
			<div class="hide992">
				<div class="fc cat-hero">
					<?php if (!$parent) echo wp_get_attachment_image(get_field('icon', $catID), 'thumbnail', '', array( 'class' => 'icon'));
					else echo wp_get_attachment_image(get_field('icon', 'category_'.$parent), 'thumbnail', '', array( 'class' => 'icon')); ?>
					<h1 class="entry-title low" itemprop="name"><?php if ($parent && $title) echo $title; else single_cat_title(); ?></h1>
				</div>
				<div class="archive-meta" itemprop="description">
					<?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?>
				</div>
			</div>
		</div>
	</header>
	<div class="show992">
		<div class="fc cat-hero">
			<?php if (!$parent) echo wp_get_attachment_image(get_field('icon', $catID), 'thumbnail', '', array( 'class' => 'icon'));
			else echo wp_get_attachment_image(get_field('icon', 'category_'.$parent), 'thumbnail', '', array( 'class' => 'icon')); ?>
			<h1 class="entry-title low" itemprop="name"><?php if ($parent && $title) echo $title; else single_cat_title(); ?></h1>
		</div>
		<div class="archive-meta" itemprop="description">
			<?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?>
		</div>
	</div>
	<?php if ($parent): ?>
		<?php if (get_field('show', $catID)): ?>
		<div class="bar low">
			<div class="container">
				<div class="flex">
					<?php foreach (get_field('tags', $catID) as $cat): ?>
						<a href="<?php echo get_term_link($cat['tag']); ?>" class="link-blue all"><?php echo $cat['tag']->name; ?> <i class="fas fa-caret-right"></i></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php else: ?>
	<div class="bar low">
		<div class="container">
			<div class="flex">
				<?php if (have_rows('subcategrories', $catID)): foreach (get_field('subcategrories', $catID) as $cat): ?>
					<a href="<?php echo get_term_link($cat['subcategory']); ?>" class="link-blue all"><?php echo $cat['subcategory']->name; ?> <i class="fas fa-caret-right"></i></a>
				<?php endforeach; endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

<div class="custom-sections">
	
	<?php
	if ($parent):
		$args1 = [
		    'cat' => $category->cat_ID,
		    'posts_per_page' => 12,
		    'paged' => 1
		];
		$args = [
		    'cat' => $category->cat_ID,
		    'posts_per_page' => 12,
		    'paged' => 2
		];
		$argsNext = [
		    'cat' => $category->cat_ID,
		    'posts_per_page' => 12,
		    'paged' => 3
		];
		$loop1 = new WP_Query($args1);
		$loop = new WP_Query($args);
		$loopNext = new WP_Query($argsNext);
		?>
		<?php if ($loop1->have_posts()): ?>

		<div class="container posts-wrap tr">
			<div class="row">
				<?php while ($loop1->have_posts()): $loop1->the_post();
					echo get_template_part("templates/part", "post");
				endwhile; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if (have_rows('offers', $catID)): ?>
		<section class="offers_carousel dark_mode">
			<div class="container">
				<div class="fc">
					<h2 class="h1"><?php the_field('headline', $catID); ?></h2>
					<a href="<?php echo get_post_type_archive_link('offers'); ?>" class="all">see all <i class="fas fa-caret-right"></i></a>
				</div>
				<div class="offers-carousel owl-carousel owl-theme" data-pages="<?php echo sizeof(get_field('offers', $catID)); ?>">
					<?php foreach (get_field('offers', $catID) as $offer): $catID = $offer["offer"]; ?>
					    <div class="item">
					    	<a href="<?php echo ($url = get_the_permalink($catID)); ?>" class="thumb-link">
					    		<?php echo get_the_post_thumbnail($catID, '300x300', array('itemprop' => 'image'));?>
					    		<span class="btn">shop now</span>
					    	</a>
					    	<h5>
						    	<a href="<?php echo $url; ?>">
						    		<?php echo get_the_title($catID); ?>
					    		</a>
					    	</h5>
					    </div>
				    <?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<form id="more_form" class="row fcc">
			<input type="hidden" name="paged" value="2" />
			<input type="hidden" name="ignore" value="" />
			<input type="hidden" name="cat" value="<?php echo $category->cat_ID; ?>" />
			<input type="hidden" name="action" value="more_form" />
			<?php wp_nonce_field('more_form'); ?>
		</form>

		<?php if ($loop->have_posts()): ?>
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
		<?php if ($loopNext->have_posts()): ?>
			<div class="more-load-more load-more tr">
				<button class="btn">load more</button>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (!$parent) echo get_template_part("templates/part", "sections");
		else echo get_template_part("templates/part", "nl") ?>


	<section class="instagram_module">
		<?php echo get_template_part("templates/part", "ig"); ?>
	</section>
</div>

</main>
<?php get_footer(); ?>
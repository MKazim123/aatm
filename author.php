<?php get_header(); ?>
<main id="content" role="main">
	<?php $uid = 'user_' . get_the_author_meta('ID'); ?>
	<?php the_post(); ?>

	<header class="author-header">
		<div class="container txt">
			<?php echo wp_get_attachment_image(get_field('img', $uid), 'thumbnail'); ?>	
			<h1 class="entry-title author" itemprop="name"><?php the_author_link(); ?></h1>
			<?php if ($field = get_field('user_desc', $uid)) echo $field; ?>
			<div class="fcc">
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
			<?php rewind_posts(); ?>
		</div>
	</header>

	<div class="container posts-wrap brad12">
		<div class="row">
			<?php while (have_posts()): the_post(); ?>
			<?php echo get_template_part("templates/part", "post"); ?>
			<?php endwhile; ?>
		</div>
	</div>

	<?php echo get_template_part("templates/part", "nl"); ?>

	<section class="instagram_module">
		<?php echo get_template_part("templates/part", "ig"); ?>
	</section>

	<?php //get_template_part( 'nav', 'below' ); ?>
</main>
<?php get_footer(); ?>
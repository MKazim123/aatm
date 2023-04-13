<?php get_header(); ?>
<main id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php echo get_template_part("templates/part", "hero"); ?>		

		<div class="entry-content" itemprop="mainContentOfPage">
			<?php // if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); } ?>
			<div class="container-sm txt">
				<?php the_content(); ?>				
				<?php echo get_template_part("templates/part", "footer"); ?>
			</div>
		</div>
		<?php echo get_template_part("templates/part", "nl"); ?>
		<section class="instagram_module <?php the_sub_field('appearance'); ?>">
			<?php echo get_template_part("templates/part", "ig"); ?>
		</section>
	</article>
	<?php // if ( comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
	<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
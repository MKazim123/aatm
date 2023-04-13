<?php get_header(); ?>
<?php
$id = get_the_ID();
$args = [
		'post_type' => 'sweepstakes',
		'posts_per_page' => 4,
		'orderby' => 'rand',
		'post__not_in' => [$id]
	];
	$loop = new WP_Query($args);
?>
<main id="content" role="main"  <?php if (!$loop->have_posts())	echo 'class="no-others"' ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="container-sm txt">			
			<h1><?php the_title(); ?></h1>
			<div class="post-share fc">
				<p>Updated <?php echo get_the_modified_date(); ?></p>
				<?php share(); ?>
			</div>

			<section class="sweepstakes_form">
				<div class="container-sm">
					<div class="row">
						<?php $section = get_field('sweepstakes', 'options'); ?>
						<div class="col-12 col-lg-4 bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($id, '1280x1280'); ?>');">
							<?php echo wp_get_attachment_image ($section['logo_v'], 'medium', '', array( 'class' => 'logo_v')) ?>
							<?php echo wp_get_attachment_image(get_field('logo', 'options'), 'large') ?>
						</div>
						<div class="col-12 col-lg-8">
							<h2 class="h1 fcc"><img src="<?php echo get_template_directory_uri(); ?>/img/sweepstake.svg" /> 
								<span><?php echo $section['form_title']; ?></span>
							</h2>
							<div class="larger txt"><?php echo $section['form_description']; ?></div>
							<?php echo do_shortcode('[gravityform id="'.get_field('form').'" title="false" description="false" ajax="true"]'); ?>
							<div class="footer_text txt">
								<?php echo $section['form_footer']; ?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php the_content(); ?>
			<?php echo get_template_part("templates/part", "footer"); ?>
		</div>
	<?php endwhile; endif; ?>

	<?php if ($loop->have_posts()):	?>
	<section class="more_sweep posts-wrap brad12">
		<div class="container">
			<h2 class="h1">more giveaways & sweepstakes</h2>
			<div class="row">
			<?php 
			while ($loop->have_posts()): $loop->the_post();
				echo get_template_part("templates/part", "post");
			endwhile; ?>
			</div>
				
		</div>
	</section>
	<?php endif; ?>
	<section class="instagram_module">
		<?php echo get_template_part("templates/part", "ig"); ?>
	</section>
</main>
<?php get_footer(); ?>
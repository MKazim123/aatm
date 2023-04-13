<?php /* Template Name: Contact Page */ ?>

<?php get_header(); ?>

	<?php echo get_template_part("templates/part", "hero"); ?>

	<section class="content_img">
		<div class="container-sm">
			<div class="row fc">
				<div class="col-12 col-lg-6 txt larger">
					<?php if (have_posts()): the_post(); the_content(); endif; ?>
					<?php if ($field = get_field('contact_email')): ?>
					<h3>
						<a href="mailto:<?php echo $field; ?>" class="blink">
							<i class="fas fa-envelope"></i> <?php echo $field; ?>
						</a>
					</h3>
					<?php endif; ?>
					<?php if ($field = get_field('contact_phone')): ?>
					<h3>
						<a href="tel:<?php tel($field); ?>" class="blink">
							<i class="fas fa-phone-alt"></i> <?php echo $field; ?>
						</a>
					</h3>
					<?php endif; ?>
				</div>
				<div class="col-12 col-lg-6 brad12">
					<?php echo get_the_post_thumbnail($id, '750x525', array('itemprop' => 'image')); ?>
				</div>
			</div>
		</div>
	</section>

	<section class="two_cards">
		<div class="container-sm">
			<div class="row">
				<div class="col-12 col-lg-6">
					<section class="match">
						<?php $section = get_field('second_section')['card_1'] ?>
						<h2><?php echo $section['title']; ?></h2>
						<div class="txt"><?php echo $section['text']; ?></div>
						<?php if ($field = $section['email']): ?>
						<h3>
							<a href="mailto:<?php echo $field; ?>" class="blink">
								<i class="fas fa-envelope"></i> <?php echo $field; ?>
							</a>
						</h3>
						<?php endif; ?>
					</section>
				</div>
				<div class="col-12 col-lg-6">
					<section class="match">
						<?php $section = get_field('second_section')['card_2'] ?>
						<h2><?php echo $section['title']; ?></h2>
						<div class="txt"><?php echo $section['text']; ?></div>
						<?php if ($field = $section['email']): ?>
						<h3>
							<a href="mailto:<?php echo $field; ?>" class="blink">
								<i class="fas fa-envelope"></i> <?php echo $field; ?>
							</a>
						</h3>
						<?php endif; ?>
					</section>
				</div>
			</div>
		</div>
	</section>

	<section class="instagram_module">
		<?php echo get_template_part("templates/part", "ig"); ?>
	</section>

<?php get_footer(); ?>
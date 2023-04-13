<?php $nl = get_field('newsletter_module', 'options'); ?>
<section class="newsletter_module">
	<div class="overlay bg" style="background-image: url('<?php echo $nl['background_pattern']['sizes']['1536x1536']; ?>');"></div>
	<div class="overlay"></div>
	<div class="container txt">
		<?php		
		echo wp_get_attachment_image($nl['icon'], 'medium');
		echo '<h2 class="h1">'.$nl['headline'].'</h2>';
		echo '<p>'.$nl['text'].'</p>';
		echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]');
		?>
	</div>
</section>
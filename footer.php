<?php // get_sidebar(); ?>
	<?php $nl = get_field('newsletter_module', 'options'); ?>
	<div class="modal modal-nl">
		<div class="overlay"></div>
		<div class="container-sm">
			<div class="modal-close tr"></div>
			<section class="newsletter_module">
				<div class="overlay bg" style="background-image: url('<?php echo $nl['background_pattern']['sizes']['1536x1536']; ?>');"></div>
				<div class="overlay"></div>
				<div class="container txt">
					<?php
					echo wp_get_attachment_image($nl['icon'], 'medium');
					echo '<h2 class="h1">'.$nl['headline'].'</h2>';
					echo '<p>'.$nl['text'].'</p>';
					echo do_shortcode('[gravityform id="6" title="false" description="false" ajax="true"]');
					?>
				</div>
			</section>
		</div>
	</div>

	<?php $section = get_field('sweepstakes', 'options'); ?>
	<?php if ($section['show']): ?>
	<div class="modal modal-sweep">
		<div class="overlay"></div>
		<div class="container-sm">
			<section class="sweepstakes_form">
				<div class="modal-close tr"></div>
				<div class="row">
					<div class="col-12 col-lg-4 bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($id = $section['sweepstake'], '1280x1280'); ?>');">
						<?php echo wp_get_attachment_image ($section['logo_v'], 'medium', '', array( 'class' => 'logo_v')) ?>
						<?php echo wp_get_attachment_image(get_field('logo', 'options'), 'large') ?>
					</div>
					<div class="col-12 col-lg-8">
						<h2 class="h1 fcc"><img src="<?php echo get_template_directory_uri(); ?>/img/sweepstake.svg" /> 
							<span><?php echo $section['form_title']; ?></span>
						</h2>
						<div class="larger txt"><?php echo $section['form_description']; ?></div>
						<?php echo do_shortcode('[gravityform id="'.get_field('form', $id).'" title="false" description="false" ajax="true"]'); ?>
						<div class="footer_text txt">
							<?php echo $section['form_footer']; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<?php endif; ?>
	<div class="modal modal-doc">
		<div class="overlay"></div>
		<div class="container-sm">
			<div class="modal-close tr"></div>
			<div class="container txt">
				<?php $nl = get_field('doc', 'options'); ?>
				<h2 class="h1 fcc"><img src="<?php echo $nl['icon']['sizes']['thumbnail']; ?>" /> <span><?php echo $nl['title']; ?></span></h2>
				<p class="larger"><?php echo $nl['text']; ?></p>
				<?php echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="true"]'); ?>
				<section>
					<?php echo $nl['footer_text']; ?>
				</section>
			</div>
		</div>
	</div>
</div>

<footer id="footer" role="contentinfo">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-xl-3">
				<?php echo '<a href="'.esc_url(home_url('/')).'" title="'.esc_attr(get_bloginfo('name')).'" rel="home" itemprop="url">'.wp_get_attachment_image (get_field('logo', 'options'), 'large').'</a>'; ?>
				<?php social(); ?>
			</div>
			<div class="col-12 col-xl-9 flex">
				<section class="menu-1">
					<h3>company</h3>
					<?php wp_nav_menu(array('menu' => 'company menu')); ?>
				</section>
				<section class="menu-2">
					<h3>legal</h3>
					<?php wp_nav_menu(array('menu' => 'legal menu')); ?>
				</section>
				<section class="btnbg">
					<div class="nl-small flex">
						<svg xmlns="http://www.w3.org/2000/svg" width="120" height="80" viewBox="0 0 120 80">
							<path d="M30,64A30,30,0,0,0,0,94v43.333A6.667,6.667,0,0,0,6.667,144H60V94A30,30,0,0,0,30,64Zm16.667,36.667A3.333,3.333,0,0,1,43.333,104H16.667a3.333,3.333,0,0,1-3.333-3.333V94a3.333,3.333,0,0,1,3.333-3.333H43.333A3.333,3.333,0,0,1,46.667,94ZM90,64H51.015A36.625,36.625,0,0,1,66.667,94v50h46.667A6.667,6.667,0,0,0,120,137.333V94A30,30,0,0,0,90,64Zm16.667,43.333a3.333,3.333,0,0,1-3.333,3.333H96.667a3.333,3.333,0,0,1-3.333-3.333v-10H81.667A1.667,1.667,0,0,1,80,95.667V92.333a1.667,1.667,0,0,1,1.667-1.667h21.667A3.333,3.333,0,0,1,106.667,94Z" transform="translate(0 -64)" fill="#f084f4"/>
						</svg>
						<div>
							<h3><?php the_field('newsletter_headline', 'options') ?></h3>
							<?php echo do_shortcode('[gravityform id="7" title="false" description="false" ajax="true"]'); ?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<div id="copyright">
		&copy; <?php echo esc_html(date_i18n(__('Y', 'blankslate'))); ?> <?php the_field('copyright', 'options'); ?> Web Design by <a href="https://www.loungelizard.com/" target="_blank">Lounge Lizard</a>
	</div>
	<script>
		/*
		jQuery(document).on('ready', function() {
			jQuery(document).on('submit','.pmform-event',function() { 
				let slist = ''; 
				let clist = jQuery(this)[0].classList; 
				for(let c = 0; c<clist.length; c++) { 
					if(clist[c] != 'pmform-event' && clist[c].substring(0,6) == 'pmform') { 
						slist = clist[c] 
					} 
				} 
				pmpx('event','form_fill',{ form : slist }); 
			})
			
			jQuery(document).on('click','.external_link', function() {
				let c = jQuery(this).attr('href');
				pmpx('event','external_link', { href : c } );
			})
		})
		*/
	</script>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
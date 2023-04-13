<aside id="sidebar" role="complementary">

	<div id="primary" class="widget-area">
		<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
		<ul class="xoxo">
			<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
		<?php endif; ?>
		<?php if (!in_category('lizzies-list')): ?>
		<div class="posts-list posts-list-offers">
			<div class="fcc">
				<h4>popular products</h4>
				<a href="<?php echo get_post_type_archive_link('offers'); ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
			</div>
			<?php
			$query = new WP_Query ([
				'post_type' => 'offers',
			    'meta_key' => 'post_views_count',
			    'orderby' => 'meta_value_num',
			    'posts_per_page' => 3
			]);
			if ($query->have_posts()):
				while ($query->have_posts()): $query->the_post(); ?>
				<section class="fc">
					<a href="<?php the_permalink(); ?>" class="thumb-link">
						<?php the_post_thumbnail('thumbnail', array('itemprop' => 'image')); ?>
					</a>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				</section>
			<?php endwhile;	endif; wp_reset_query(); ?>
		</div>
		<?php endif; ?>
		<?php $section = get_field('sidebar_banenrs', 'options'); ?>		
		<div class="aside-banner">
			<?php if (in_category('ask-a-doc')): ?>
				<img class="modal-show" data-modal=".modal-doc" src="<?php echo $section['banner_2']['sizes']['medium_large']; ?>" />
			<?php else: if (get_field('sweepstakes', 'options')['show']): ?>
				<a href="<?php echo $section['link'] ?>">
					<img src="<?php echo $section['banner_1']['sizes']['medium_large']; ?>" />
				</a>
			<?php endif; endif; ?>
		</div>
	</div>

</aside>
<?php

$pid = get_the_ID();

if (is_archive()) {
	$category = get_queried_object();
	$pid = 'category_'.$category->cat_ID;
	wp_reset_query();
}

$ignore = [];
$carousel = [];

if (!is_front_page() && !is_archive()): 
	echo get_template_part("templates/part", "hero");
endif;

if (have_rows("sections", $pid)):
	while (have_rows("sections", $pid)):
		the_row();
		/************************************************** Section: Posts Carousel + Top Stories **************************************************/
		if (get_row_layout() == "carousel_stories"):

			$announce = get_sub_field('announcement_bar');
			if ($announce['show']): ?>
			<div class="announce">
				<h4>
					<?php echo $announce['headline']; ?>
					<a href="<?php echo get_the_permalink($announce['post']); ?>">
						<span><?php echo get_the_title($announce['post']); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="13.838" viewBox="0 0 14 13.838">
		  					<path id="Path_203" data-name="Path 203" d="M6.816,34.7l-.619.619a.375.375,0,0,0,0,.53l4.848,4.848H.375A.375.375,0,0,0,0,41.067v.875a.375.375,0,0,0,.375.375h10.67L6.2,47.165a.375.375,0,0,0,0,.53l.619.619a.375.375,0,0,0,.53,0L13.89,41.77a.375.375,0,0,0,0-.53L7.346,34.7A.375.375,0,0,0,6.816,34.7Z" transform="translate(0 -34.586)" fill="#3a1bff"/>
		  				</svg>
					</a>
				</h4>
			</div>
			<?php else: ?>
				<hr class="show1366 hrhome" />
			<?php endif; ?>
		<section class="carousel_stories">
			<div class="container"> <?php //container; ?>
				<div class="row">
					<div class="col-12 col-lg-7 col-xl-8">
						<div class="posts-carousel owl-carousel owl-theme" data-pages="<?php echo sizeof(get_sub_field('carousel', $pid)); ?>">							
							<?php foreach (get_sub_field('carousel', $pid) as $post): $id = $post["post"]; $carousel[] = $id; ?>
						    <div class="item">
						    	<div class="bg flex" style="background-image: url('<?php echo get_the_post_thumbnail_url($id, '1536x1536') ?>');">
						    		<?php echo get_the_post_thumbnail($id, '1200x600', array('itemprop' => 'image', 'class' => 'posts-carousel-img'));?>
						    		<section class="txt larger">
						    			<h2 class="h1"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
						    			<p><?php echo ($exc = get_field('excerpt', $id)) ? $exc : get_the_excerpt($id); ?></p>
						    			<a href="<?php echo get_the_permalink($id); ?>" class="btn">continue reading</a>
						    		</section>
						    	</div>
						    </div>
						    <?php endforeach; ?>  
						</div>
					</div>
					<div class="col-12 col-lg-5 col-xl-4">
						<div class="posts-list">
							<h3><?php the_sub_field('top_stories_headline', $pid) ?></h3>
							<?php if (!get_sub_field('custom', $pid)):
								$query = new WP_Query ([
								    'meta_key' => 'post_views_count',
								    'orderby' => 'meta_value_num',
								    'posts_per_page' => 3,
								    'post__not_in' => $carousel,
								]);
								if ($query->have_posts()):
									while ($query->have_posts()): $query->the_post();
										$ignore[] = get_the_ID();
									?>
									<section class="fc">
										<a href="<?php the_permalink(); ?>" class="thumb-link">
											<?php the_post_thumbnail('thumbnail', array('itemprop' => 'image')); ?>
										</a>
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									</section>
								<?php endwhile; endif; wp_reset_query(); ?>
							<?php else: ?>
								<?php foreach (get_sub_field('posts') as $post): $id = $post['post']; ?>
									<section class="fc">
										<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link">
											<?php echo get_the_post_thumbnail($id, 'thumbnail', array('itemprop' => 'image')); ?>											
										</a>
										<h4><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h4>
									</section>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="nl-small flex">
							<svg xmlns="http://www.w3.org/2000/svg" width="120" height="80" viewBox="0 0 120 80">
								<path d="M30,64A30,30,0,0,0,0,94v43.333A6.667,6.667,0,0,0,6.667,144H60V94A30,30,0,0,0,30,64Zm16.667,36.667A3.333,3.333,0,0,1,43.333,104H16.667a3.333,3.333,0,0,1-3.333-3.333V94a3.333,3.333,0,0,1,3.333-3.333H43.333A3.333,3.333,0,0,1,46.667,94ZM90,64H51.015A36.625,36.625,0,0,1,66.667,94v50h46.667A6.667,6.667,0,0,0,120,137.333V94A30,30,0,0,0,90,64Zm16.667,43.333a3.333,3.333,0,0,1-3.333,3.333H96.667a3.333,3.333,0,0,1-3.333-3.333v-10H81.667A1.667,1.667,0,0,1,80,95.667V92.333a1.667,1.667,0,0,1,1.667-1.667h21.667A3.333,3.333,0,0,1,106.667,94Z" transform="translate(0 -64)" fill="#f084f4"/>
							</svg>
							<div>
								<h3><?php the_field('newsletter_headline', 'options') ?></h3>
								<?php echo do_shortcode('[gravityform id="9" title="false" description="false" ajax="true"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Two Main Categories **************************************************/
		elseif (get_row_layout() == "two_categories"):			
		?>
		<section class="two_categories" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container">
				<h2 class="h1"><?php the_sub_field('headline', $pid) ?></h2>
				<div class="row">
					<div class="col-12 col-lg-6 cat-1">
						<?php $cat = get_sub_field('category_1', $pid); ?>
						<?php $mainCat = $cat['main_category']; ?>
						<div class="fc cat-hero">
							<?php echo wp_get_attachment_image(get_field('icon', 'category_' . $mainCat->term_id), 'thumbnail', '', array( 'class' => 'icon')); ?>
							<h2 class="h1 low"><?php echo $mainCat->name; ?></h2>
							<a href="<?php echo get_term_link($mainCat); ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
						</div>
						<div class="flex match">
							<section class="txt">
								<h4>trending topics</h4>
								<?php foreach ($cat['subcategories'] as $cat): ?>
									<a href="<?php echo get_term_link($cat['subcategory']); ?>" class="link-blue all"><?php echo $cat['subcategory']->name; ?> <i class="fas fa-caret-right"></i></a>
								<?php endforeach; ?>
							</section>
							<div class="posts-list">
								<?php
								$query = new WP_Query ([
								    'cat' => $mainCat->term_id,
								    'orderby' => 'date',
								    'order' => 'DESC',
								    'posts_per_page' => 3
								]);
								if ($query->have_posts()):
									while ($query->have_posts()): $query->the_post();
										$ignore[] = get_the_ID();
									?>
									<section class="fc">
										<a href="<?php the_permalink(); ?>" class="thumb-link">
											<?php the_post_thumbnail('thumbnail', array('itemprop' => 'image')); ?>
										</a>
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									</section>
								<?php endwhile;	endif; wp_reset_query(); ?>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6 cat-2">
						<?php $cat = get_sub_field('category_2', $pid); ?>
						<?php $mainCat = $cat['main_category']; ?>
						<div class="fc cat-hero">
							<?php echo wp_get_attachment_image(get_field('icon', 'category_' . $mainCat->term_id), 'thumbnail', '', array( 'class' => 'icon')); ?>
							<h2 class="h1 low"><?php echo $mainCat->name; ?></h2>
							<a href="<?php echo get_term_link($mainCat); ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
						</div>
						<div class="flex match">
							<section class="txt">
								<h4>trending topics</h4>
								<?php foreach ($cat['subcategories'] as $cat): ?>
									<a href="<?php echo get_term_link($cat['subcategory']); ?>" class="link-blue all"><?php echo $cat['subcategory']->name; ?> <i class="fas fa-caret-right"></i></a>
								<?php endforeach; ?>
							</section>
							<div class="posts-list">
								<?php
								$query = new WP_Query ([
								    'cat' => $mainCat->term_id,
								    'orderby' => 'date',
								    'order' => 'DESC',
								    'posts_per_page' => 3
								]);
								if ($query->have_posts()):
									while ($query->have_posts()): $query->the_post();
										$ignore[] = get_the_ID();
									?>
									<section class="fc">
										<a href="<?php the_permalink(); ?>" class="thumb-link">
											<?php the_post_thumbnail('thumbnail', array('itemprop' => 'image')); ?>
										</a>
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									</section>
								<?php endwhile;	endif; wp_reset_query(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Instagram Module **************************************************/
		elseif (get_row_layout() == "instagram_module"):
			if (!is_archive()):
		?>
		<section class="instagram_module <?php the_sub_field('appearance', $pid); ?>">
		<?php echo get_template_part("templates/part", "ig"); ?>
		</section>
		<?php
			endif;
		/************************************************** Section: Newsletter Module **************************************************/
		elseif (get_row_layout() == "newsletter_module"):
		?>
		<?php echo get_template_part("templates/part", "nl"); ?>
		<?php
		/************************************************** Section: Offers Carousel **************************************************/
		elseif (get_row_layout() == "offers_carousel"):
		?>
		<section class="offers_carousel <?php the_sub_field('appearance', $pid); ?>">
			<div class="container">
				<div class="fc">
					<h2 class="h1"><?php the_sub_field('headline', $pid); ?></h2>
					<a href="<?php echo get_post_type_archive_link('offers'); ?>" class="all">see all <i class="fas fa-caret-right"></i></a>
				</div>
				<div class="offers-carousel owl-carousel owl-theme" data-pages="<?php echo sizeof(get_sub_field('offers', $pid)); ?>">
					<?php foreach (get_sub_field('offers', $pid) as $offer): $id = $offer["offer"]; ?>
					    <div class="item">
					    	<a href="<?php echo ($url = get_the_permalink($id)); ?>" class="thumb-link">
					    		<?php echo get_the_post_thumbnail($id, '300x300', array('itemprop' => 'image'));?>
					    		<span class="btn">shop now</span>
					    	</a>
					    	<h5>
						    	<a href="<?php echo $url; ?>">
						    		<?php echo get_the_title($id); ?>
					    		</a>
					    	</h5>
					    </div>
				    <?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Mom of the Month + Ask a Doc Latest Post **************************************************/
		elseif (get_row_layout() == "mom_ask"):
		?>
		<section class="mom_ask">
			<div class="overlay" style="background: <?php echo get_sub_field('mom', $pid)['bg']; ?>"></div>
			<div class="overlay" style="background: <?php echo get_sub_field('ask', $pid)['bg']; ?>"></div>
			<div class="container">
				<div class="row">
					<?php $section = get_sub_field('mom', $pid); ?>
					<div class="col-12 col-xl-6 larger" style="background: <?php echo $section['bg']; ?>;">
						<h2 class="h1"><?php echo $section['headline'] ?></h2>
						<?php echo wp_get_attachment_image($section['image'], '400x400', '', array( 'class' => 'show992')); ?>
						<h2><?php echo $section['name']. (($section['age']) ? ', ': ' ') .$section['age'] ?></h2>
						<div class="row">
							<div class="col-12 txt">
								<div class="quote <?php echo ($section['add_q']) ? ' has_quotes' : ' no_quotes'; ?>"><?php echo $section['quote']; ?></div>
							</div>
							<div class="col-12 img">
								<?php echo wp_get_attachment_image($section['image'], '400x400', '', array( 'class' => 'hide992')); ?>
								<?php if ($cta = $section['cta']): ?>
									<a href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>" class="btn"><?php echo $cta['title']; ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php $section = get_sub_field('ask', $pid); ?>
					<div class="col-12 col-xl-6" style="background: <?php echo $section['bg']; ?>;">
						<?php $mainCat = $section['main_category']; ?>
						<div class="fc cat-hero">
							<?php echo wp_get_attachment_image(get_field('icon', 'category_' . $mainCat->term_id), 'thumbnail', '', array( 'class' => 'icon')); ?>
							<h2 class="h1 low"><?php echo $mainCat->name; ?></h2>
							<a href="<?php echo get_term_link($mainCat); ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
						</div>
						<?php
						if (!$section['custom']):
							$query = new WP_Query ([
							    'cat' => 38,
							    'orderby' => 'date',
							    'order' => 'DESC',
							    'posts_per_page' => 1
							]);
							if ($query->have_posts()):
								while ($query->have_posts()): $query->the_post();
									$id = get_the_ID();
									$ignore[] = $id;
								?>
								<div class="txt larger">
									<h2>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<p><?php echo ($exc = get_field('excerpt', $id)) ? $exc : get_the_excerpt($id); ?></p>
									<a href="<?php the_permalink(); ?>" class="btn">continue reading</a>
								</div>
							<?php endwhile;	endif; wp_reset_query(); ?>
						<?php else: $id = $section['post']; ?>
							<div class="txt larger">
								<h2>
									<a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a>
								</h2>
								<p><?php echo ($exc = get_field('excerpt', $id)) ? $exc : get_the_excerpt($id); ?></p>
								<a href="<?php echo get_the_permalink($id); ?>" class="btn">continue reading</a>
							</div>
						<?php endif; ?>
						<div class="flex">
							<?php foreach ($section['subcategories'] as $cat): ?>
								<div>
									<a href="<?php echo get_term_link($cat['subcategory']); ?>" class="link-blue all"><?php echo $cat['subcategory']->name; ?> <i class="fas fa-caret-right"></i></a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>					
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Featured Stories  **************************************************/
		elseif (get_row_layout() == "featured_stories"):
		?>
		<section class="featured_stories recent_posts" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container">
				<div class="txt">
					<h3><?php the_sub_field('headline', $pid) ?></h3>
					<?php the_sub_field('text', $pid) ?>
				</div>
				
				<div class="row">
					<div class="col-12 col-lg-6 latest">
						<?php $posts = get_sub_field('stories', $pid); ?>
						<?php $id = $posts[0]['story']; ?>
						<div class="bg flex" style="background-image: url('<?php echo get_the_post_thumbnail_url(($id), '1536x1536') ?>');">
							<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link show992">
								<?php echo get_the_post_thumbnail($id, '1200x600', array('itemprop' => 'image'));?>
							</a>
				    		<section class="txt larger">
				    			<h2 class="h1"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
				    			<p><?php echo ($exc = get_field('excerpt', $id)) ? $exc : get_the_excerpt($id); ?></p>
				    			<a href="<?php echo get_the_permalink($id); ?>" class="btn">continue reading</a>
				    		</section>
				    	</div>						
					</div>
					<div class="col-12 col-lg-6">
						<div class="row">							
							<?php for ($i = 1; $i < sizeof($posts); $i ++): $id = $posts[$i]['story']; ?>								
								<div class="col-12 col-md-6">
									<div class="post-wrap">
										<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link">
											<div class="img bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($id, '400x400'); ?>'); "></div>
										</a>
										<h2 class="h3"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
									</div>
								</div>
							<?php endfor; ?>							
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Recent Posts From Category  **************************************************/
		elseif (get_row_layout() == "recent_posts"):
		?>
		<section class="recent_posts" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="fc cat-hero">
							<?php $mainCat = get_sub_field('main_category', $pid) ?>
							<?php echo wp_get_attachment_image(get_field('icon', 'category_' . $mainCat->term_id), 'thumbnail', '', array( 'class' => 'icon')); ?>
							<h2 class="h1 low"><?php echo $mainCat->name; ?></h2>
							<a href="<?php echo get_term_link($mainCat); ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
						</div>
						<div class="flex">
							<?php foreach (get_sub_field('subcategories', $pid) as $cat): ?>
								<div>
									<a href="<?php echo get_term_link($cat['subcategory']); ?>" class="link-blue all"><?php echo $cat['subcategory']->name; ?> <i class="fas fa-caret-right"></i></a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php $custom = get_sub_field('custom', $pid) ?>
					<div class="col-12 col-lg-6 latest">
						<?php
						if ($custom):
							$posts = get_sub_field('posts', $pid);
							$id = $posts[0]['post'];
						else:
							$posts = get_posts([
								'cat' => $mainCat->term_id
							]);
							$id = $posts[0]->ID;
						endif;
						$ignore[] = $id;
						?>
						<div class="bg flex" style="background-image: url('<?php echo get_the_post_thumbnail_url(($id), '1536x1536') ?>');">
							<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link show992">
								<?php echo get_the_post_thumbnail($id, '1200x600', array('itemprop' => 'image'));?>
							</a>
				    		<section class="txt larger">
				    			<h2 class="h1"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
				    			<p><?php echo ($exc = get_field('excerpt', $id)) ? $exc : get_the_excerpt($id); ?></p>
				    			<a href="<?php echo get_the_permalink($id); ?>" class="btn">continue reading</a>
				    		</section>
				    	</div>						
					</div>
					<div class="col-12 col-lg-6">
						<div class="row">							
							<?php for ($i = 1; $i < sizeof($posts); $i ++): ?>
								<?php $id = ($custom) ? $posts[$i]['post'] : $posts[$i]->ID; $ignore[] = $id; ?>
								<div class="col-12 col-md-6">
									<div class="post-wrap">
										<a href="<?php echo get_the_permalink($id); ?>" class="thumb-link">
											<div class="img bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($id, '400x400'); ?>'); "></div>
										</a>
										<h2 class="h3"><a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a></h2>
									</div>
								</div>
							<?php endfor; ?>							
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: other **************************************************/
		elseif (get_row_layout() == "two_cards"):
		?>
		<section class="two_cards" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container-sm">
				<div class="row">
					<div class="col-12 col-lg-6">
						<section class="match">
							<?php $section = get_sub_field('card_1', $pid); ?>
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
							<?php $section = get_sub_field('card_2', $pid); ?>
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
		<?php
		/************************************************** Section: Content + Image **************************************************/
		elseif (get_row_layout() == "content_img"):
		?>
		<section class="content_img" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container-sm">
				<div class="row fc">
					<?php if (get_sub_field('image_first')): ?>
					<div class="col-12 col-lg-6">
						<?php echo wp_get_attachment_image(get_sub_field('img'), '750x525', $pid); ?>
					</div>
					<div class="col-12 col-lg-6 txt larger">
						<?php the_sub_field('content', $pid) ?>
					</div>
					<?php else: ?>
					<div class="col-12 col-lg-6 txt larger">
						<?php the_sub_field('content', $pid) ?>
					</div>
					<div class="col-12 col-lg-6">
						<?php echo wp_get_attachment_image(get_sub_field('img'), '750x525', $pid); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Two Columns of Text **************************************************/
		elseif (get_row_layout() == "two_columns"):
		?>
		<section class="two_columns" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container-sm">
				<div class="row fc">
					<div class="col-12 col-lg-6 txt">
						<?php the_sub_field('column_1', $pid); ?>
					</div>
					<div class="col-12 col-lg-6 txt">
						<?php the_sub_field('column_1', $pid); ?>
					</div>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Team Members **************************************************/
		elseif (get_row_layout() == "team_members"):
		?>
		<section class="team_members" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container-sm">
				<h2 class="h1"><?php the_sub_field('headline', $pid) ?></h2>
				<div class="row">
					<?php foreach (get_sub_field('team', $pid) as $member): $uid = $member['member']; ?>
						<div class="col-12 col-lg-6">
							<?php echo wp_get_attachment_image(get_field('img', $uid), '400x400'); ?>
							<h2><?php echo get_the_title($uid) ?></h2>
							<p><?php the_field('title', $uid); ?></p>
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
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Logo Carousel **************************************************/
		elseif (get_row_layout() == "logo_carousel"):
		?>
		<section class="logo_carousel" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container-sm">
				<h2 class="h3"><?php the_sub_field('headline', $pid); ?></h2>				
				<div class="logos-carousel owl-carousel owl-theme">
					<?php foreach (get_sub_field('logos', $pid) as $logo): ?>
				    <div class="item">
				    	<?php echo wp_get_attachment_image($logo['logo'], '400x400'); ?>
				    </div>
				    <?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: Post Rows **************************************************/
		elseif (get_row_layout() == "post_rows"):
		?>
		<section class="post_rows" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container">
				<?php foreach (get_sub_field('rows', $pid) as $row): if($cat = $row['category']): 
					$cat_stuff = get_term_link($cat);
					if ( ! is_wp_error( $cat_stuff )):
					?>
				<div class="row">
					<div class="fc cat-hero col-12">
						<h2 class="h1 low"><?php echo $row['custom_headline'] ? $row['custom_headline'] : get_cat_name($cat); ?></h2>
						<a href="<?php echo $cat_stuff; ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
					</div>
					<div class="col-12">
						<div class="row">
							<?php
							$query = new WP_Query ([
							    'cat' => $cat,
							    'orderby' => 'date',
							    'order' => 'DESC',
							    'posts_per_page' => 4
							]);
							if ($query->have_posts()):
								while ($query->have_posts()): $query->the_post();
									$ignore[] = get_the_ID();
									echo get_template_part("templates/part", "post");
								endwhile;
							endif; wp_reset_query(); ?>							
						</div>
					</div>
				</div>
				<?php endif;endif; endforeach; ?>
			</div>
		</section>
		<?php
		/************************************************** Section: 3 Category Columns **************************************************/
		elseif (get_row_layout() == "_3_col_cat"):
		?>
		<section class="_3_col_cat" style="background: <?php the_sub_field('bg', $pid) ?>; ">
			<div class="container">
				<div class="row">
					<?php
					for ($i = 1; $i <= 3; $i ++):
						$bigCat = get_sub_field('cat_'.$i, $pid);
						$cat = $bigCat['category'];
						if ($cat): ?>
						<div class="col-12 col-xl-4 ">
							<div class="fc cat-hero">
								<h2 class=""><?php echo $bigCat['custom_headline'] ? $bigCat['custom_headline'] : get_cat_name($cat); ?></h2>
								<a href="<?php echo get_term_link($cat); ?>" class="link-blue all">see all <i class="fas fa-caret-right"></i></a>
							</div>
							<div class="posts-list">
								<?php
								$query = new WP_Query ([
								    'cat' => $cat,
								    'orderby' => 'date',
								    'order' => 'DESC',
								    'posts_per_page' => 4
								]);
								if ($query->have_posts()):
									while ($query->have_posts()): $query->the_post();
										$ignore[] = get_the_ID();
									?>
									<section class="fc">
										<a href="<?php the_permalink(); ?>" class="thumb-link">
											<?php the_post_thumbnail('thumbnail', array('itemprop' => 'image')); ?>
										</a>
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									</section>
								<?php endwhile;	endif; wp_reset_query(); ?>
							</div>
						</div>
					<?php endif; endfor; ?>
				</div>
			</div>
		</section>
		<?php
		/************************************************** Section: other **************************************************/
		elseif (get_row_layout() == "other"):
		?>
		<section class="other" style="background: <?php the_sub_field('bg', $pid) ?>; ">
		</section>
<?php
		endif;
	endwhile;
endif;

if (is_archive()):
	$args = [
	    'cat' => $category->cat_ID,
	    'posts_per_page' => 12
	];
    /*'post__not_in' => $ignore,*/
	$argsNext = [
	    'cat' => $category->cat_ID,
	    'paged' => 2,
	    'posts_per_page' => 12
	];
    /*'post__not_in' => $ignore,*/
	$loop = new WP_Query($args);
	$loopNext = new WP_Query($argsNext);
	
	if (sizeof(get_posts($args))): ?>
	<form id="more_form" class="row fcc">
		<input type="hidden" name="paged" value="1" />
		<input type="hidden" name="ignore" value="<?php echo implode(',', $ignore); ?>" />
		<input type="hidden" name="cat" value="<?php echo $category->cat_ID; ?>" />
		<input type="hidden" name="action" value="more_form" />
		<?php wp_nonce_field('more_form'); ?>
	</form>
	<div class="more-posts">
		<h2 class="h1">explore more in <?php single_cat_title(); ?></h2>
		<?php if ($loop->have_posts()): ?>
		<div class="container more-wrap posts-wrap tr">
			<div class="row">
				<?php while ($loop->have_posts()): $loop->the_post();
					echo get_template_part("templates/part", "post");
				endwhile; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php if ($loopNext->have_posts()): ?>
			<div class="more-load-more load-more tr">
				<button class="btn">load more</button>
			</div>
		<?php endif; ?>
	</div>
<?php
	endif;
endif;
?>
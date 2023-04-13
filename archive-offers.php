<?php get_header(); ?>

<main id="content" role="main">
	<?php $section = get_field('offers_header', 'options') ?>
	<header class="header bg" style="background-image: url('<?php echo $section['bg']['sizes']['2048x2048']; ?>');">
		<div class="overlay" style="<?php echo $section['overlay'] ?>"></div>
		<div class="container-lg txt larger">
			<div class="bread">
				<a href="<?php echo esc_url(home_url('/')); ?>">home</a>
				<?php bread(); ?>
				<span class="low"><?php echo $section['title']; ?></span>
			</div>
			<div class="hide992">
				<div class="fc cat-hero">
					<?php echo wp_get_attachment_image($section['icon'], 'thumbnail', '', array( 'class' => 'icon')); ?>
					<h2 class="h1" itemprop="name"><?php echo $section['title']; ?></h1>
				</div>
				<div class="archive-meta" itemprop="description">
					<?php echo $section['description']; ?>
				</div>
			</div>
		</div>
	</header>
	<div class="show992">
			<div class="fc cat-hero">
				<?php echo wp_get_attachment_image($section['icon'], 'thumbnail', '', array( 'class' => 'icon')); ?>
				<h2 class="h1" itemprop="name"><?php echo $section['title']; ?></h1>
			</div>
			<div class="archive-meta" itemprop="description">
				<?php echo $section['description']; ?>
			</div>
		</div>

	<div class="container">
		<div class="clearfix">
			<?php
			$tax = ['relation' => 'OR'];
			if (isset($_GET['c']))
				$tax[] = [
					'taxonomy' => 'offer_category',
					'field' => 'term_id',
					'terms' => $_GET['c']
				];

			$argsAll = [
				'post_type' => 'offers',
				'posts_per_page' => -1
			];
			$args = [
				'post_type' => 'offers',				
				'posts_per_page' => 24,
				'tax_query' => $tax
			];
			$loop = new WP_Query($args);
			$loopAll = new WP_Query($argsAll);

			$terms = ['offer_category','ages_stages','brand'];
			$titles = ['categories','ages & stages','brands'];
			?>		
			<div class="toggle-filter tr swap show992">
				<h3 class="fcc">
					<span>filter offers</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="11.436" viewBox="0 0 20 11.436" class="tr">
						<path d="M.159,1.053,1.053.159a.542.542,0,0,1,.766,0L10,8.319,18.181.159a.542.542,0,0,1,.766,0l.894.894a.542.542,0,0,1,0,.766l-9.458,9.457a.542.542,0,0,1-.766,0L.159,1.819A.542.542,0,0,1,.159,1.053Z" transform="translate(20 11.436) rotate(180)" fill="#f084f4"/>
					</svg>
				</h3>
			</div>
			<form id="offer_form">
				<div class="filter swap">
					<h3 class="fc">
					offer types
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="11.436" viewBox="0 0 20 11.436" class="tr">
						<path d="M.159,1.053,1.053.159a.542.542,0,0,1,.766,0L10,8.319,18.181.159a.542.542,0,0,1,.766,0l.894.894a.542.542,0,0,1,0,.766l-9.458,9.457a.542.542,0,0,1-.766,0L.159,1.819A.542.542,0,0,1,.159,1.053Z" transform="translate(20 11.436) rotate(180)" fill="#f084f4"/>
					</svg>
					</h3>
					<section>
						<input type="checkbox" name="show_featured" id="show_featured" value="featured" />
						<label for="show_featured">
							featured
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
								<path d="M9.7,104l5.128-5.128,1.058-1.058a.4.4,0,0,0,0-.566l-1.132-1.132a.4.4,0,0,0-.566,0L8,102.3,1.815,96.117a.4.4,0,0,0-.566,0L.117,97.249a.4.4,0,0,0,0,.566L6.3,104,.117,110.186a.4.4,0,0,0,0,.566l1.132,1.132a.4.4,0,0,0,.566,0L8,105.7l5.128,5.128,1.058,1.058a.4.4,0,0,0,.566,0l1.132-1.132a.4.4,0,0,0,0-.566Z" transform="translate(0 -96)" fill="#f084f4"/>
							</svg>
						</label>
						<input type="checkbox" name="show_popular" id="show_popular" class="special-offer" />
						<label for="show_popular">
							most popular
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
								<path d="M9.7,104l5.128-5.128,1.058-1.058a.4.4,0,0,0,0-.566l-1.132-1.132a.4.4,0,0,0-.566,0L8,102.3,1.815,96.117a.4.4,0,0,0-.566,0L.117,97.249a.4.4,0,0,0,0,.566L6.3,104,.117,110.186a.4.4,0,0,0,0,.566l1.132,1.132a.4.4,0,0,0,.566,0L8,105.7l5.128,5.128,1.058,1.058a.4.4,0,0,0,.566,0l1.132-1.132a.4.4,0,0,0,0-.566Z" transform="translate(0 -96)" fill="#f084f4"/>
							</svg>
						</label>
						<input type="checkbox" name="show_last" id="show_last" value="last_chance" />
						<label for="show_last">
							last chance
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
								<path d="M9.7,104l5.128-5.128,1.058-1.058a.4.4,0,0,0,0-.566l-1.132-1.132a.4.4,0,0,0-.566,0L8,102.3,1.815,96.117a.4.4,0,0,0-.566,0L.117,97.249a.4.4,0,0,0,0,.566L6.3,104,.117,110.186a.4.4,0,0,0,0,.566l1.132,1.132a.4.4,0,0,0,.566,0L8,105.7l5.128,5.128,1.058,1.058a.4.4,0,0,0,.566,0l1.132-1.132a.4.4,0,0,0,0-.566Z" transform="translate(0 -96)" fill="#f084f4"/>
							</svg>
						</label>
					</section>
				</div>
				<?php foreach ($terms as $key => $term): ?>
				<div class="filter swap">
					<h3 class="fc">
						<?php echo $titles[$key] ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="11.436" viewBox="0 0 20 11.436" class="tr">
							<path d="M.159,1.053,1.053.159a.542.542,0,0,1,.766,0L10,8.319,18.181.159a.542.542,0,0,1,.766,0l.894.894a.542.542,0,0,1,0,.766l-9.458,9.457a.542.542,0,0,1-.766,0L.159,1.819A.542.542,0,0,1,.159,1.053Z" transform="translate(20 11.436) rotate(180)" fill="#f084f4"/>
						</svg>
			
					</h3>
					<section>
					<?php foreach (get_terms($term) as $tax): ?>
						<input type="checkbox" name="<?php echo $terms[$key] ?>[]" id="<?php echo $tax->slug.$tax->term_id ?>" value="<?php echo $tax->term_id ?>"
						<?php if ($tax->term_id == $_GET['c']) echo 'checked'; ?> />
						<label for="<?php echo $tax->slug.$tax->term_id ?>">
							<?php echo $tax->name ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
								<path d="M9.7,104l5.128-5.128,1.058-1.058a.4.4,0,0,0,0-.566l-1.132-1.132a.4.4,0,0,0-.566,0L8,102.3,1.815,96.117a.4.4,0,0,0-.566,0L.117,97.249a.4.4,0,0,0,0,.566L6.3,104,.117,110.186a.4.4,0,0,0,0,.566l1.132,1.132a.4.4,0,0,0,.566,0L8,105.7l5.128,5.128,1.058,1.058a.4.4,0,0,0,.566,0l1.132-1.132a.4.4,0,0,0,0-.566Z" transform="translate(0 -96)" fill="#f084f4"/>
							</svg>
						</label>
					<?php endforeach; ?>
					</section>
				</div>
				<?php endforeach; ?>
				<input type="hidden" name="paged" value="1" />
				<input type="hidden" name="meta_key" value="" />
				<input type="hidden" name="orderby" value="" />
				<input type="hidden" name="order" value="DESC" />				
				<input type="hidden" name="action" value="offer_form" />
				<?php wp_nonce_field('offer_form'); ?>
			</form>
			<section>
				<div class="fc">
					<div>
						<p> Showing
							<span class="count"><?php echo sizeof(get_posts($args)) ?></span>
							out of
							<span class="count-all"><?php echo sizeof(get_posts($argsAll)) ?></span>
							Results
						</p>
					</div>
					<section class="fcc">
						<h5><label for="sort">Sort by: </label></h5>
						<select id="sort">
							<option value="1" selected>Default Sorting</option>
							<option value="2">A-Z</option>
							<option value="3">Z-A</option>
						</select>
					</section>
				</div>
				<?php if ($loop->have_posts()): ?>
				<div class="offers-wrap posts-wrap tr">
					<div class="more-posts" style="background: none; padding: 0;">
						<div class="row">
							<?php while ($loop->have_posts()): $loop->the_post();
								echo get_template_part("templates/part", "offer");
							endwhile; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="pagination-wrapper">
					<?php 
						echo custom_pagination($loop->max_num_pages, "", $paged);
					?>
				</div>
			</section>
		</div>
	</div>
</main>

<?php get_footer(); ?>
<?php /*
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' );
*/ ?>
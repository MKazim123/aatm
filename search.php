

<?php get_header(); ?>
<main id="content" role="main">

<?php

$argsAll = [
	's'=> get_search_query(),
	'cat' => '',
	'post_type' => 'post',
	'posts_per_page' => -1
];
$args = [
	's'=> get_search_query(),
	'cat' => '',
	'post_type' => 'post',
	'posts_per_page' => 24
];
$argsNext = [
	's'=> get_search_query(),
	'cat' => '',
	'paged' => 2,
	'post_type' => 'post',
	'posts_per_page' => 24
];
$loopAll = new WP_Query();
$loopAll->parse_query($argsAll);
relevanssi_do_query($loopAll);

$count = $loopAll->found_posts;

if (!$count):
	$args = [
		's'=> '',
		'post_type' => 'post',
		'meta_key' => 'post_views_count',
	    'orderby' => 'meta_value_num',
		'posts_per_page' => 12
	];
	$argsNext = [
		's'=> '',
		'paged' => 2,
		'post_type' => 'post',
		'meta_key' => 'post_views_count',
	    'orderby' => 'meta_value_num',
		'posts_per_page' => 12
	];
endif;


$loop = new WP_Query();
$loop->parse_query($args);
relevanssi_do_query($loop);

$loopNext = new WP_Query();
$loopNext->parse_query($argsNext);
relevanssi_do_query($loopNext);

?>

<?php if ($count): ?>

<header class="header">
	<h1 class="entry-title" itemprop="name"><?php echo '<span class="count">'.$count.'</span>'; printf( esc_html__( ' Results for “%s”', 'blankslate' ), get_search_query() ); ?></h1>

	<form id="search_form" class="row fcc">
		<label for="cat">Sort by:</label>
		<select name="cat" id="cat" class="nice">
			<option value="" selected="">Select a category</option>
			<?php
		    $catArgs = array(
               'post_type' => ['post'],
               'orderby' => 'name',
               'order'   => 'ASC',
               'parent' => 0
            );
		    $cats = get_categories($catArgs);

		   foreach($cats as $cat): ?>
	    	<option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
			<?php endforeach ?>
		</select>
		<input type="hidden" name="paged" value="1" />
		<input type="hidden" name="searchfor" value="<?php echo get_search_query(); ?>" />
		<input type="hidden" name="many" value="<?php echo $count; ?>" />
		<input type="hidden" name="action" value="search_form" />
		<?php wp_nonce_field('search_form'); ?>
	</form>
</header>

<?php else: ?>

<article id="post-0" class="post no-results not-found">	
	
	<header class="header">
		
		<h1 class="entry-title" itemprop="name"><?php printf( esc_html__( '0 results for “%s”', 'blankslate' ), get_search_query() ); ?></h1>		
		<p>Sorry, there are no matches for your query. Try searching again with different terms.</p>
		
		<form class="fcc tr" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		    <input type="text" class="search-field tr" name="s" placeholder="Search articles">
		    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32.005" viewBox="0 0 32 32.005" class="tr">
		        <path d="M31.565,27.671l-6.232-6.232A1.5,1.5,0,0,0,24.271,21H23.252A12.995,12.995,0,1,0,21,23.252v1.019a1.5,1.5,0,0,0,.438,1.063l6.232,6.232a1.494,1.494,0,0,0,2.119,0L31.559,29.8A1.507,1.507,0,0,0,31.565,27.671ZM13,21a8,8,0,1,1,8-8A8,8,0,0,1,13,21Z" fill="#3a1bff"/>
		    </svg>
		    <input type="submit" value="search" />
		</form>

		<form id="search_form" class="row fcc">		
			<input type="hidden" name="paged" value="1" />
			<input type="hidden" name="count" value="<?php $count; ?>" />
			<input type="hidden" name="action" value="search_form" />
			<?php wp_nonce_field('search_form'); ?>
		</form>
	</header>
</article>

<?php endif; ?>

	<?php if ($loop->have_posts()): ?>
	<div class="container search-wrap posts-wrap tr">
		<h3 class='no-cat tr'></h3>
		<?php if (!$count) echo '<h3>check out these popular stories</h3>'; ?>
		<div class="row">
			<?php while ($loop->have_posts()): $loop->the_post();
				echo get_template_part("templates/part", "post");
			endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if ($loopNext->have_posts()): ?>
		<div class="search-load-more load-more tr">
			<button class="btn">load more</button>
		</div>		
	<?php endif; ?>


<?php echo get_template_part("templates/part", "nl"); ?>

<section class="instagram_module <?php the_sub_field('appearance'); ?>">
	<?php echo get_template_part("templates/part", "ig"); ?>
</section>

</main>
<?php get_footer(); ?>
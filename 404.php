<?php get_header(); ?>
<main id="content" role="main">
<article id="post-0" class="post not-found">
	<header class="page-hero">
		<h1 class="entry-title" itemprop="name"><?php esc_html_e( '404 - Not Found', 'blankslate' ); ?></h1>
	</header>
	<div class="entry-content " itemprop="mainContentOfPage">
		<div class="container-sm txt">
			<h4><?php esc_html_e( 'Nothing found for the requested page. Try a search instead?', 'blankslate' ); ?></h4>
			<?php get_search_form(); ?>
		</div>		
	</div>
</article>
</main>
<?php get_footer(); ?>
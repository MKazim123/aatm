<?php get_header(); ?>
    <section class="vt_section" id="vt_hero_section">
        <div class="vt-container">
            <div class="vt-content-section">
                <div class="vt-sec-left">
                    <div class="vt-content">
                        <h1 class="vt-main-heading">THE MOM</h1>
                        <p class="vt-subheading-1">The Source</p>
                        <p class="vt-subheading-2">of all <span>Codes & Coupons</span></p>
                        <p class="vt-hero-quote">JUST SERACH, FIND AND GET YOUR <span>DISCOUNT CODE</span></p>
                        <div class="vt-stats">
                            <div class="vt-stat">
                                <p class="vt-stat-num">6789</p>
                                <p class="vt-stat-head">DISCOUNTS</p>
                                <p class="vt-stat-footer">OFFERS</p>
                            </div>
                            <div class="vt-stat">
                                <p class="vt-stat-num">405</p>
                                <p class="vt-stat-head">PARTNERSHIP</p>
                                <p class="vt-stat-footer">BRANDS</p>
                            </div>
                            <div class="vt-stat">
                                <p class="vt-stat-num">203</p>
                                <p class="vt-stat-head">STORE</p>
                                <p class="vt-stat-footer">LOCATIONS</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vt-sec-right">
                    <div class="vt-content">
                        <img src="<?php echo home_url('/wp-content/uploads/2022/11/OfferPage-1.png'); ?>" alt="hero section image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="vt_section mt-5 mb-5" id="vt_search_section">
        <div class="vt-container">
            <div class="vt-content">
                <select name="offer_category" id="offer_category">
                    <option value="">Select Category</option>
                    <?php
                        $offer_categories = get_terms([
                            'taxonomy' => "offer_category",
                            'hide_empty' => false,
                        ]);
                        foreach ($offer_categories as $offer_category){
                            echo '<option value="'.$offer_category->slug.'">'.$offer_category->name.'</option>';
                        }
                    ?>
                </select>
                <select name="offer_brand" id="offer_brand">
                    <option value="">Select Brand</option>
                </select>
                <a href="javascript:void(0)" class="vt-search-btn">Search</a>
            </div>
        </div>
    </section>

    <!-- search section new -->
	<section class="vt_section search-container-new">
		<div class="vt-container search-section-new">
			<div class="search-category-wrapper">
				<div class="search-content-wrap">
					<img src="https://aboutthemomdev.wpengine.com/wp-content/uploads/2022/12/category-icon.svg" />
					<p>Categories</p>
				</div>
				<img src="https://aboutthemomdev.wpengine.com/wp-content/uploads/2022/12/down-arrow.svg" />
			</div>
			<div class="search-wrapper">
				<img src="https://aboutthemomdev.wpengine.com/wp-content/uploads/2022/12/search.svg" />
				<input type="text" name="adv_search" id="adv_search" />
                <div class="adv_search_container">
                    <div class="offers_search_container">
                        <h4>Offers</h4>
                        <ul class="search_items"></ul>
                    </div>
                    <div class="brands_search_container">
                        <h4>Brands</h4>
                        <ul class="search_items"></ul>
                    </div>
                </div>
                
				<div class="search-btn-wrap">
					<a href="#">Search</a>
				</div>
			</div>
		</div>
	</section>

    <!-- trending coupons -->
    <section class="vt_section" id="vt_trending_coupons">
        <div class="vt-container">
            <div class="vt-content">
                <h2 class="vt-section-heading mb-3">Tending <span>Coupons</span></h2>
                <div class="vt-slider-section">
                    <div class="vt-coupons-cards">
                        <?php
                        $popular_offers = new WP_Query( 
                            array( 
                                'post_type' => 'offers',
                                'posts_per_page' => 10,
                                'meta_key' => 'post_views_count', 
                                'orderby' => 'meta_value_num', 
                                'order' => 'DESC'  
                            ) 
                        );
                        while($popular_offers->have_posts()){
                            $popular_offers->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-event-thumbnail' );
                            $offer_button = get_field('lasso_shortcode') ? do_shortcode(get_field('lasso_shortcode')) : '<a href="javascript:void(0)" class="vt-card-btn">get it now!</a>';
                            echo '
                            <div class="vt-card">
                                <div class="vt-card-head">
                                    <div class="vt-sec-left">
                                        <div class="vt-brand-logo">
                                            <img src="'.$image[0].'" alt="">
                                        </div>
                                    </div>
                                    <div class="vt-sec-right">
                                        <div class="vt-sec-top">
                                            <h3 class="vt-card-heading">'.get_the_title().'</h3>
                                        </div>
                                        <div class="vt-sec-bottom">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="vt-card-body">
                                    <p>'.get_the_excerpt().'</p>
                                    <span class="vt-circle-left"></span>
                                    <span class="vt-circle-right"></span>
                                </div>
                                <div class="vt-card-footer">
                                    <div class="vt-coupon-btn">
                                        '.$offer_button.'
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        ?>
                        <!-- <div class="vt-card">
                            <div class="vt-card-head">
                                <div class="vt-sec-left">
                                    <div class="vt-brand-logo">
                                        <img src="http://localhost/mom/wp-content/uploads/2022/11/brndlogo1.png" alt="">
                                    </div>
                                </div>
                                <div class="vt-sec-right">
                                    <div class="vt-sec-top">
                                        <h3 class="vt-card-heading">Starbucks</h3>
                                    </div>
                                    <div class="vt-sec-bottom">
                                        <p>60% OFF</p>
                                    </div>
                                </div>
                            </div>
                            <div class="vt-card-body">
                                <p>Zen Sleapwear | Nested Bean shop now</p>
                                <span class="vt-circle-left"></span>
                                <span class="vt-circle-right"></span>
                            </div>
                            <div class="vt-card-footer">
                                <a href="javascript:void(0)" class="vt-card-btn">Get The Offer</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top brands -->
    <section class="vt_section mt-5 mb-5" id="vt_top_brands">
        <div class="vt-container">
            <div class="vt-content">
                <div class="vt_top_brand_header mb-3">
                    <h2 class="vt-section-heading">Top <span>Brands</span></h2>
                    <select id="brand_order_by">
                        <option value="">Sort By</option>
                        <option value="a-z">A-Z</option>
                        <option value="z-a">Z-A</option>
                    </select>
                </div>
                <div class="vt-brands-slider-section">
                    <div class="vt-brands-cards" style="display: flex; column-gap: 12px;row-gap: 12px;flex-wrap: wrap;">
                        <?php
                            $total_brands = wp_count_terms('brand', array('hide_empty'=> true));
                            $number = 12;
                            $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $taxonomy = 'brand';
                            $offset = $page ? $number * ($page - 1):0;
                            $args = array( 'post_per_page' => 12,'orderby' => 'title','order'=> 'ASC' ,'number' => $number, 'offset' => $offset );
                            $brand_terms = get_terms( $taxonomy, $args );
                            // echo '<pre>';
                            // print_r($brand_terms);
                            // echo "</pre>";
                            foreach($brand_terms as $brand_term){
                                $brand_image = get_field('brand_image', 'brand_'.$brand_term->term_id) ? get_field('brand_image', 'brand_'.$brand_term->term_id) : home_url("/wp-content/uploads/2022/11/brand.png");
                                $brand_description = $brand_term->description ? $brand_term->description : "Zen Sleapwear | Nested Bean shop now";
                                echo '
                                <div class="vt-card">
                                    <div class="vt-card-head"></div>
                                    <div class="vt-card-body">
                                        <div class="vt-brand-logo">
                                            <img src="'.$brand_image.'" alt="">
                                        </div>
                                        <div class="vt-brand-meta">
                                            <h3 class="vt-card-heading">'.$brand_term->name.'</h3>
                                            <div class="vt-card-desp">
                                                <p>'.$brand_description.'</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vt-card-footer">
                                        <a href="'.home_url("/listing?b=".$brand_term->term_id).'" class="vt-card-btn">Get The Offer</a>
                                    </div>
                                </div>
                                ';
                            }

                            
                        ?>
                        <!-- <div class="vt-card">
                            <div class="vt-card-head"></div>
                            <div class="vt-card-body">
                                <div class="vt-brand-logo">
                                    <img src="http://localhost/mom/wp-content/uploads/2022/11/brand.png" alt="">
                                </div>
                                <div class="vt-brand-meta">
                                    <h3 class="vt-card-heading">SwipeWire</h3>
                                    <div class="vt-card-desp">
                                        <p>Zen Sleapwear | Nested Bean shop now</p>
                                    </div>
                                </div>
                            </div>
                            <div class="vt-card-footer">
                                <a href="javascript:void(0)" class="vt-card-btn">Get The Offer</a>
                            </div>
                        </div> -->
                    </div>
                    <?php
                    if($total_brands > $number){

                        $pl_args = array(
                           'base'     => @add_query_arg('paged','%#%'),
                           'format'   => '',
                           'total'    => ceil($total_brands / $number),
                           'current'  => max(1, $page),
                           'prev_next' => True,
                            'prev_text' => __( '<' ),
                            'next_text' => __( '>' )
                        );
                      
                        // for ".../page/n"
                        if($GLOBALS['wp_rewrite']->using_permalinks()){
                          $pl_args['base'] = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');
                        }
                      
                        echo '<div class="mt-5 pagination-wrap">'.paginate_links($pl_args)."</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>
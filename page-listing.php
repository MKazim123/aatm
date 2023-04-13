<?php 
    get_header(); 
    $brand_id = $_GET['b'];
    $brand_data = get_term( $brand_id );
    $brand_image = get_field('brand_image', 'brand_'.$brand_id) ? get_field('brand_image', 'brand_'.$brand_id) : home_url("/wp-content/uploads/2022/11/brand.png");
    $brand_website = get_field('brand_website', 'brand_'.$brand_id) ? get_field('brand_website', 'brand_'.$brand_id) : "none";
    $brand_email = get_field('brand_email', 'brand_'.$brand_id) ? get_field('brand_email', 'brand_'.$brand_id) : "none";
    $brand_description = $brand_data->description ? $brand_data->description : "Zen Sleapwear | Nested Bean shop now";
?>

<section class="vt-section mt-5 mb-4" id="brand_listing">
    <div class="vt-container">
        <div class="vt-content vt-brand-content">
            <div class="vt-sec-left">
                <div class="vt-current-offer-section">
                    <div class="vt-current-cards">
                        <div class="vt-card">
                            <div class="vt-card-head"></div>
                            <div class="vt-card-body">
                                <div class="vt-brand-logo">
                                    <img src="<?php echo $brand_image; ?>" alt="">
                                </div>
                                <div class="vt-brand-meta">
                                    <h3 class="vt-card-heading"><?php echo $brand_data->name; ?></h3>
                                    <div class="vt-card-desp">
                                        <p><?php echo $brand_description; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php if($brand_website != "none" || $brand_email != "none"){ ?>
                            <div class="vt-card-footer">
                                <div class="vt-info-box">
                                    <?php if($brand_website != "none"){ ?>
                                    <div class="vt-info">
                                        <div class="vt-info-logo"><img src="<?php echo home_url("/wp-content/uploads/2022/11/websitelogo.png"); ?>" alt=""></div>
                                        <div class="vt-info-meta"><span><a href="<?php echo $brand_website; ?>">Visit <?php echo $brand_data->name; ?></a></span></div>
                                    </div>
                                    <?php } ?>
                                    <?php if($brand_email != "none"){ ?>
                                    <div class="vt-info">
                                        <div class="vt-info-logo"><img src="<?php echo home_url("/wp-content/uploads/2022/11/emaillogo.png"); ?>" alt=""></div>
                                        <div class="vt-info-meta"><span><a href="mailto:<?php echo $brand_email; ?>"><?php echo $brand_email; ?></a></span></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="vt-similar-offer-section">
                    <div class="vt-similar-heading mb-3 mt-5">
                        <h3>Popular <span>Brands</span></h3>
                    </div>
                    <div class="vt-similar-cards">
                        <?php
                        $all_brands_ids = wp_list_pluck(get_terms('brand', 'hide_empty=0'), 'term_id');
                        if (($key = array_search($brand_id, $all_brands_ids)) !== false) {
                            unset($all_brands_ids[$key]);
                        }
                        // print_r($all_brands_ids);
                        $popular_offers = new WP_Query( 
                            array( 
                                'post_type' => 'offers',
                                'posts_per_page' => 2,
                                'meta_key' => 'post_views_count', 
                                'orderby' => 'meta_value_num', 
                                'order' => 'DESC',
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'brand',
                                        'terms' => $all_brands_ids,      
                                        'field' => 'id',
                                        'operator' => 'IN'
                                    ),
                                )
                            ) 
                        );
                        while($popular_offers->have_posts()){
                            $popular_offers->the_post();
                            $popular_brand = get_the_terms(get_the_ID(), 'brand');
                            $popular_brand_id = $popular_brand[0]->term_id;
                            $popular_brand_image = get_field('brand_image', 'brand_'.$popular_brand_id) ? get_field('brand_image', 'brand_'.$popular_brand_id) : home_url("/wp-content/uploads/2022/11/brand.png");
                            $popular_brand_description = $popular_brand[0]->description ? $popular_brand[0]->description : "Zen Sleapwear | Nested Bean shop now";
                            echo '
                            <div class="vt-card">
                                <div class="vt-card-head"></div>
                                <div class="vt-card-body">
                                    <div class="vt-brand-logo">
                                        <img src="'.$popular_brand_image.'" alt="'.get_the_ID().'">
                                    </div>
                                    <div class="vt-brand-meta">
                                        <h3 class="vt-card-heading">'.$popular_brand[0]->name.'</h3>
                                        <div class="vt-card-desp">
                                            <p>'.$popular_brand_description.'</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="vt-card-footer">
                                    <a href="'.home_url("/listing?b=".$popular_brand[0]->term_id).'" class="vt-card-btn">Get The Offer</a>
                                </div>
                            </div>
                            ';
                        }
                        wp_reset_postdata();
                        ?>
                        
                        <!-- <div class="vt-card">
                            <div class="vt-card-head"></div>
                            <div class="vt-card-body">
                                <div class="vt-brand-logo">
                                    <img src="brand.png" alt="">
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
                </div>
            </div>
            <div class="vt-sec-right">
                <div class="vt-breadcrumb-sec">
                    <p class="vt-breadcrumb">OFFERS - <span style="text-transform: uppercase"><?php echo $brand_data->name; ?></span></p>
                </div>
                <div class="vt-listing-heading">
                    <h1  style="text-transform: capitalize">All <?php echo $brand_data->name; ?> <span>Offers</span></h1>
                </div>
                <div class="vt-offer-listing-cards">
                    <?php
                    $args = array(
                        'post_type' => 'offers',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'brand',
                                'field'    => 'slug',
                                'terms'    => $brand_data->slug,
                            ),
                        ),
                    );
                    $offers_query = new WP_Query( $args );
                    while(  $offers_query->have_posts()){
                        $offers_query->the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-event-thumbnail' );
                        $offer_button = get_field('lasso_shortcode') ? do_shortcode(get_field('lasso_shortcode')) : '<a href="javascript:void(0)">get it now!</a>';
                        echo '
                        <div class="vt-card">
                            <div class="vt-promo-sec">
                                <div class="vt-promo">
                                    <img src="'.$image[0].'" />
                                </div>
                            </div>
                            <div class="vt-card-meta">
                                <h3 class="vt-meta-heading">'.get_the_title().'</h3>
                                <p class="vt-meta-desp">'.get_the_excerpt().'</p>
                            </div>
                            <div class="vt-card-btn">
                                '.$offer_button.'
                            </div>
                        </div>
                        ';
                    }
                    wp_reset_postdata();
                    ?>
                    <!-- <div class="vt-card">
                        <div class="vt-promo-sec">
                            <div class="vt-promo">
                                <h3 class="vt-percent-heading">25%</h3>
                                <span>Code</span>
                            </div>
                        </div>
                        <div class="vt-card-meta">
                            <h3 class="vt-meta-heading">Up to 50% OFF + FREE Shipping</h3>
                            <p class="vt-meta-desp">Mixbook combines unique, on-trend designs with a powerful editor,
                                allowing you to create one-of-a-kind photo goods</p>
                        </div>
                        <div class="vt-card-btn">
                            <a href="javascript:void(0)">Get The Offer</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
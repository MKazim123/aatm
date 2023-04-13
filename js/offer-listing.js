jQuery('.vt-coupons-cards').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: "<img class='a-left control-c prev slick-prev' src='"+ajax_obj.home_url+"/wp-content/uploads/2022/11/Arrow-1-1.png'>",
    nextArrow: "<img class='a-right control-c next slick-next' src='"+ajax_obj.home_url+"/wp-content/uploads/2022/11/Arrow-1-1.png'>",
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
});

jQuery(document).ready(function(){
// alert(ajax_obj.home_url);
  jQuery(document).on('change', '#offer_category', function(){
    jQuery('.vt-search-btn').attr('href', 'javascript:void(0)');
    let offer_category = jQuery(this).val();
    if(offer_category != ""){
      let formdata = new FormData();
      formdata.append('action','get_brands_from_category');
      formdata.append('offer_category', offer_category);
      jQuery.ajax({
          type: "post",
          data : formdata,
          url: ajax_obj.ajax_url,
          success: function(msg){
              jQuery('#offer_brand').html(msg);
          },
          cache: false,
          contentType: false,
          processData: false
      });
    }
    
  });
  jQuery(document).on('change', '#offer_brand', function(){
    let offer_brand = jQuery(this).val();
    if(offer_brand != ""){
      jQuery('.vt-search-btn').attr('href', ajax_obj.home_url+"/listing?b="+offer_brand);
    }else{
      jQuery('.vt-search-btn').attr('href', 'javascript:void(0)');
    }
    
  });


  jQuery(document).on('change', '#brand_order_by', function(){
    let brand_order_by = jQuery(this).val();
    if(brand_order_by != ""){
      let formdata = new FormData();
      formdata.append('action','brand_order_by');
      formdata.append('brand_order_by', brand_order_by);
      jQuery.ajax({
          type: "post",
          data : formdata,
          url: ajax_obj.ajax_url,
          success: function(msg){
              jQuery('.vt-brands-slider-section .vt-brands-cards').html(msg);
          },
          cache: false,
          contentType: false,
          processData: false
      });
    }
    
  });


  // advance search
  jQuery(document).on('keyup', '#adv_search', function(){
    setTimeout(function(){
      let search_val = jQuery('#adv_search').val();
    if(search_val != ""){
      let formdata = new FormData();
      formdata.append('action','offer_brand_search_action');
      formdata.append('search_val', search_val);
      jQuery.ajax({
          type: "post",
          data : formdata,
          url: ajax_obj.ajax_url,
          success: function(msg){
              if(msg != ""){
                let exp_msg = msg.split('|||');
                if(exp_msg[0] != "" && exp_msg[1] != ""){
                  jQuery(".adv_search_container").show();

                  jQuery(".adv_search_container .offers_search_container").show();
                  jQuery(".offers_search_container .search_items").html(exp_msg[0]);

                  jQuery(".adv_search_container .brands_search_container").show();
                  jQuery(".brands_search_container .search_items").html(exp_msg[1]);
                }
                else if(exp_msg[0] != "" && exp_msg[1] == ""){
                  jQuery(".adv_search_container").show();

                  jQuery(".adv_search_container .offers_search_container").show();
                  jQuery(".offers_search_container .search_items").html(exp_msg[0]);
                }
                else if(exp_msg[0] == "" && exp_msg[1] != ""){
                  jQuery(".adv_search_container").show();

                  jQuery(".adv_search_container .brands_search_container").show();
                  jQuery(".brands_search_container .search_items").html(exp_msg[1]);
                }
                else{
                  jQuery(".adv_search_container").hide();
                }

              }
              // console.log(msg);
          },
          cache: false,
          contentType: false,
          processData: false
      });
    }else{
      jQuery(".adv_search_container").hide();
    }
    },1000)
  });
  jQuery(document).on('click', 'body.page', function(){
    jQuery(".adv_search_container").hide();
  });

});
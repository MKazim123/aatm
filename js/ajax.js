jQuery(document).ready(function($) {

	"use strict";

	$("#search_form").submit(function(e) {

		e.preventDefault();

		$(".search-wrap, .load-more").css("opacity", 0);
		var filtersForm = $(this).serializeArray();
		var $page, $count;
		
		$.ajax({
			type: "POST",
			url: ajax_obj.ajax_url,
			data: filtersForm,
			success: function(data){

				console.log(data.count);
				$count = data.count != null ? data.count : 0;

				$page = parseInt($("input[name='paged']").val());
				$(".load-more").html(data.more);

				if ($page == 1)
					$(".search-wrap .row").html(data.results);
				else
					$(".search-wrap .row").append(data.results);

				if (!$count)
					$('h3.no-cat').text('Sorry, there are no matches for your query. Try a different category.');
				else
					$('h3.no-cat').text('');
				
				setTimeout(function(){
					$(".search-wrap, .load-more").css("opacity", 1);
					$('.count').text($count);
				}, 400);
			},

			error : function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});

		return false;
	});

	$(document).on("change", "#search_form select", function() {
		
		$("input[name='paged']").val(1);
		$("#search_form").submit();
	});
	
	$(document).on("click", ".search-load-more button", function() {

		var $page = parseInt($("input[name='paged']").val());
		$("input[name='paged']").val($page + 1);
		$("#search_form").submit();
	});

	$("#more_form").submit(function(e) {

		e.preventDefault();

		$(".more-wrap, .load-more").css("opacity", 0);
		var filtersForm = $(this).serializeArray();
		var $page;
		
		$.ajax({
			type: "POST",
			url: ajax_obj.ajax_url,
			data: filtersForm,
			success: function(data){

				$page = parseInt($("input[name='paged']").val());
				$(".load-more").html(data.more);				

				if ($page == 1)
					$(".more-wrap .row").html(data.results);
				else
					$(".more-wrap .row").append(data.results);
				
				setTimeout(function(){
					$(".more-wrap, .load-more").css("opacity", 1);
				}, 400);
			},

			error : function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});

		return false;
	});

	$(document).on("click", ".more-load-more button", function() {

		var $page = parseInt($("input[name='paged']").val());
		$("input[name='paged']").val($page + 1);
		$("#more_form").submit();
	});

	$("#offer_form").submit(function(e) {

		e.preventDefault();

		$(".offers-wrap, .pagination-wrapper").css("opacity", 0);
		var filtersForm = $(this).serializeArray();
		var $page;
		
		$.ajax({
			type: "POST",
			url: ajax_obj.ajax_url,
			data: filtersForm,
			success: function(data){

				$(".load-more").html(data.more);				
				$(".offers-wrap .row").html(data.results);
				$(".pagination-wrapper").html(data.pagination);

				//console.log(data.args);
				
				setTimeout(function(){
					$(".offers-wrap, .pagination-wrapper").css("opacity", 1);
					$('.count-all').text(data.count);
					$('.count').text($('.offer-wrap').length);
				}, 400);
			},

			error : function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});

		return false;
	});

	$(document).on("change", "#offer_form input[type='checkbox']:not(#show_popular)", function() {

		$("input[name='paged']").val(1);
		$("input[name='meta_key']").val('');
		$("input[name='orderby']").val('date');
		$("#offer_form #show_popular").prop('checked', false);
		$("#offer_form").submit();
	});

	$(document).on("change", "#offer_form #show_popular", function() {

		$("input[type='checkbox']:not(#show_popular)").prop('checked', false);

		if ($(this).prop('checked')) {
			$("input[name='paged']").val(0);
			$("input[name='meta_key']").val('post_views_count');
			$("input[name='orderby']").val('meta_value_num');
		}
		else {
			$("input[name='meta_key']").val('');
			$("input[name='orderby']").val('date');
			$("input[name='paged']").val(1);
		}
			
		$("#offer_form").submit();
	});

	$(document).on("change", "select#sort", function() {
		
		$("input[name='paged']").val(1);
		if ($(this).val() == 1) {
			$("input[name='orderby']").val('date');
			$("input[name='order]").val('DESC');
		}
		if ($(this).val() == 2) {
			$("input[name='orderby']").val('title');
			$("input[name='order']").val('ASC');
		}
		if ($(this).val() == 3) {
			$("input[name='orderby']").val('title');
			$("input[name='order]").val('DESC');
		}
		$("#offer_form").submit();
	});


	$(document).on('click', '.custom-pagination a', function(e){

        e.preventDefault();
        
        var scroll = 700;
        var timeout = 800;

        if ($("#offer_form").offset().top == $(window).scrollTop()){

            scroll = 0;
            timeout = 0;
        }
        
        $([document.documentElement, document.body]).animate({
            scrollTop: $("body").offset().top
        }, scroll);
        
        
        if ($(this).hasClass("next"))
            $("input[name='paged']").val(parseInt($("input[name='paged']").val()) + 1);
        else if ($(this).hasClass("prev"))
            $("input[name='paged']").val(parseInt($("input[name='paged']").val()) - 1);
        else
            $("input[name='paged']").val(parseInt($(this).text()));

        setTimeout(function(){ 
            $("#offer_form").submit();
        }, timeout);
        
    });


});
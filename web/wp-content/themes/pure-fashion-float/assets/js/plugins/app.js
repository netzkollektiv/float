(function ($, window) {
	'use strict';

	var $doc = $(document),
			win = $(window),
			body = $('body'),
			adminbar = $('#wpadminbar'),
			cc = $('.click-capture'),
			header = $('.header'),
			wrapper = $('#wrapper'),
      mobile_menu = $('#mobile-menu'),
			mobile_toggle = $('.mobile-toggle-holder');

	var SITE = SITE || {};

  function thb_toggleClass( selector, cls ) {
    $(selector).toggleClass( cls );
  }

	SITE = {
		thb_scrolls: {},
		h_offset: 0,
		init: function() {
			var self = this,
					obj;

			function initFunctions() {
				for (obj in self) {
					if ( self.hasOwnProperty(obj)) {
						var _method =  self[obj];
						if ( _method.selector !== undefined && _method.init !== undefined ) {
							if ( $(_method.selector).length > 0 ) {
								_method.init();
							}
						}
					}
				}
			}
      initFunctions();
		},
    header: {
			selector: '.header',
			init: function() {
				var base = this,
            container = $(base.selector),
            offset = 100;

	      if ( Headroom.cutsTheMustard ) {
	  			container.headroom({
	  				offset: offset,
	          onTop: function() {
	            $('.header-wrapper').css('height', function() {
	              return container.outerHeight(true) + 'px';
	            });
	          },
	  			});
				}
				win.on('scroll.fixed-header', function() { base.scroll(); } ).trigger('scroll.fixed-header');

			},
			scroll: function() {
        var base = this,
            container = $(base.selector),
            wOffset = win.scrollTop(),
						stick = 'fixed',
            fixed_offset = 0;

        if ( $('.subheader').length ) {
          fixed_offset = $('.subheader').outerHeight();
        }

        if (wOffset > fixed_offset) {
    			if ( ! header.hasClass(stick)) {
    				header.addClass(stick);
						body.addClass('header-sticky');
    			}
    		} else {
    			if ( header.hasClass(stick) ) {
    				header.removeClass(stick);
						body.removeClass('header-sticky');
    			}
    		}
			}
		},
    fullMenu: {
			selector: '.thb-full-menu',
			init: function() {
				var base = this,
  					container = $(base.selector),
  					children = container.find('.menu-item-has-children');

        /* Sub-Menus */
				children.each(function() {
					var _this = $(this),
							menu = _this.find('>.sub-menu'),
							li = menu.find('>li>a');

					_this.hoverIntent(
						function() {
							_this.addClass('sfHover');
							menu.fadeIn();
						},
						function() {
							_this.removeClass('sfHover');
							menu.fadeOut();
						}
					);
				});
			}
		},
    mobileMenu: {
			selector: '#mobile-menu',
			init: function() {
				var base = this,
						container = $(base.selector),
						behaviour = container.data('behaviour'),
						arrow = behaviour === 'thb-submenu' ? container.find('.thb-mobile-menu li.menu-item-has-children>a') : container.find('.thb-mobile-menu li.menu-item-has-children>a>span');

				arrow.on('click', function(e){
					var that = $(this),
							parent = that.parents('a').length ? that.parents('a') : that,
							menu = parent.next('.sub-menu');

					if (parent.hasClass('active')) {
						parent.removeClass('active');
						menu.slideUp('200');
					} else {
						parent.addClass('active');
						menu.slideDown('200');
					}
					e.stopPropagation();
					e.preventDefault();
				});
			}
		},
    shopSidebar: {
			selector: '.widget_tag_cloud .tag-link-count',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function(){
					var count = $.trim($(this).html());
					count = count.substring(1, count.length-1);
					$(this).html(count);
				});
			}
		},
    shop_toggle: {
			selector: '#thb-shop-filters',
      init: function() {
				var base = this,
            container = $(base.selector),
            side_filters = $('#side-filters'),
						close = $( '.thb-close', side_filters );

        container.on('click', function() {
          wrapper.addClass('open-cc');
					wrapper.addClass('open-filters');
					return false;
				});
        $doc.on('keyup', function(e) {
          if (e.keyCode === 27) {
            wrapper.removeClass('open-cc');
						wrapper.removeClass('open-filters');
          }
        });
        cc.add(close).on('click', function() {
					wrapper.removeClass('open-cc');
					wrapper.removeClass('open-filters');
          return false;
        });
      }
    },
    mobile_toggle: {
			selector: '.mobile-toggle-holder',
      init: function() {
				var base = this,
            container = $(base.selector),
						close = $('.thb-close', mobile_menu);


        container.on('click', function() {
					wrapper.addClass('open-cc');
					wrapper.addClass('open-menu');
					return false;
				});

				$doc.on('keyup',function(e) {
				  if (e.keyCode === 27) {
						wrapper.removeClass('open-cc');
						wrapper.removeClass('open-menu');
				  }
				});
				cc.add(close).on('click', function() {
					wrapper.removeClass('open-cc');
					wrapper.removeClass('open-menu');
					return false;
				});
      }
    },
		quickCart: {
			selector: '.thb-quick-cart',
      init: function() {
				var base = this,
            container = $(base.selector),
            side_cart = $('#side-cart'),
						close = $( '.thb-close', side_cart );

        container.on('click', function() {
					if ( themeajax.settings.is_cart || themeajax.settings.is_checkout ) {
						window.location.href = themeajax.settings.cart_url;
						return false;
					} else {
						wrapper.addClass('open-cc');
						wrapper.addClass('open-cart');

						return false;
					}

				});
        $doc.on('keyup', function(e) {
          if (e.keyCode === 27) {
						wrapper.removeClass('open-cc');
						wrapper.removeClass('open-cart');
          }
        });
        cc.add(close).on('click', function() {
					wrapper.removeClass('open-cc');
					wrapper.removeClass('open-cart');
          return false;
        });
      }
    },
		autoComplete: {
			selector: '.header .thb-header-inline-search',
			init: function() {
				var base = this,
						container = $(base.selector),
						field = $('.search-field', container);

				$( '.thb-quick-search .thb-item-text, .thb-quick-search .thb-item-icon-wrapper', '.header' ).on('click', function(e) {
					e.stopPropagation();
					$(this).parents('.thb-secondary-area').toggleClass('thb-search-active');

				});
        function escapeRegExChars(value) {
          return value.replace(/[|\\{}()[\]^$+*?.]/g, "\\$&");
        }
        container.each(function() {
          var _this = $(this),
              field = $('.search-field', _this);

          field.autocomplete({
  					minChars: 3,
  					appendTo: $('.thb-autocomplete-wrapper', _this),
  					containerClass: 'thb-results-container',
  					triggerSelectOnValidInput: false,
  					serviceUrl: themeajax.url + '?action=thb_ajax_search',
            tabDisabled: true,
            showNoSuggestionNotice: false,
            params: {
  						security: themeajax.nonce.autocomplete_ajax
  					},
            onSearchStart: function() {
  						$('.woocommerce-product-search', _this).addClass('thb-loading');
  					},
  					formatResult: function(suggestion, currentValue) {
              var pattern = '(' + escapeRegExChars(currentValue) + ')',
                  value = suggestion.value
                  .replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
                  .replace(/&/g, '&amp;')
                  .replace(/</g, '&lt;')
                  .replace(/>/g, '&gt;')
                  .replace(/"/g, '&quot;')
                  .replace(/&lt;(\/?strong)&gt;/g, '<$1>');
  						return '<a href="'+suggestion.url+'">'+suggestion.thumbnail+'</figure><span class="product-title">'+value+'</span>'+suggestion.price+'</a>';
  					},
  					onSelect: function(suggestion) {
  						if (suggestion.id !== -1) {
  							window.location.href = suggestion.url;
  						}
  					},
  					onSearchComplete: function (query, suggestions) {
  						$('.woocommerce-product-search', _this).removeClass('thb-loading');

              if (suggestions.length) {
                $('.thb-results-container').append($('<div class="thb-search-btn"><a href="'+themeajax.settings.site_url+'?s='+query+'&post_type=product" class="btn">'+themeajax.l10n.results_all+'</a></div>'));
              }
  					}
  				});
        });

			}
		},
    loginForm: {
			selector: '.thb-overflow-container',
			init: function() {
				var base = this,
						container = $(base.selector),
						ul = $('ul', container),
						links = $('a', ul);

				links.on('click', function() {
					var _this = $(this);
					if (!_this.hasClass('active')) {
						links.removeClass('active');
						_this.addClass('active');

						$('.thb-form-container', container).toggleClass('register-active');
					}
					return false;
				});
			}
		},
    productAjaxAddtoCart: {
			selector: '.thb-single-product-ajax-on.single-product .product-type-variable form.cart, .thb-single-product-ajax-on.single-product .product-type-simple form.cart',
			init: function() {
				var base = this,
						container = $(base.selector),
						btn = $('.single_add_to_cart_button', container);

				if ( typeof wc_add_to_cart_params !== 'undefined' ) {
					if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
						return;
					}
				}
				$doc.on('submit', 'body.single-product form.cart', function(e){
					e.preventDefault();
					var _this = $(this),
							btn_text = btn.eq(0).text();

					if (btn.is('.disabled') || btn.is('.wc-variation-selection-needed')) {
						return;
					}

					var	data = {
						product_id:	_this.find("[name*='add-to-cart']").val(),
						product_variation_data: _this.serialize()
					};

					$.ajax({
						method: 'POST',
						data: data.product_variation_data,
						dataType: 'html',
						url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add-to-cart=' + data.product_id + '&thb-ajax-add-to-cart=1' ),
						cache: false,
						headers: {'cache-control': 'no-cache'},
						beforeSend: function() {
							body.trigger( 'adding_to_cart' );
							btn.addClass('disabled').text(themeajax.l10n.adding_to_cart);
						},
						success: function( data ) {
							var parsed_data = $.parseHTML(data);

							var thb_fragments = {
								'.thb-cart-amount': $(parsed_data).find('.thb-cart-amount').html(),
								'.thb-cart-count': $(parsed_data).find('.thb-cart-count').html(),
								'.thb_prod_ajax_to_cart_notices': $(parsed_data).find('.thb_prod_ajax_to_cart_notices').html(),
								'.widget_shopping_cart_content': $(parsed_data).find('.widget_shopping_cart_content').html()
							};

							$.each( thb_fragments, function( key, value ) {
								$( key ).html(value);
							});
							body.trigger( 'wc_fragments_refreshed' );
							btn.removeClass('disabled').text(btn_text);
						},
						error: function( response ) {
							body.trigger( 'wc_fragments_ajax_error' );
							btn.removeClass('disabled').text(btn_text);
						}
					});
				});
			}
		},
    variations: {
			selector: 'form.variations_form',
			init: function() {
				var base = this,
    				container = $(base.selector),
    				slider = $('#product-images'),
    				thumbnails = $('#product-thumbnails'),
    				org_image_wrapper = $('.first', slider ),
    				org_image = $('img', org_image_wrapper),
    				org_link = $('a', org_image_wrapper),
    				org_image_link = org_link.attr('href'),
    				org_image_src = org_image.attr('src'),
    				org_thumb = $('.first img', thumbnails),
    				org_thumb_src = org_thumb.attr('src'),
    				price_container = $('p.price', '.product-information').eq(0),
    				org_price = price_container.html();

				container.on( 'show_variation', function( e, variation ) {
          if (variation.price_html) {
  					price_container.html(variation.price_html);
          }

          if ( ! slider.length ) {
            return;
          }
					if (variation.hasOwnProperty("image") && variation.image.src) {
						org_image.attr("src", variation.image.src).attr("srcset", "");
						org_thumb.attr("src", variation.image.thumb_src).attr("srcset", "");
						org_link.attr("href", variation.image.full_src);

						if (slider.hasClass('slick-initialized')) {
							slider.slick('slickGoTo', 0);
						}
						if ( typeof wc_single_product_params !== 'undefined' ) {
							if (wc_single_product_params.zoom_enabled === '1') {
								  org_image.attr("data-src", variation.image.full_src);
							}
						}
					}
				}).on('reset_image', function () {
					price_container.html(org_price);
          if ( ! slider.length ) {
            return;
          }
					org_image.attr("src", org_image_src).attr("srcset", "");
					org_thumb.attr("src", org_thumb_src).attr("srcset", "");
					org_link.attr("href", org_image_link);

					if ( typeof wc_single_product_params !== 'undefined' ) {
						if (wc_single_product_params.zoom_enabled === '1') {
							org_image.attr("data-src", org_image_src);
						}
					}
				});
        if ( container.find('.single_variation').is(':visible')) {
          if (container.find('.single_variation .woocommerce-variation-price').html()) {
            price_container.html(container.find('.single_variation .woocommerce-variation-price').html());
          }
        }
			}
		},
		alignFull: {
			selector: '.alignfull',
			init: function() {

				const scrollbarWidth = window.innerWidth - document.body.clientWidth;

				$('.alignfull').css({
					maxWidth: function() {
						return 'calc(100vw - ' + scrollbarWidth + 'px)';
					}
				});
			}
		},
    quantity: {
			selector: '.quantity:not(.hidden)',
			init: function() {
				var base = this,
						container = $(base.selector);

				base.initialize();
				body.on( 'updated_cart_totals', function(){
					base.initialize();
				});
			},
			initialize: function() {
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).prepend( '<div class="qty-label">'+themeajax.l10n.qty+'</div>' );
			}
		},
    shop: {
			selector: '.products .product, .wc-block-grid__products .product',
			init: function() {
				var base = this,
						container = $(base.selector),
            product,
            text;

        $('body')
          .on( 'adding_to_cart', function( e, $button ) {
            if ( ! $button ) {
              return;
            }
            product = $button.closest('.product');
            text    = $button.text();

            $button.text( themeajax.l10n.adding_to_cart );

          })
  				.on( 'added_to_cart', function( e, fragments, cart_hash, $button) {
            if ( $button ) {
              $button.text(text);
            }
            var product_title = product.find('.woocommerce-loop-product__title a').text();

            $('.thb_prod_ajax_to_cart_notices').html('<div class="thb-temp-message">' + product_title + ' ' + themeajax.l10n.has_been_added + '</div>');
  				});
			}
		},
    widget_nav_menu: {
			selector: '.widget_nav_menu, .widget_pages, .widget_product_categories',
			init: function() {
				var base = this,
						container = $(base.selector),
            items = container.find('.menu-item-has-children, .page_item_has_children, .cat-parent' );

        items.each( function() {
          var _this = $(this),
              link = $('>a', _this ),
              menu = _this.find('.sub-menu, .children');

    			menu.before( '<div class="thb-arrow"><i class="thb-icon-down-open-mini"></i></div>' );

    			$( '.thb-arrow', _this ).on('click', function(e) {
  					var that = $(this),
                parent = that.parents('li');

  					if (parent.hasClass('active')) {
  						parent.removeClass('active');
  						menu.slideUp('200');
  					} else {
  						parent.addClass('active');
  						menu.slideDown('200');
  					}
  					e.stopPropagation();
  					e.preventDefault();
    			});
    			if ( link.attr( 'href' ) === '#' ) {
    				link.on('click', function( e ) {
              var that = $(this),
                  menu = that.next('.sub-menu');
              if (that.hasClass('active')) {
    						that.removeClass('active');
    						menu.slideUp('200');
    					} else {
    						that.addClass('active');
    						menu.slideDown('200');
    					}
    					e.preventDefault();
    				});
    			}
    		});
      }
    },
    toTop: {
			selector: '#scroll_to_top',
			init: function() {
				var base = this,
					container = $(base.selector);

				container.on('click', function(){
					$('html, body').animate({scrollTop: 0 }, 500);
					return false;
				});
				win.on('scroll', function(){
					base.control();
				});
			},
			control: function() {
				var base = this,
						container = $(base.selector);

				if (win.scrollTop() > 200) {
					container.addClass('active');
				} else {
					container.removeClass('active');
				}
			}
		},
	};

	$(function(){
		SITE.init();
	});
})(jQuery, this);

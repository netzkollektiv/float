<?php

/**
 * Gutenberg Patterns
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

if ( ! is_admin() ) {
	return;
}
if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
	return;
}
function thb_patterns_register_block_patterns() {
	register_block_pattern(
		'pure-fashion/homepage',
		array(
			'title'      => esc_html__( 'Homepage', 'pure-fashion' ),
			'keywords'   => array( 'pure', 'purefashion', 'pure-fashion', 'page' ),
			'categories' => array( 'purefashion' ),
			// phpcs:disable
			'content' => '<!-- wp:cover {"url":"https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/hero-img.jpg","id":256,"dimRatio":10,"minHeight":70,"minHeightUnit":"vh","align":"full"} -->
			<div class="wp-block-cover alignfull has-background-dim-10 has-background-dim" style="background-image:url(https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/hero-img.jpg);min-height:70vh"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"fontSize":14}}} -->
			<p style="font-size:14px">NEW ARRIVALS</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1} -->
			<h1>Discover This Week’s Pieces<br>From Our Collection</h1>
			<!-- /wp:heading -->

			<!-- wp:spacer {"height":30} -->
			<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"borderRadius":5,"style":{"color":{"text":"#f4ead5"}},"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color" href="https://purefashion.fuelthemes.net/shop/" style="border-radius:5px;color:#f4ead5">VIEW COLLECTION</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->

			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:cover -->

			<!-- wp:spacer {"height":80} -->
			<div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:image {"align":"center","id":270,"width":54,"height":76,"sizeSlug":"large"} -->
			<div class="wp-block-image"><figure class="aligncenter size-large is-resized"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf-icon.png" alt="" class="wp-image-270" width="54" height="76"/></figure></div>
			<!-- /wp:image -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:columns -->
			<div class="wp-block-columns"><!-- wp:column {"width":"25%"} -->
			<div class="wp-block-column" style="flex-basis:25%"></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"80%"} -->
			<div class="wp-block-column" style="flex-basis:80%"><!-- wp:heading {"textAlign":"center"} -->
			<h2 class="has-text-align-center">Urban Outfitters—a brand she also was aging out of—there was a void in her life. She longed for a store to indulge hercreative side. This wasnt an isolated.</h2>
			<!-- /wp:heading -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:paragraph {"align":"center","className":"thb-text-button","fontSize":"small"} -->
			<p class="has-text-align-center thb-text-button has-small-font-size"><a href="https://purefashion.fuelthemes.net/about-us/" data-type="page" data-id="463">LEARN OUR STORY →</a></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"25%"} -->
			<div class="wp-block-column" style="flex-basis:25%"></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:spacer {"height":70} -->
			<div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:fuel-themes/thb-woocommerce-category-block-grid {"uid":"fuelthemes-1604921115136","is_desc_visible":true,"align":"wide","categories":[{"term_id":18,"name":"Dresses","slug":"dress","term_group":0,"term_taxonomy_id":18,"taxonomy":"product_cat","description":"","parent":0,"count":10,"filter":"raw","id":18},{"term_id":19,"name":"Jumpsuits","slug":"jump","term_group":0,"term_taxonomy_id":19,"taxonomy":"product_cat","description":"","parent":0,"count":7,"filter":"raw","id":19},{"term_id":20,"name":"Knits","slug":"knit","term_group":0,"term_taxonomy_id":20,"taxonomy":"product_cat","description":"","parent":0,"count":9,"filter":"raw","id":20},{"term_id":21,"name":"Outerwear","slug":"outerwear","term_group":0,"term_taxonomy_id":21,"taxonomy":"product_cat","description":"","parent":0,"count":7,"filter":"raw","id":21}]} /-->

			<!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center"><!-- wp:spacer {"height":60} -->
			<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading {"style":{"typography":{"fontSize":40}}} -->
			<h2 style="font-size:40px">New Arrivals</h2>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:woocommerce/product-best-sellers {"columns":4,"rows":1,"align":"wide"} /-->

			<!-- wp:buttons {"align":"center"} -->
			<div class="wp-block-buttons aligncenter"><!-- wp:button {"borderRadius":5,"style":{"color":{"background":"#404b3b","text":"#f4ead5"}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background" href="https://purefashion.fuelthemes.net/shop/" style="border-radius:5px;background-color:#404b3b;color:#f4ead5">SEE ALL NEW ARRIVALS</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->

			<!-- wp:spacer {"height":70} -->
			<div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column -->
			<div class="wp-block-column"><!-- wp:quote {"className":"is-style-large"} -->
			<blockquote class="wp-block-quote is-style-large"><p>It is difficult to talk about fashion in the abstract, without a human body before my eyes, without drawings, without a choice of fabric - without a practical or visual reality. Age and size are only numbers. Its the attitude you bring to clothes that make the difference.</p><cite>P. CATERINE HOLMES</cite></blockquote>
			<!-- /wp:quote -->

			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":249,"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf2-1024x920.jpg" alt="" class="wp-image-249"/></figure>
			<!-- /wp:image --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
			<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"typography":{"fontSize":40}}} -->
			<h2 style="font-size:40px">From The Blog</h2>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:latest-posts {"postsToShow":4,"displayPostContent":true,"excerptLength":21,"displayPostDate":true,"postLayout":"grid","columns":4,"displayFeaturedImage":true,"featuredImageAlign":"center","featuredImageSizeSlug":"large","align":"wide"} /-->

			<!-- wp:buttons {"align":"center"} -->
			<div class="wp-block-buttons aligncenter"><!-- wp:button {"borderRadius":5,"style":{"color":{"background":"#404b3b","text":"#f4ead5"}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background" href="https://purefashion.fuelthemes.net/blog/" style="border-radius:5px;background-color:#404b3b;color:#f4ead5">VIEW ALL POSTS</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->

			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->',
		)
	// phpcs:enable
	);

	register_block_pattern(
		'pure-fashion/aboutpage',
		array(
			'title'      => esc_html__( 'About Page', 'pure-fashion' ),
			'keywords'   => array( 'pure', 'purefashion', 'pure-fashion', 'page' ),
			'categories' => array( 'purefashion' ),
			// phpcs:disable
			'content' => '<!-- wp:cover {"url":"https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf14.jpg","id":502,"dimRatio":0,"align":"full"} -->
			<div class="wp-block-cover alignfull" style="background-image:url(https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf14.jpg)"><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#f4ead5"}}} -->
			<h1 class="has-text-align-center has-text-color" style="color:#f4ead5">Beautifully Made Clothes<br>For Every Woman</h1>
			<!-- /wp:heading --></div></div>
			<!-- /wp:cover -->

			<!-- wp:spacer {"height":77} -->
			<div style="height:77px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:columns -->
			<div class="wp-block-columns"><!-- wp:column -->
			<div class="wp-block-column"></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"70%"} -->
			<div class="wp-block-column" style="flex-basis:70%"><!-- wp:heading -->
			<h2>Originally founded by three design professionals,the Industrial Union of the town of Pordenone, Italy, (Unione Industriali Pordenone) and the Friulianregion’s <span style="text-decoration: underline;">best furniture producers</span> and artisans, in 2017 Valitalia is experiencing a new beginning. Weare passionate about well-designed, <em>timeless furnishings</em> and have come.</h2>
			<!-- /wp:heading -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading -->
			<h2>Home is a story of people who reside in there, the colors are <em>background music and the furniture</em> are the second lead of the story. Your furniture is more than just a piece of the timbere.</h2>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:spacer {"height":68} -->
			<div style="height:68px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:media-text {"align":"","mediaId":505,"mediaType":"image"} -->
			<div class="wp-block-media-text is-stacked-on-mobile"><figure class="wp-block-media-text__media"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf15-1024x989.jpg" alt="" class="wp-image-505 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"fontSize":"large"} -->
			<h2 class="has-large-font-size">Style, Meet Substance</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Plenty of beauty brands claim to be ethical. But here at Kester Black, sustainability and social justice aren’t just glossy marketing buzzwords. They’re the driving force behind our good-weird kind of beauty company: the kind that’s certified carbon neutral, that donates 2% of all revenue to social causes, and that makes vegan and sustainable products that are both all class, and all conscience. Ultimately, they’re what fires and fuels us with enthusiasm – the original renewable energy.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:media-text -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:media-text {"align":"","mediaPosition":"right","mediaId":506,"mediaType":"image"} -->
			<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile"><figure class="wp-block-media-text__media"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf16-1024x989.jpg" alt="" class="wp-image-506 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"fontSize":"large"} -->
			<h2 class="has-large-font-size">Direct To Consumer</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Plenty of beauty brands claim to be ethical. But here at Kester Black, sustainability and social justice aren’t just glossy marketing buzzwords. They’re the driving force behind our good-weird kind of beauty company: the kind that’s certified carbon neutral, that donates 2% of all revenue to social causes, and that makes vegan and sustainable products that are both all class, and all conscience. Ultimately, they’re what fires and fuels us with enthusiasm – the original renewable energy.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:media-text -->

			<!-- wp:spacer {"height":87} -->
			<div style="height:87px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:separator {"className":"is-style-wide"} -->
			<hr class="wp-block-separator is-style-wide"/>
			<!-- /wp:separator -->

			<!-- wp:spacer {"height":59} -->
			<div style="height:59px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:heading {"textAlign":"center","level":1} -->
			<h1 class="has-text-align-center">The Founders</h1>
			<!-- /wp:heading -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:columns -->
			<div class="wp-block-columns"><!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":507,"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf17.jpg" alt="" class="wp-image-507"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3>Victoria H. Alfonso</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"normal"} -->
			<p class="has-normal-font-size">Saw of midst lesser man air forth is moved moveth man seasons creature morning set living said green evening given together herb gathering days. Moved make. Moving image.</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":40} -->
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":508,"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf18.jpg" alt="" class="wp-image-508"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3>Mike M. Talley</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"normal"} -->
			<p class="has-normal-font-size">Light. Fruitful land make you’ll hath have fish days you.<br>Beast great divide Appear god years for shall under you’ll fruit great you dry moving be lights fruitful. Moving behold void Itself face subdue.</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":40} -->
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer --></div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":509,"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf19.jpg" alt="" class="wp-image-509"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3>Evelyn Ewing</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"normal"} -->
			<p class="has-normal-font-size">Saw of midst lesser man air forth is moved moveth man seasons creature morning set living said green evening given together herb gathering days. Moved make. Moving image.</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":40} -->
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->

			<!-- wp:media-text {"align":"full","mediaPosition":"right","mediaId":510,"mediaLink":"https://purefashion.fuelthemes.net/about-us/pf20/","mediaType":"image","mediaWidth":59,"style":{"color":{"background":"#404b3b"}}} -->
			<div class="wp-block-media-text alignfull has-media-on-the-right is-stacked-on-mobile has-background" style="background-color:#404b3b;grid-template-columns:auto 59%"><figure class="wp-block-media-text__media"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf20-1024x535.jpg" alt="" class="wp-image-510 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"style":{"color":{"text":"#f4ead5"}}} -->
			<h2 class="has-text-color" style="color:#f4ead5">We’re Here To<br>Help You.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"normal","style":{"color":{"text":"#f4ead5"}}} -->
			<p class="has-text-color has-normal-font-size" style="color:#f4ead5">Join our Design Advice Team and help us<br>decide all the details, like what pieces to<br>launch and what they should look like.<br>Get sneak peeks at new designs and<br>sign up for waiting lists.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:media-text -->',
		)
	// phpcs:enable
	);

	register_block_pattern(
		'pure-fashion/contactpage',
		array(
			'title'      => esc_html__( 'Contact Page', 'pure-fashion' ),
			'keywords'   => array( 'pure', 'purefashion', 'pure-fashion', 'page' ),
			'categories' => array( 'purefashion' ),
			// phpcs:disable
			'content' => '<!-- wp:media-text {"align":"","mediaId":511,"mediaLink":"https://purefashion.fuelthemes.net/contact-us/pf21/","mediaType":"image","mediaWidth":59,"textColor":"white","style":{"color":{"background":"#404b3b"}}} -->
			<div class="wp-block-media-text is-stacked-on-mobile has-white-color has-text-color has-background" style="background-color:#404b3b;grid-template-columns:59% auto"><figure class="wp-block-media-text__media"><img src="https://purefashion.fuelthemes.net/wp-content/uploads/2020/11/pf21.jpg" alt="" class="wp-image-511 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph {"align":"center","placeholder":"Content…","fontSize":"normal","style":{"color":{"text":"#f4ead5"}}} -->
			<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#f4ead5"><strong>PURE FASHION</strong><br>8212 E. Glen Creek Street Orchard Park,<br>NY 14127, United States of America</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center","placeholder":"Content…","fontSize":"normal","style":{"color":{"text":"#f4ead5"}}} -->
			<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#f4ead5">Phone: +1 909969 0383<br>Email: hello@fuelthemes.net</p>
			<!-- /wp:paragraph -->

			<!-- wp:spacer {"height":20} -->
			<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->

			<!-- wp:paragraph {"align":"center","fontSize":"normal","style":{"color":{"text":"#f4ead5"}}} -->
			<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#f4ead5"><strong>STORE HOURS</strong><br>Monday–Saturday 11am–7pm<br>ET Sunday 11am–6pm ET</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:media-text -->

			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->',
		)
	// phpcs:enable
	);
	register_block_pattern_category(
		'purefashion',
		array( 'label' => esc_html__( 'Pure Fashion', 'pure-fashion' ) )
	);
}
add_action( 'init', 'thb_patterns_register_block_patterns' );

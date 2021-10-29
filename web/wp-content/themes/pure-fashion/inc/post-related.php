<?php
/**
 * Post related functions
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

// Post Categories.
function thb_categories( $article = false ) {
	if ( has_category() ) {
		?>
		<div class="post-category">
			<?php the_category( ', ' ); ?>
		</div>
		<?php
	}
}
add_action( 'thb_categories', 'thb_categories', 10, 1 );

// Article Title Before.
function thb_article_before_h1() {
	?>
	<aside class="thb-post-bottom">
		<?php if ( thb_customizer( 'article_cat', 1 ) ) { ?>
			<?php do_action( 'thb_categories', true ); ?>
		<?php } ?>
		<?php if ( thb_customizer( 'article_date', 1 ) ) { ?>
			<div class="thb-post-date">
				<?php echo get_the_date(); ?>
			</div>
		<?php } ?>
	</aside>
	<?php
}
add_action( 'thb_article_before_h1', 'thb_article_before_h1', 10 );

// Article Title After.
function thb_article_after_h1() {
	?>
	<?php if ( thb_customizer( 'article_author_name', 1 ) ) { ?>
	<aside class="thb-article-meta">
		<div class="post-author">
			<em><?php esc_html_e( 'by', 'pure-fashion' ); ?></em>
			<?php the_author_posts_link(); ?>
		</div>
	</aside>
	<?php } ?>
	<?php
}
add_action( 'thb_article_after_h1', 'thb_article_after_h1', 10 );

// Article End.
function thb_article_end() {
	?>
	<div class="thb-article-bottom">
		<div class="row align-middle">
			<div class="small-12 medium-6 columns">
				<?php get_template_part( 'inc/templates/post-detail-bits/post-tags' ); ?>
			</div>
			<div class="small-12 medium-6 columns">
				<?php get_template_part( 'inc/templates/post-detail-bits/post-sharing' ); ?>
			</div>
		</div>
	</div>
	<?php
	get_template_part( 'inc/templates/post-detail-bits/post-nav' );
}
add_action( 'thb_article_end', 'thb_article_end' );


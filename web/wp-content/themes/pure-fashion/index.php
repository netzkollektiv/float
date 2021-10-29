<?php
/**
 * Index
 *
 * Main index file for the theme.
 *
 * @package WordPress
 * @subpackage pure-fashion
 */

?>
<?php get_header(); ?>
<div class="row">
	<div class="small-12 columns">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'inc/templates/post-styles/post-style2' );
			endwhile;
		endif;

		the_posts_pagination(
			array(
				'prev_text' => '',
				'next_text' => '',
				'mid_size'  => 2,
			)
		);
		?>
	</div>
</div>
<?php
get_footer();

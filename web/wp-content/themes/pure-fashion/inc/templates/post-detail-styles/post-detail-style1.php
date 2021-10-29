<?php
/**
 * Post Detail Page
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

?>
<div class="post-detail-row">
	<div class="row">
		<div class="small-12 columns">
			<?php
			if ( has_post_thumbnail() ) {
				?>
				<div class="thb-article-featured-image">
					<?php the_post_thumbnail( 'full' ); ?>
				</div>
				<?php
			}
			?>
			<div class="post-wrapper">
				<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post post-detail post-detail-style1' ); ?> id="post-<?php the_ID(); ?>">
					<?php do_action( 'thb_article_start' ); ?>
					<div class="post-content-container">
						<div class="post-title-container">
							<?php do_action( 'thb_article_before_h1' ); ?>
							<header class="post-title entry-header">
								<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
							</header>
							<?php do_action( 'thb_article_after_h1' ); ?>
						</div>
						<?php do_action( 'thb_before_content' ); ?>
						<div class="post-content entry-content" itemprop="articleBody">
							<?php the_content(); ?>
						</div>
						<?php do_action( 'thb_after_content' ); ?>
					</div>
					<?php do_action( 'thb_article_end' ); ?>
				</article>
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</div>
		</div>
	</div>
</div>

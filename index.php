<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AcmeThemes
 * @subpackage Education Base
 */
get_header();
global $education_base_customizer_all_values;
$education_base_enable_feature = $education_base_customizer_all_values['education-base-enable-feature'];

$education_base_blog_archive_layout = $education_base_customizer_all_values['education-base-blog-archive-layout'];
$education_base_content_part = get_post_format();
if( 'full-image' == $education_base_blog_archive_layout ) {
	$education_base_content_part = 'full';
}
if(
	( is_home() && is_front_page() && 1 != $education_base_enable_feature )
	|| !is_front_page()
){
	?>
	<div class="wrapper inner-main-title">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<div class="container">
				<header class="entry-header slideInUp1">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
					if( 1 == $education_base_customizer_all_values['education-base-show-breadcrumb'] ){
						education_base_breadcrumbs();
					}
					?>
				</header><!-- .entry-header -->

			</div>
		<?php endif; ?>
	</div>
	<?php
}
?>
	<div id="content" class="site-content container clearfix">
		<?php
		$sidebar_layout = education_base_sidebar_selection(get_the_ID());
		if( 'both-sidebar' == $sidebar_layout ) {
			echo '<div id="primary-wrap" class="clearfix">';
		}
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
						get_template_part( 'template-parts/content', $education_base_content_part );
					
					endwhile;
					/**
					 * read_more_action_navigation hook
					 * @since Read More 1.0.0
					 *
					 * @hooked: education_base_posts_navigation - 10
					 *
					 */
					do_action( 'education_base_action_navigation' );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif; ?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		get_sidebar( 'left' );
		get_sidebar();

		if( 'both-sidebar' == $sidebar_layout ) {
			echo '</div>';
		}
		?>

	</div><!-- #content -->
<?php get_footer();?>

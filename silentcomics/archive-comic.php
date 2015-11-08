<?php
/**
 * Template Name: Archive all comics
 * The template for displaying comic Archives pages. 
 * This template provides an overview to peruse all stories — it also has links to custom comic posts in a second loop 
 *
 * @package SilentComics
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-content" role="main">
				
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
				<?php
					printf( __( 'STORIES %s', 'silentcomics' ), '<span>' .
					single_cat_title( '', false ) . '</span>' );
					?>
					</h1>
				
				<h3 class="page-title"> 
				Watch and follow 3
					</h3>
					<h2 class="taxonomy-description">
	<a href="<?php echo esc_url( home_url( '/stories/' ) ); ?>">Series</a></h2>
	
				
					<h3 class="comic-title">
					<a href="http://localhost:8888/shizukana/story/exile/">ExIle</a></h3>
					<h3 class="comic-title">
					<a href="http://localhost:8888/shizukana/story/tofu/">Morning Tofu Chase</a></h3>
					<h3 class="comic-title">
					<a href="http://localhost:8888/shizukana/sentient-drone">Sentient Drone</a></h3>
					
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

<?php 
$args = array(
  'post_type'=>'story',
  'title_li'=> __('story')
);
wp_list_pages( $args ); 
?> 
			
<?php // Create and run first loop in reverse order
    $comic = new WP_Query();
    $comic = new WP_Query( array(
					'post_type' => 'comic',
					'showposts' => -1, 
					'paged'		=> $paged,
					'orderby'   => 'title',
					'order'   	=> 'ASC',)
					);
    while ($comic->have_posts()) : $comic->the_post();   
				
				get_template_part( 'content-comic' );
				// to style it like the blog entry page, change to 'content' ?> 

						<?php endwhile;
						wp_reset_postdata(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive-comic' ); ?>

		<?php endif; 
			wp_reset_postdata();
		?>

		</main><!-- #main -->
	</section><!-- #primary -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>
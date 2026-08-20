<?php
/*
Template Name: Process
*/
?>

<?php get_header(); ?>

<div id="container">
<div id="one-column-content">
<h2 class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/process-title.jpg" alt="Process" width="940" height="105"  /></h2>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- #post-->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<!-- .entry-content -->
<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
</div>
<!-- .entry-content-END -->

</div>
<!-- #post-END -->


<?php endwhile; ?>

</div><!-- #one-column-content -->
</div><!-- #container -->

<?php get_footer(); ?>

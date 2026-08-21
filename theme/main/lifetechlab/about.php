<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>

<div id="container">
<div id="content" role="main">
<h2 class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/about-title.jpg" alt="ABOUT" width="720" height="105"  /></h2>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- #post-->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_front_page() ) { ?>
<h2 class="entry-title"><?php the_title(); ?></h2>
<?php } else { ?>
<h1 class="main-title"><?php the_title(); ?></h1>
<?php } ?>

<!-- .entry-content -->
<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
</div>
<!-- .entry-content-END -->

</div>
<!-- #post-END -->


<?php endwhile; ?>

</div><!-- #content -->
</div><!-- #container -->

<?php include ( TEMPLATEPATH . '/sidebar-about.php'); ?>
<?php get_footer(); ?>

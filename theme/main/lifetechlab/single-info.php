<?php get_header(); ?>

<div id="container">
<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- #post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h1 class="entry-title"><?php the_title(); ?></h1>

<!-- .entry-meta-->
<div class="entry-meta">
<?php twentyten_posted_on(); ?>
</div>
<!-- .entry-meta-END-->

<!-- .entry-content-->
<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
</div>
<!-- .entry-content-END -->

<!-- .entry-utility -->
<div class="entry-utility">
<?php twentyten_posted_in(); ?>
<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<!-- .entry-utility-END -->

</div>
<!-- #post-END -->

<!-- #nav-below -->
<div id="nav-below" class="navigation">
<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
</div>
<!-- #nav-below-END -->


<?php endwhile; // end of the loop. ?>

</div>
<!-- #content -->
</div>
<!-- #container -->


<?php include ( TEMPLATEPATH . '/sidebar-info.php'); ?>
<?php get_footer(); ?>

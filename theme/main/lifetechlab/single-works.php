<?php get_header(); ?>

<div id="container">
<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- #post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h1 class="entry-title"><?php the_title(); ?></h1>

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



<?php endwhile; // end of the loop. ?>

<table width="100%" cellspacing="0" cellpadding="3" class="lifetable">
  <tr>
    <td width="20%" align="center"><a href="http://ltl.co.jp/inquiry/"><img src="http://ltl.co.jp/wp/wp-content/uploads/2012/07/inquiry.jpg" alt="" title="inquiry" width="650" height="60" /></a>
</td>
  </tr>
</table>

</div>
<!-- #content -->
</div>
<!-- #container -->


<?php include ( TEMPLATEPATH . '/sidebar-works.php'); ?>
<?php get_footer(); ?>

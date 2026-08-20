<?php get_header(); ?>

<div id="container">
<div id="one-column-content">

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

<?php endwhile; // end of the loop. ?>

<table width="100%" cellspacing="0" cellpadding="3" class="lifetable">
  <tr>
    <?php $upload_dir = wp_upload_dir('2012/07'); ?>
    <td width="20%" align="center"><a href="<?php echo esc_url( home_url( '/inquiry/' ) ); ?>"><img src="<?php echo esc_url( $upload_dir['url'] . '/inquiry.jpg' ); ?>" alt="" title="inquiry" width="650" height="60" /></a>
</td>
  </tr>
</table>

</div>
<!-- #one-column-content -->
</div>
<!-- #container -->


<?php get_footer(); ?>

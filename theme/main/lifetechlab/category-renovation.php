<?php /** Works-renovation */ ?>

<?php get_header(); ?>

<!-- #container -->
<div id="container">

<!-- #content -->
<div id="content" role="main">

<h2 class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/works-title-re.jpg" alt="リフォーム" width="720" height="105"  /></h2>

<ul class="houselist">
<?php
if (have_posts()) : while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>">
<?php the_post_thumbnail(array(230,160)); ?></a><br />
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
</li> 
<?php endwhile; endif; wp_reset_query(); ?> 
</ul>

<table width="100%" cellspacing="0" cellpadding="3" class="lifetable">
  <tr>
    <?php $upload_dir = wp_upload_dir('2012/07'); ?>
    <td width="20%" align="center"><a href="<?php echo esc_url( home_url( '/inquiry/' ) ); ?>"><img src="<?php echo esc_url( $upload_dir['url'] . '/inquiry.jpg' ); ?>" alt="" title="inquiry" width="650" height="60" /></a>
</td>
  </tr>
</table>

<div align="center"><?php wp_pagenavi(); ?></div>

</div><!-- #content -->
</div><!-- #container -->

<?php include ( TEMPLATEPATH . '/sidebar-renovation.php'); ?>
<?php get_footer(); ?>

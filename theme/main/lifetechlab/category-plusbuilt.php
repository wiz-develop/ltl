<?php /** Works-plusbuilt */ ?>

<?php get_header(); ?>

<!-- #container -->
<div id="container">

<!-- #content -->
<div id="content" role="main">

<h2 class="logo"><img src="/wp/wp-content/themes/lifetechlab/images/works-title-plus.jpg" alt="増改築" width="720" height="105"  /></h2>

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
    <td width="20%" align="center"><a href="http://ltl.co.jp/inquiry/"><img src="http://ltl.co.jp/wp/wp-content/uploads/2012/07/inquiry.jpg" alt="" title="inquiry" width="650" height="60" /></a>
</td>
  </tr>
</table>

<div align="center"><?php wp_pagenavi(); ?></div>

</div><!-- #content -->
</div><!-- #container -->

<?php include ( TEMPLATEPATH . '/sidebar-plusbuilt.php'); ?>
<?php get_footer(); ?>

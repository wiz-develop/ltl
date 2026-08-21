<?php /** Blog */ ?>

<?php get_header(); ?>

<!-- #container -->
<div id="container">

<!-- #content -->
<div id="content" role="main">

<h2 class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/blog-title2.jpg" alt="BLOG" width="720" height="105"  /></h2>

<?php
$category_description = category_description();
if ( ! empty( $category_description ) )
echo '<div class="archive-meta">' . $category_description . '</div>';
get_template_part( 'loop', 'category' );
?>

<div align="center"><?php wp_pagenavi(); ?></div>

</div><!-- #content -->
</div><!-- #container -->

<?php include ( TEMPLATEPATH . '/sidebar-blog.php'); ?>
<?php get_footer(); ?>

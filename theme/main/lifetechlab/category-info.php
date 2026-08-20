<?php /** INFORMATION */ ?>

<?php get_header(); ?>

<!-- #container -->
<div id="container">

<!-- #content -->
<div id="content" role="main">

<h2 class="logo"><img src="/wp/wp-content/themes/lifetechlab/images/info-title2.jpg" alt="Information" width="720" height="105"  /></h2>

<?php
$category_description = category_description();
if ( ! empty( $category_description ) )
echo '<div class="archive-meta">' . $category_description . '</div>';
get_template_part( 'loop', 'category' );
?>

<div align="center"><?php wp_pagenavi(); ?></div>

</div><!-- #content -->
</div><!-- #container -->

<?php include ( TEMPLATEPATH . '/sidebar-info.php'); ?>
<?php get_footer(); ?>

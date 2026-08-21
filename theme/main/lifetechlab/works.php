<?php
/*
Template Name: Works
*/
?>


<?php get_header(); ?>

<!-- #container -->
<div id="container">

<!-- #content -->
<div id="content" role="main">

<h2 class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/works-title.jpg" alt="Works" width="760" height="105"  /></h2>

<?php if ( have_posts() ) : query_posts('showposts=5&cat=5'); ?>
<!-- #�V�z�@�ꗗ�X�^�[�g�� -->
<ul class="gallery">
<li class="gallery-thumb">
<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(180,120) ); ?></a><br />
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
<?php endif; ?>
</ul>
<!-- #�V�z�@�ꗗEND�� -->


<?php if ( have_posts() ) : query_posts('showposts=5&cat=6'); ?>
<!-- #�����z�@�ꗗ�X�^�[�g�� -->
<ul class="gallery">
<li class="gallery-thumb">
<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(180,120) ); ?></a><br />
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
<?php endif; ?>
</ul>
<!-- #�����z�@�ꗗEND�� -->


</div><!-- #content -->
</div><!-- #container -->

<?php include ( TEMPLATEPATH . '/sidebar-works.php'); ?>
<?php get_footer(); ?>
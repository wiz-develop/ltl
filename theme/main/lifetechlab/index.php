<?php include ( TEMPLATEPATH . '/header.php'); ?>

<!-- ▼スライドショー -->



<div class="flexslider">
   <ul class="slides">
    <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'orderby' => 'rand',
            'cat' => 4,
            'date_query' => array(
                array(
                    'inclusive' => true,
                    'after' => '2018/1/1',
                ),
            ),
        );
        $randimg_query = new WP_Query( $args );

        while ( $randimg_query->have_posts() ) :
            $randimg_query->the_post();
            $id = get_the_ID();
    ?>
        <li>
            <a href="<?php echo get_permalink($id); ?>"><?php echo get_the_post_thumbnail($id,array(954,470)); ?></a>
            <p class="flex-caption"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
        </li>
    <?php
        endwhile;
        wp_reset_postdata();
    ?>
    </ul>
</div>



<!-- #top-content -->
<div id="top-content" role="main">

<!-- #information -->
<div id="information">
<h2>Information</h2>

<!-- #entry-summary-->
<div id="entry-summary">
<?php if ( have_posts() ) : query_posts('showposts=8&cat=1'); ?>
<!-- .entry-content -->
<div class="entry-content">
<ul>
<?php while (have_posts()) : the_post(); ?>
<li class="news-line"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow1.gif" alt="" width="15" height="15" /><span class="date"><?php the_time('Y.m.d'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
<?php endif; ?>
</div>
<!-- .entry-content-END -->
</div>
<!-- #entry-summary-END-->

<p><a href="<?php bloginfo('url'); ?>/category/info/">過去ログはこちら <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow2.gif" alt="" width="13" height="12" /></a></p>
</div>
<!-- #information END -->

<!-- #blog -->
<div id="blog">
<h2>Blog</h2>

<!-- blog最新2件 -->
<!-- #entry-summary-->
<div id="entry-summary">
<!-- .entry-content -->
<div class="entry-content">
<ul class="gallery">
<?php query_posts('cat=3&showposts=2');?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php if( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
<li class="gallery-thumb">
<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(215,130)); ?></a><br />
<span class="days"><?php the_time('Y.m.d'); ?></span><br />
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blogTitle"><?php the_title(); ?></a><br />
<?php the_excerpt(); ?></li>
<?php else: // サムネイルを持っていないときの処理 ?>
<li class="gallery-thumb">
<a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/dummy.jpg" alt="" width="215" height="130" /></a><br />
<span class="days"><?php the_time('Y.m.d'); ?></span><br />
<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="blogTitle"><?php the_title(); ?></a><br />
<?php the_excerpt(); ?></li>
<?php endif; ?>
<?php endwhile;?>
<?php endif; ?>
</ul>
</div>
<!-- .entry-content-END -->
</div>
<!-- #entry-summary-END-->
<!-- blog最新2件 END-->


<p><a href="<?php bloginfo('url'); ?>/category/blog/">過去ログはこちら <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow2.gif" alt="" width="13" height="12" /></a></p>
</div>
<!-- #blog END-->

</div>
<!-- #top-content END -->
        
<?php get_footer(); ?>

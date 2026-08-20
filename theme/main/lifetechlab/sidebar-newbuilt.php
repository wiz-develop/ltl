<?php /** Works */ ?>

<div id="primary" class="widget-area" role="complementary">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/works-side-title.gif" alt="works" width="200" height="20" />
<br /><br />
<ul class="xoxo">
<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
<li id="search" class="widget-container widget_search">
<?php get_search_form(); ?>
</li>

<li id="category" class="widget-container">
<ul><?php wp_list_categories('include=5'); ?></ul>
</li>
<?php endif; // end primary widget area ?>
</ul>

<p class="bold">List</p>
<p>
<?php query_posts('cat=5'); if (have_posts()) : while (have_posts()) : the_post(); ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
<?php endwhile; endif; wp_reset_query(); ?> 



</div><!-- #primary .widget-area -->
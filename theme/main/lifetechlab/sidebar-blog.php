<?php /** BLOG */ ?>

<div id="primary" class="widget-area" role="complementary">
<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/blog-side-title.gif" alt="BLOG" width="200" height="20" />
<br /><br />
<ul class="xoxo">
<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
<li id="search" class="widget-container widget_search">
<?php get_search_form(); ?>
</li>

<li id="archives" class="widget-container">
<p class="widget-title">月別アーカイブ</p>
<ul><?php wp_get_archives('cat=3'); ?></ul>
</li>


<?php endif; // end primary widget area ?>
</ul>
</div><!-- #primary .widget-area -->

<?php /** INFORMATIONページのサイドバーテンプレ */ ?>

<div id="primary" class="widget-area" role="complementary">
<img src="/wp/wp-content/themes/lifetechlab/images/info-side-title.gif" alt="INFORMATION" width="200" height="20" />
<br /><br />
<ul class="xoxo">
<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
<li id="search" class="widget-container widget_search">
<?php get_search_form(); ?>
</li>

<li id="archives" class="widget-container">
<p class="widget-title">月別アーカイブ</p>
<ul><?php wp_get_archives('cat=1'); ?></ul>
</li>


<?php endif; // end primary widget area ?>
</ul>
</div><!-- #primary .widget-area -->


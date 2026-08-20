<?php get_header(); ?>

<div id="container">
<div id="content" role="main">

<?php if ( have_posts() ) : ?>
<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
<?php get_template_part( 'loop', 'search' ); ?>
<?php else : ?>

<!-- #post-0 -->
<div id="post-0" class="post no-results not-found">
<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>

<!-- .entry-content -->
<div class="entry-content">
<p><?php _e( 'お探しの記事が見つかりませんでした。言葉を変えて再度検索してみてください。', 'twentyten' ); ?></p>
<?php get_search_form(); ?>
</div>
<!-- .entry-content-END -->

</div>
<!-- #post-0-END-->

<?php endif; ?>
</div>
<!-- #content -->
</div>
<!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

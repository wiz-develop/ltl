<?php get_header(); ?>

<div id="container">
<div id="one-column-content">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php if ( ! empty( $post->post_parent ) ) : ?>
<p class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'twentyten' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
printf( __( '<span class="meta-nav">&larr;</span> %s', 'twentyten' ), get_the_title( $post->post_parent ) );
?></a></p>
<?php endif; ?>

<!-- #post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h3 class="entry-title"><?php the_title(); ?></h3>

<!-- .entry-meta -->
<div class="entry-meta">

<?php
printf( __('<span class="%1$s">Published</span> %2$s', 'twentyten'),
'meta-prep meta-prep-entry-date',
sprintf( '<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
esc_attr( get_the_time() ),
get_the_date()
)
);
if ( wp_attachment_is_image() ) {
echo ' <span class="meta-sep">|</span> ';
$metadata = wp_get_attachment_metadata();
printf( __( 'Full size is %s pixels', 'twentyten'),
sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
wp_get_attachment_url(),
esc_attr( __('Link to full-size image', 'twentyten') ),
$metadata['width'],
$metadata['height']
)
);
}
?>
</div>
<!-- .entry-meta-END -->

<!-- .entry-content -->
<div class="entry-content">

<!-- .entry-attachment -->
<div class="entry-attachment">
<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// ギャラリーに1枚以上の画像があった場合
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// 次の画像へのURLを取得する
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// もしくは1枚目の画像のURLを取得する
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// もし1枚しかない場合は、その1枚の画像のURLを取得する
		$next_attachment_url = wp_get_attachment_url();
	}
?>
<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php $attachment_size = apply_filters( 'twentyten_attachment_size', 900 );
echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // フィルターを通した画像の幅とともに、高さも制限がない
?></a></p>

</div><!-- #nav-below -->
<div id="nav-below" class="navigation">
<div class="nav-previous"><?php previous_image_link( false ); ?></div>
<div class="nav-next"><?php next_image_link( false ); ?></div>
</div>
<!-- #nav-below-END-->
<?php else : ?>

<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>
</div>
<!-- .entry-attachment-END-->

<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>
<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
</div>
<!-- .entry-content-END -->


</div>
<!-- #post-END -->


<?php endwhile; ?>

</div><!-- #one-column-content -->
</div><!-- #container -->
<?php get_footer(); ?>

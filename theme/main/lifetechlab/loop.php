<?php
/**
 * 高橋メモヾ（゜д゜；）ノ消したらアカン★重要★：
 * 
 * loop.phpは投稿を表示する時の指示関数。
 * 
 * 【注】各loopの投稿表示数は、管理画面の投稿数設定に依存しているため
 * 投稿数をカスタマイズする場合は、各PHPデータの記述を変える必要あり
 *  category-3.phpを参照してください（住宅施工事例は１ページ30表示）
 * （▲2010.10.13　追記）
 * 
 * ▼下記を参照▼
 * http://codex.wordpress.org/The_Loop
 * http://codex.wordpress.org/Template_Tags
 * 
 * 子テーマ使用の場合、親loop.php/loop-template.phpを無効にすることができる。
 * loop-template.phpの'template'はリクエストされた文脈を繰り返すという意。
 * 例えばloop-index.phpはそれが存在して、なおかつ
 * <code>get_template_part( 'loop', 'index' );</code>と書くことで
 * 使うことができるようになる。
 * 
 * ●が各命令文。
 * 
 */
?>

<?php /* ●前のページが存在している時に次ページへのナビを表示● */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

<!-- #nav-above -->
<div id="nav-above" class="navigation">
<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
</div>
<!-- #nav-above-END-->

<?php endif; ?>

<?php /* ●何の投稿もない場合● */ ?>
<?php if ( ! have_posts() ) : ?>

<!-- #post-0-->
<div id="post-0" class="post error404 not-found">
<h1 class="entry-title"><?php _e( '何も見つかりませんでした。', 'twentyten' ); ?></h1>
<!-- .entry-content -->
<div class="entry-content">
<p><?php _e( 'お探しの記事が見つかりませんでした。検索フォームから探してみてください。', 'twentyten' ); ?></p>
<?php get_search_form(); ?>
</div>
<!-- .entry-content-END-->
</div>
<!-- #post-0-END-->
<?php endif; ?>

<?php
	/* loopをスタートさせる
	 * 複雑なコンテキストの中で同じloopを使うことができる。
	 * 
	 * ▼下記の３つの主なパーツで使用が可能▼
	 * １．ギャラリーカテゴリに投稿する場合。
	 * ２．asidesカテゴリに投稿する場合。
	 * ３．全てのその他の投稿の場合。
　　 * 
	 * 加えてアーカイブページにいるか、検索ページにいるかをチェックする。
	 * それぞれのテンプレートのloopでの小さな違いは許可し、
	 * 二重loopなくシェアする。
	 * 
	 */ ?>
     
<?php while ( have_posts() ) : the_post(); ?>

<?php 
    /* ●ギャラリーでの表示方法●
	 * 
	 * 住宅施工事例では下記のloopは適用外のため使用していない。
	 * 
	 * デフォルト通りの使い方をする場合、管理画面のカテゴリで
	 * 該当カテゴリのslugに「gallery」と入力し、
	 * 必ず「category-gallery.php」を作成すること（中身はcategory.phpと同じでOK）
	 * 
     */ 
	 ?>

<?php if ( in_category( _x('gallery', 'gallery category slug', 'twentyten') ) ) : ?>

<!-- #post-->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<!-- 投稿した日付-->
<div class="entry-meta">
<?php twentyten_posted_on(); ?>
</div>
<!-- 投稿した日付-END-->

<!-- .entry-content -->
<div class="entry-content">
<?php if ( post_password_required() ) : ?>
<?php the_content(); ?>
<?php else : ?>			
<?php 
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
if ( $images ) :
$total_images = count( $images );
$image = array_shift( $images );
$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>

<!-- サムネイル画像表示 -->
<div class="gallery-thumb">
<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
</div>
<!-- サムネイル画像表示-END -->

<?php                       
/* 削除中。「このギャラリーには●枚の画像を含みます」の表示部分
<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'twentyten' ),
'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
$total_images
); ?></em></p>
*/
?>
                        
<?php endif; ?>

<!-- 本文（抜粋の表示） -->
<?php the_excerpt(); /* （注）日本語表示の場合、プラグイン「WP Multibyte Patch」を有効にしておかないと「続きを読む」がクリックできない現象が発生する */ ?>
<!-- 本文（抜粋の表示）-END -->

<?php endif; ?>
</div>
<!-- .entry-content -->
            
<?php
/* これも現在削除中。コメントリンクや編集リンクの表示箇所
<div class="entry-utility">
<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'twentyten'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
<span class="meta-sep">|</span>
<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
</div><!-- .entry-utility -->
*/
?>
            
</div>
<!-- #post-END -->

<?php /* ●asidesでの表示方法● */ ?>

<?php elseif ( in_category( _x('asides', 'asides category slug', 'twentyten') ) ) : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( is_archive() || is_search() ) : // アーカイブと検索からの引用を表示 ?>

<!-- .entry-summary -->
<div class="entry-summary">

<!-- 本文（抜粋の表示） -->
<?php the_excerpt(); /* （注）日本語表示の場合、プラグイン「WP Multibyte Patch」を有効にしておかないと「続きを読む」がクリックできない現象が発生する */ ?>
<!-- 本文（抜粋の表示）-END -->

</div>
<!-- .entry-summary-END-->

<?php else : ?>

<!-- .entry-content-->
<div class="entry-content">
<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
</div>
<!-- .entry-content-END-->

<?php endif; ?>
        
<?php
/*　これも現在削除中。コメントリンクや編集リンクの表示箇所
<div class="entry-utility">
<?php twentyten_posted_on(); ?>
<span class="meta-sep">|</span>
<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
</div>
<!-- .entry-utility -->
*/
?>

</div>
<!-- #post-END -->

<?php /* ●他の投稿の表示方法● */ ?>

<?php else : ?>

<!-- #post-->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

<!-- 投稿した日付 -->
<div class="entry-meta">
<?php twentyten_posted_on(); ?>
</div>
<!-- 投稿した日付-END -->

<?php if ( is_archive() || is_search() ) : // アーカイブと検索からの引用だけを表示 ?>

<!-- .entry-summary-->
<div class="entry-summary">
<!-- 本文（抜粋の表示） -->
<?php the_content(); 
/* （注）日本語表示の場合、プラグイン「WP Multibyte Patch」を有効にしておかないと「続きを読む」がクリックできない現象が発生する */ ?>
<!-- 本文（抜粋の表示）-END -->
</div>
<!-- .entry-summary-END-->

<?php else : ?>

<!-- .entry-content-->
<div class="entry-content">
<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
</div>
<!-- .entry-content-END-->

<?php endif; ?>

<?php
/* これも現在削除中。投稿した人の表示・タグ・コメントのリンク・編集リンクなど。
<div class="entry-utility">
<?php if ( count( get_the_category() ) ) : ?>
<span class="cat-links">
<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
</span>
<span class="meta-sep">|</span>
<?php endif; ?>
<?php
$tags_list = get_the_tag_list( '', ', ' );
if ( $tags_list ):
?>
<span class="tag-links">
<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?></span>
<span class="meta-sep">|</span>
<?php endif; ?>
<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
</div><!-- .entry-utility -->
*/
?>
</div>
<!-- #post-END -->

<?php /*非表示中。→<?php comments_template( '', true ); ?>　←*/ ?>

<?php endif; // 各カテゴリーのloopに対する命令終了 ?>

<?php endwhile; // loop終わり ?>



<?php /* ●前のページがある時、次ページへのリンクナビを表示させる● */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>

<!-- #nav-below -->
<div id="nav-below" class="navigation">
<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
</div>
<!-- #nav-below-END-->

<?php endif; ?>

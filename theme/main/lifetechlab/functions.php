<?php
if ( ! isset( $content_width ) )
	$content_width = 640;

/** ●「twentyten_setup()」がある時、「after_setup_theme」を加える● */
 
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):

function twentyten_setup() {

	// 「visual editor」（editor-style.css）のテーマスタイルと合わせる
	add_editor_style();

	// サムネイル画像を使ってます。
	add_theme_support( 'post-thumbnails' );
	/* set_post_thumbnail_size( 150, 150, true ); // 幅 150 ピクセル、高さ 150 ピクセル、切り抜きモード */

	// ヘッダーに、デフォルトの投稿とRSS-feedのコメントを付け加える。
	add_theme_support( 'automatic-feed-links' );

	// 翻訳のためのテーマ作りが利用可（翻訳機能は「languages」フォルダの中）
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// 「wp_nav_menu()」を使用
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// カスタム背景を設定することを許可
	add_custom_background();

	// 変えることができる背景の設定はここから
	define( 'HEADER_TEXTCOLOR', '' );
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :

/**
 * 　●ヘッダー画像のスタイル定義（ヘッダー管理者パネル）●
 * 「twentyten_setup()」の中の「add_custom_image_header()」を経由して参照
 */
function twentyten_admin_header_style() {
?>



<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>


<?php
} endif;

/**
 *　●「wp_nav_menu() 」は「wp_page_menu()」としてfallbackる●
 *  子テーマの中ではこれを無視し、関数を取り除き、独自関数を
 * 「wp_page_menu_args」に連携させる
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * ●投稿文からの抜粋の長さは60文字にする●
 * 子テーマではこれを無視し、関数を取り除き
 * 「excerpt_length」と連携させ独自の関数を追加する
 */
function twentyten_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * ●抜粋文のために "Continue Reading" リンクで返す●
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * ●"[...]" (自動的に生成抜粋に追加) を省略記号と
 * 「twentyten_continue_reading_link()」と、一緒に置換する。●
 *  子テーマではこれを無視し関数を取り除き、
 * 「excerpt_more」と独自関数を連携させる。 
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * ●カスタムポストの抜粋には"続きを読む"のリンクを追加する●
 * 子テーマではこのリンクを無視し関数を取り除き、
 * 「get_the_excerpt」と独自関数を連携させる
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * ●ギャラリーショートコードを使う時、インラインスタイル印刷は削除する●
 * ギャラリーはstyle.cssによってデザインされているのでstyle.cssを参照
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :

/**
 * ●コメントとピンバックのためのテンプレート●
 *
 * コメントテンプレートを変更せずに子テーマの中でこの動きを無視し、
 * 独自の「twentyten_comment（）」を作成し、使用される。
 * コメントを表示させるための「wp_list_comments」によって使われる。
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<div id="comment-<?php comment_ID(); ?>">

<!-- .comment-author .vcard-->
<div class="comment-author vcard">
<?php echo get_avatar( $comment, 40 ); ?>
<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
</div>
<!-- .comment-author .vcard -END-->

<?php if ( $comment->comment_approved == '0' ) : ?>
<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
<br />
<?php endif; ?>

<!-- .comment-meta .commentmetadata-->
<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<?php /* translators: 1: date, 2: time */
printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );?>
</div>
<!-- .comment-meta .commentmetadata-END-->

<div class="comment-body"><?php comment_text(); ?></div>

<!-- .reply -->
<div class="reply">
<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div>
<!-- .reply -END-->

</div>
<!-- #comment-END  -->
    
    

<?php
break;
case 'pingback'  :
case 'trackback' :
?>
<li class="post pingback">
<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p></li>
        
        
<?php
break;
endswitch;
}
endif;

/**
 * ●ウィジットの設定●
 *
 * 子テーマの中で「twentyten_widgets_init()」をオーバーライドさせるため、
 * action関数と初期化処理関数initに結びついている独自関数を取り除く
 */
function twentyten_widgets_init() {
	// Area 1, サイドバーのトップ
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, サイドバーのプライマーウィジット。デフォルトでは空。
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, フッター。デフォでは空。
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, フッター。デフォでは空
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, フッター。デフォでは空
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, フッター。デフォでは空。
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

/** ●「widgets_init hook」で「twentyten_widgets_init()」を動かすためにサイドバーを登録●　*/
add_action( 'widgets_init', 'twentyten_widgets_init' );

/**
 * ●「最近のコメント」ウィジットと同梱されているデフォルトのスタイルを取り除く●
 *
 * これを子テーマでオーバライドさせるため
 * 「widgets_init action」と一緒に機能している独自関数を取り除く
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :

/**
 * ●現在の投稿日付・投稿者情報のためにメタ情報をHTMLと一緒に出力する●
 */
 
function twentyten_posted_on() {
	printf( __( '%2$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<span class="entry-date">%3$s</span>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :

/**
 * ●現在の投稿（カテゴリ、タグ、パーマリンク）のためにメタ情報と一緒にHTMLを出力する●
 */
 
function twentyten_posted_in() {
	// 現在の投稿タグリストを回収し「,」で分ける
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">-</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">-</a>.', 'twentyten' );
	}
	// stringを出力し、プレイスホルダーを置き換える
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
?>


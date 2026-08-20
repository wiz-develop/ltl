<?php ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title>
<?php global $page, $paged;
wp_title( '|', true, 'right' );
bloginfo( 'name' );
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
echo " | $site_description";
if ( $paged >= 2 || $page >= 2 )
echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
?></title>
<meta name="keywords" content="ライフテックラボ,京都,建築事務所,中京区,二級建築士事務所,知事許可,リフォーム,新築,増改築,店舗,ツリーハウス" />
<meta name="description" content="京都市中京区にある二級建築事務所です" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="lifetechlab-feed" href="<?php bloginfo('url'); ?>/feed/" />
<link rel="stylesheet" href="http://ltl.co.jp/wp/wp-content/themes/lifetechlab/flexslider.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ltl.co.jp/wp/wp-content/themes/lifetechlab/js/jquery.flexslider.js"></script>
<?php wp_head(); ?>
<script type="text/javascript">
<!--gallery-->
$("document").ready(function(){
    $('.flexslider').flexslider();
});
<!--menu1-->
$(function(){
$("a#menu-call-about").mouseover(function()
	{
		$("ul#about").animate({height:"show",opacity:0.7},"slow");
		return false;
	});
$("ul#about").hover(
	function()
		{ 
			$("ul#about").animate({height:"show",opacity:0.7},"slow");
		},
	function()
		{ 
			$("ul#about").stop().animate({opacity:0.7},1).slideUp("slow");
			return false;
		});

}); 
<!--menu2-->
$(function(){
$("a#menu-call-works").mouseover(function() {
$("ul#works").animate({height:"show",opacity:0.7},"slow");
return false;
});
$("ul#works").hover(function(){},
function() { 
$("ul#works").animate({opacity:0.7},0).slideUp("slow");
},
function() { 
$("ul#works").stop().animate({opacity:0.7},1).slideUp("slow");
return false;
});

});  
		   
</script>



</head>

<body <?php body_class(); ?>>
<div id="ajastContainer">
<div id="wrapper" class="hfeed">
<div id="header">

<!-- #branding -->
<div id="branding">
<div id="logo">
<h1><a href="<?php bloginfo('url'); ?>"><img src="/wp/wp-content/themes/lifetechlab/images/logo-anime.gif" alt="LIFE TECH LAB" width="300" height="125" /></a></h1></div>
<div id="address">
<p>株式会社ライフテックラボ<br />
一般建設業　京都府知事許可（般-1）第35659号<br />
二級建築士事務所　京都府知事登録（02B）第02551号<br />
京都市中京区猩々町131<br />
TEL:075-253-0253 / FAX:075-253-0252</p>
</div>
</div>
<!-- /#branding -->

<!-- #access -->
<div id="access" role="navigation">

<!-- ▼メニュー -->
<div class="menu">
<ul>
<li id="mNavi01"><a href="<?php bloginfo('url'); ?>/about" id="menu-call-about">ABOUT</a>
           <div id="menu-container">
           <ul id="about">
            <li id="mNavi01-1"><a href="<?php bloginfo('url'); ?>/about">会社概要</a></li>
            <li id="mNavi01-2"><a href="<?php bloginfo('url'); ?>/about/concept/">コンセプト</a></li>
            <li id="mNavi01-3"><a href="<?php bloginfo('url'); ?>/about/accessmap/">アクセスマップ</a></li>
            <li id="mNavi01-4"><a href="<?php bloginfo('url'); ?>/about/link/">リンク</a></li>
            <li id="mNavi01-5"><a href="<?php bloginfo('url'); ?>/about/pp/">プライバシーポリシー</a></li>
          </ul>
          </div>
</li>
<li id="mNavi02"><a href="<?php bloginfo('url'); ?>/category/works" id="menu-call-works">WORKS</a>
          <div id="menu-container">
          <ul id="works">
          <ul>
            <li id="mNavi02-1"><a href="<?php bloginfo('url'); ?>/category/works/newbuilt/">新築</a></li>
            <li id="mNavi02-2"><a href="<?php bloginfo('url'); ?>/category/works/plusbuilt/">増改築</a></li>
            <li id="mNavi02-3"><a href="<?php bloginfo('url'); ?>/category/works/renovation/">リフォーム</a></li>
            <li id="mNavi02-4"><a href="<?php bloginfo('url'); ?>/category/works/store/">店舗</a></li>
          </ul>
          </div>
</li>
<li id="mNavi03"><a href="<?php bloginfo('url'); ?>/process">PROCESS</a></li>
<li id="mNavi04"><a href="<?php bloginfo('url'); ?>/category/blog">BLOG</a></li>
<li id="mNavi05"><a href="<?php bloginfo('url'); ?>/inquiry">INQUIRY</a></li>
</ul>
</div>
<!-- ▲メニューEND -->

</div><!-- /#access -->

</div><!-- #header -->

<div id="main">

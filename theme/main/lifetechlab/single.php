<?php
$post = $wp_query->post;

// cat=1 Information 
if ( in_category('1') ) {
include(TEMPLATEPATH.'/single-info.php');

// cat=3 BLOG 
} elseif ( in_category('3') ) {
include(TEMPLATEPATH.'/single-blog.php');

// cat=4 WORKS 
} elseif ( in_category('4') ) {
include(TEMPLATEPATH.'/single-works.php');

// cat=5 Newbuilt
} elseif ( in_category('5') ) {
include(TEMPLATEPATH.'/single-newbuilt.php');

// cat=6 plusbuilt
} elseif ( in_category('6') ) {
include(TEMPLATEPATH.'/single-plusbuilt.php');

// cat=7 renovation
} elseif ( in_category('7') ) {
include(TEMPLATEPATH.'/single-renovation.php');

// cat=8 store
} elseif ( in_category('8') ) {
include(TEMPLATEPATH.'/single-store.php');
} else {
	
// それ以外 
include(TEMPLATEPATH.'/single-other.php');
}
?>


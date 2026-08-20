<?php
/*
Template Name Posts: 増改築
*/
?>

<?php get_header(); ?>

<div id="container">
<div id="content" role="main">

<h2 class="logo"><img src="/wp/wp-content/themes/lifetechlab/images/works-title-plus.jpg" alt="増改築" width="720" height="105"  /></h2>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- #post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h1 class="entry-title"><?php the_title(); ?></h1>

<!-- .entry-content-->
<div class="entry-content">
<?php the_content(); ?>


<p class="ctitle">■お施主様データ</p>
<table class="housedata" width="720px">
<tr>
<td width="120px">お施主様：</td>
<td><?php echo get_post_meta($post->ID, 'お施主様', true); ?></td>
</tr>
<tr>
<td width="120px">設計・デザイン：</td>
<td><?php echo get_post_meta($post->ID, '設計・デザイン', true); ?></td>
</tr>
<tr>
<td width="120px">施工：</td>
<td><?php echo get_post_meta($post->ID, '施工', true); ?></td>
</tr>
<tr>
<td width="120px">業種：</td>
<td><?php echo get_post_meta($post->ID, '業種', true); ?></td>
</tr>
<tr>
<td width="120px">面積（坪）：</td>
<td><?php echo get_post_meta($post->ID, '面積（坪）', true); ?></td>
</tr>
<tr>
<td width="120px">施工費：</td>
<td><?php echo get_post_meta($post->ID, '施工費', true); ?></td>
</tr>
<tr>
<td width="120px">工期：</td>
<td><?php echo get_post_meta($post->ID, '工期', true); ?></td>
</tr>
<tr>
<td width="120px">工事種目：</td>
<td><?php echo get_post_meta($post->ID, '工事種目', true); ?></td>
</tr>
<tr>
<td width="120px">工事日：</td>
<td><?php echo get_post_meta($post->ID, '工事日', true); ?></td>
</tr>
<tr>
<td width="120px">備考：</td>
<td><?php echo get_post_meta($post->ID, '備考', true); ?></td>
</tr>
<tr>
<td width="120px">解説：</td>
<td><?php echo get_post_meta($post->ID, '解説', true); ?></td>
</tr>
<tr>
<td width="120px">LINK：</td>
<td><?php echo get_post_meta($post->ID, 'LINK', true); ?></td>
</tr>
<tr>
<td width="120px">住所：</td>
<td><?php echo get_post_meta($post->ID, '住所', true); ?></td>
</tr>
<tr>
<td width="120px">TEL：</td>
<td><?php echo get_post_meta($post->ID, 'TEL', true); ?></td>
</tr>
<tr>
<td width="120px">営業日：</td>
<td><?php echo get_post_meta($post->ID, '営業日', true); ?></td>
</tr>
<tr>
<td width="120px">定休日：</td>
<td><?php echo get_post_meta($post->ID, '定休日', true); ?></td>
</tr>
</table>

<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
</div>
<!-- .entry-content-END -->

<!-- .entry-utility -->
<div class="entry-utility">
<?php twentyten_posted_in(); ?>
<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<!-- .entry-utility-END -->

</div>
<!-- #post-END -->



<?php endwhile; // end of the loop. ?>

<table width="100%" cellspacing="0" cellpadding="3" class="lifetable">
  <tr>
    <td width="20%" align="center"><a href="http://ltl.co.jp/inquiry/"><img src="http://ltl.co.jp/wp/wp-content/uploads/2012/07/inquiry.jpg" alt="" title="inquiry" width="650" height="60" /></a>
</td>
  </tr>
</table>

</div>
<!-- #content -->
</div>
<!-- #container -->


<?php include ( TEMPLATEPATH . '/sidebar-plusbuilt.php'); ?>
<?php get_footer(); ?>

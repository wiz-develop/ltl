</div>
<!-- /#main -->

<p id="pageTop"><a href="#wrapper"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/totop.jpg" alt="PAGE TOP" width="150" height="30" /></a></p>

<p id="footer-illust"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer-illust.jpg" width="980" height="88" /></p>

</div>
<!-- #wrapper-END -->

<!-- #footer -->
<div id="footerbg">

<!-- #footer -->
<div id="footer">
<table width="950px" height="250px" align="center">
<tr>
<td width="190px"><span class="bold"><a href="/about">ABOUT</a></span></td>
<td width="190px"><span class="bold"><a href="/category/works/newbuilt/">WORKS - 新築</a></span></td>
<td width="190px"><span class="bold"><a href="/category/works/plusbuilt/">WORKS - リフォーム</a></span></td>
<td width="190px"><span class="bold"><a href="/category/works/renovation/">WORKS - 医院・薬局</a></span></td>
<td width="190px"><span class="bold"><a href="/category/works/store/">WORKS - 店舗</a></span></td>
</tr>
<tr>
<td width="190px">
<a href="/about">- 会社概要</a><br />
<a href="/about/concept/">- コンセプト</a><br />
<a href="/about/accessmap/">- アクセスマップ</a><br />
<a href="/about/link/">- リンク</a><br />
<a href="/about/pp/">- プライバシーポリシー</a><br />
<a href="/inquiry">- お問い合わせ</a><br />
<a href="/process">- 完成までの流れ</a><br />
<a href="/category/blog">- スタッフブログ</a><br />
<a href="/category/info/">- お知らせ</a>
</td>
<td width="190px"><?php query_posts('showposts=10&cat=5'); ?>
<ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>">- <?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
<?php wp_reset_query();?>
</td>
<td width="190px"><?php query_posts('showposts=10&cat=6'); ?>
<ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>">- <?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
<?php wp_reset_query();?>
</td>
<td width="190px"><?php query_posts('showposts=10&cat=7'); ?>
<ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>">- <?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
<?php wp_reset_query();?>
</td>
<td width="190px"><?php query_posts('showposts=10&cat=8'); ?>
<ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>">- <?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>
<?php wp_reset_query();?>
</td>
</tr>
</table>
</div>
<!-- #footer-END -->
</div>
<!-- #footerbg-END -->

<?php wp_footer();?>
</div>
<!-- #ajastContainer-END -->
<!-- SWC導入20130422 --> 
<script src="http://hei.a.swcs.jp/12/j/" type="text/javascript"></script> 
<!-- SWC導入20130422 --> 
</body>
</html>
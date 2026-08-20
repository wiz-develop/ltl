<?php
require_once('header.php');
?>

<!-- +++++++++++++++++++++++++++++++++++++++++++ -->


<?php if (is_category('info')): ?>
<!-- Informationここから -->
<?php
require_once('category-info.php');
require_once('sidebar-info.php');
?>
<!-- Informationここまで -->


<?php elseif (is_category('blog')): ?>
<!-- Blogここから -->
<?php
require_once('category-blog.php');
require_once('sidebar-blog.php');
?>
<!-- Blogここまで -->

<?php elseif (in_category('works')): ?>
<!-- 構築事例ここから -->
<?php
require_once('category-works.php');
require_once('sidebar-works.php');
?>
<!-- 構築事例ここまで -->

<?php elseif (is_category('newbuilt')): ?>
<!-- 新築ここから -->
<?php
require_once('category-newbuilt.php');
require_once('sidebar-newbuilt.php');
?>
<!-- 新築ここまで -->

<?php elseif (is_category('plusbuilt')): ?>
<!-- 増改築ここから -->
<?php
require_once('category-plusbuilt.php');
require_once('sidebar-plusbuilt.php');
?>
<!-- 増改築ここまで -->

<?php elseif (is_category('renovation')): ?>
<!-- リフォームここから -->
<?php
require_once('category-renovation.php');
require_once('sidebar-renovation.php');
?>
<!-- リフォームここまで -->

<?php elseif (is_category('store')): ?>
<!-- 店舗ここから -->
<?php
require_once('category-store.php');
require_once('sidebar-store.php');
?>
<!-- 店舗ここまで -->


<?php endif; ?>

<!-- +++++++++++++++++++++++++++++++++++++++++++ -->

<?php
require_once('footer.php');
?>


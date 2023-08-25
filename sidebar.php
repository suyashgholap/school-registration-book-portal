<?php
function activeside($currect_page)
{
  $url_array =  explode('/', $_SERVER['REQUEST_URI']);
  $url = end($url_array);
  if ($currect_page == $url) {
    echo 'active'; //class name in css 
  }
}
?>
<div class="sidebar">
  <a class="<?php activeside('index.php'); ?>" href="./index.php"> Search Student Data</a>
  <?php if ($_SESSION['prev_id'] == 1) : ?>
    <a class="<?php activeside('insert-student.php'); ?>" href="./insert-student.php">Insert Student Data</a>
  <?php endif; ?>
  <?php if ($_SESSION['prev_id'] == 1 || $_SESSION['prev_id'] == 3) : ?>
    <a class="<?php activeside('generate-bonafide.php'); ?>" href="./generate-bonafide.php">Generate Bonafide</a>
    <a class="<?php activeside('generate-lc.php'); ?>" href="./generate-lc.php">Generate Leaving Certificate</a>
    <a class="<?php activeside('generate-lc-duplicate.php'); ?>" href="./generate-lc-duplicate.php">Generate Duplicate Leaving Certificate</a>
    <a class="<?php activeside('generate-nirgam.php'); ?>" href="./generate-nirgam.php">Generate Student Nirgam</a>
  <?php endif; ?>
</div>
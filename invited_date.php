<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
  $date_array = get_invited_date($email);
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
do_html_header('受邀的聚会');
?>
  <div class="container">
    <?php if (isset($_SESSION['success'])){
      echo '<div class="alert alert-success">';
      echo $_SESSION['success'];
      echo "</div>";
      unset($_SESSION['success']);
    } ?>
    <div class="row-fluid">
      <div class="span9">
        <h2>受邀的聚会</h2>
        <br/>
        <?php
        do_html_table($date_array);
        ?>
      </div>

      <?php
      do_html_sidebar();
      ?>
    </div>
  </div>

<?php
do_html_footer();
?>
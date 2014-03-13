<?php
require_once('include.php');
session_start();
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
}
do_html_header('账户设置');
?>
  <div class="container">
    <form class="form-horizontal form-signin well"
          method="post" action="user_setting.php">
      <h2 class="form-signin-heading">账户设置</h2>
      <br/>
      <?php if (isset($_SESSION['error'])){
        echo '<div class="alert alert-error">';
        echo $_SESSION['error'];
        echo "</div>";
        unset($_SESSION['error']);
      } ?>
      <?php if (isset($_SESSION['success'])){
        echo '<div class="alert alert-success">';
        echo $_SESSION['success'];
        echo "</div>";
        unset($_SESSION['success']);
      } ?>

      <div class="control-group">
        <label class="control-label" for="email">邮箱</label>

        <div class="controls">
          <input type="text"
                 id="email" name="email" placeholder="邮箱"
            <?php
            echo 'value="';
            echo $email;
            echo '"';
            ?>
                 disabled>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="username">昵称</label>

        <div class="controls">
          <input type="text"
                 id="username" name="username" placeholder="昵称"
            <?php
            echo 'value="';
            echo get_name($email);
            echo '"';
            ?>
                 required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="phone">手机号码</label>

        <div class="controls">
          <input type="text"
                 id="phone" name="phone" placeholder="请输入手机号码"
            <?php
            echo 'value="';
            echo get_phone($email);
            echo '"';
            ?>
            >
        </div>
      </div>
      <button class="btn btn-large btn-primary" type="submit">
        &nbsp;保存&nbsp;
      </button>
    </form>
  </div>

<?php
do_html_footer();
?>
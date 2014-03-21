<?php ob_start();
session_start();
require_once('include.php');
do_html_header('修改密码');
if (!isset($_SESSION['valid_user'])){
  $_SESSION['log'] = "您还没有登录！";
  header("location:loading.php");
  exit();
}
?>
  <div class="container">
    <form class="form-horizontal form-signin well"
          method="post" action="change_passwd.php">
      <h2 class="form-signin-heading">修改密码</h2>
      <br/>
      <?php if (isset($_SESSION['error'])){
        echo '<div class="alert alert-error">';
        echo $_SESSION['error'];
        echo "</div>";
        unset($_SESSION['error']);
      } ?>

      <div class="control-group">
        <label class="control-label" for="old_passwd">旧密码</label>

        <div class="controls">
          <input type="password" id="old_passwd"
                 name="old_passwd" placeholder="旧密码" required autofocus>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="new_passwd">新密码</label>

        <div class="controls">
          <input type="password" id="new_passwd"
                 name="new_passwd" placeholder="新密码" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="new_passwd2">新密码</label>

        <div class="controls">
          <input type="password" id="new_passwd2"
                 name="new_passwd2" placeholder="再次输入新密码" required>
        </div>
      </div>
      <button class="btn btn-large btn-primary" type="submit">
        &nbsp;修改密码&nbsp;
      </button>
    </form>
  </div>
<?php
do_html_footer();
?>
<?php
session_start();
require_once('include.php');
do_html_header('重置密码');
?>
<div class="container">
  <form class="form-horizontal form-signin well"
        method="post" action="forgot_passwd.php">
    <h2 class="form-signin-heading">重置密码</h2>
    <br/>
    <?php if (isset($_SESSION['error'])){
      echo '<div class="alert alert-error">';
      echo $_SESSION['error'];
      echo "</div>";
      unset($_SESSION['error']);
    } ?>
    <div class="control-group">
      <label class="control-label" for="email">邮箱</label>

      <div class="controls">
        <input type="text"
               id="email" name="email" placeholder="邮箱"
          <?php
          if (isset($_SESSION['email'])){
            echo 'value="';
            echo $_SESSION['email'];
            echo '"';
          }
          ?>
               required autofocus>
      </div>
    </div>
    <button class="btn btn-large btn-primary" type="submit">
      &nbsp;发送新密码到邮箱&nbsp;
    </button>
  </form>
</div>
<?php
do_html_footer();
?>

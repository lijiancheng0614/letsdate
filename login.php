<?php
session_start();
require_once('include.php');
do_html_header('登录');
?>
  <div class="container">
    <form class="form-horizontal form-signin well"
          method="post" action="index.php">
      <h2 class="form-signin-heading">登录</h2>
      <br/>
      <?php
      if (isset($_SESSION['error'])){
        echo '<div class="alert alert-error">';
        echo $_SESSION['error'];
        echo "</div>";
        unset($_SESSION['error']);
      } ?>

      <div class="control-group">
        <label class="control-label" for="email">邮箱</label>

        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
              <input type="text"
                     name="email" placeholder="邮箱"
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
      </div>

      <div class="control-group">
        <label class="control-label" for="passwd">密码</label>

        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
              <input type="password"
                 id="passwd" name="passwd" placeholder="请输入密码" required>
          </div>
        </div>
      </div>
      <!--
      <label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    -->
      <button class="btn btn-large btn-success" type="submit">
        &nbsp;登录&nbsp;
      </button>

      <p>
        <br/>
      </p>

      <p>
        还没有账号？ <a href="register_form.php">立即注册！</a>
      </p>

      <p><a href="forgot_form.php">忘记密码</a></p>
    </form>
  </div>

<?php
do_html_footer();
?>
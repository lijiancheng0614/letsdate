<?php
session_start();
require_once('include.php');
do_html_header('注册');
?>
  <div class="container">
    <form class="form-horizontal form-signin well"
          method="post" action="register_new.php">
      <h2 class="form-signin-heading">注册</h2>
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
          <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
              <input type="text"
                 id="email" name="email" placeholder="邮箱" required autofocus>
          </div>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="username">昵称</label>

        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span>
              <input type="text"
                 id="username" name="username" placeholder="昵称"
            <?php
            if (isset($_SESSION['username'])){
              echo 'value="';
              echo $_SESSION['username'];
              echo '"';
            }
            ?>
                 required>
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
      <button class="btn btn-large btn-warning" type="submit">
        &nbsp;注册&nbsp;
      </button>
    </form>
  </div>
<?php
do_html_footer();
?>
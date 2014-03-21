<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
if (isset($_GET['user'])){
  $id = $_GET['user'];
}
$user = get_user_detail($id);
do_html_header($user['email']);
?>

  <div class="container">
    <div class="row-fluid">
      <div class="span9 form-horizontal well">
          <h2>用户资料</h2>
          <br/>
          <?php if (isset($_SESSION['error'])){
            echo '<div class="alert alert-error">';
            echo $_SESSION['error'];
            echo "</div>";
            unset($_SESSION['error']);
          } ?>

          <div class="control-group">
            <label class="control-label span2" for="email">邮箱</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="email" name="email"
                <?php
                echo 'value="';
                echo $user['email'];
                echo '"';
                ?>
                disabled>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label span2" for="name">昵称</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="name" name="name"
                <?php
                echo 'value="';
                echo $user['name'];
                echo '"';
                ?>
                disabled>
            </div>
          </div>

          <?php
            if (!$user['is_phone_private'] && $user['phone']){
          ?>
          <div class="control-group">
            <label class="control-label span2" for="phone">手机号码</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="phone" name="phone"
                <?php
                echo 'value="';
                echo $user['phone'];
                echo '"';
                ?>
                disabled>
            </div>
          </div>
          <?php
            }
          ?>

          <?php
            if (!$user['is_location_private'] && $user['location']){
          ?>
          <div class="control-group">
            <label class="control-label span2" for="location">所在地</label>

            <div class="controls">
              <input type="text" class="span9"
                     id="location" name="location"
                <?php
                echo 'value="';
                echo $user['location'];
                echo '"';
                ?>
                disabled>
            </div>
          </div>
          <?php
            }
          ?>

          <?php
            if (!$user['is_intro_private'] && $user['intro']){
          ?>
          <div class="control-group">
            <label class="control-label span2" for="intro">简介</label>

            <div class="controls">
              <textarea rows="4" class="span9"
                        id="intro" name="intro"disabled><?php
                echo $user['intro'];
                ?></textarea>
            </div>
          </div>
          <?php
            }
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
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
do_html_header("用户资料");
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

        <dl class="dl-horizontal">
          <dt class="span2">邮箱</dt>
          <dd class="span9">
            <?php
            echo $user['email'];
            ?>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt class="span2">昵称</dt>
          <dd class="span9">
            <?php
            echo $user['name'];
            ?>
          </dd>
        </dl>

        <?php
        if (!$user['is_phone_private'] && $user['phone']){
          ?>
          <dl class="dl-horizontal">
            <dt class="span2">手机号码</dt>
            <dd class="span9">
              <?php
              echo $user['phone'];
              ?>
            </dd>
          </dl>
        <?php
        }
        ?>

        <?php
        if (!$user['is_location_private'] && $user['location']){
          ?>
          <dl class="dl-horizontal">
            <dt class="span2">所在地</dt>
            <dd class="span9">
              <?php
              echo $user['location'];
              ?>
            </dd>
          </dl>
        <?php
        }
        ?>

        <dl class="dl-horizontal">
          <dt class="span2">简介</dt>
          <dd class="span9">
            <pre class="help-inline span10"
                 id="intro" name="intro"><?php
              echo $user['intro'];
              ?></pre>
          </dd>
        </dl>

      </div>

    </div>
  </div>

<?php
do_html_footer();
?>
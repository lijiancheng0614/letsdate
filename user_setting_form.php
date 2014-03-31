<?php ob_start();
session_start();
require_once('include.php');
if (isset($_SESSION['valid_user'])){
  $email = $_SESSION['valid_user'];
  $user = get_user_detail($email);
}
else{
  $_SESSION['error'] = "您还没有登录！";
  header("location:login.php");
  exit();
}
do_html_header('账户设置');
?>

  <div class="container">
    <div class="row-fluid">
      <form class="span9 form-horizontal well"
            method="post" action="user_setting.php">
        <h2>账户设置</h2>
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

        <dl class="dl-horizontal">
          <dt class="span2">邮箱</dt>
          <dd class="span9">
            <input type="text"
                   id="email" name="email" placeholder="邮箱"
              <?php
              echo 'value="';
              echo $user['email'];
              echo '"';
              ?>
                   disabled>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt class="span2">昵称</dt>
          <dd class="span9">
            <input type="text"
                   id="username" name="username" placeholder="昵称"
              <?php
              echo 'value="';
              echo $user['name'];
              echo '"';
              ?>
                   required>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt class="span2">手机号码</dt>
          <dd class="span9">
            <input type="text"
                   id="phone" name="phone" placeholder="请输入手机号码"
              <?php
              echo 'value="';
              echo $user['phone'];
              echo '"';
              ?>
              >
            <label class="offset2 help-inline checkbox">
              <input type="checkbox" id="checkbox"
                     name="checkbox[]" value="is_phone_private"
                <?php
                if ($user['is_phone_private'])
                  echo "checked";
                ?>
                >不公开
            </label>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt class="span2">所在地</dt>
          <dd class="span9">
            <input type="text"
                   id="location" name="location" placeholder="请输入您的所在地"
              <?php
              echo 'value="';
              echo $user['location'];
              echo '"';
              ?>
              >
            <label class="offset2 help-inline checkbox">
              <input type="checkbox" id="checkbox"
                     name="checkbox[]" value="is_location_private"
                <?php
                if ($user['is_location_private'])
                  echo "checked";
                ?>
                >不公开
            </label>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt class="span2">简介</dt>
          <dd class="span9">
            <textarea class="help-inline span10" rows="4" placeholder="请输入简介"
                      id="intro" name="intro"><?php
              echo $user['intro'];
              ?></textarea>
          </dd>
        </dl>

        <button class="offset3 btn btn-large btn-warning" type="submit">
          &nbsp;保存&nbsp;
        </button>
      </form>
    </div>
  </div>

<?php
do_html_footer();
?>